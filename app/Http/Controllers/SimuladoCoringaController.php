<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Redacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimuladoCoringaController extends Controller
{
    private $temposPorNivel = [
        'iniciante' => 3600,     // Exatamente 60:00 minutos em segundos
        'intermediario' => 2100,  // Exatamente 35:00 minutos em segundos
        'avancado' => 1200       // Exatamente 20:00 minutos em segundos
    ];

    public function index()
    {
        $user = Auth::user();
        $tempoLimite = $this->temposPorNivel[$user->nivel];
        
        return view('simulado-coringa', [
            'tempoLimite' => $tempoLimite,
            'nivel' => $user->nivel
        ]);
    }

    public function gerarTema()
    {
        // Busca um tema aleatório do banco de dados
        $tema = Tema::with('textosMotivadores')->inRandomOrder()->first();

        if (!$tema) {
            return response()->json(['error' => 'Nenhum tema encontrado'], 404);
        }

        // Prepara os textos motivadores
        $textos = $tema->textosMotivadores->pluck('texto')->toArray();
        
        // Prepara as charges (filtra apenas as que não são nulas)
        $charges = $tema->textosMotivadores->pluck('charge')->filter()->toArray();

        $user = Auth::user();
        $tempoLimite = $this->temposPorNivel[$user->nivel];

        return response()->json([
            'tema' => $tema->titulo,
            'textos' => $textos,
            'imagem' => $tema->imagem,
            'charges' => $charges,
            'tempoLimite' => $tempoLimite
        ]);
    }

    public function salvarRedacao(Request $request)
    {
        $request->validate([
            'texto' => 'required|string',
            'tema' => 'required|string',
            'tempo_gasto' => 'required|integer'
        ]);

        $redacao = new Redacao([
            'texto_redacao' => $request->texto,
            'tema' => $request->tema,
            'modo_envio' => 'simulado_coringa',
            'tempo_gasto' => $request->tempo_gasto
        ]);

        Auth::user()->redacoes()->save($redacao);

        return response()->json(['message' => 'Redação salva com sucesso', 'id' => $redacao->id]);
    }
}
