<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        // Buscar usuários com a contagem de redações enviadas
        $users = User::withCount('redacoes')
            ->orderByDesc('redacoes_count') // Ordena pelo número de redações
            ->take(10) // Pega os 10 melhores
            ->get();

        return view('ranking.index', compact('users'));
    }
}
