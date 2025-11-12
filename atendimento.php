<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta com Psicólogo</title>
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
    }

    nav ul li a:hover {
      background-color: var(--hover);
      color: var(--roxo);
    }

    /* ---------- CONTEÚDO ---------- */
    main {
      margin-top: 140px;
      text-align: center;
      padding: 40px 20px;
    }

    h1 {
      font-family: "Playfair Display", serif;
      font-size: 2.5em;
      color: var(--roxo-escuro);
      margin-bottom: 15px;
    }

    p {
      font-size: 1.1em;
      max-width: 700px;
      margin: 0 auto 50px;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .psicologo {
      background-color: var(--menu);
      border-radius: 25px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.08);
      width: 260px;
      padding: 25px;
      transition: 0.3s;
    }

    .psicologo:hover {
      transform: translateY(-6px);
      background-color: var(--hover);
    }

    .psicologo img {
      width: 100%;
      border-radius: 15px;
      margin-bottom: 15px;
    }

    .psicologo h3 {
      color: var(--roxo);
      margin-bottom: 10px;
    }

    .psicologo p {
      font-size: 0.95em;
      margin-bottom: 10px;
    }

    .botao {
      background: var(--roxo);
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 25px;
      cursor: pointer;
      font-weight: 600;
      transition: 0.3s;
    }

    .botao:hover {
      background: var(--roxo-escuro);
    }

    @media (max-width: 768px) {
      header {
        flex-direction: column;
      }
      nav ul {
        flex-direction: column;
        gap: 10px;
      }
      .logo {
        margin: 0 0 10px 0;
      }
    }
  </style>
</head>
<body>

  <header>
  <div class="logo">🌞 LUCEM</div>
  <nav>
    <ul>

      <li><a href="index.php"style="font-weight:600; color:var(--roxo);">Sobre</a></li>

      <?php if(!isset($_SESSION['usuario_id'])): ?>

      <!-- VISÍVEL PARA VISITANTES -->
     <li><a href="cadastro.html">Criar Conta</a></li>
     <li><a href="login.php">Fazer login</a></li>

      <?php else: ?>

      <!-- VISÍVEL SOMENTE PARA LOGADOS -->
      <li><a href="registra_emocoes.php">Registrar Emoções</a></li>
      <li><a href="atendimento.php">Atendimento Psicológico</a></li>
      <li><a href="artigos.php" style="font-weight:600; color:var(--roxo);">Artigos</a></li>
      <li><a href="metas.php">Exercícios & Metas</a></li>
      <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>

      <?php endif; ?>

    </ul>
  </nav>
</header>

  <!-- CONTEÚDO PRINCIPAL -->
  <main>
    <h1>Consulta com Psicólogo</h1>
    <p>Escolha o profissional ideal e agende sua consulta de forma rápida e segura.</p>

    <div class="container">
      <div class="psicologo">
        <img src="https://via.placeholder.com/250x200" alt="Psicólogo João">
        <h3>Dr. João Mendes</h3>
        <p>Especialista em ansiedade e autoconhecimento.</p>
        <p><strong>Horários:</strong> Segunda a sexta, 14h às 18h</p>
        <button class="botao">Agendar</button>
      </div>

      <div class="psicologo">
        <img src="https://via.placeholder.com/250x200" alt="Psicóloga Marina">
        <h3>Dra. Marina Lopes</h3>
        <p>Atendimento para adolescentes e jovens adultos.</p>
        <p><strong>Horários:</strong> Segunda a quinta, 10h às 16h</p>
        <button class="botao">Agendar</button>
      </div>

      <div class="psicologo">
        <img src="https://via.placeholder.com/250x200" alt="Psicóloga Larissa">
        <h3>Dra. Larissa Figueira</h3>
        <p>Foco em saúde mental feminina e autoestima.</p>
        <p><strong>Horários:</strong> Terça e sexta, 9h às 15h</p>
        <button class="botao">Agendar</button>
      </div>
    </div>
  </main>

</body>
</html>
