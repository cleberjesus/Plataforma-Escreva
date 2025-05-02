<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Verificação de E-mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: rgb(209, 222, 255);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            display: flex;
            background-color: #fff;
            border-radius: 8px;
            max-width: 900px;
            width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .image-side {
            flex: 1;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .image-side img {
            max-width: 100%;
            height: auto;
        }

        .content {
            flex: 1;
            padding: 40px 30px;
        }

        .content p {
            font-size: 15px;
            color: #444;
            margin-bottom: 20px;
        }

        .alert-success {
            font-size: 14px;
            color: #155724;
            background-color: #d4edda;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .button-group {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .button-group form {
            display: inline-block;
        }

        .btn {
            background-color: #4a90e2;
            color: #fff;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
        }

        .btn-logout {
            background: none;
            color: #555;
            text-decoration: underline;
            padding: 0;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .image-side {
                padding: 20px;
            }

            .content {
                padding: 30px 20px;
            }

            .button-group {
                flex-direction: column;
                align-items: stretch;
            }

            .btn, .btn-logout {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image-side">
            <img src="{{ asset('images/verification-illustration.png') }}" alt="Ilustração de verificação">
        </div>
        <div class="content">
            <p>
                {{ __('Obrigado por se registrar! Antes de começar, você poderia verificar seu e-mail clicando no link que acabamos de enviar? Caso não tenha recebido, podemos reenviá-lo.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert-success">
                    {{ __('Um novo link de verificação foi enviado para o endereço de e-mail fornecido durante o cadastro.') }}
                </div>
            @endif

            <div class="button-group">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button class="btn" type="submit">
                        {{ __('Reenviar E-mail de Verificação') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        {{ __('Sair') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
