<?php
session_start();
if (isset($_SESSION['psicologo_id'])) {
  header("Location: painel_psicologo.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Login Psicólogo - LUCEM</title>

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

/* ---------- AJUSTES GERAIS ---------- */
body {
  margin: 0;
  font-family: "Poppins", sans-serif;
  background: var(--bg);
  padding-top: 90px; /* impede sobreposição do menu */
  display: flex;
  justify-content: center;
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
  z-index: 1000;
}

.logo {
  font-family: "Playfair Display", serif;
  font-weight: 700;
  font-size: 1.7em;
  color: var(--roxo-escuro);
  margin-right: 80px;
}

nav ul {
  list-style: none;
  display: flex;
  gap: 25px;
  margin: 0;
  padding: 0;
}

nav ul li a {
  text-decoration: none;
  color: var(--roxo-escuro);
  font-weight: 500;
  padding: 10px 16px;
  border-radius: 10px;
  transition: 0.3s ease;
}

nav ul li a:hover {
  background-color: var(--hover);
  color: var(--roxo);
}

/* ---------- LOGIN BOX ---------- */
.container {
  display: flex;
  background: #fff7ef;
  width: 80%;
  max-width: 1200px;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

.left {
  flex: 1.3;
  padding: 50px;
  display: flex;
  flex-direction: column;
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

<!-- MENU SUPERIOR -->
<header>
  <div class="logo">🌞 LUCEM</div>

  <nav>
    <ul>
      <li><a href="index.php">Sobre</a></li>
      <li><a href="cadastro.html" style="color:#d9534f;">Criar Conta</a></li>
      <li><a href="login.php" style="color:#d9534f;">Fazer Login</a></li>
      <li><a href="login.psicologo.php" style="color:#9b6bc2; font-weight:600;">Login Psicólogo</a></li>
      <li><a href="cadastrar_psicologo.html" style="color:#d9534f;">Cadastro Psicólogo</a></li>
    </ul>
  </nav>

   <div class="nav-icons">
            <a href="configuracoes.php" class="config-icon">⚙️</a>
        </div>
</header>

<!-- CAIXA DE LOGIN -->
<div class="container">

  <div class="left">
    <img src="lucem.png" alt="Logo Lucem" />
    <h1>Login de Psicólogo ☀️</h1>
    <p>Entre e continue sua jornada de equilíbrio.</p>
  </div>

  <div class="right">
    <h2>Entrar</h2>
    <p>Use seu e-mail e senha cadastrados.</p>

    <?php if (isset($_GET['erro'])): ?>
      <p class="erro"><?= htmlspecialchars($_GET['erro']) ?></p>
    <?php endif; ?>

    <form action="sessao_psicologo.php" method="POST">
      <input type="email" name="email" placeholder="E-mail" required />
      <input type="password" name="senha" placeholder="Senha" required />
      <button class="btn" type="submit">Entrar</button>
    </form>

    <p class="login-link">Não possui conta?
      <a href="cadastro_psicologo.html">Cadastrar</a>
    </p>
  </div>

</div>

</body>
</html>
