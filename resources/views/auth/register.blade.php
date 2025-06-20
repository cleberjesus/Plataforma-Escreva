<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('icons/logo-secundaria.ico') }}">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
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
        form { flex: 1; }
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
        label { font-size: 14px; }
        .terms {
            font-size: 14px;
            margin: 10px 0 20px;
        }
        .terms a { text-decoration: underline; }
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
        .mt-1 { margin-top: 0.25rem; }
        .email-status {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .email-status.available {
            color: #28a745;
        }
        .email-status.unavailable {
            color: #dc3545;
        }

        /* Ajuste para o reCAPTCHA */
        .g-recaptcha {
            width: 100% !important;
            margin-bottom: 20px;
        }

        @media (max-width: 992px) {
            .inner {
                flex-direction: column-reverse;
                text-align: center;
                gap: 40px;
            }
            form { width: 100%; }
            h3 { font-size: 24px; }
            .subtitle { font-size: 15px; }
            .form-wrapper input {
                padding: 12px 38px 12px 12px;
            }
            button { font-size: 15px; }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="inner">
            <div class="image-holder">
                <img src="{{ asset('images/register-illustration.png') }}" alt="Ilustração de cadastro">
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h3>Criar conta</h3>
                <p class="subtitle">Crie sua conta e tenha acesso a diversos recursos da nossa plataforma!</p>

                <div class="form-wrapper">
                    <input type="text" name="name" placeholder="Seu nome" value="{{ old('name') }}" required autofocus>
                    <i class="mdi mdi-account"></i>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-wrapper">
                    <input type="email" name="email" id="email" placeholder="Seu e-mail" value="{{ old('email') }}" required>
                    <i class="mdi mdi-email"></i>
                    <div id="emailStatus" class="email-status"></div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-wrapper">
                    <input id="password" type="password" name="password" placeholder="Senha" required>
                    <i class="mdi mdi-eye password-toggle" id="togglePasswordIcon" onclick="togglePassword()"></i>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-wrapper">
                    <input id="confirmPassword" type="password" name="password_confirmation" placeholder="Confirme a senha" required>
                    <i class="mdi mdi-lock"></i>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="terms">
                    <label>
                        <input type="checkbox" required>
                        Concordo com os <a href="{{ route('terms') }}">Termos de serviço</a>
                    </label>
                </div>

                {{-- reCAPTCHA --}}
                <div class="form-wrapper">
                    <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.sitekey') }}"></div>
                    @if ($errors->has('g-recaptcha-response'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('g-recaptcha-response') }}</p>
                    @endif
                </div>

                <button type="submit">Registrar</button>

                <div class="text-links">
                    <a href="{{ route('login') }}">Já sou cadastrado</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Script do reCAPTCHA --}}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    {{-- Mostrar/ocultar senha --}}
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('togglePasswordIcon');

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

        // Verificação de email em tempo real
        let emailTimeout;
        const emailInput = document.getElementById('email');
        const emailStatus = document.getElementById('emailStatus');

        emailInput.addEventListener('input', function() {
            clearTimeout(emailTimeout);
            const email = this.value;

            if (email) {
                emailTimeout = setTimeout(() => {
                    fetch('{{ route("check.email") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ email })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            emailStatus.textContent = 'Este e-mail já está em uso';
                            emailStatus.className = 'email-status unavailable';
                        } else {
                            emailStatus.textContent = 'E-mail disponível';
                            emailStatus.className = 'email-status available';
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao verificar email:', error);
                    });
                }, 500); // Aguarda 500ms após o usuário parar de digitar
            } else {
                emailStatus.textContent = '';
                emailStatus.className = 'email-status';
            }
        });
    </script>
</body>
</html>
