<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Login - LUCEM</title>
 <!-- DARK MODE CSS -->
    <link rel="stylesheet" href="darkmode.css">
<style>
/* ---------- CORES ---------- */
:root {
  --bg: #f9efe4;
  --menu: #ffffff;
  --texto: #5b3a70;
  --roxo: #9b6bc2;
  --roxo-escuro: #4d2f68;
  --hover: #e7d3f5;
}

/* ---------- AJUSTE GERAL ---------- */
body {
  margin: 0;
  font-family: "Poppins", sans-serif;
  background-color: var(--bg);
  color: var(--texto);
  padding-top: 90px; /* IMPORTANTE → evita sobreposição do menu */
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
  z-index: 1000;
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
  padding: 10px 16px;
  border-radius: 10px;
  transition: 0.3s;
}
nav ul li a:hover {
  background-color: var(--hover);
  color: var(--roxo);
}

/* ---------- CONTAINER PRINCIPAL ---------- */
.container {
  display: flex;
  background: #fff7ef;
  width: 80%;
  max-width: 1200px;
  margin: auto;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

.left {
  flex: 1.3;
  padding: 50px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.left img {
  width: 100%;
  max-width: 350px;
  margin-bottom: 25px;
}

.right {
  flex: 0.7;
  background: #fff1dd;
  padding: 60px 40px;
  text-align: center;
}

/* ---------- FORM LOGIN ---------- */
.right input {
  width: 100%;
  padding: 12px;
  margin: 8px 0;
  border-radius: 8px;
  border: 1px solid #c9b7a4;
}

.btn {
  background: #6a4fb6;
  color: white;
  border: none;
  padding: 13px;
  width: 100%;
  border-radius: 8px;
  margin-top: 12px;
  cursor: pointer;
}
.btn:hover {
  background: #523c91;
}

.erro {
  color: red;
  margin-bottom: 15px;
}
</style>
</head>

<body>

<!-- ---------- MENU SUPERIOR ---------- -->
<header>
    <div class="logo">🌞 LUCEM</div>

    <nav>
        <ul>
            <li>
                <a href="index.php" style="font-weight:600; color:var(--roxo);">Sobre</a>
            </li>

            <?php if (isset($_SESSION['psicologo_id'])): ?>
                <li><a href="painel_psicologo.php">Painel</a></li>
                <li><a href="lista_paciente.php">Meus Pacientes</a></li>
                <li><a href="artigos.php">Artigos</a></li>
                <li><a href="atendimento.php">Atendimento</a></li>
                <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>

            <?php elseif (isset($_SESSION['usuario_id'])): ?>
                <li><a href="registra_emocoes.php">Registrar Emoções</a></li>
                <li><a href="minhas_emocoes.php">Minhas Emoções</a></li>
                <li><a href="ligacao_paciente.php">Atendimento Psicológico</a></li>
                <li><a href="artigos.php">Artigos</a></li>
                <li><a href="metas.php">Exercícios & Metas</a></li>
                <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>

            <?php else: ?>
                <li><a href="cadastro.html" style="color:#d9534f;">Criar Conta</a></li>
                <li><a href="login.php" style="color:#d9534f;">Fazer Login</a></li>
                <li><a href="login.psicologo.php" style="color:#d9534f;">Login Psicólogo</a></li>
                <li><a href="cadastrar_psicologo.html" style="color:#d9534f;">Cadastro Psicólogo</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="nav-icons">
        <a href="configuracoes.php" class="config-icon">⚙️</a>
    </div>
</header>

<!-- CONTEÚDO -->
<div class="container">

  <div class="left">
    <img src="lucem.png" alt="Logo Lucem" />
    <h1>Bem-vindo(a) ao LUCEM ☀️</h1>
    <p>Entre e continue sua jornada de equilíbrio.</p>
  </div>

  <div class="right">
    <h2>Entrar</h2>
    <p>Use seu e-mail e senha cadastrados.</p>

    <?php if (isset($_GET['erro'])): ?>
      <p class="erro"><?= htmlspecialchars($_GET['erro']) ?></p>
    <?php endif; ?>

    <form action="sessao.php" method="POST">
      <input type="email" name="email" placeholder="E-mail" required />
      <input type="password" name="senha" placeholder="Senha" required />
      <button class="btn" type="submit">Entrar</button>
    </form>

    <p class="login-link">Não possui conta? <a href="cadastro.html">Cadastrar</a></p>
  </div>

</div>
  <script>
  // Salva o dark mode no navegador
function toggleDarkMode() {
    document.body.classList.toggle("dark-mode");

    // Se estiver ativo, salva "1". Se não, salva "0".
    if (document.body.classList.contains("dark-mode")) {
        localStorage.setItem("darkmode", "1");
    } else {
        localStorage.setItem("darkmode", "0");
    }
}

// Ao carregar qualquer página, aplica o darkmode salvo
document.addEventListener("DOMContentLoaded", () => {
    if (localStorage.getItem("darkmode") === "1") {
        document.body.classList.add("dark-mode");
    }
});
</script>
 <script src="darkmode.js"></script>

</body>
</html>
