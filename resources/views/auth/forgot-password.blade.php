<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Esqueceu sua senha</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('icons/logo-secundaria.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            width: 100vw;
            overflow: hidden; /* Remove barras de rolagem */
            padding: 10px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 500px;
            padding: 20px;
            text-align: center;
        }

        .illustration img {
            width: 100%;
            max-width: 300px;
        }

        .form-section h2 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .form-section p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }

        .form-section input[type="email"],
        .form-section button {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
        }

        .form-section input[type="email"] {
            border: 1px solid #ccc;
            margin-bottom: 15px;
        }

        .form-section button {
            background-color: #4a90e2;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .form-section .back-link {
            display: block;
            margin-top: 15px;
            font-size: 16px;
            color: #aaa;
            text-decoration: none;
        }

        .form-section .back-link:hover {
            text-decoration: underline;
        }

        .alert-success {
            background-color: #e6f7ec;
            color: #276749;
            border: 1px solid #c6f6d5;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .alert-error {
            background-color: #ffe6e6;
            color: #cc0000;
            border: 1px solid #ffb3b3;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="illustration">
            <img src="{{ asset('images/forgot-password-illustration.png') }}" alt="Esqueceu a senha">
        </div>

        <div class="form-section">
            <h2>Esqueceu sua senha?</h2>
            <p>Informe seu e-mail e enviaremos um link para você redefinir sua senha.</p>

            @if (session('status'))
                <div class="alert-success">
                    <strong>Sucesso:</strong> {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-error">
                    <strong>Erro:</strong>
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