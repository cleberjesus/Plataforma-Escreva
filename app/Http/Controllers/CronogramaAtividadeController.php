<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cronograma;
use App\Models\CronogramaAtividade;
use Carbon\Carbon;

class CronogramaAtividadeController extends Controller
{
    public function index($cronogramaId)
    {
        $cronograma = Cronograma::with('atividades')->findOrFail($cronogramaId);

        if ($cronograma->user_id !== auth()->id()) {
            abort(403);
        }

        return view('cronograma.atividades.index', compact('cronograma'));
    }

    public function store(Request $request, $cronogramaId)
    {
        $request->validate([
            'data' => 'required|date',
        ]);

        $cronograma = Cronograma::findOrFail($cronogramaId);

        if ($cronograma->user_id !== auth()->id()) {
            abort(403);
        }

        $dataMarcada = Carbon::parse($request->data);

        // Valida se está dentro do intervalo
        if ($dataMarcada->lt(Carbon::parse($cronograma->inicio))) {
            return redirect()->back()->with('error', 'Essa data é anterior ao início do cronograma.');
        }

        if ($cronograma->fim && $dataMarcada->gt(Carbon::parse($cronograma->fim))) {
            return redirect()->back()->with('error', 'Essa data é posterior ao fim do cronograma.');
        }

        // Mapeia os dias da semana
        $mapaSemana = [
            0 => 'domingo',
            1 => 'segunda',
            2 => 'terca',
            3 => 'quarta',
            4 => 'quinta',
            5 => 'sexta',
            6 => 'sabado'
        ];

        $diaDaSemana = $mapaSemana[$dataMarcada->dayOfWeek];

        if (!in_array($diaDaSemana, $cronograma->dias_da_semana)) {
            return redirect()->back()->with('error', 'Esse dia da semana não faz parte do cronograma.');
        }

        // Salva ou atualiza a atividade
        CronogramaAtividade::updateOrCreate(
            [
                'cronograma_id' => $cronograma->id,
                'data' => $dataMarcada->toDateString(),
            ],
            [
                'concluido' => true
            ]
        );

        return redirect()->back()->with('success', 'Dia marcado como concluído!');
    }

    public function destroy($id)
    {
        $atividade = CronogramaAtividade::findOrFail($id);

        if ($atividade->cronograma->user_id !== auth()->id()) {
            abort(403);
        }

        $atividade->delete();

        return redirect()->back()->with('success', 'Dia removido do cronograma.');
    }
}
