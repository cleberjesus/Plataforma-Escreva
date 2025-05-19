@extends('layouts.app')

@section('title', 'dfd')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-back-button />
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-6 text-gray-800">Simulado Comum</h1>
                
                <!-- Timer -->
                <div class="mb-6">
                    <div class="text-center">
                        <span class="text-3xl font-bold text-blue-600" id="timer">00:00:00</span>
                    </div>
                </div>

                <!-- Charge -->
                @if(isset($charge))
                <div class="mb-8">
                    <div class="max-w-2xl mx-auto">
                        <img src="{{ asset('images/charges/' . $charge) }}" alt="Charge" class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                </div>
                @endif

                <!-- Formulário de Redação -->
                <form method="POST" action="{{ route('redacoes.store') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="tipo" value="comum">
                    @if(isset($charge))
                    <input type="hidden" name="charge" value="{{ $charge }}">
                    @endif

                    <div>
                        <label for="titulo" class="block text-sm font-medium text-gray-700">Título da Redação</label>
                        <input type="text" name="titulo" id="titulo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="conteudo" class="block text-sm font-medium text-gray-700">Conteúdo da Redação</label>
                        <textarea name="conteudo" id="conteudo" rows="15" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Enviar Redação
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let startTime = Date.now();
    let timerInterval;
    let ultimaAtualizacao = Date.now();

    function atualizarTimer() {
        const agora = Date.now();
        const tempoDecorrido = agora - startTime;
        const segundos = Math.floor(tempoDecorrido / 1000);
        const minutos = Math.floor(segundos / 60);
        const horas = Math.floor(minutos / 60);

        const displaySegundos = (segundos % 60).toString().padStart(2, '0');
        const displayMinutos = (minutos % 60).toString().padStart(2, '0');
        const displayHoras = horas.toString().padStart(2, '0');

        document.getElementById('timer').textContent = `${displayHoras}:${displayMinutos}:${displaySegundos}`;
        ultimaAtualizacao = agora;
        requestAnimationFrame(atualizarTimer);
    }

    // Iniciar o timer quando a página carregar
    window.onload = function() {
        requestAnimationFrame(atualizarTimer);
    };
</script>
@endsection 