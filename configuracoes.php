<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>LUCEM — Configurações</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="darkmode.css">

<style>

/* Cores do site */
:root {
  --bg: #f9efe4;
  --menu: #ffffff;
  --texto: #5b3a70;
  --roxo: #9b6bc2;
  --roxo-escuro: #4d2f68;
  --hover: #e7d3f5;
  --bege: #f3dcc5;
}

body {
  margin: 0;
  font-family: "Inter", sans-serif;
  background: var(--bg);
  color: var(--texto);
}

/* MENU IGUAL AO INDEX */
header {
  background-color: var(--menu);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 18px 40px;
  box-shadow: 0 3px 10px rgba(0, 0, 0, .1);
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
  display: flex;
  gap: 25px;
  list-style: none;
}

nav a {
  text-decoration: none;
  color: var(--roxo-escuro);
  padding: 10px 16px;
  border-radius: 10px;
  transition: .3s;
  font-weight: 500;
}

nav a:hover {
  background: var(--hover);
  color: var(--roxo);
}

/* BOTÃO DARK */
#darkToggle {
  margin-left: 20px;
  padding: 8px 14px;
  border-radius: 10px;
  cursor: pointer;
}

/* ---- CONTEÚDO ---- */
.container {
  max-width: 900px;
  margin: 140px auto 60px;
  padding: 20px;
}

/* Título */
h1 {
  text-align: center;
  font-family: "Playfair Display", serif;
  font-size: 2.2em;
  margin-bottom: 40px;
  color: var(--roxo-escuro);
}

/* ---- BOTÕES ACORDEÃO ---- */
.acordeon {
  background: var(--menu);
  padding: 18px 22px;
  width: 100%;
  text-align: left;
  border-radius: 12px;
  border: none;
  font-size: 1.1em;
  font-weight: 600;
  color: var(--roxo-escuro);
  cursor: pointer;
  margin-top: 15px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  transition: .3s;
}

.acordeon:hover {
  background: var(--hover);
}

.acordeon:after {
  content: "▼";
  float: right;
  transition: .3s;
}

.acordeon.active:after {
  transform: rotate(180deg);
}

/* Conteúdo do acordeão */
.painel {
  max-height: 0;
  overflow: hidden;
  background: var(--menu);
  border-radius: 0 0 12px 12px;
  transition: max-height .4s ease;
  padding: 0 22px;
}

/* Campos internos */
.painel form,
.painel div {
  padding: 20px 0;
}

label {
  font-weight: 500;
  color: var(--roxo-escuro);
}

input {
  width: 100%;
  padding: 12px;
  margin-top: 8px;
  border-radius: 10px;
  border: 1px solid #ccc;
}

button.salvar {
  margin-top: 15px;
  padding: 12px 26px;
  border-radius: 10px;
  background: var(--roxo);
  color: white;
  border: none;
  cursor: pointer;
  font-weight: 600;
  transition: .3s;
}

button.salvar:hover {
  background: var(--roxo-escuro);
}
</style>
</head>
<body>

<header>
  <div class="logo">🌞 LUCEM</div>
  <nav>
    <ul>
      <li><a href="index.php">Início</a></li>
      <li><a href="artigos.php">Artigos</a></li>
      <li><a href="metas.php">Exercícios</a></li>
      <li><a href="configuracoes.php" style="font-weight:600; color:var(--roxo)">Configurações</a></li>
      <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>
    </ul>
  </nav>

  <button id="darkToggle" onclick="toggleDarkMode()">🌓</button>
</header>


<div class="container">
  <h1>Configurações</h1>

  <!-- Visual -->
  <button class="acordeon">🎨 Visual</button>
  <div class="painel">
    <div>
      <p><strong>Modo Escuro:</strong></p>
      <button class="salvar" onclick="toggleDarkMode()">Ativar / Desativar Dark Mode</button>
    </div>

    <div>
      <p><strong>Modo Daltônico (protanopia / deuteranopia / tritanopia):</strong></p>
      <button class="salvar">Ativar (em produção)</button>
    </div>

    <div>
      <p><strong>Modo com texto maior:</strong></p>
      <button class="salvar">Aumentar fonte (em produção)</button>
    </div>
  </div>

  <!-- Acessibilidade -->
  <button class="acordeon">♿ Acessibilidade</button>
  <div class="painel">
    <p><strong>Audiodescrição:</strong> (em produção)</p>
    <p><strong>Leitura automática de botões:</strong> (em produção)</p>
  </div>

  <!-- Segurança -->
  <button class="acordeon">🔒 Segurança</button>
  <div class="painel">
    <form>
      <label>Novo E-mail:</label>
      <input type="email" placeholder="Digite seu novo e-mail">
      
      <label>Senha Atual:</label>
      <input type="password">

      <label>Nova Senha:</label>
      <input type="password">

      <button class="salvar">Salvar Alterações</button>
    </form>
  </div>
</div>

<!-- Script accordion -->
<script>
const acc = document.querySelectorAll(".acordeon");
acc.forEach(btn => {
  btn.addEventListener("click", () => {
    btn.classList.toggle("active");
    const painel = btn.nextElementSibling;

    if (painel.style.maxHeight) {
      painel.style.maxHeight = null;
    } else {
      painel.style.maxHeight = painel.scrollHeight + "px";
    }
  });
});
</script>

<script src="darkmode.js"></script>

</body>
</html>
