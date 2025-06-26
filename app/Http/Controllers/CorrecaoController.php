<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Correcao;

class CorrecaoController extends Controller
{
    public function resultado(Request $request, $id)
    {
        $redacao = \App\Models\Redacao::findOrFail($id);

        if ($redacao->corrigida) {
            return redirect()->route('redacoes.show', $id)
                ->with('info', 'Esta redação já foi corrigida.');
        }

        $texto = $redacao->texto_redacao;

        // Simulação de correção manual (sem IA)
        // Nota simulada baseada no tamanho do texto
        $nota = min(1000, max(600, strlen($texto) / 10));
        
        // Feedback simulado
        $feedbackDecoded = [
            'competencias' => [
                'competencia1' => [
                    'nota' => min(200, max(120, strlen($texto) / 50)),
                    'comentario' => 'Demonstra domínio da norma culta da língua escrita.'
                ],
                'competencia2' => [
                    'nota' => min(200, max(120, strlen($texto) / 50)),
                    'comentario' => 'Compreende a proposta e aplica conceitos das várias áreas de conhecimento.'
                ],
                'competencia3' => [
                    'nota' => min(200, max(120, strlen($texto) / 50)),
                    'comentario' => 'Seleciona, relaciona, organiza e interpreta informações.'
                ],
                'competencia4' => [
                    'nota' => min(200, max(120, strlen($texto) / 50)),
                    'comentario' => 'Demonstra conhecimento dos mecanismos linguísticos necessários.'
                ],
                'competencia5' => [
                    'nota' => min(200, max(120, strlen($texto) / 50)),
                    'comentario' => 'Elabora proposta de intervenção para o problema abordado.'
                ]
            ],
            'comentario_geral' => 'Redação bem estruturada com argumentação adequada ao tema proposto.'
        ];

        $redacao->corrigida = true;
        $redacao->save();

        return view('resultado', [
            'nota' => $nota,
            'feedback' => $feedbackDecoded,
            'redacao_id' => $redacao->id,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'redacao_id' => 'required|exists:redacoes,id',
            'nota' => 'required|integer|min:0|max:1000',
            'feedback' => 'nullable|string',
        ]);

        $correcao = new Correcao();
        $correcao->user_id = auth()->id();
        $correcao->redacao_id = $request->redacao_id;
        $correcao->nota = $request->nota;
        $correcao->feedback = $request->feedback;
        $correcao->data = now();
        $correcao->save();

        return response()->json(['status' => 'ok']);
    }
}
