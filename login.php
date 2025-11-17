<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
  // Se já está logado, vai direto pra página inicial
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
<style>
  body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    background: #fdeedd;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

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
</body>
</html>
