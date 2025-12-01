<?php
session_start();

// Verifica se o paciente está logado
if (!isset($_SESSION['paciente_id'])) {
    header("Location: login_paciente.php");
    exit();
}

$paciente_nome = $_SESSION['paciente_nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ligação — Paciente</title>

<style>
    /* ---------- CORES DO SEU SITE ---------- */
    :root {
        --bg: #f9efe4;
        --menu: #ffffff;
        --texto: #5b3a70;
        --roxo: #9b6bc2;
        --roxo-escuro: #4d2f68;
        --hover: #d4b5e2;
    }

    /* ---------- GERAL ---------- */
    body {
        background-color: var(--bg);
        font-family: Arial, sans-serif;
        color: var(--texto);
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .box {
        background: var(--menu);
        width: 380px;
        padding: 30px;
        border-radius: 18px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: fadeIn .4s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(15px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    h2 {
        color: var(--roxo-escuro);
        margin-bottom: 10px;
    }

    button {
        background: var(--roxo);
        color: white;
        border: none;
        padding: 14px 22px;
        border-radius: 12px;
        cursor: pointer;
        font-size: 17px;
        transition: 0.2s;
        width: 100%;
        margin-top: 15px;
    }

    button:hover {
        background: var(--roxo-escuro);
    }

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

    <p>Olá, <b><?php echo htmlspecialchars($paciente_nome); ?></b></p>
    <p>Clique no botão abaixo para iniciar a ligação com seu psicólogo.</p>

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

</body>
</html>
