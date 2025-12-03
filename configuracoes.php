<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUCEM — Configurações</title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="darkmode.css">
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

        /* ===================== FORMULÁRIOS ===================== */
        .painel form,
        .painel div {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 0;
            gap: 12px;
        }

        label {
            font-weight: 600;
            display: block;
            margin: 12px 0 6px;
            width: 100%;
            max-width: 400px;
        }

        input,
        button.salvar {
            width: 100%;
            max-width: 400px;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #d1b3f1;
            font-size: 1em;
            outline: none;
            box-sizing: border-box;
        }

        input:focus {
            border-color: var(--roxo);
        }

        button.salvar {
            background: var(--roxo);
            color: white;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
            border: none;
        }

        button.salvar:hover {
            background: var(--roxo-escuro);
        }

        /* ===================== TITULOS ===================== */
        h1 {
            text-align: center;
            margin-top: 20px;
        }

        hr {
            border: 0;
            height: 1px;
            background: #ddd;
            margin: 25px 0;
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <?php include "nav.php"; ?>

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

            <hr>

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
