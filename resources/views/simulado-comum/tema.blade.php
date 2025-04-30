@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 text-gray-800">
    <h1 class="text-2xl font-bold mb-4 text-center">{{ $tema['titulo'] }}</h1>

    <div class="mb-6">
        <img src="{{ asset('images/temas/' . $tema['imagem']) }}"
             onerror="this.onerror=null; this.src='{{ asset('images/temas/default.jpg') }}';"
             alt="Imagem do tema {{ $tema['titulo'] }}"
             class="w-full h-60 object-cover rounded-md">
    </div>

    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-lg font-semibold mb-2">Textos de Apoio</h2>
        <ul class="list-disc list-inside space-y-2">
            @foreach ($tema['textos'] as $texto)
                <li>{{ $texto }}</li>
            @endforeach
        </ul>
    </div>

    {{-- Botão para iniciar o simulado --}}
    <div class="text-center mb-6">
        <button onclick="iniciarSimulado()" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
            Iniciar Simulado
        </button>
    </div>

    {{-- Timer e botões de controle (inicialmente oculto) --}}
    <div id="timerContainer" class="text-center hidden">
        <p class="text-lg font-semibold">Tempo: <span id="timer">00:00</span></p>
        <button id="pausarTimer" class="mt-4 px-4 py-2 bg-yellow-500 text-white rounded" onclick="pausarTimer()">Pausar</button>
        <button id="finalizarSimulado" class="mt-2 px-4 py-2 bg-red-500 text-white rounded" onclick="finalizarSimulado()">Finalizar</button>
    </div>
</div>

<script>
    let tempo = 0;
    let timerAtivo = false;
    let timerInterval = null;

    function iniciarSimulado() {
        // Evita múltiplos inícios
        if (timerInterval) return;

        timerAtivo = true;
        document.getElementById("timerContainer").classList.remove("hidden");

        timerInterval = setInterval(() => {
            if (timerAtivo) {
                tempo++;
                let min = String(Math.floor(tempo / 60)).padStart(2, '0');
                let seg = String(tempo % 60).padStart(2, '0');
                document.getElementById("timer").textContent = `${min}:${seg}`;
            }
        }, 1000);
    }

    function pausarTimer() {
        timerAtivo = !timerAtivo;
        document.getElementById("pausarTimer").textContent = timerAtivo ? "Pausar" : "Retomar";
    }

    function finalizarSimulado() {
        clearInterval(timerInterval);
        alert("Simulado finalizado! Tempo total: " + document.getElementById("timer").textContent);
    }
</script>
@endsection
