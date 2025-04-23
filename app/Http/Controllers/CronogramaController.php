<?php

namespace App\Http\Controllers;

use App\Models\Cronograma;
use Illuminate\Http\Request;

class CronogramaController extends Controller
{
    public function index()
    {
        $cronogramas = Cronograma::where('user_id', auth()->id())->get();
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
