@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <!-- Botão Voltar -->
    <div class="mb-4">
        <button onclick="history.back()" class="flex items-center text-blue-600 hover:text-blue-800 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="text-sm md:text-base">Voltar</span>
        </button>
    </div>

    <h1 class="text-3xl font-extrabold text-center mb-6 text-black drop-shadow">Simulado Coringa</h1>

    <!-- Card de Boas-Vindas e Início -->
    <div id="inicioCard" class="hidden flex flex-col md:flex-row items-center justify-center gap-10 bg-white p-4 md:p-8 rounded-2xl shadow-xl mb-6">
        <div class="text-left text-gray-800 max-w-sm">
            <ul class="list-disc pl-5 space-y-2 font-medium text-base md:text-lg">
                <li>Pegue papel e caneta</li>
                <li>Prepare um ambiente calmo</li>
                <li>Respire fundo</li>
                <li>Este é seu momento de treino!</li>
                <li>Você é capaz, acredite!</li>
                <li>Aquela nota 1000 do ENEM é sua!</li>
            </ul>
        </div>
        <div class="text-center mt-4 md:mt-0">
            <p class="mb-4 font-semibold text-base md:text-lg text-gray-700">Você está pronto para começar o simulado?</p>
            <button id="btnInicioContagem" class="bg-blue-600 text-white px-6 md:px-8 py-2 md:py-3 rounded-full hover:bg-blue-700 transition duration-300 shadow-md text-sm md:text-base">Iniciar</button>
        </div>
    </div>

    <!-- Contagem regressiva -->
    <div id="contagemRegressiva" class="hidden text-4xl md:text-6xl text-center text-blue font-extrabold mb-6 animate-pulse"></div>

    <!-- Conteúdo principal -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 hidden" id="simuladoContainer">
        <!-- Área do tema e texto motivador -->
        <div class="bg-white p-4 rounded-2xl shadow-xl mx-auto w-full max-w-4xl">
            <div class="text-center">
                <div id="resultado" class="p-4 border border-gray-200 rounded-lg hidden bg-gray-50">
                    <!-- Tema -->
                    <div class="mb-4">
                        <h3 class="text-lg md:text-xl font-bold text-blue-700">
                            <span class="block text-gray-600 text-base mb-1">Tema:</span>
                            <span id="tema" class="leading-relaxed"></span>
                        </h3>
                    </div>
                    
                    <!-- Imagem do Tema -->
                    <div class="my-4">
                        <img id="imagemTema" src="" alt="Imagem do Tema" class="w-full h-auto max-h-[250px] object-contain rounded-lg shadow-md mx-auto hidden">
                    </div>

                    <!-- Textos Motivadores -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div id="textoMotivador1" class="bg-white p-4 rounded-lg border-l-4 border-blue-600 shadow-sm">
                            <h3 class="font-semibold mb-2 text-blue-700 text-base">Texto Motivador 1</h3>
                            <p class="text-sm text-gray-700 whitespace-pre-line break-words leading-snug"></p>
                        </div>
                        <div id="textoMotivador2" class="bg-white p-4 rounded-lg border-l-4 border-blue-600 shadow-sm">
                            <h3 class="font-semibold mb-2 text-blue-700 text-base">Texto Motivador 2</h3>
                            <p class="text-sm text-gray-700 whitespace-pre-line break-words leading-snug"></p>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>

        <!-- Timer fixo no canto direito em telas md+ -->
        <div class="hidden md:block">
            <div class="fixed top-24 right-8 z-40 flex flex-col items-center gap-4">
                <div class="circle-timer inline-block w-28 h-28 relative mb-2 bg-white rounded-full shadow-xl">
                    <svg id="timerSvg" viewBox="0 0 100 100" class="w-full h-full">
                        <circle cx="50" cy="50" r="42" stroke="#e9ecef" stroke-width="10" fill="none"></circle>
                        <circle id="progress" cx="50" cy="50" r="42" stroke="#3b82f6" stroke-width="10" fill="none"
                            stroke-dasharray="264" stroke-dashoffset="264" stroke-linecap="round"></circle>
                    </svg>
                    <div class="timer-text absolute inset-0 flex items-center justify-center text-2xl font-bold text-gray-800" id="timerText">00:00</div>
                </div>
                <div id="motivacionalTexto" class="text-blue-700 font-semibold text-center hidden text-lg"></div>
            </div>
        </div>
        <!-- Timer fixo para mobile -->
        <div class="md:hidden">
            <div class="fixed top-20 right-4 z-40 flex flex-col items-center gap-4">
                <div class="circle-timer inline-block w-24 h-24 relative mb-2 bg-white rounded-full shadow-xl">
                    <svg id="timerSvgMobile" viewBox="0 0 100 100" class="w-full h-full">
                        <circle cx="50" cy="50" r="42" stroke="#e9ecef" stroke-width="10" fill="none"></circle>
                        <circle id="progressMobile" cx="50" cy="50" r="42" stroke="#3b82f6" stroke-width="10" fill="none"
                            stroke-dasharray="264" stroke-dashoffset="264" stroke-linecap="round"></circle>
                    </svg>
                    <div class="timer-text absolute inset-0 flex items-center justify-center text-xl font-bold text-gray-800" id="timerTextMobile">00:00</div>
                </div>
                <div id="motivacionalTextoMobile" class="text-blue-700 font-semibold text-center hidden text-base bg-white p-2 rounded-lg shadow-md"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Avaliação de Nível -->
<div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 z-50" id="nivelModal">
    <div class="bg-white p-4 md:p-6 rounded-2xl shadow-2xl w-11/12 md:w-full max-w-md relative mx-4">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 focus:outline-none">
            <i class="bi bi-x-circle text-2xl"></i>
        </button>

        <h5 class="text-lg md:text-xl font-bold text-center mb-4 text-gray-800">Avaliação de Nível</h5>
        <form id="nivelForm" class="space-y-4">
            <div>
                <label for="experiencia" class="block font-medium text-gray-700 text-sm md:text-base">Qual sua experiência com redação?</label>
                <select id="experiencia" class="w-full p-2 border rounded focus:ring focus:border-blue-400 text-sm md:text-base" required>
                    <option value="">Selecione...</option>
                    <option value="iniciante">Nenhuma experiência</option>
                    <option value="intermediario">Já escrevi algumas redações</option>
                    <option value="avancado">Escrevo frequentemente</option>
                </select>
            </div>
            <div>
                <label for="frequencia" class="block font-medium text-gray-700 text-sm md:text-base">Com que frequência você escreve redações?</label>
                <select id="frequencia" class="w-full p-2 border rounded focus:ring focus:border-blue-400 text-sm md:text-base" required>
                    <option value="">Selecione...</option>
                    <option value="iniciante">Raramente</option>
                    <option value="intermediario">Uma vez por mês</option>
                    <option value="avancado">Toda semana</option>
                </select>
            </div>
            <div>
                <label for="conhecimento" class="block font-medium text-gray-700 text-sm md:text-base">Como avalia seu conhecimento em técnicas de redação?</label>
                <select id="conhecimento" class="w-full p-2 border rounded focus:ring focus:border-blue-400 text-sm md:text-base" required>
                    <option value="">Selecione...</option>
                    <option value="iniciante">Baixo</option>
                    <option value="intermediario">Médio</option>
                    <option value="avancado">Alto</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300 shadow text-sm md:text-base">Começar Simulado</button>
        </form>
    </div>
</div>

<!-- ÁUDIO DA CONTAGEM -->
<audio id="audioContagem" src="{{ asset('sounds/countdowngame.mp3') }}" preload="auto"></audio>

<audio id="audioContagem" src="https://cdn.pixabay.com/audio/2022/03/15/audio_95c8a22157.mp3" preload="auto"></audio>

<script>
let tempoTotal = 3600;
let tempoRestante = tempoTotal;
let intervalo, motivacaoIntervalo;
let ultimaAtualizacao = Date.now();
const timerText = document.getElementById('timerText');
const progressCircle = document.getElementById('progress');
const motivacionalTexto = document.getElementById('motivacionalTexto');
const audio = document.getElementById('audioContagem');

const frasesMotivacionais = [
    "Continue assim! Você está indo muito bem!",
    "Mantenha o foco, falta pouco!",
    "Você consegue, sua evolução tá vindo!",
    "A constância vai te levar à nota 1000!",
    "Respira fundo, você tá no caminho certo!",
];

audio.load();

function atualizarTimer() {
    const agora = Date.now();
    const delta = agora - ultimaAtualizacao;
    
    if (delta >= 1000) {
        tempoRestante = Math.max(0, tempoRestante - 1);
        ultimaAtualizacao = agora;
        
        let minutos = Math.floor(tempoRestante / 60).toString().padStart(2, '0');
        let segundos = (tempoRestante % 60).toString().padStart(2, '0');
        
        timerText.textContent = `${minutos}:${segundos}`;
        let progresso = (tempoRestante / tempoTotal) * 264;
        progressCircle.style.strokeDashoffset = progresso;

        const timerTextMobile = document.getElementById('timerTextMobile');
        const progressMobile = document.getElementById('progressMobile');
        timerTextMobile.textContent = `${minutos}:${segundos}`;
        progressMobile.style.strokeDashoffset = progresso;
        
        if (tempoRestante <= 0) {
            clearInterval(intervalo);
            clearInterval(motivacaoIntervalo);
            mostrarModalTempoEsgotado();
            return;
        }
    }
    
    requestAnimationFrame(atualizarTimer);
}

function exibirMotivacao() {
    const frase = frasesMotivacionais[Math.floor(Math.random() * frasesMotivacionais.length)];
    motivacionalTexto.textContent = frase;
    motivacionalTexto.classList.remove('hidden');
}

function iniciarTimer() {
    ultimaAtualizacao = Date.now();
    atualizarTimer();
    exibirMotivacao();
    motivacaoIntervalo = setInterval(exibirMotivacao, 240000);
}

document.getElementById('nivelForm').addEventListener('submit', function (event) {
    event.preventDefault();
    const experiencia = document.getElementById('experiencia').value;
    const frequencia = document.getElementById('frequencia').value;
    const conhecimento = document.getElementById('conhecimento').value;

    if (experiencia === 'avancado' && frequencia === 'avancado' && conhecimento === 'avancado') {
        tempoTotal = 1200;
    } else if (experiencia === 'intermediario' || frequencia === 'intermediario' || conhecimento === 'intermediario') {
        tempoTotal = 2100;
    } else {
        tempoTotal = 3600;
    }

    tempoRestante = tempoTotal;
    atualizarTimer();
    document.getElementById('nivelModal').style.display = 'none';
    document.getElementById('inicioCard').classList.remove('hidden');
});

document.getElementById('btnInicioContagem').addEventListener('click', function () {
    document.getElementById('inicioCard').classList.add('hidden');
    const contagem = document.getElementById('contagemRegressiva');
    let contador = 5;

    contagem.classList.remove('hidden');
    contagem.textContent = contador;

    audio.addEventListener('canplaythrough', function iniciarContagem() {
        audio.removeEventListener('canplaythrough', iniciarContagem);
        audio.currentTime = 0;
        audio.play().catch(() => {});

        const intervaloContagem = setInterval(() => {
            contador--;
            if (contador === 0) {
                clearInterval(intervaloContagem);
                contagem.classList.add('hidden');
                document.getElementById('simuladoContainer').classList.remove('hidden');
                gerarTema();
                iniciarTimer();
            } else {
                contagem.textContent = contador;
                audio.currentTime = 0;
                audio.play().catch(() => {});
            }
        }, 1000);
    });

    audio.load();
});

function gerarTema() {
    fetch("{{ route('simulado-coringa.gerarTema') }}")
        .then(response => response.json())
        .then(data => {
            document.getElementById('tema').textContent = data.tema;

            const texto1 = document.getElementById('textoMotivador1');
            const texto2 = document.getElementById('textoMotivador2');

            if (data.textos && data.textos.length > 0) {
                texto1.classList.remove('hidden');
                texto1.querySelector('p').textContent = data.textos[0];

                if (data.textos.length > 1) {
                    texto2.classList.remove('hidden');
                    texto2.querySelector('p').textContent = data.textos[1];
                } else {
                    texto2.classList.add('hidden');
                }
            }

            if (data.imagem) {
                const imagem = document.getElementById('imagemTema');
                imagem.src = '/images/temas/' + data.imagem;
                imagem.classList.remove('hidden');
            }

            if (data.charges && data.charges.length > 0) {
                const charge = document.getElementById('chargeTema');
                charge.src = '/images/temas/' + data.charges[0];
                charge.classList.remove('hidden');
            }

            document.getElementById('resultado').classList.remove('hidden');
        })
        .catch(() => toastr.error("Erro ao gerar o tema. Tente novamente.", "Erro"));
}

document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('nivelModal').style.display = 'none';
});

function mostrarModalTempoEsgotado() {
    const modalHTML = `
        <div id="modalTempoEsgotado" class="fixed inset-0 flex items-center justify-center z-50">
            <div class="fixed inset-0 bg-black opacity-50"></div>
            <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4 relative z-10 transform transition-all animate-bounce">
                <div class="text-center">
                    <div class="mb-4">
                        <svg class="mx-auto h-16 w-16 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Tempo Esgotado!</h3>
                    <p class="text-gray-600 mb-6">Não se preocupe! O importante é que você praticou. 
                        Que tal revisar sua redação agora?</p>
                    <div class="space-y-3">
                        <button onclick="salvarRedacao()" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            Salvar Redação
                        </button>
                        <button onclick="novoSimulado()" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                            Iniciar Novo Simulado
                        </button>
                        <button onclick="voltarInicio()" class="w-full bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">
                            Voltar ao Início
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', modalHTML);

    // TOCAR SOM DE FIM
    audio.src = "{{ asset('sounds/timeup.mp3') }}";
    audio.currentTime = 0;
    audio.play().catch(() => {});
}

function salvarRedacao() {
    toastr.success('Sua redação foi salva com sucesso!');
    voltarInicio();
}

function novoSimulado() {
    document.getElementById('modalTempoEsgotado').remove();
    document.getElementById('nivelModal').style.display = 'flex';
}

function voltarInicio() {
    window.location.href = "{{ route('dashboard') }}";
}
</script>

@endsection
