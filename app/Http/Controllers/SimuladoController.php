<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SimuladoController extends Controller
{
    public function simuladoCoringa()
    {
        $charges = File::files(public_path('images/charges'));
        $charge = $charges[array_rand($charges)]->getFilename();
        
        return view('simulado-coringa', compact('charge'));
    }

    public function simuladoComum()
    {
        $charges = File::files(public_path('images/charges'));
        $charge = $charges[array_rand($charges)]->getFilename();
        
        return view('simulado-comum', compact('charge'));
    }
} 