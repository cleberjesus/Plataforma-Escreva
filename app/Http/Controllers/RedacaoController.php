<?php

namespace App\Http\Controllers;

use App\Models\Redacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RedacaoController extends Controller
{
    public function index(Request $request)
    {
        $redacoes = Redacao::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $redacaoEditando = null;

        if ($request->has('edit')) {
            $redacaoEditando = Redacao::where('id', $request->edit)
                ->where('user_id', Auth::id())
                ->first();
        }

        return view('redacoes.index', compact('redacoes', 'redacaoEditando'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tema' => 'required|string|max:255',
            'modo_envio' => 'required|in:digitado,imagem',
            'texto_redacao' => 'nullable|string',
            'imagem_redacao' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->has('redacao_id')) {
            return $this->update($request, $request->redacao_id);
        }

        $redacao = new Redacao();
        $redacao->user_id = Auth::id();
        $redacao->created_at = now();
        $redacao->data = now();
        $redacao->tema = $request->tema;
        $redacao->modo_envio = $request->modo_envio;

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

    public function update(Request $request, $id)
    {
        $redacao = Redacao::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'tema' => 'required|string|max:255',
            'modo_envio' => 'required|in:digitado,imagem',
            'texto_redacao' => 'nullable|string',
            'imagem_redacao' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $redacao->tema = $request->tema;
        $redacao->modo_envio = $request->modo_envio;
        $redacao->updated_at = now();

        if ($request->modo_envio === 'digitado') {
            $redacao->texto_redacao = $request->texto_redacao;

            if ($redacao->imagem_redacao) {
                Storage::disk('public')->delete($redacao->imagem_redacao);
                $redacao->imagem_redacao = null;
            }
        } else {
            if ($request->hasFile('imagem_redacao')) {
                if ($redacao->imagem_redacao) {
                    Storage::disk('public')->delete($redacao->imagem_redacao);
                }
                $path = $request->file('imagem_redacao')->store('redacoes', 'public');
                $redacao->imagem_redacao = $path;
                $redacao->texto_redacao = null;
            }
        }

        $redacao->save();

        return redirect()->route('redacoes.index')->with('success', 'Redação atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $redacao = Redacao::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($redacao->imagem_redacao) {
            Storage::disk('public')->delete($redacao->imagem_redacao);
        }

        $redacao->delete();

        return redirect()->route('redacoes.index')->with('success', 'Redação deletada com sucesso!');
    }
}
