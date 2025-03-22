@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-center mb-4" style="color: white;">Simulado Comum</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <label for="tema" class="block font-medium text-lg">Escolha um tema:</label>
        <select id="tema" class="mt-2 p-2 border rounded w-full" onchange="exibirTextoMotivador()">
            <option value="">Selecione um tema...</option>
            @foreach ($temas as $tema)
                <option value="{{ $tema }}">{{ $tema }}</option>
            @endforeach
        </select>

        <div id="textoMotivador" class="mt-4 p-4 bg-gray-100 rounded hidden">
            <p class="font-semibold">Texto Motivador:</p>
            <p id="motivadorContent" class="mt-2"></p>
        </div>

        <button id="iniciarSimulado" class="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full">
             Iniciar Simulado
        </button>

    </div>
</div>

<script>
    let textosMotivadores = @json($textosMotivadores);

    function exibirTextoMotivador() {
        let temaSelecionado = document.getElementById("tema").value;
        let motivadorDiv = document.getElementById("textoMotivador");
        let motivadorContent = document.getElementById("motivadorContent");
        let iniciarSimulado = document.getElementById("iniciarSimulado");

        if (temaSelecionado) {
            let textos = textosMotivadores[temaSelecionado];
            motivadorContent.textContent = textos[Math.floor(Math.random() * textos.length)];
            motivadorDiv.classList.remove("hidden");
            iniciarSimulado.classList.remove("hidden");
        } else {
            motivadorDiv.classList.add("hidden");
            iniciarSimulado.classList.add("hidden");
        }
    }
</script>
@endsection
