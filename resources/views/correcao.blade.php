@extends('layouts.app')

@section('title', 'Resultado da Correção')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-4">Resultado da Correção</h2>
    <p><strong>Nota:</strong> {{ $nota }}</p>
    <div class="mt-4">
        <strong>Feedback:</strong>
        <pre class="bg-gray-100 p-4 rounded">{{ is_array($feedback) ? json_encode($feedback, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : $feedback }}</pre>
    </div>
    <a href="{{ route('redacoes.index') }}" class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Voltar</a>
</div>
@endsection