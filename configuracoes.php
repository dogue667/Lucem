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
        /* ===================== CORES PADRÃO ===================== */
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

        /* Ícone ⚙️ */
        .nav-icons a {
            font-size: 1.6rem;
            color: var(--roxo-escuro);
            transition: transform 0.4s ease, color 0.2s ease;
            text-decoration: none;
            margin-left: 25px;
        }

        .nav-icons a:hover {
            transform: rotate(180deg) scale(1.15);
            color: var(--roxo);
        }

        .container {
            max-width: 900px;
            background: var(--menu);
            margin: 140px auto 60px;
            padding: 40px;
            border-radius: 30px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        }

        /* ===================== ACORDEÃO ===================== */
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: .3s;
        }

        .acordeon:hover {
            background: var(--hover);
        }

        .painel {
            max-height: 0;
            overflow: hidden;
            background: var(--menu);
            border-radius: 0 0 12px 12px;
            transition: max-height .4s ease;
            padding: 0 22px;
        }

        .painel form,
        .painel div {
            padding: 20px 0;
        }

        label {
            font-weight: 600;
            display: block;
            margin: 12px 0 6px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #d1b3f1;
            font-size: 1em;
            outline: none;
        }

        input:focus {
            border-color: var(--roxo);
        }

        button.salvar {
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

        button.salvar:hover {
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
        }

        .dark-mode .container {
            background-color: #1e1e1e !important;
        }

        .dark-mode input {
            background-color: #303030;
            color: #fff;
            border: 1px solid #666;
        }

        .dark-mode button {
            background: #8b5bb5;
        }
    </style>
</head>

<body>

    <!-- NAVBAR FINAL LIMPA -->
    <header>
        <div class="logo">🌞 LUCEM</div>

        <nav>
            <ul>
                <li><a href="index.php">Sobre</a></li>

                <?php if (isset($_SESSION['psicologo_id'])): ?>
                    <li><a href="painel_psicologo.php">Painel</a></li>
                    <li><a href="lista_paciente.php">Meus Pacientes</a></li>
                    <li><a href="artigos.php">Artigos</a></li>
                    <li><a href="config_psicologo.php" style="font-weight:600; color:var(--roxo);">Configurações</a></li>
                    <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>

                <?php elseif (isset($_SESSION['usuario_id'])): ?>
                    <li><a href="registra_emocoes.php">Registrar Emoções</a></li>
                    <li><a href="minhas_emocoes.php">Minhas Emoções</a></li>
                    <li><a href="atendimento.php">Atendimento Psicológico</a></li>
                    <li><a href="artigos.php">Artigos</a></li>
                    <li><a href="metas.php">Exercícios & Metas</a></li>
                    <li><a href="configuracoes.php" style="font-weight:600; color:var(--roxo);">Configurações</a></li>
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
            <a href="configuracoes.php">⚙️</a>
        </div>
    </header>

    <!-- CONTEÚDO -->
    <div class="container">

        <h1>Configurações</h1>

        <!-- VISUAL -->
        <button class="acordeon">🎨 Visual</button>
        <div class="painel">
            <div>
                <p><strong>Modo Escuro:</strong></p>
                <button class="salvar" onclick="toggleDarkMode()">Ativar / Desativar Dark Mode</button>
            </div>

            <div>
                <p><strong>Modo Daltônico:</strong></p>
                <button class="salvar">Ativar (em produção)</button>
            </div>
        </div>

        <!-- ACESSIBILIDADE -->
        <button class="acordeon">♿ Acessibilidade</button>
        <div class="painel">
            <p><strong>Audiodescrição:</strong> (em produção)</p>
            <p><strong>Leitura de botões:</strong> (em produção)</p>
        </div>

        <!-- SEGURANÇA -->
        <button class="acordeon">🔒 Segurança</button>
        <div class="painel">

            <?php $isPsicologo = isset($_SESSION['psicologo_id']); ?>

            <h3>🔑 Trocar Senha</h3>

            <form action="<?= $isPsicologo ? 'trocar_senha_psicologo.php' : 'trocar_senha.php'; ?>" method="POST">

                <label>Senha Atual:</label>
                <input type="password" name="senha_atual" required>

                <label>Nova Senha:</label>
                <input type="password" name="senha_nova" required>

                <label>Confirmar Nova Senha:</label>
                <input type="password" name="senha_confirmar" required>

                <button class="salvar" type="submit">Atualizar Senha</button>
            </form>

            <hr style="border:0;height:1px;background:#ddd;margin:25px 0;">

            <h3>📧 Trocar E-mail</h3>

            <form action="<?= $isPsicologo ? 'trocar_email_psicologo.php' : 'trocar_email.php'; ?>" method="POST">

                <label>Novo E-mail:</label>
                <input type="email" name="email_novo" required>

                <label>Senha Atual:</label>
                <input type="password" name="senha_atual" required>

                <button class="salvar" type="submit">Atualizar E-mail</button>
            </form>
        </div>

    </div>

    <!-- SCRIPT ACORDEÃO -->
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

    <!-- SCRIPT DARK MODE -->
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

