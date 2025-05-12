@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-extrabold text-center mb-6 text-black drop-shadow">Simulado Coringa</h1>

    <!-- Card de Boas-Vindas e Início -->
    <div id="inicioCard" class="hidden flex flex-col md:flex-row items-center justify-center gap-10 bg-white p-8 rounded-2xl shadow-xl mb-6">
        <div class="text-left text-gray-800 max-w-sm">
            <ul class="list-disc pl-5 space-y-2 font-medium text-lg">
                <li>Pegue papel e caneta</li>
                <li>Prepare um ambiente calmo</li>
                <li>Respire fundo</li>
                <li>Este é seu momento de treino!</li>
                <li>Você é capaz, acredite!</li>
                <li>Aquela nota 1000 do ENEM é sua!</li>
            </ul>
        </div>
        <div class="text-center">
            <p class="mb-4 font-semibold text-lg text-gray-700">Você está pronto para começar o simulado?</p>
            <button id="btnInicioContagem" class="bg-blue-600 text-white px-8 py-3 rounded-full hover:bg-blue-700 transition duration-300 shadow-md">Iniciar</button>
        </div>
    </div>

    <!-- Contagem regressiva -->
    <div id="contagemRegressiva" class="hidden text-6xl text-center text-blue font-extrabold mb-6 animate-pulse"></div>

    <!-- Conteúdo principal -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 hidden" id="simuladoContainer">
        <!-- Área do tema e texto motivador -->
        <div class="bg-white p-6 rounded-2xl shadow-xl">
            <div class="text-center mb-5">
                <div id="resultado" class="p-4 border border-gray-200 rounded-lg hidden bg-gray-50">
                    <h3 class="text-lg font-bold mb-2"><strong>Tema:</strong> <span id="tema" class="text-blue-700"></span></h3>
                    <p class="text-base font-medium"><strong>Texto Motivador:</strong></p>
                    <p id="textoMotivador" class="text-justify text-gray-700 mt-2"></p>

                    <!-- Imagem do Tema -->
                    <div class="mt-4">
                        <img id="imagemTema" src="" alt="Imagem do Tema" class="w-full rounded-lg shadow hidden">
                    </div>

                    <!-- Charge -->
                    <div class="mt-4">
                        <img id="chargeTema" src="" alt="Charge do Tema" class="w-full rounded-lg shadow hidden">
                    </div>
                </div>
            </div>
        </div>

        <!-- Timer + textos motivacionais -->
        <div class="bg-white p-6 rounded-2xl shadow-xl text-center flex flex-col items-center justify-center gap-6">
            <div class="circle-timer inline-block w-36 h-36 relative mb-2">
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
</div>

<!-- Modal Avaliação de Nível -->
<div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-60 z-50" id="nivelModal">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-md relative">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600 focus:outline-none">
            <i class="bi bi-x-circle text-2xl"></i>
        </button>

        <h5 class="text-xl font-bold text-center mb-4 text-gray-800">Avaliação de Nível</h5>
        <form id="nivelForm" class="space-y-4">
            <div>
                <label for="experiencia" class="block font-medium text-gray-700">Qual sua experiência com redação?</label>
                <select id="experiencia" class="w-full p-2 border rounded focus:ring focus:border-blue-400" required>
                    <option value="">Selecione...</option>
                    <option value="iniciante">Nenhuma experiência</option>
                    <option value="intermediario">Já escrevi algumas redações</option>
                    <option value="avancado">Escrevo frequentemente</option>
                </select>
            </div>
            <div>
                <label for="frequencia" class="block font-medium text-gray-700">Com que frequência você escreve redações?</label>
                <select id="frequencia" class="w-full p-2 border rounded focus:ring focus:border-blue-400" required>
                    <option value="">Selecione...</option>
                    <option value="iniciante">Raramente</option>
                    <option value="intermediario">Uma vez por mês</option>
                    <option value="avancado">Toda semana</option>
                </select>
            </div>
            <div>
                <label for="conhecimento" class="block font-medium text-gray-700">Como avalia seu conhecimento em técnicas de redação?</label>
                <select id="conhecimento" class="w-full p-2 border rounded focus:ring focus:border-blue-400" required>
                    <option value="">Selecione...</option>
                    <option value="iniciante">Baixo</option>
                    <option value="intermediario">Médio</option>
                    <option value="avancado">Alto</option>
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300 shadow">Começar Simulado</button>
        </form>
    </div>
</div>

<!-- ÁUDIO DA CONTAGEM -->
<audio id="audioContagem" src="{{ asset('sounds/countdowngame.mp3') }}" preload="auto"></audio>

<script>
let tempoTotal = 3600;
let tempoRestante = tempoTotal;
let intervalo, motivacaoIntervalo;
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
    let minutos = Math.floor(tempoRestante / 60).toString().padStart(2, '0');
    let segundos = (tempoRestante % 60).toString().padStart(2, '0');
    timerText.textContent = `${minutos}:${segundos}`;
    let progresso = (tempoRestante / tempoTotal) * 264;
    progressCircle.style.strokeDashoffset = progresso;
}

function exibirMotivacao() {
    const frase = frasesMotivacionais[Math.floor(Math.random() * frasesMotivacionais.length)];
    motivacionalTexto.textContent = frase;
    motivacionalTexto.classList.remove('hidden');
}

function iniciarTimer() {
    atualizarTimer();
    exibirMotivacao();

    intervalo = setInterval(() => {
        if (tempoRestante <= 0) {
            clearInterval(intervalo);
            clearInterval(motivacaoIntervalo);
            toastr.error('Tempo esgotado!', 'Aviso');
        } else {
            tempoRestante--;
            atualizarTimer();
        }
    }, 1000);

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
            document.getElementById('textoMotivador').textContent = data.textoMotivador;
            document.getElementById('resultado').classList.remove('hidden');

            if (data.imagem) {
                const imagem = document.getElementById('imagemTema');
                imagem.src = '/images/' + data.imagem;
                imagem.classList.remove('hidden');
            }

            if (data.charges && data.charges.length > 0) {
                const charge = document.getElementById('chargeTema');
                charge.src = '/images/' + data.charges[0];
                charge.classList.remove('hidden');
            }
        })
        .catch(() => toastr.error("Erro ao gerar o tema. Tente novamente.", "Erro"));
}

document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('nivelModal').style.display = 'none';
});
document.getElementById('nivelModal').addEventListener('click', (event) => {
    if (event.target === document.getElementById('nivelModal')) {
        document.getElementById('nivelModal').style.display = 'none';
    }
});
</script>
@endsection
