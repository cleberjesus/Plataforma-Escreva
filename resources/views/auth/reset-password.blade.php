<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('icons/logo-secundaria.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fff;
            color: #333;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px 20px;
        }

        .inner {
            display: flex;
            width: 100%;
            max-width: 1100px;
            gap: 60px;
            align-items: center;
        }

        form {
            flex: 1;
        }

        h3 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .subtitle {
            font-size: 16px;
            color: #555;
            margin-bottom: 25px;
        }

        .form-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .form-wrapper input {
            width: 100%;
            padding: 12px 40px 12px 12px;
            border: none;
            border-bottom: 1px solid #ccc;
            background: transparent;
            font-size: 16px;
            outline: none;
        }

        .form-wrapper i.mdi {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            color: #aaa;
        }

        .form-wrapper i.password-toggle {
            cursor: pointer;
            font-size: 20px;
        }

        label {
            font-size: 14px;
        }

        button {
            background-color: #4a90e2;
            color: #fff;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .text-links {
            margin-top: 15px;
            font-size: 14px;
            text-align: center;
        }

        .text-links a {
            color: #333;
            text-decoration: underline;
        }

        .image-holder {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-holder img {
            max-width: 100%;
            height: auto;
        }

        .text-red-500 {
            color: #e3342f;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .mt-1 {
            margin-top: 0.25rem;
        }

        @media (max-width: 992px) {
            .inner {
                flex-direction: column-reverse;
                text-align: center;
                gap: 40px;
            }

            form {
                width: 100%;
            }

            h3 {
                font-size: 24px;
            }

            .subtitle {
                font-size: 15px;
            }

            .form-wrapper input {
                padding: 12px 38px 12px 12px;
            }

            button {
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="inner">
            <div class="image-holder">
                <img src="{{ asset('images/reset-password.png') }}" alt="Ilustração de redefinição de senha">
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <h3>Redefinir Senha</h3>
                <p class="subtitle">Digite sua nova senha para redefinir o acesso à sua conta.</p>

                <!-- Email Address -->
                <div class="form-wrapper">
                    <input type="email" name="email" placeholder="Seu e-mail" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                    <i class="mdi mdi-email"></i>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-wrapper">
                    <input type="password" name="password" placeholder="Nova senha" required autocomplete="new-password">
                    <i class="mdi mdi-eye password-toggle" onclick="togglePassword(this)"></i>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-wrapper">
                    <input type="password" name="password_confirmation" placeholder="Confirme a nova senha" required autocomplete="new-password">
                    <i class="mdi mdi-lock"></i>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit">Redefinir Senha</button>

                <div class="text-links">
                    <a href="{{ route('login') }}">Voltar para o login</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword(icon) {
            const input = icon.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('mdi-eye');
                icon.classList.add('mdi-eye-off');
            } else {
                input.type = 'password';
                icon.classList.remove('mdi-eye-off');
                icon.classList.add('mdi-eye');
            }
        }
    </script>
</body>
</html>
