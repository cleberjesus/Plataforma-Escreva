<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;

class SimuladoCoringaController extends Controller
{
    public function index()
    {
        return view('simulado-coringa');
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

        return response()->json([
            'tema' => $tema->titulo,
            'textos' => $textos,
            'imagem' => $tema->imagem,
            'charges' => $charges
        ]);
    }
}
