<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: rgb(209, 222, 255);
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            min-height: 100vh;
        }

        .inner {
            display: flex;
            flex-direction: row;
            width: 100%;
            max-width: 1000px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .image-holder {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .image-holder img {
            max-width: 100%;
            height: auto;
        }

        form {
            flex: 1;
            padding: 40px 30px;
        }

        h3 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .description {
            font-size: 14px;
            color: #555;
            margin-bottom: 25px;
        }

        .form-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .form-wrapper input {
            width: 100%;
            padding: 12px 35px 12px 12px;
            border: none;
            border-bottom: 1px solid #ccc;
            background: transparent;
            font-size: 16px;
        }

        .form-wrapper i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 20px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .remember-me input {
            margin-right: 8px;
        }

        button {
            background-color: #4a90e2;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .text-links {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
        }

        .text-links a {
            color: #333;
            text-decoration: underline;
            margin: 0 5px;
        }

        /* RESPONSIVO */
        @media (max-width: 768px) {
            .inner {
                flex-direction: column;
            }

            .image-holder {
                order: 2;
                padding: 30px 15px;
            }

            form {
                order: 1;
                padding: 30px 20px;
            }

            h3 {
                font-size: 24px;
            }

            .form-wrapper input {
                font-size: 15px;
            }

            button {
                font-size: 15px;
            }

            .description {
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            h3 {
                font-size: 22px;
            }

            .description {
                font-size: 12px;
            }

            button {
                font-size: 14px;
                padding: 10px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="inner">
            <div class="image-holder">
                <img src="{{ asset('images/login-illustration.png') }}" alt="Ilustração de login">
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h3>Entrar</h3>
                <p class="description">Faça login para acessar sua conta e aproveitar todos os recursos da plataforma.</p>

                        <div class="form-wrapper">
            <input type="email" name="email" placeholder="Seu e-mail" value="{{ old('email') }}" required autofocus>
            <i class="mdi mdi-account"></i>
            @error('email')
                <p class="text-red-500 text-sm mt-1" style="color: #e3342f;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-wrapper">
            <input type="password" name="password" placeholder="Senha" required>
            <i class="mdi mdi-lock"></i>
            @error('password')
                <p class="text-red-500 text-sm mt-1" style="color: #e3342f;">{{ $message }}</p>
            @enderror
        </div>


                <label class="remember-me">
                    <input type="checkbox" name="remember"> Lembrar-me
                </label>

                <button type="submit">Entrar <i class="mdi mdi-arrow-right"></i></button>

                <div class="text-links">
                    <a href="{{ route('register') }}">Criar uma conta</a> |
                    <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
