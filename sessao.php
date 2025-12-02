<?php
session_start();

// Verifica se o paciente está logado (AGORA USANDO A MESMA SESSÃO DO LOGIN)
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

<!-- DARK MODE -->
<link rel="stylesheet" href="darkmode.css">

<style>
/* ---------- CORES LUCEM ---------- */
:root {
    --bg: #f9efe4;
    --menu: #ffffff;
    --texto: #5b3a70;
    --roxo: #9b6bc2;
    --roxo-escuro: #4d2f68;
    --hover: #e9d6f3;
}

/* ---------- GERAL ---------- */
body {
    background: var(--bg);
    font-family: "Poppins", sans-serif;
    color: var(--texto);
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* ---------- CAIXA ---------- */
.box {
    background: var(--menu);
    width: 380px;
    padding: 32px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    animation: fadeIn .4s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to   { opacity: 1; transform: translateY(0); }
}

h2 {
    margin: 0 0 10px;
    font-size: 26px;
    color: var(--roxo-escuro);
}

/* ---------- TEXTO ---------- */
.box p {
    font-size: 15px;
}

/* ---------- BOTÃO ---------- */
button {
    background: var(--roxo);
    color: white;
    border: none;
    padding: 14px 22px;
    border-radius: 14px;
    font-size: 17px;
    cursor: pointer;
    width: 100%;
    margin-top: 18px;
    transition: 0.2s ease;
}

button:hover {
    background: var(--roxo-escuro);
}

/* ---------- STATUS ---------- */
#status {
    margin-top: 18px;
    font-size: 14px;
    font-weight: bold;
    color: var(--texto);
}
</style>

</head>

<body>

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

<!-- DARK MODE -->
<script src="darkmode.js"></script>

</body>
</html>
