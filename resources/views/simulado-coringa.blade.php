@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-center mb-4 text-white">Simulado Coringa</h1>

    <div class="grid grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="text-center mb-5">
                <button id="gerarTema" class="btn btn-primary mb-3 bg-blue-500 text-white py-2 px-4 rounded">Gerar Tema</button>
                <div id="resultado" class="p-3 border rounded d-none">
                    <h3><strong>Tema:</strong> <span id="tema"></span></h3>
                    <p><strong>Texto Motivador:</strong> <span id="textoMotivador"></span></p>
                </div>
            </div>
        </div>

        <div class="text-center">
            <div class="circle-timer inline-block w-32 h-32 relative">
                <svg id="timerSvg" viewBox="0 0 100 100" class="w-full h-full">
                    <circle cx="50" cy="50" r="42" stroke="#e9ecef" stroke-width="10" fill="none"></circle>
                    <circle id="progress" cx="50" cy="50" r="42" stroke="#28a745" stroke-width="10" fill="none"
                            stroke-dasharray="264" stroke-dashoffset="264" stroke-linecap="round"></circle>
                </svg>
                <div class="timer-text absolute inset-0 flex items-center justify-center text-xl font-bold text-white" id="timerText">00:00</div>
            </div>
            <button id="iniciarTimer" class="btn btn-success mt-3 bg-green-500 text-white py-2 px-4 rounded" disabled>
                <i class="bi bi-play-fill" style="font-size: 2rem;"></i>
                Iniciar Simulado
            </button>
        </div>
    </div>
</div>

<!-- Modal de Avaliação de Nível -->
<div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50" id="nivelModal">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h5 class="text-lg font-semibold text-center mb-4">Avaliação de Nível</h5>
        <form id="nivelForm">
            <div class="mb-3">
                <label for="experiencia" class="block font-medium">Qual sua experiência com redação?</label>
                <select id="experiencia" class="w-full p-2 border rounded" required>
                    <option value="">Selecione...</option>
                    <option value="iniciante">Nenhuma experiência</option>
                    <option value="intermediario">Já escrevi algumas redações</option>
                    <option value="avancado">Escrevo frequentemente</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="frequencia" class="block font-medium">Com que frequência você escreve redações?</label>
                <select id="frequencia" class="w-full p-2 border rounded" required>
                    <option value="">Selecione...</option>
                    <option value="iniciante">Raramente</option>
                    <option value="intermediario">Uma vez por mês</option>
                    <option value="avancado">Toda semana</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="conhecimento" class="block font-medium">Como avalia seu conhecimento em técnicas de redação?</label>
                <select id="conhecimento" class="w-full p-2 border rounded" required>
                    <option value="">Selecione...</option>
                    <option value="iniciante">Baixo</option>
                    <option value="intermediario">Médio</option>
                    <option value="avancado">Alto</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-full bg-blue-500 text-white py-2 px-4 rounded">Começar Simulado</button>
        </form>
    </div>
</div>

<script>
    let tempoTotal = 3600;
    let tempoRestante = tempoTotal;
    let intervalo;
    let motivacaoIntervalo;

    const timerText = document.getElementById('timerText');
    const progressCircle = document.getElementById('progress');
    const iniciarBtn = document.getElementById('iniciarTimer');

    function atualizarTimer() {
        let minutos = Math.floor(tempoRestante / 60).toString().padStart(2, '0');
        let segundos = (tempoRestante % 60).toString().padStart(2, '0');
        timerText.textContent = `${minutos}:${segundos}`;
        let progresso = (tempoRestante / tempoTotal) * 264;
        progressCircle.style.strokeDashoffset = progresso;
    }

    function iniciarTimer() {
        atualizarTimer();
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

        motivacaoIntervalo = setInterval(() => {
            exibirMotivacao();
        }, 240000);
    }

    function exibirMotivacao() {
        toastr.success('Continue assim! Você está indo muito bem! Não desista!', 'Motivação');
    }

    document.getElementById('nivelForm').addEventListener('submit', function(event) {
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
        iniciarBtn.disabled = false;

        document.getElementById('nivelModal').style.display = 'none';
    });

    iniciarBtn.addEventListener('click', function () {
        clearInterval(intervalo);
        iniciarTimer();
    });

    document.getElementById('gerarTema').addEventListener('click', function () {
        fetch("{{ route('simulado-coringa.gerarTema') }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById('tema').textContent = data.tema;
                document.getElementById('textoMotivador').textContent = data.textoMotivador;
                document.getElementById('resultado').classList.remove('d-none');
            })
            .catch(() => toastr.error("Erro ao gerar o tema. Tente novamente.", "Erro"));
    });
</script>
@endsection
