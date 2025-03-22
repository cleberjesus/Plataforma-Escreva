<?php

namespace App\Http\Controllers;

use App\Models\Redacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->route('redacoes.index')->with('success', 'Redação salva com sucesso!');
    }
}
