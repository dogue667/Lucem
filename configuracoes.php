<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUCEM — Configurações</title>

    <style>
        /* ===================== CORES PADRÃO (MESMAS DA INDEX) ===================== */
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
            transition: 0.3s ease;
        }

        /* ===================== NAVBAR ===================== */
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
            transition: 0.3s;
        }

        nav ul li a:hover {
            background-color: var(--hover);
            color: var(--roxo);
        }

        /* Ícone de engrenagem */
        .nav-icons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .config-icon {
            font-size: 1.5rem;
            color: var(--roxo-escuro);
            text-decoration: none;
            transition: 0.3s;
        }

        .config-icon:hover {
            transform: rotate(20deg);
            color: var(--roxo);
        }

        /* ===================== CONTAINER ===================== */
        .container {
            margin-top: 140px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            background: var(--menu);
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
            transition: 0.3s;
        }

        h2 {
            font-family: "Playfair Display", serif;
            color: var(--roxo-escuro);
            margin-bottom: 15px;
        }

        .grupo {
            margin-bottom: 40px;
        }

        .box {
            background: var(--bege);
            padding: 18px;
            border-radius: 20px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 600;
        }

        .box:hover {
            transform: translateY(-4px);
        }

        .conteudo {
            display: none;
            background: #ffffff;
            padding: 25px;
            margin-top: 12px;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            animation: abrir 0.3s ease;
        }

        @keyframes abrir {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        label {
            font-weight: 600;
            display: block;
            margin: 12px 0 6px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #d1b3f1;
            font-size: 1em;
            outline: none;
        }

        input:focus,
        select:focus {
            border-color: var(--roxo);
        }

        button {
            margin-top: 20px;
            background: var(--roxo);
            color: white;
            padding: 12px 22px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        button:hover {
            background: var(--roxo-escuro);
        }

        /* ===================== DARK MODE ===================== */
        .dark-mode {
            background-color: #121212 !important;
            color: #eeeeee !important;
        }

        .dark-mode header {
            background-color: #1e1e1e !important;
        }

        .dark-mode nav ul li a {
            color: #e0e0e0 !important;
        }

        .dark-mode nav ul li a:hover {
            background-color: #333 !important;
            color: #fff !important;
        }

        .dark-mode .container {
            background-color: #1e1e1e !important;
        }

        .dark-mode .box {
            background-color: #2b2b2b !important;
        }

        .dark-mode .conteudo {
            background-color: #242424 !important;
        }

        .dark-mode input,
        .dark-mode select {
            background-color: #303030;
            color: #fff;
            border: 1px solid #666;
        }

        .dark-mode button {
            background: #8b5bb5;
        }

        .dark-mode button:hover {
            background: #6e4690;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
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
                    <li><a href="config_psicologo.php">Configurações</a></li>
                    <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>

                <?php elseif (isset($_SESSION['usuario_id'])): ?>
                    <li><a href="registra_emocoes.php">Registrar Emoções</a></li>
                    <li><a href="minhas_emocoes.php">Minhas Emoções</a></li>
                    <li><a href="atendimento.php">Atendimento Psicológico</a></li>
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

        <h2>Configurações da Conta</h2>

        <!-- VISUAL -->
        <div class="grupo">
            <div class="box" onclick="toggleBox('visual')">🎨 Configurações de Visual</div>
            <div id="visual" class="conteudo">

                <label for="darkmode">Modo Escuro</label>
                <button onclick="toggleDarkMode()">Alternar Modo Escuro</button>

                <br><br>

                <label>Modo Daltonismo</label>
                <select id="daltonismo">
                    <option value="">Selecione…</option>
                    <option value="protanopia">Protanopia</option>
                    <option value="deuteranopia">Deuteranopia</option>
                    <option value="tritanopia">Tritanopia</option>
                </select>

            </div>
        </div>

        <!-- ALTERAR EMAIL -->
        <h2>Segurança</h2>
<!-- ALTERAR E-MAIL -->
<div class="grupo">
    <div class="box" onclick="toggleBox('email')">📧 Alterar E-mail</div>

    <div id="email" class="conteudo">
        <form action="alteraemail.php" method="POST">

            <label for="email_atual">E-mail atual</label>
            <input type="email" id="email_atual" name="email_atual" required>

            <label for="novo_email">Novo e-mail</label>
            <input type="email" id="novo_email" name="novo_email" required>

            <label for="senha_email">Senha atual (obrigatória)</label>
            <input type="password" id="senha_email" name="senha_email" required>

            <button type="submit" name="atualizar_email">Atualizar E-mail</button>
        </form>
    </div>
</div>


<!-- ALTERAR SENHA -->
<div class="grupo">
    <div class="box" onclick="toggleBox('senha')">🔒 Alterar Senha</div>

    <div id="senha" class="conteudo">
        <form action="alterasenha.php" method="POST">

            <label for="senha_atual">Senha atual</label>
            <input type="password" id="senha_atual" name="senha_atual" required>

            <label for="nova_senha">Nova senha</label>
            <input type="password" id="nova_senha" name="nova_senha" required>

            <label for="confirmar_senha">Confirmar nova senha</label>
            <input type="password" id="confirmar_senha" name="confirmar_senha" required>

            <button type="submit" name="atualizar_senha">Atualizar Senha</button>
        </form>
    </div>
</div>


    <!-- SCRIPT DAS CAIXAS -->
    <script>
        function toggleBox(id) {
            const box = document.getElementById(id);
            box.style.display = (box.style.display === "block") ? "none" : "block";
        }
    </script>

    <!-- SCRIPT DO DARK MODE GLOBAL -->
    <script>
        function toggleDarkMode() {
            document.body.classList.toggle("dark-mode");
            localStorage.setItem("darkMode", document.body.classList.contains("dark-mode"));
        }

        document.addEventListener("DOMContentLoaded", () => {
            if (localStorage.getItem("darkMode") === "true") {
                document.body.classList.add("dark-mode");
            }
        });
    </script>

</body>

</html>
