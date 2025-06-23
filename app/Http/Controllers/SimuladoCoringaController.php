<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Redacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SimuladoCoringaController extends Controller
{
    private $temposPorNivel = [
        'iniciante' => 3600,     // 60 minutos
        'intermediario' => 2100,  // 35 minutos
        'avancado' => 1200       // 20 minutos
    ];

    public function index()
    {
        $user = Auth::user();
        $tempoLimite = $this->temposPorNivel[$user->nivel ?? 'iniciante'];
        
        return view('simulado-coringa', [
            'tempoLimite' => $tempoLimite,
            'nivel' => $user->nivel ?? 'iniciante'
        ]);
    }

    public function gerarTema()
    {
        try {
            // Busca um tema aleatório do banco de dados
            $tema = Tema::with('textosMotivadores')->inRandomOrder()->first();

            if (!$tema) {
                return response()->json([
                    'error' => 'Nenhum tema encontrado no banco de dados'
                ], 404);
            }

            // Prepara os textos motivadores
            $textos = $tema->textosMotivadores->pluck('texto')->toArray();
            
            // Prepara as charges (filtra apenas as que não são nulas)
            $charges = $tema->textosMotivadores->pluck('charge')->filter()->toArray();

            $user = Auth::user();
            $tempoLimite = $this->temposPorNivel[$user->nivel ?? 'iniciante'];

            return response()->json([
                'tema' => $tema->titulo,
                'textos' => $textos,
                'imagem' => $tema->imagem,
                'charges' => $charges,
                'tempoLimite' => $tempoLimite,
                'success' => true
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao gerar tema do simulado coringa: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Erro interno do servidor ao gerar tema',
                'message' => 'Tente novamente em alguns instantes'
            ], 500);
        }
    }

    public function salvarRedacao(Request $request)
    {
        try {
            $request->validate([
                'texto' => 'required|string|min:10',
                'tema' => 'required|string|max:255',
                'tempo_gasto' => 'required|integer|min:0'
            ]);

            $user = Auth::user();

            $redacao = new Redacao([
                'texto_redacao' => $request->texto,
                'tema' => $request->tema,
                'modo_envio' => 'simulado_coringa',
                'tempo_gasto' => $request->tempo_gasto,
                'corrigida' => false
            ]);

            $user->redacoes()->save($redacao);

            Log::info("Redação do simulado coringa salva com sucesso", [
                'user_id' => $user->id,
                'redacao_id' => $redacao->id,
                'tema' => $request->tema,
                'tempo_gasto' => $request->tempo_gasto
            ]);

            return response()->json([
                'message' => 'Redação salva com sucesso!',
                'id' => $redacao->id,
                'success' => true
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Dados inválidos',
                'message' => 'Verifique os dados enviados',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Erro ao salvar redação do simulado coringa: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Erro interno do servidor',
                'message' => 'Não foi possível salvar a redação. Tente novamente.'
            ], 500);
        }
    }

    public function finalizarSimulado(Request $request)
    {
        try {
            $request->validate([
                'tema' => 'required|string',
                'tempo_gasto' => 'required|integer|min:0'
            ]);

            $user = Auth::user();

            // Aqui você pode adicionar lógica adicional para finalizar o simulado
            // Por exemplo, salvar estatísticas, marcar como concluído, etc.

            return response()->json([
                'message' => 'Simulado finalizado com sucesso!',
                'success' => true
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao finalizar simulado coringa: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Erro interno do servidor',
                'message' => 'Não foi possível finalizar o simulado.'
            ], 500);
        }
    }

    public function iniciar(Request $request)
    {
        try {
            $request->validate([
                'nivel' => 'required|in:iniciante,intermediario,avancado'
            ]);

            $user = Auth::user();
            $user->update(['nivel' => $request->nivel]);

            return response()->json([
                'message' => 'Nível definido com sucesso!',
                'tempo_limite' => $this->temposPorNivel[$request->nivel],
                'success' => true
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao iniciar simulado coringa: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Erro interno do servidor',
                'message' => 'Não foi possível iniciar o simulado.'
            ], 500);
        }
    }
}
