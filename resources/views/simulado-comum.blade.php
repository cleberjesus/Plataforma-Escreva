@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-center mb-6 text-white">Simulado Comum</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
        <label for="tema" class="block font-medium text-lg">Escolha um tema:</label>
        <select id="tema" class="mt-2 p-2 border rounded w-full" onchange="exibirTextoMotivador()">
            <option value="">Selecione um tema...</option>
            @foreach ($temas as $slug => $tema)
                <option value="{{ $slug }}">{{ $tema['titulo'] }}</option>
            @endforeach
        </select>

        <div id="textoMotivador" class="mt-4 p-4 bg-gray-100 rounded hidden">
            <p class="font-semibold text-gray-700">Texto Motivador:</p>
            <p id="motivadorContent" class="mt-2 text-gray-600"></p>
        </div>

        <button id="iniciarSimulado" 
            class="mt-6 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded w-full hidden"
            onclick="iniciarSimulado()">
             Iniciar Simulado
        </button>

        <div id="timerContainer" class="mt-4 hidden text-center">
            <p class="text-lg font-semibold">Tempo: <span id="timer">00:00</span></p>
            <button id="pausarTimer" class="mt-2 px-4 py-2 bg-yellow-500 text-white rounded hidden" onclick="pausarTimer()">Pausar</button>
            <button id="finalizarSimulado" class="mt-2 px-4 py-2 bg-red-500 text-white rounded hidden" onclick="finalizarSimulado()">Finalizar</button>
        </div>
    </div>
</div>

<script>
    // Os textos estão organizados por slug
    let textosMotivadores = @json(array_map(fn($t) => $t['textos'], $temas));
    let tempo = 0;
    let timerAtivo = false;
    let timerInterval;

    function exibirTextoMotivador() {
        let temaSelecionado = document.getElementById("tema").value;
        let motivadorDiv = document.getElementById("textoMotivador");
        let motivadorContent = document.getElementById("motivadorContent");
        let iniciarSimulado = document.getElementById("iniciarSimulado");

        if (temaSelecionado && textosMotivadores[temaSelecionado]) {
            let textos = textosMotivadores[temaSelecionado];
            motivadorContent.textContent = textos[Math.floor(Math.random() * textos.length)];
            motivadorDiv.classList.remove("hidden");
            iniciarSimulado.classList.remove("hidden");
        } else {
            motivadorDiv.classList.add("hidden");
            iniciarSimulado.classList.add("hidden");
        }
    }

    function iniciarSimulado() {
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
        document.getElementById("iniciarSimulado").classList.add("hidden");
    }
</script>
@endsection
