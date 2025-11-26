<?php
session_start();
require "conexao.php";

// Verifica se o psicólogo está logado
if (!isset($_SESSION['ID_psicologo'])) {
    header("Location: login_psicologo.php");
    exit();
}

$id_psicologo = $_SESSION['ID_psicologo'];

// Buscar sessões agendadas do psicólogo
$sql = $conexao->prepare("
    SELECT Sessao.ID_sessao, Sessao.Data_sessao, Usuario.Nome_usuario
    FROM Sessao
    INNER JOIN Usuario ON Sessao.ID_usuario = Usuario.ID_usuario
    WHERE Sessao.ID_psicologo = ?
    ORDER BY Sessao.Data_sessao ASC
");
$sql->bind_param("i", $id_psicologo);
$sql->execute();
$resultado = $sql->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
<meta charset="UTF-8">
<title>Atendimento — LUCEM</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f8f4ef;
        padding: 120px 20px 40px;
    }

    h2 {
        color: #4c2b72;
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.2em;
    }

    .tabela {
        width: 90%;
        max-width: 900px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-size: 1.1em;
    }

    th {
        background-color: #e7daf3;
        color: #4c2b72;
    }

    .btn-ligar {
        background-color: #7d46c2;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-ligar:hover {
        background-color: #5c2c96;
    }

    /* NAVBAR IGUAL AO SEU SITE */
    header {
        background-color: var(--menu, #fff);
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
        color: var(--roxo-escuro, #4c2b72);
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
        color: var(--roxo-escuro, #4c2b72);
        padding: 10px 16px;
        border-radius: 10px;
        font-weight: 500;
        transition: 0.3s;
    }

    nav ul li a:hover {
        background-color: var(--hover, #e7daf3);
        color: var(--roxo, #7d46c2);
    }
</style>

<script>
function ligar(nome) {
    alert("📞 Iniciando ligação com " + nome + "... (simulação)");
}
</script>

</head>
<body>

<header>
    <div class="logo">LUCEM</div>
    <nav>
        <ul>
            <li><a href="painel_psicologo.php">Início</a></li>
            <li><a href="atendimento.php">Atendimentos</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
</header>

<h2>Atendimentos Agendados</h2>

<div class="tabela">
<table>
    <tr>
        <th>Paciente</th>
        <th>Horário</th>
        <th>Ação</th>
    </tr>

    <?php while($row = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['Nome_usuario']) ?></td>

        <td>
            <?= date("d/m/Y H:i", strtotime($row['Data_sessao'])) ?>
        </td>

        <td>
            <button class="btn-ligar" onclick="ligar('<?= $row['Nome_usuario'] ?>')">
                Ligar
            </button>
        </td>
    </tr>
    <?php endwhile; ?>

</table>
</div>

</body>
</html>
