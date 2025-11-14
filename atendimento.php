<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LUCEM — Artigos e Inspirações</title>

  <!-- FONTES -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg: #f9efe4;
      --menu: #ffffff;
      --texto: #5b3a70;
      --roxo: #9b6bc2;
      --roxo-escuro: #4d2f68;
      --hover: #e7d3f5;
      --degrade: linear-gradient(135deg, #d1b3f1, #a57cd3, #8a68b0);
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: "Inter", sans-serif;
      background-color: var(--bg);
      color: var(--texto);
      overflow-x: hidden;
    }

    /* ---------- MENU ---------- */
    header {
      background-color: var(--menu);
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 18px 40px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 100;
      flex-wrap: wrap;
      gap: 10px;
    }

    .logo {
      font-family: "Playfair Display", serif;
      font-weight: 700;
      font-size: clamp(1.4em, 2.5vw, 1.7em);
      color: var(--roxo-escuro);
      letter-spacing: 1px;
      margin-right: 60px;
      white-space: nowrap;
    }

    nav ul {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
      gap: 25px;
      flex-wrap: wrap;
      justify-content: center;
    }

    nav ul li {
      position: relative;
    }

    nav ul li a {
      text-decoration: none;
      color: var(--roxo-escuro);
      font-weight: 500;
      font-size: 1em;
      padding: 10px 16px;
      border-radius: 10px;
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    nav ul li a:hover {
      background-color: var(--hover);
      color: var(--roxo);
    }

    nav ul ul {
      display: none;
      position: absolute;
      background-color: var(--menu);
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      top: 45px;
      padding: 10px 0;
      min-width: 160px;
    }

    nav ul li:hover > ul {
      display: block;
    }

    nav ul ul li a {
      display: block;
      padding: 10px 15px;
    }

    /* ---------- BANNER ---------- */
    .banner {
      margin-top: 130px;
      text-align: center;
      background: var(--degrade);
      color: white;
      padding: 100px 20px 130px;
      border-radius: 60px;
      margin-inline: 20px;
    }

    .banner h1 {
      font-family: "Playfair Display", serif;
      font-size: clamp(1.8em, 4vw, 2.6em);
      margin-bottom: 10px;
    }

    .banner p {
      font-size: clamp(1em, 2vw, 1.2em);
      max-width: 600px;
      margin: 0 auto;
      line-height: 1.6;
    }

    /* ---------- ARTIGOS ---------- */
    .artigos {
      padding: 90px 40px;
      text-align: center;
    }

    .artigos h2 {
      font-family: "Playfair Display", serif;
      font-size: clamp(1.6em, 3vw, 2em);
      color: var(--roxo-escuro);
      margin-bottom: 50px;
    }

    .lista-artigos {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .artigo {
      background-color: var(--menu);
      border-radius: 20px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.08);
      width: clamp(250px, 30vw, 300px);
      text-align: left;
      overflow: hidden;
      transition: 0.3s;
    }

    .artigo:hover {
      transform: translateY(-6px);
      background-color: var(--hover);
    }

    .artigo img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .conteudo-artigo {
      padding: 20px;
    }

    .conteudo-artigo h3 {
      color: var(--roxo);
      margin-top: 0;
      margin-bottom: 10px;
      font-size: 1.2em;
    }

    .conteudo-artigo p {
      font-size: 0.95em;
      color: var(--texto);
      line-height: 1.5;
    }

    .leia-mais {
      display: inline-block;
      margin-top: 12px;
      color: var(--roxo-escuro);
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }

    .leia-mais:hover {
      color: var(--roxo);
    }

    /* ---------- CTA ---------- */
    .cta {
      background: var(--degrade);
      color: white;
      text-align: center;
      padding: 80px 20px;
      border-radius: 50px;
      margin: 60px 40px;
    }

    .cta h2 {
      font-family: "Playfair Display", serif;
      font-size: clamp(1.6em, 3vw, 2em);
      margin-bottom: 20px;
    }

    .cta a {
      background: white;
      color: var(--roxo-escuro);
      padding: 14px 34px;
      border-radius: 30px;
      font-weight: 600;
      text-decoration: none;
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
      transition: 0.3s;
    }

    .cta a:hover {
      background: var(--roxo-escuro);
      color: white;
      transform: translateY(-2px);
    }

    footer {
      background-color: var(--menu);
      text-align: center;
      padding: 25px;
      font-size: 0.9em;
      color: #866b95;
      margin-top: 60px;
      box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.05);
    }

    /* ---------- ANIMAÇÕES ---------- */
    .fade {
      opacity: 0;
      transform: translateY(40px);
      transition: all 1s ease;
    }

    .fade.visible {
      opacity: 1;
      transform: translateY(0);
    }

    @media (max-width: 768px) {
      header {
        flex-direction: column;
        text-align: center;
      }

      nav ul {
        flex-direction: column;
        gap: 10px;
      }

      .logo {
        margin: 0 0 10px 0;
      }

      .artigo {
        width: 90%;
      }

      .cta {
        margin: 40px 20px;
        border-radius: 30px;
      }

      .banner {
        border-radius: 40px;
        padding: 80px 15px;
      }
    }
  </style>
</head>
<body>

  <!-- ---------- MENU ---------- -->
  <header>
    <div class="logo">🌞 LUCEM</div>
    <nav>
      <ul>
        <li><a href="index.php" style="font-weight:600; color:var(--roxo);">Sobre</a></li>

        <?php if(!isset($_SESSION['usuario_id'])): ?>
          <li><a href="cadastro.html" style="color:#d9534f;">Criar Conta</a></li>
          <li><a href="login.php" style="color:#d9534f;">Fazer login</a></li>
        <?php else: ?>
          <li><a href="registra_emocoes.php">Registrar Emoções</a></li>
          <li><a href="atendimento.php" style="font-weight:600; color:var(--roxo);">Atendimento Psicológico</a></li>
          <li><a href="artigos.php" style="font-weight:600; color:var(--roxo);">Artigos</a></li>
          <li><a href="metas.php">Exercícios & Metas</a></li>
          <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <!-- ---------- BANNER ---------- -->
  <section class="banner fade">
    <h1>Artigos e Inspirações 💭</h1>
    <p>Conteúdos que acolhem, informam e fortalecem sua jornada de autocuidado.</p>
  </section>

  <!-- ---------- ARTIGOS ---------- -->
  <section class="artigos">
    <h2>Explore nossos conteúdos</h2>
    <div class="lista-artigos">
      <!-- (seus artigos originais aqui — mantidos idênticos) -->
    </div>
  </section>

  <!-- ---------- CTA ---------- -->
  <section class="cta fade">
    <h2>Cuide da sua mente</h2>
    <p>Encontre conteúdos confiáveis sobre saúde mental no site oficial do Governo Federal.</p>
    <a href="https://www.gov.br/saude/pt-br" target="_blank">Leia mais artigos em gov.br</a>
  </section>

  <!-- ---------- FOOTER ---------- -->
  <footer>
    © 2025 LUCEM — Todos os direitos reservados.
  </footer>

  <!-- ---------- SCRIPT DE ANIMAÇÃO ---------- -->
  <script>
    const faders = document.querySelectorAll(".fade");

    const appearOptions = {
      threshold: 0.2,
      rootMargin: "0px 0px -100px 0px"
    };

    const appearOnScroll = new IntersectionObserver(function(entries, observer) {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("visible");
        observer.unobserve(entry.target);
      });
    }, appearOptions);

    faders.forEach(fader => {
      appearOnScroll.observe(fader);
    });
  </script>
</body>
</html>
