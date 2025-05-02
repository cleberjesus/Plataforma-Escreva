<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Esqueceu sua senha</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 40px;
        }

        .container {
            display: flex;
            max-width: 900px;
            width: 100%;
            gap: 40px;
            align-items: center;
        }

        .illustration {
            flex: 1;
        }

        .illustration img {
            width: 100%;
            max-width: 400px;
        }

        .form-section {
            flex: 1;
        }

        .form-section h2 {
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .form-section p {
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }

        .form-section input[type="email"] {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .form-section button {
            width: 100%;
            padding: 12px;
            background-color: #4a90e2;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .form-section .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
            color: #aaa;
            text-decoration: none;
        }

        .form-section .back-link:hover {
            text-decoration: underline;
        }

        .alert-success {
            background-color: #e6f7ec;
            color: #276749;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c6f6d5;
        }

        .alert-error {
            background-color: #ffe6e6;
            color: #cc0000;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #ffb3b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="illustration">
            <img src="{{ asset('images/forgot-password-illustration.png') }}" alt="Esqueceu a senha">
        </div>

        <div class="form-section">
            <h2>Esqueceu<br>sua senha?</h2>
            <p>Informe seu e-mail e enviaremos um link para você redefinir sua senha.</p>

            {{-- Mensagem de sucesso --}}
            @if (session('status'))
                <div class="alert-success">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Mensagens de erro --}}
            @if ($errors->any())
                <div class="alert-error">
                    <ul style="list-style: none; padding-left: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <input type="email" name="email" placeholder="Digite seu e-mail" value="{{ old('email') }}" required autofocus>
                <button type="submit">ENVIAR LINK DE RECUPERAÇÃO</button>
            </form>

            <a href="{{ route('login') }}" class="back-link">Voltar para o login</a>
        </div>
    </div>
</body>
</html>
