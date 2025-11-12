<?php
session_start();
?>

<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>LUCEM - Minhas Emoções</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg: #F9F0E6;
      --card: #FFF2EA;
      --muted: #D7B7A8;
      --text: #4A3A33;
      --accent: #E3A999;
      --radius: 12px;
      font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      background: var(--bg);
      color: var(--text);
    }

    /* ----------- HEADER ----------- */
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

    /* ----------- LAYOUT ----------- */
    .container {
      display: flex;
      min-height: 100vh;
      padding: 28px;
    }

    .sidebar {
      width: 220px;
      padding: 18px;
      background: #FFEFE0;
      border-radius: 14px;
      margin-right: 20px;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 20px;
    }

    .logo .sun {
      font-size: 20px;
    }

    .logo .brand {
      font-weight: 700;
    }

    .sidebar nav a {
      display: block;
      padding: 10px 8px;
      border-radius: 10px;
      margin-bottom: 8px;
      color: var(--text);
      cursor: pointer;
    }

    .sidebar nav a.current {
      background: #F6E6DD;
    }

    .sidebar nav a.emergency {
      color: #b33;
    }

    .main {
      flex: 1;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 18px;
    }

    .topbar .welcome {
      font-size: 18px;
    }

    .topbar .feeling {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
    }

    .topbar .feeling label {
      font-size: 13px;
      color: #7a6158;
    }

    .topbar .feeling input {
      padding: 8px;
      border-radius: 8px;
      border: none;
      background: #EEDDD3;
      width: 160px;
    }

    .card.form-card {
      display: flex;
      gap: 20px;
      padding: 18px;
      background: var(--card);
      border-radius: 16px;
      align-items: flex-start;
    }

    .card-head {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
    }

    .card-head h2 {
      margin: 0;
      font-weight: 600;
    }

    .btn-primary {
      background: var(--accent);
      border: none;
      padding: 10px 14px;
      border-radius: 10px;
      color: white;
      cursor: pointer;
    }

    .week {
      display: flex;
      gap: 12px;
      margin: 14px 0;
    }

    .day {
      flex: 1;
    }

    .chip {
      padding: 14px;
      border-radius: 12px;
      text-align: center;
      cursor: pointer;
      box-shadow: 0 2px 0 rgba(0, 0, 0, 0.03);
    }

    .chip span {
      display: block;
      margin-top: 6px;
      font-weight: 600;
    }

    .chip.selected {
      outline: 3px solid rgba(0, 0, 0, 0.03);
      transform: translateY(-4px);
    }

    textarea {
      width: 100%;
      min-height: 80px;
      padding: 12px;
      border-radius: 10px;
      border: none;
      background: #F6EDE6;
    }

    input[type=hidden] {
      display: none;
    }

    .factors {
      display: flex;
      gap: 14px;
      margin: 8px 0;
    }

    .factors label {
      background: #FFF3EE;
      padding: 8px 10px;
      border-radius: 8px;
    }

    .actions {
      margin-top: 8px;
    }

    .btn-save {
      background: #E1A89D;
      border: none;
      padding: 10px 16px;
      border-radius: 10px;
      color: white;
      cursor: pointer;
    }

    .sidebox {
      width: 220px;
      padding: 12px;
      background: transparent;
      border-left: 1px solid rgba(0, 0, 0, 0.04);
    }

    .sidebox h4 {
      margin: 8px 0 6px;
    }

    @media (max-width:900px) {
      .container {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        display: flex;
        flex-direction: row;
        overflow: auto;
      }

      .card.form-card {
        flex-direction: column;
      }

      .sidebox {
        width: 100%;
        border-left: none;
        border-top: 1px solid rgba(0, 0, 0, 0.04);
        padding-top: 12px;
      }
    }
  </style>
</head>

<body>
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $dir = __DIR__ . '/registros';
      if (!is_dir($dir)) mkdir($dir, 0755, true);

      $file = $dir . '/registros.txt';
      $emocao = strip_tags($_POST['emocao'] ?? '');
      $descricao = strip_tags($_POST['descricao'] ?? '');
      $fatores = $_POST['fatores'] ?? [];
      $fatores = array_map('strip_tags', $fatores);

      $entry = "---\nData: " . date('Y-m-d H:i:s') .
              "\nEmoção: " . ($emocao ?: 'Não informada') .
              "\nDescrição:\n" . ($descricao ?: '—') .
              "\n\nFatores:\n" . (count($fatores) ? ('- ' . implode("\n- ", $fatores)) : "—") .
              "\n---\n\n";

      file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
      echo "<script>alert('Registro salvo com sucesso!');</script>";
  }
  ?>

  <header>
    <div class="logo">🌞 LUCEM</div>
    <nav>
      <ul>
        <li><a href="index.php" style="font-weight:600; color:var(--roxo);">Sobre</a></li>

        <?php if (!isset($_SESSION['usuario_id'])): ?>
          <li><a href="cadastro.html"style="font-weight:600; color:var(--roxo);">Criar Conta</a></li>
          <li><a href="login.php"style="font-weight:600; color:var(--roxo);">Fazer login</a></li>
        <?php else: ?>
          <li><a href="emocoes.php">Registrar Emoções</a></li>
          <li><a href="atendimento.php">Atendimento Psicológico</a></li>
          <li><a href="artigos.php" style="font-weight:600; color:var(--roxo);">Artigos</a></li>
          <li><a href="metas.php">Exercícios & Metas</a></li>
          <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>
        <?php endif; ?>

      </ul>
    </nav>
  </header>

  <div class="container">
    <aside class="sidebar">
      <div class="logo">
        <div class="sun">☀️</div>
        <div class="brand">LUCEM</div>
      </div>

      <nav>
        <a class="active">Início</a>
        <a class="active current">Minhas Emoções</a>
        <a>Exercícios de Respiração</a>
        <a>Artigos</a>
        <a>Atendimento Psicológico</a>
        <a>Perfil de Usuário</a>
        <a class="emergency">Emergência</a>
      </nav>
    </aside>

    <main class="main">
      <header class="topbar">
        <div class="welcome">Bem–vindo(a), <strong>Guilherme</strong></div>
        <div class="feeling">
          <label>Como você está se sentindo hoje?</label>
          <input id="moodShort" placeholder="escreva...">
        </div>
      </header>

      <section class="card form-card">
        <div class="card-head">
          <h2>Seu Mapa Emocional da Semana</h2>
          <button class="btn-primary">Registrar Emoção +</button>
        </div>

        <form method="post">
          <div class="week">
            <div class="day"><div class="chip" data-emotion="Calmo" data-color="#F6D7A8">Seg<br><span>Calmo</span></div></div>
            <div class="day"><div class="chip" data-emotion="Triste" data-color="#E6C6D0">Ter<br><span>Triste</span></div></div>
            <div class="day"><div class="chip" data-emotion="Grato" data-color="#CDE7B8">Qua<br><span>Grato</span></div></div>
            <div class="day"><div class="chip" data-emotion="Ansioso" data-color="#F2B3AE">Qui<br><span>Ansioso</span></div></div>
            <div class="day"><div class="chip" data-emotion="Feliz" data-color="#BFD5F0">Sex<br><span>Feliz</span></div></div>
            <div class="day"><div class="chip" data-emotion="" data-color="#F6EDE6">Sáb<br><span>—</span></div></div>
          </div>

          <h3>Descreva seu dia em palavras</h3>
          <input type="hidden" name="emocao" id="emocaoInput">
          <textarea name="descricao" placeholder="Descreva seu dia em palavras"></textarea>

          <h3>O que ajudou ou piorou seu humor?</h3>
          <div class="factors">
            <label><input type="checkbox" name="fatores[]" value="Amigos"> Amigos</label>
            <label><input type="checkbox" name="fatores[]" value="Trabalho"> Trabalho</label>
            <label><input type="checkbox" name="fatores[]" value="Sono"> Sono</label>
            <label><input type="checkbox" name="fatores[]" value="Alimentação"> Alimentação</label>
          </div>

          <div class="actions">
            <button type="submit" class="btn-save">Salvar registro</button>
          </div>
        </form>

        <aside class="sidebox">
          <h4>Resumo da Semana</h4>
          <p>Você se sentiu mais calmo(a) em 3 dias</p>

          <h4>Sugestão Lucem</h4>
          <p>Experimente o exercício de respiração 4x4 hoje.</p>

          <h4>Sugestão Lucem</h4>
          <p>Ouça uma meditação guiada de 1 minuto.</p>
        </aside>
      </section>
    </main>
  </div>

  <script>
    const chips = document.querySelectorAll('.chip');
    const emocaoInput = document.getElementById('emocaoInput');

    chips.forEach(chip => {
      chip.addEventListener('click', () => {
        chips.forEach(c => c.classList.remove('selected'));
        chip.classList.add('selected');
        emocaoInput.value = chip.dataset.emotion || '';
      });
    });
  </script>
</body>
</html>
