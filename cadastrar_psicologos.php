<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LUCEM - Cadastro Psicólogo</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="darkmode.css" />
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
      }

      /* -------- VARIÁVEIS -------- */
      :root {
        --bg: #f9efe4;
        --menu: #ffffff;
        --texto: #5b3a70;
        --roxo: #9b6bc2;
        --roxo-escuro: #4d2f68;
        --hover: #e7d3f5;
      }

      /* -------- BODY -------- */
      body {
        background-color: #fdf4eb;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 110px;
        /* evita que o card fique atrás do menu */
      }

    

      /* -------- CARD DO CADASTRO -------- */
      .card {
        background-color: #fff3e4;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 50px 40px;
        width: 100%;
        max-width: 400px;
        text-align: center;
      }

      h3 {
        font-size: 26px;
        color: #4b2b12;
        margin-bottom: 12px;
      }

      form {
        display: flex;
        flex-direction: column;
        gap: 12px;
      }

      form input {
        width: 100%;
        padding: 10px;
        border: 1px solid #d9b89c;
        border-radius: 8px;
        background-color: #fff;
        font-size: 14px;
      }

      .btn {
        background-color: #6d4af0;
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
        transition: 0.3s ease;
      }

      .btn:hover {
        background-color: #5b39d0;
      }

      .login-link {
        margin-top: 15px;
        font-size: 14px;
        color: #4b2b12;
      }

      .login-link a {
        color: #6d4af0;
        text-decoration: none;
        font-weight: 600;
      }
    </style>
  </head>

  <body>
 <!-------------- NAV ---------- -->
<?php include "nav.php"; ?>
  

    <!-- -------- CARD -------- -->
    <div class="card">
      <h3>Crie sua conta de psicólogo</h3>

      <form action="cadastrar_psicologo.php" method="POST">
        <input type="text" name="nome" placeholder="Nome completo" required />
        <input
          type="email"
          name="email"
          placeholder="E-mail profissional"
          required
        />
        <input type="text" name="crp" placeholder="Número do CRP" required />
        <input
          type="password"
          name="senha"
          placeholder="Crie uma senha"
          required
        />
        <button class="btn" type="submit">Cadastrar</button>
      </form>

      <div class="login-link">
        Já tem uma conta? <a href="login_psicologo.php">Entrar</a>
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
