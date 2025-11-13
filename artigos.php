<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LUCEM | Artigos</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

  <style>
    /* ---------- CORES ---------- */
    :root {
      --bg: #f9efe4;
      --menu: #ffffff;
      --texto: #5b3a70;
      --roxo: #9b6bc2;
      --roxo-escuro: #4d2f68;
      --hover: #e7d3f5;
      --degrade: linear-gradient(135deg, #d1b3f1, #a57cd3, #8a68b0);
      --bege: #f3dcc5;
    }

    body {
      margin: 0;
      font-family: "Inter", sans-serif;
      background-color: var(--bg);
      color: var(--texto);
      overflow-x: hidden;
    }

    /* ---------- MENU SUPERIOR ---------- */
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
    }

    .logo {
      font-family: "Playfair Display", serif;
      font-weight: 700;
      font-size: 1.7em;
      color: var(--roxo-escuro);
      letter-spacing: 1px;
      margin-right: 80px;
    }

    nav ul {
      list-style: none;
      display: flex;
      margin: 0;
      padding: 0;
      gap: 25px;
    }

    nav ul li a {
      text-decoration: none;
      color: var(--roxo-escuro);
      font-weight: 500;
      font-size: 1em;
      padding: 10px 16px;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    nav ul li a:hover {
      background-color: var(--hover);
      color: var(--roxo);
    }

    /* ---------- CONTEÚDO PRINCIPAL ---------- */
    main {
      margin-top: 140px;
      padding: 40px 20px 80px;
      max-width: 1000px;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }

    main h1 {
      font-family: "Playfair Display", serif;
      font-size: 2.5em;
      color: var(--roxo-escuro);
      margin-bottom: 10px;
    }

    main p {
      font-size: 1.2em;
      color: var(--texto);
      margin-bottom: 40px;
    }

    /* ---------- GRID DE ARTIGOS ---------- */
    .artigos-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
      gap: 30px;
    }

    .artigo {
      background-color: var(--menu);
      border-radius: 20px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.08);
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

    .artigo-content {
      padding: 20px;
    }

    .artigo-content h3 {
      color: var(--roxo);
      margin-bottom: 10px;
      font-size: 1.3em;
    }

    .artigo-content p {
      font-size: 0.95em;
      color: var(--texto);
      line-height: 1.5;
    }

    .botao {
      display: inline-block;
      margin-top: 15px;
      background: var(--degrade);
      color: white;
      padding: 10px 25px;
      border-radius: 25px;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
    }

    .botao:hover {
      transform: scale(1.05);
    }

    footer {
      background-color: var(--menu);
      text-align: center;
      padding: 25px;
      font-size: 0.9em;
      color: #866b95;
      margin-top: 50px;
      box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>

<body>
  <!-- NAVBAR IGUAL AO INDEX -->
  <header>
    <div class="logo">🌞 LUCEM</div>
    <nav>
      <ul>
        <li><a href="index.php">Sobre</a></li>

        <?php if(!isset($_SESSION['usuario_id'])): ?>
          <li><a href="cadastro.html">Criar Conta</a></li>
          <li><a href="login.php">Fazer login</a></li>
        <?php else: ?>
          <li><a href="registra_emocoes.php">Registrar Emoções</a></li>
          <li><a href="atendimento.php">Atendimento Psicológico</a></li>
          <li><a href="artigos.php" style="font-weight:600; color:var(--roxo);">Artigos</a></li>
          <li><a href="metas.php">Exercícios & Metas</a></li>
          <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

  <!-- CONTEÚDO -->
  <main>
    <h1>📰 Artigos sobre Saúde Mental</h1>
    <p>Explore conteúdos cuidadosamente selecionados para o seu bem-estar emocional e crescimento pessoal.</p>

    <div class="artigos-container">
      <div class="artigo">
        <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97" alt="Mindfulness">
        <div class="artigo-content">
          <h3>O poder do Mindfulness</h3>
          <p>Descubra como a atenção plena pode reduzir o estresse e melhorar sua qualidade de vida.</p>
          <a href="#" class="botao">Ler mais</a>
        </div>
      </div>

      <div class="artigo">
        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f" alt="Autoconhecimento">
        <div class="artigo-content">
          <h3>Autoconhecimento e Emoções</h3>
          <p>Aprenda a identificar e lidar com suas emoções para alcançar equilíbrio emocional.</p>
          <a href="#" class="botao">Ler mais</a>
        </div>
      </div>

      <div class="artigo">
        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2" alt="Sono e bem-estar">
        <div class="artigo-content">
          <h3>O impacto do sono no bem-estar</h3>
          <p>Compreenda a importância do sono na saúde mental e física, e veja como melhorar sua rotina.</p>
          <a href="#" class="botao">Ler mais</a>
        </div>s
      </div>
    </div>
  </main>

  <footer>
    <p>© 2025 LUCEM — Promovendo saúde emocional com empatia e tecnologia 💜</p>
  </footer>
</body>
</html>
