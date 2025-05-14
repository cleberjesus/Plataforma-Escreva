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
      scroll-behavior: smooth;
    }
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8fafc;
      color: #1e293b;
      line-height: 1.6;
    }
    header {
      background-color: #ffffff;
      padding: 20px 60px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #e2e8f0;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
      flex-wrap: wrap;
    }
    .logo {
      height: 4rem;
      width: auto;
      max-width: 300px;
    }
    nav a {
      margin: 0 10px;
      text-decoration: none;
      color: #1e293b;
      font-weight: 500;
      position: relative;
    }
    nav a.active {
      color: #2563eb;
      font-weight: 700;
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

    section {
      scroll-margin-top: 100px;
    }

    .hero {
      display: flex;
      padding: 100px 60px;
      background-color: white;
      align-items: center;
      justify-content: space-between;
      gap: 40px;
      flex-wrap: wrap;
      min-height: 90vh;
    }

    .hero-text {
      flex: 1;
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

    .hero-img {
      flex: 1;
      max-width: 500px;
      width: 100%;
      height: auto;
    }

    .features {
      display: flex;
      padding: 60px;
      justify-content: space-between;
      background-color: #f1f5f9;
      flex-wrap: wrap;
    }

    .features > div {
      flex: 1;
      margin: 20px;
      min-width: 280px;
    }

    .pricing-section {
      display: flex;
      padding: 80px 60px;
      background-color: #ffffff;
      justify-content: center;
      flex-wrap: wrap;
      gap: 30px;
    }

    .plan-card {
      background-color: white;
      padding: 40px;
      border-radius: 12px;
      width: 100%;
      max-width: 400px;
      text-align: center;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      flex: 1;
      min-width: 280px;
    }

    .plan-card h3 {
      margin: 0;
      font-size: 1.5em;
    }

    .plan-card .price {
      font-size: 2em;
      margin: 10px 0;
    }

    .plan-card .price span {
      font-size: 0.8em;
      color: #555;
    }

    .plan-card ul {
      list-style: none;
      padding: 0;
      margin: 20px 0;
      text-align: left;
    }

    .plan-card ul li {
      margin: 8px 0;
    }

    .plan-card button {
      background: #0d1b2a;
      color: white;
      border: none;
      padding: 10px;
      width: 100%;
      border-radius: 5px;
      cursor: pointer;
    }

    .basic { border-top: 6px solid #00bfa6; }
    .standard { border-top: 6px solid #ff5722; }
    .premium { border-top: 6px solid #e91e63; }

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

    @media (max-width: 768px) {
      .hero {
        flex-direction: column;
        text-align: center;
        padding-top: 120px;
        padding-left: 20px;
        padding-right: 20px;
      }
      
      .hero-text {
        max-width: 100%;
      }
      
      .features {
        flex-direction: column;
        padding: 30px 20px;
      }
      
      .pricing-section {
        padding: 40px 20px;
        flex-direction: column;
        align-items: center;
      }
      
      header, footer {
        flex-direction: column;
        text-align: center;
        padding: 20px;
      }
      
      nav {
        margin-top: 15px;
      }
      
      nav a {
        display: inline-block;
        margin: 5px 10px;
      }
      
      .footer-links {
        flex-direction: column;
        gap: 20px;
      }
      
      .plan-card {
        width: 100%;
        max-width: 350px;
      }

      .logo {
        height: 3rem;
        max-width: 260px;
      }
    }

    @media (min-width: 769px) and (max-width: 1024px) {
      .pricing-section {
        padding: 60px 30px;
      }
      
      .plan-card {
        min-width: 250px;
      }
    }
  </style>
</head>
<body>

<header>
  <div>
    <a href="{{ route('dashboard') }}">
      <img src="{{ asset('images/logo-secundaria.png') }}" alt="Logo" class="logo">
    </a>
  </div>
  <nav>
    <a href="#inicio">Início</a>
    <a href="#como-funciona">Como Funciona</a>
    <a href="#planos">Planos</a>
    @if (Route::has('login'))
      @auth
        <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
      @else
        <a href="{{ route('login') }}" class="btn">Entrar</a>
        @if (Route::has('register'))
          <a href="{{ route('register') }}">Cadastrar</a>
        @endif
      @endauth
    @endif
  </nav>
</header>

<section class="hero" id="inicio">
  <div class="hero-text">
    <h1>Sua Redação Nota 1000 Começa Aqui</h1>
    <p>Corrigida por IA. Com sugestões, temas e exemplos de excelência.</p>
    <a href="#planos" class="btn">Começar Agora</a>
  </div>
  <img src="/images/home-illustration.png" alt="Ilustração IA corrigindo redação" class="hero-img">
</section>

<section class="features" id="como-funciona">
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

<section class="pricing-section" id="planos">
  <div class="plan-card basic">
    <h3>BASIC</h3>
    <p class="price">Grátis<span></span></p>
    <ul>
      <li>Simulado Coringa</li>
      <li>Correções Comum</li>
      <li>Minhas Redações</li>
      <li>Espaço de descrição</li>
      <li>Outros recursos</li>
    </ul>
<button onclick="window.location.href='{{ route('register') }}'">Selecionar</button>
  </div>

  <div class="plan-card premium">
    <h3>Escreva Plus</h3>
    <p class="price">R$9,90 <span>/ mês</span></p>
    <ul>
      <li>Simulado Coringa</li>
      <li>Correções Comum</li>
      <li>Minhas Redações</li>
      <li>Espaço de descrição</li>
      <li>Acesso ilimitado a IA</li>
    </ul>
<button onclick="window.location.href='{{ route('register') }}'">Selecionar</button>
  </div>
</section>

<<footer style="background: linear-gradient(to right, #1e293b, #0f172a); color: white; padding: 60px 20px;">
  <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; gap: 40px;">
    
    <div style="flex: 1; min-width: 200px;">
      <h3 style="margin-bottom: 10px; font-size: 1.25rem;">Escreva</h3>
      <p style="opacity: 0.8;">Plataforma inteligente para simular, corrigir e evoluir suas redações. Rumo à nota 1000!</p>
    </div>

    <div style="flex: 1; min-width: 150px;">
      <h4 style="margin-bottom: 10px;">Links</h4>
      <ul style="list-style: none; padding: 0;">
        <li><a href="#inicio" style="color: #e2e8f0; text-decoration: none;">Início</a></li>
        <li><a href="#como-funciona" style="color: #e2e8f0; text-decoration: none;">Como Funciona</a></li>
        <li><a href="#planos" style="color: #e2e8f0; text-decoration: none;">Planos</a></li>
      </ul>
    </div>

    <div style="flex: 1; min-width: 150px;">
      <h4 style="margin-bottom: 10px;">Institucional</h4>
      <ul style="list-style: none; padding: 0;">
        <li><a href="#" style="color: #e2e8f0; text-decoration: none;">Política de Privacidade</a></li>
        <li><a href="#" style="color: #e2e8f0; text-decoration: none;">Termos de Uso</a></li>
      </ul>
    </div>

    <div style="flex: 1; min-width: 150px;">
      <h4 style="margin-bottom: 10px;">Siga-nos</h4>
      <div style="display: flex; gap: 15px;">
        <a href="#" title="YouTube"><img src="/icons/youtube.svg" alt="YouTube" style="width: 24px;"></a>
        <a href="#" title="Instagram"><img src="/icons/instagram.svg" alt="Instagram" style="width: 24px;"></a>
        <a href="#" title="TikTok"><img src="/icons/tiktok.svg" alt="TikTok" style="width: 24px;"></a>
      </div>
    </div>

  </div>

  <div style="text-align: center; margin-top: 40px; font-size: 0.9rem; opacity: 0.7;">
    &copy; 2025 Escreva. Todos os direitos reservados.
  </div>
</footer>


<script>
  const sections = document.querySelectorAll("section");
  const navLinks = document.querySelectorAll("nav a[href^='#']");

  function activateLink() {
    let scrollY = window.pageYOffset;
    sections.forEach((section) => {
      const sectionTop = section.offsetTop - 120;
      const sectionHeight = section.offsetHeight;
      const id = section.getAttribute("id");

      if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
        navLinks.forEach((link) => {
          link.classList.remove("active");
          if (link.getAttribute("href") === `#${id}`) {
            link.classList.add("active");
          }
        });
      }
    });
  }

  window.addEventListener("scroll", activateLink);
</script>

</body>
</html>
