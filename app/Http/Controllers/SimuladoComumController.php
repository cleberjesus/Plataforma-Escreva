<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\TextoMotivador;
use Illuminate\Http\Request;

class SimuladoComumController extends Controller
{
    // Página inicial com cards dos temas
    public function index()
    {
        $temas = Tema::with('textosMotivadores')->get();
        return view('simulado-comum.index', compact('temas'));
    }

    // Página específica de um tema
    public function mostrarTema($slug)
    {
        $tema = Tema::where('slug', $slug)
            ->with('textosMotivadores')
            ->firstOrFail();

        $textosMotivadores = $tema->textosMotivadores;
        $charges = $textosMotivadores->pluck('charge')->filter()->values()->toArray();

        return view('simulado-comum.tema', compact('slug', 'tema', 'textosMotivadores', 'charges'));
    }
}