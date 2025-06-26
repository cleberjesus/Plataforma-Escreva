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

        $processNota = proc_open(
            'python ' . base_path('scripts/IA_TCC/inferencia.py'),
            [
                0 => ['pipe', 'r'],
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w']
            ],
            $pipesNota
        );

        $nota = null;
        if (is_resource($processNota)) {
            fwrite($pipesNota[0], $texto);
            fclose($pipesNota[0]);

            $nota = trim(stream_get_contents($pipesNota[1]));
            fclose($pipesNota[1]);

            $notaError = stream_get_contents($pipesNota[2]);
            fclose($pipesNota[2]);

            $notaReturn = proc_close($processNota);
            if ($notaReturn !== 0) {
                return response()->json(['erro' => 'Erro no script de nota: ' . $notaError], 500);
            }
        }

        // ===== INFERÊNCIA DO FEEDBACK =====
        $processFeedback = proc_open(
            'python ' . base_path('scripts/IA_analise/main.py'),
            [
                0 => ['pipe', 'r'],
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w']
            ],
            $pipesFeedback
        );

        $feedback = null;
        if (is_resource($processFeedback)) {
            fwrite($pipesFeedback[0], $texto);
            fclose($pipesFeedback[0]);

            $feedback = trim(stream_get_contents($pipesFeedback[1]));
            fclose($pipesFeedback[1]);

            $feedbackError = stream_get_contents($pipesFeedback[2]);
            fclose($pipesFeedback[2]);

            $feedbackReturn = proc_close($processFeedback);
            if ($feedbackReturn !== 0) {
                return response()->json(['erro' => 'Erro no script de feedback: ' . $feedbackError], 500);
            }
        }

        $feedbackDecoded = json_decode($feedback, true);

        $redacao->corrigida = true;
        $redacao->save();

        return view('resultado', [
            'nota' => $nota,
            'feedback' => $feedbackDecoded,
            'redacao_id' => $redacao->id,
        ]);
    }
}