<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escreva</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.6;
        }
        header, footer {
            background-color: #ffffff;
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
        }
        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #1e293b;
            font-weight: 500;
        }
        .btn {
            background-color: #2563eb;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #1d4ed8;
        }
        .hero {
            display: flex;
            padding: 60px;
            background-color: white;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .hero-text {
            max-width: 600px;
        }
        .hero-text h1 {
            font-size: 2.75rem;
            margin-bottom: 1rem;
            color: #0f172a;
        }
        .hero-text p {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        .features {
            display: flex;
            padding: 60px;
            justify-content: space-between;
            background-color: #f1f5f9;
            flex-wrap: wrap;
        }
        .plans {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 80px 60px;
            background-color: #ffffff;
        }
        .plan-card {
            background-color: #f1f5f9;
            padding: 40px;
            border-radius: 12px;
            margin: 20px 0;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .features > div {
            flex: 1;
            margin: 20px;
            min-width: 280px;
        }
        .features h2, .plans h3 {
            margin-bottom: 1rem;
            color: #0f172a;
        }
        .testimonial {
            background-color: #e2e8f0;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            font-style: italic;
        }
        footer {
            background-color: #1e293b;
            color: white;
            flex-direction: column;
            text-align: center;
            padding: 60px 20px;
        }
        .footer-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
            margin-top: 30px;
        }
        .footer-links div {
            min-width: 150px;
        }
        .footer-links strong {
            display: block;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

<header>
    <div>
        <strong>Escreva</strong></div>
    <nav>
        <a href="#">Início</a>
        <a href="#">Como Funciona</a>
        <a href="#">Planos</a>
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="btn">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn">
                    Entrar
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">
                        Cadastrar
                    </a>
                @endif
            @endauth
        @endif
    </nav>
</header>

<section class="hero">
    <div class="hero-text">
        <h1>Sua Redação Nota 1000 Começa Aqui</h1>
        <p>Corrigida por IA. Com sugestões, temas e exemplos de excelência.</p>
        <a href="#" class="btn">Começar Agora</a>
    </div>
    <img src="/images/illustration.png" alt="Ilustração IA corrigindo redação" style="max-width: 40%;">
</section>

<section class="features">
    <div>
        <h2>Como Funciona</h2>
        <p>📌 Escolha um tema</p>
        <p>✍️ Escreva ou envie sua redação</p>
        <p>📊 Receba a análise com pontuação e dicas</p>
    </div>
    <div>
        <h2>Benefícios da Plataforma</h2>
        <p>✔ Correção instantânea com IA</p>
        <p>✔ Sugestões personalizadas</p>
        <p>✔ Modelos nota 1000</p>
        <p>✔ Temas atualizados semanalmente</p>

        <div class="testimonial">
            <p>"Minha nota no ENEM subiu de 640 para 950!"</p>
            <small>Ana Beatriz, MG</small>
        </div>
    </div>
</section>

<section class="plans">
    <div class="plan-card">
        <h3>Plano Grátis</h3>
        <ul>
            <li>Simulado Coringa</li>
            <li>Correções Comum</li>
            <li>Minhas Redações</li>
        </ul>
    </div>
    
    <div class="plan-card">
        <h3>Plano Premium</h3>
        <p><strong>R$ 9,90</strong> / mês</p>
        <ul>
            <li>Acesso ilimitado a correções ilimitadas com IA</li>
        </ul>
    </div>
    
   
</section>

<footer>
    <strong>Escreva &copy; {{ date('Y') }}</strong>
    <div class="footer-links">
        <div>
            <strong>Sobre nós</strong>
            <p>Sobre</p>
            <p>Equipe</p>
        </div>
        <div>
            <strong>Contato</strong>
            <p>Política de Privacidade</p>
            <p>Termos de Uso</p>
        </div>
        <div>
            <strong>Redes Sociais</strong>
            <p>🎥 YouTube</p>
            <p>📸 Instagram</p>
            <p>🎵 TikTok</p>
        </div>
    </div>
</footer>

</body>
</html>