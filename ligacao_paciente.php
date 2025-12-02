<?php
session_start();

// Verifica se o paciente (usuário) está logado corretamente
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$paciente_nome = $_SESSION['usuario_nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ligação — Paciente</title>

<link rel="stylesheet" href="darkmode.css">

<style>
/* -----------------------------------------------------
   CORES PRINCIPAIS
----------------------------------------------------- */
:root {
    --bg: #f9efe4;
    --menu: #ffffff;
    --texto: #5b3a70;
    --roxo: #9b6bc2;
    --roxo-escuro: #4d2f68;
    --hover: #d4b5e2;
}

/* -----------------------------------------------------
   AJUSTE GLOBAL
----------------------------------------------------- */
body {
    background-color: var(--bg);
    font-family: "Poppins", Arial, sans-serif;
    color: var(--texto);
    margin: 0;
    padding: 0;
    padding-top: 110px; /* Evita o header sobrepor o conteúdo */
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
}

/* -----------------------------------------------------
   HEADER
----------------------------------------------------- */
header {
    background-color: var(--menu);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 40px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
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

/* Submenu */
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

.nav-icons {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.config-icon a {
    font-size: 1.5rem;
    color: var(--roxo-escuro);
    transition: 0.3s;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.config-icon a:hover {
    transform: rotate(20deg);
    color: var(--roxo);
}

/* RESPONSIVO */
@media (max-width: 768px) {
    header { flex-direction: column; }
    nav ul { flex-direction: column; gap: 10px; }
    .logo { margin: 0 0 10px 0; }
}
/* -----------------------------------------------------
   CAIXA CENTRAL
----------------------------------------------------- */
.box {
    background: var(--menu);
    width: 380px;
    padding: 32px;
    border-radius: 18px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    animation: fadeIn .4s ease;
    margin-top: 30px;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to   { opacity: 1; transform: translateY(0); }
}

h2 {
    color: var(--roxo-escuro);
    margin-bottom: 10px;
}

/* BOTÃO */
button {
    background: var(--roxo);
    color: white;
    border: none;
    padding: 14px 22px;
    border-radius: 12px;
    cursor: pointer;
    font-size: 17px;
    width: 100%;
    transition: 0.25s;
    margin-top: 18px;
}

button:hover {
    background: var(--roxo-escuro);
}

#status {
    margin-top: 18px;
    font-size: 14px;
    font-weight: bold;
}

/* -----------------------------------------------------
   RESPONSIVO
----------------------------------------------------- */
@media (max-width: 768px) {
    header {
        flex-direction: column;
        gap: 10px;
        padding: 15px;
    }

    nav ul {
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    body {
        padding-top: 160px;
    }
}
</style>
</head>

<body>

<header>
    <div class="logo">🌞 LUCEM</div>

    <nav>
        <ul>
            <li>
                <a href="index.php" style="font-weight:600; color:var(--roxo);">Sobre</a>
            </li>

            <?php if (isset($_SESSION['psicologo_id'])): ?>
                <li><a href="lista_usuarios.php">Pacientes</a></li>
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
<!-- CAIXA PRINCIPAL -->
<div class="box">
    <h2>Iniciar ligação</h2>

    <p>Olá, <b><?= htmlspecialchars($paciente_nome) ?></b> 👋</p>
    <p>Clique no botão abaixo para iniciar sua ligação com o psicólogo.</p>

    <button onclick="iniciarLigacao()">📞 Iniciar ligação</button>

    <p id="status"></p>
</div>

<script>
function iniciarLigacao() {
    document.getElementById("status").innerText = "Conectando...";

    fetch("api/iniciar_ligacao.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({})
    })
    .then(r => r.json())
    .then(ret => {
        if (ret.status === "ok") {
            document.getElementById("status").innerText = "Ligação iniciada!";
            window.location.href = "sala_chamada.php?call=" + ret.call_id;
        } else {
            document.getElementById("status").innerText = "Erro: " + ret.mensagem;
        }
    })
    .catch(() => {
        document.getElementById("status").innerText = "Não foi possível conectar.";
    });
}
</script>

<script src="darkmode.js"></script>

</body>
</html>
