@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-center mb-6 text-black">Simulado Comum</h1>

    {{-- Cards dos temas --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($temas as $slug => $tema)
            <a href="{{ route('simulado.tema', ['tema' => $slug]) }}" class="block bg-white p-4 rounded-lg shadow hover:bg-gray-100 transition">
                <img src="{{ asset('images/temas/' . $tema['imagem']) }}"
                     onerror="this.onerror=null; this.src='{{ asset('images/temas/default.jpg') }}';"
                     alt="Imagem do tema {{ $tema['titulo'] }}"
                     class="w-full h-40 object-cover rounded-md mb-4">
                <h2 class="text-lg font-semibold text-gray-800">{{ $tema['titulo'] }}</h2>
                <p class="text-sm text-gray-600 mt-2">Clique para iniciar o simulado com esse tema</p>
            </a>
        @endforeach
    </div>
</div>

    {{-- Texto motivador e botão de início --}}
    <div id="textoMotivador" class="mt-8 p-6 bg-white rounded shadow hidden">
        <p class="font-semibold text-gray-700 text-lg">Texto Motivador:</p>
        <p id="motivadorContent" class="mt-2 text-gray-600"></p>

        <button id="iniciarSimulado" 
            class="mt-6 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"
            onclick="iniciarSimulado()">
            Iniciar Simulado
        </button>
    </div>

    {{-- Temporizador e botões de controle --}}
    <div id="timerContainer" class="mt-6 hidden text-center">
        <p class="text-lg font-semibold">Tempo: <span id="timer">00:00</span></p>
        <button id="pausarTimer" class="mt-2 px-4 py-2 bg-yellow-500 text-white rounded hidden" onclick="pausarTimer()">Pausar</button>
        <button id="finalizarSimulado" class="mt-2 px-4 py-2 bg-red-500 text-white rounded hidden" onclick="finalizarSimulado()">Finalizar</button>
    </div>
</div>

<script>
    let textosMotivadores = @json(array_map(fn($t) => $t['textos'], $temas));
    let tempo = 0;
    let timerAtivo = false;
    let timerInterval;

    function selecionarTema(slug) {
        const motivadorDiv = document.getElementById("textoMotivador");
        const motivadorContent = document.getElementById("motivadorContent");
        const iniciarSimulado = document.getElementById("iniciarSimulado");

        if (textosMotivadores[slug]) {
            let textos = textosMotivadores[slug];
            motivadorContent.textContent = textos[Math.floor(Math.random() * textos.length)];
            motivadorDiv.classList.remove("hidden");
            iniciarSimulado.dataset.temaSlug = slug;
        }
    }

    function iniciarSimulado() {
    if (timerAtivo) return; // evita iniciar múltiplas vezes

    tempo = 0;
    timerAtivo = true;
    document.getElementById("timerContainer").classList.remove("hidden");
    document.getElementById("pausarTimer").classList.remove("hidden");
    document.getElementById("finalizarSimulado").classList.remove("hidden");

    timerInterval = setInterval(() => {
        if (timerAtivo) {
            tempo++;
            let minutos = String(Math.floor(tempo / 60)).padStart(2, '0');
            let segundos = String(tempo % 60).padStart(2, '0');
            document.getElementById("timer").textContent = `${minutos}:${segundos}`;
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
        document.getElementById("timerContainer").classList.add("hidden");
        document.getElementById("pausarTimer").classList.add("hidden");
        document.getElementById("finalizarSimulado").classList.add("hidden");
    }
</script>
@endsection
