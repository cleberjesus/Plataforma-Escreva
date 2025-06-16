@extends('layouts.app')

@section('title', 'Visualizar Redação')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-4 lg:px-8">
        <x-back-button url="{{ route('redacoes.index') }}" />

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 sm:p-10">
                <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">{{ $redacao->tema }}</h2>
                <p class="text-gray-500 text-sm mb-6 text-center">
                    Enviado em {{ $redacao->created_at->format('d/m/Y H:i') }}
                </p>

                @if ($redacao->modo_envio === 'digitado')
                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <p class="whitespace-pre-wrap text-gray-800">{{ $redacao->texto_redacao }}</p>
                    </div>
                @elseif ($redacao->modo_envio === 'imagem' && $redacao->imagem_redacao)
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('storage/' . $redacao->imagem_redacao) }}" class="rounded-lg shadow-md max-w-full max-h-[500px]">
                    </div>
                @endif

                <div class="flex justify-center">
                    <a href="{{ route('redacoes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold text-center">Voltar para a listagem</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 