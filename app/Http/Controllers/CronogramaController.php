<?php

namespace App\Http\Controllers;

use App\Models\Cronograma;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CronogramaController extends Controller
{
    public function index()
    {
        $cronogramas = Cronograma::with('atividades')->where('user_id', auth()->id())->get();

        foreach ($cronogramas as $cronograma) {
            $inicio = Carbon::parse($cronograma->inicio);
            $fim = $cronograma->fim ? Carbon::parse($cronograma->fim) : now()->addMonths(1);
            $diasSelecionados = $cronograma->dias_da_semana;
            $diasJaMarcados = $cronograma->atividades->pluck('data')->toArray();

            $mapaSemana = [
                'domingo' => 0,
                'segunda' => 1,
                'terca' => 2,
                'quarta' => 3,
                'quinta' => 4,
                'sexta' => 5,
                'sabado' => 6
            ];

            $diasValidos = [];
            for ($data = $inicio->copy(); $data->lte($fim); $data->addDay()) {
                $diaDaSemana = $data->dayOfWeek;
                foreach ($diasSelecionados as $dia) {
                    if ($diaDaSemana == $mapaSemana[$dia] && !in_array($data->toDateString(), $diasJaMarcados)) {
                        $diasValidos[] = $data->copy();
                    }
                }
            }

            $cronograma->dias_validos = $diasValidos;
        }

        return view('cronograma.index', compact('cronogramas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'dias_da_semana' => 'required|array',
            'inicio' => 'required|date',
            'fim' => 'nullable|date|after_or_equal:inicio',
        ]);

        Cronograma::create([
            'user_id' => auth()->id(),
            'titulo' => $request->titulo,
            'dias_da_semana' => $request->dias_da_semana,
            'inicio' => $request->inicio,
            'fim' => $request->fim,
        ]);

        return redirect()->route('cronograma.index')->with('success', 'Cronograma criado com sucesso!');
    }

    public function destroy($id)
    {
        $cronograma = Cronograma::findOrFail($id);

        if ($cronograma->user_id === auth()->id()) {
            $cronograma->delete();
            return redirect()->route('cronograma.index')->with('success', 'Cronograma excluído!');
        }

        return redirect()->route('cronograma.index')->with('error', 'Ação não permitida.');
    }
}
