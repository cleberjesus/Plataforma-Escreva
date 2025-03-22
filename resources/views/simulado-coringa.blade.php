@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-center mb-4" style="color: white;">Simulado Coringa</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="text-center mb-5">
            <button id="gerarTema" class="btn btn-primary mb-3">Gerar Tema</button>
            <div id="resultado" class="p-3 border rounded d-none">
                <h3><strong>Tema:</strong> <span id="tema"></span></h3>
                <p><strong>Texto Motivador:</strong> <span id="textoMotivador"></span></p>
            </div>
        </div>

        <div class="text-center mb-3">
            <div class="circle-timer">
                <svg id="timerSvg" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" stroke="#e9ecef" stroke-width="8" fill="none"></circle>
                    <circle id="progress" cx="50" cy="50" r="45" stroke="#28a745" stroke-width="8" fill="none"
                            stroke-dasharray="282.6" stroke-dashoffset="282.6" stroke-linecap="round"></circle>
                </svg>
                <div class="timer-text" id="timerText">00:00</div>
            </div>
        </div>

        <div class="text-center">
            <button id="iniciarTimer" class="btn btn-success">
                <i class="bi bi-play-circle-fill" style="font-size: 2rem;"></i>
                Iniciar Simulado
            </button>
        </div>
    </div>
</div>

<style>
.circle-timer {
    position: relative;
    width: 120px;
    height: 120px;
    margin: 0 auto;
}

.circle-timer svg {
    transform: rotate(-90deg);
    width: 100%;
    height: 100%;
}

.timer-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 20px;
    font-weight: bold;
    color: #333;
}
</style>

<script>
    let tempoTotal = 3600;
    let tempoRestante = tempoTotal;
    let intervalo;

    const timerText = document.getElementById('timerText');
    const progressCircle = document.getElementById('progress');

    function atualizarTimer() {
        let minutos = Math.floor(tempoRestante / 60).toString().padStart(2, '0');
        let segundos = (tempoRestante % 60).toString().padStart(2, '0');
        timerText.textContent = `${minutos}:${segundos}`;
        let progresso = (tempoRestante / tempoTotal) * 282.6;
        progressCircle.style.strokeDashoffset = progresso;
    }

    function iniciarTimer() {
        atualizarTimer();
        intervalo = setInterval(() => {
            if (tempoRestante <= 0) {
                clearInterval(intervalo);
                alert('Tempo esgotado!');
            } else {
                tempoRestante--;
                atualizarTimer();
            }
        }, 1000);
    }

    document.getElementById('iniciarTimer').addEventListener('click', function() {
        clearInterval(intervalo);
        tempoRestante = tempoTotal;
        iniciarTimer();
    });

    document.getElementById('gerarTema').addEventListener('click', function() {
        fetch("{{ route('simulado-coringa.gerarTema') }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById('tema').textContent = data.tema;
                document.getElementById('textoMotivador').textContent = data.textoMotivador;
                document.getElementById('resultado').classList.remove('d-none');
            })
            .catch(() => alert("Erro ao gerar o tema. Tente novamente."));
    });
</script>
@endsection
