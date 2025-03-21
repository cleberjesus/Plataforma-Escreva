<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulado Coringa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
        .motivational-text {
            font-size: 20px;
            margin-top: 20px;
            color: green;
            text-align: left;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .timer-container {
            margin-top: 20px;
            position: relative;
            display: inline-block;
        }
        .timer {
            font-size: 3rem;
            width: 150px;
            height: 150px;
            border: 10px solid #4CAF50;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
        .theme {
            font-size: 1.5rem;
            margin-top: 10px;
        }
        .image-container img {
            width: 100%;
            height: auto;
            margin-top: 20px;
        }
        .start-button {
            background-color: #4CAF50;
            color: white;
            font-size: 1.2rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 30px;
        }
        .start-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Simulado Coringa</h1>

        <div class="theme">
            <p><strong>Tema:</strong> {{ $tema }}</p>
        </div>

        <div class="motivational-text">
            @foreach($textosMotivadores as $texto)
                <p>{{ $texto }}</p>
            @endforeach
        </div>

        <div class="image-container">
            <img src="{{ $imagemBase }}" alt="Imagem do Tema">
        </div>

        <div class="timer-container">
            <div id="timer" class="timer">
                {{ $tempoLimite }}:00
            </div>
        </div>

        <!-- Botão para Iniciar o Cronômetro -->
        <button id="startButton" class="start-button" onclick="startTimer()">Iniciar Cronômetro</button>
    </div>

    <script>
        let tempoRestante = {{ $tempoLimite * 60 }};
        let cronometroAtivo = false;

        function formatarTempo(segundos) {
            const minutos = Math.floor(segundos / 60);
            const segundosRestantes = segundos % 60;
            return `${minutos.toString().padStart(2, '0')}:${segundosRestantes.toString().padStart(2, '0')}`;
        }

        function startTimer() {
            if (!cronometroAtivo) {
                cronometroAtivo = true;
                const timerElement = document.getElementById('timer');
                const startButton = document.getElementById('startButton');
                
                // Desabilita o botão "Iniciar" após o clique
                startButton.disabled = true;
                startButton.textContent = "Cronômetro Iniciado";

                const interval = setInterval(() => {
                    if (tempoRestante > 0) {
                        tempoRestante--;
                        timerElement.textContent = formatarTempo(tempoRestante);
                    } else {
                        clearInterval(interval);
                        alert("O tempo acabou!");
                        // Habilita o botão novamente para reiniciar, caso queira
                        startButton.disabled = false;
                        startButton.textContent = "Iniciar Cronômetro";
                    }
                }, 1000);
            }
        }
    </script>
</body>
</html>
