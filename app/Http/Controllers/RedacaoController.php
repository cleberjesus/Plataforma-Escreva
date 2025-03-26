<?php

namespace App\Http\Controllers;

use App\Models\Redacao;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RedacaoController extends Controller
{
    public function index()
    {
        $redacoes = Redacao::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('redacoes.index', compact('redacoes'));
    }

    public function store(Request $request)
    {
        $request->validate([    
            'tema' => 'required|string|max:255',
            'texto_redacao' => 'nullable|string',
            'imagem_redacao' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'modo_envio' => 'required|in:digitado,imagem',
        ]);

        $redacao = new Redacao();
        $redacao->user_id = Auth::id();
        $redacao->tema = $request->tema;
        $redacao->modo_envio = $request->modo_envio;
        $redacao->data = now();
        $redacao->created_at = now();
        $redacao->updated_at = now();

        if ($request->modo_envio === 'digitado') {
            $redacao->texto_redacao = $request->texto_redacao;
        } else {
            if ($request->hasFile('imagem_redacao')) {
                $path = $request->file('imagem_redacao')->store('redacoes', 'public');
                $redacao->imagem_redacao = $path;
            }
        }

        $redacao->save();

        // Verifica e concede conquistas ao usuário
        $this->checkAchievements(Auth::user(), $redacao);

        return redirect()->route('redacoes.index')->with('success', 'Redação salva com sucesso!');
    }

    protected function checkAchievements($user, $redacao)
    {
        // Conta quantas redações o usuário já escreveu
        $totalRedacoes = Redacao::where('user_id', $user->id)->count();

        // Primeira redação enviada
        if ($totalRedacoes == 1) {
            $this->awardAchievement($user, 'Primeira Redação Enviada');
        }

        // 5 redações concluídas
        if ($totalRedacoes == 5) {
            $this->awardAchievement($user, '5 Redações Concluídas');
        }

        // Escreveu mais de 1000 palavras em uma redação digitada
        if ($redacao->modo_envio === 'digitado' && str_word_count($redacao->texto_redacao) >= 1000) {
            $this->awardAchievement($user, 'Escreveu mais de 1000 palavras em uma redação');
        }
    }

    protected function awardAchievement($user, $achievementName)
    {
        // Busca a conquista no banco de dados
        $achievement = Achievement::where('name', $achievementName)->first();

        // Se a conquista existe e o usuário ainda não a possui
        if ($achievement && !$user->achievements->contains($achievement->id)) {
            $user->achievements()->attach($achievement->id, ['achieved_at' => Carbon::now()]);
        }
    }
}
