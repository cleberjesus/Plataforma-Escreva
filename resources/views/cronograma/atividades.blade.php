@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Atividades do Cronograma: {{ $cronograma->titulo }}</h2>

    <form action="{{ route('cronograma.atividades.store', $cronograma->id) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium">Descrição:</label>
            <input type="text" name="descricao" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Data:</label>
            <input type="date" name="data" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Adicionar Atividade</button>
    </form>

    <hr class="my-6">

    @if($atividades->count())
        <ul class="space-y-3">
            @foreach($atividades as $atividade)
                <li class="p-4 border rounded shadow flex justify-between items-center">
                    <div>
                        <p class="font-semibold">{{ $atividade->descricao }}</p>
                        <p class="text-sm text-gray-600">Data: {{ \Carbon\Carbon::parse($atividade->data)->format('d/m/Y') }}</p>
                    </div>
                    <form action="{{ route('cronograma.atividades.destroy', $atividade->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 hover:underline">Excluir</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-500">Nenhuma atividade ainda.</p>
    @endif
</div>
@endsection
