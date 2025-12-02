<?php
session_start();
include_once("conexao.php");

// Verifica login
if (!isset($_SESSION['psicologo_id'])) {
    header("Location: login_psicologo.php");
    exit();
}

$id_psicologo = $_SESSION['psicologo_id'];

// Buscar sessões
$sql = $conexao->prepare("
    SELECT 
        Sessao.Cod_sessao, 
        Sessao.Data_sessao, 
        Usuario.Nome_usuario
    FROM Sessao
    INNER JOIN Usuario 
        ON Sessao.Cod_usuario = Usuario.Cod_usuario
    WHERE Sessao.Cod_psicologo = ?
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
<title>Atendimentos — LUCEM</title>
<link rel="stylesheet" href="nav.css">
<link rel="stylesheet" href="darkmode.css">
<style>
/* ---------- CORES LUCEM ---------- */
:root {
    --bg: #f9efe4;
    --menu: #ffffff;
    --texto: #5b3a70;
    --roxo: #9b6bc2;
    --roxo-escuro: #4d2f68;
    --hover: #e3d3f5;
}

/* ---------- GERAL ---------- */
body {
    font-family: "Poppins", sans-serif;
    background: var(--bg);
    color: var(--texto);
    margin: 0;
    padding: 0;
}

/* ---------- TÍTULO ---------- */
h2 {
    margin-top: 120px;
    text-align: center;
    color: var(--roxo-escuro);
    font-size: 30px;
}

/* ---------- TABELA ---------- */
.tabela {
    width: 90%;
    max-width: 1000px;
    margin: 25px auto 50px;
    background: #fff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.08);
    transition: 0.3s;
}
.tabela:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 17px;
}
th {
    background: var(--roxo);
    color: #fff;
    padding: 14px;
    border-radius: 12px 12px 0 0;
}
td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}
tr:hover td {
    background: var(--hover);
}

/* ---------- BOTÃO LIGAR ---------- */
.btn-ligar {
    background: var(--roxo);
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 12px;
    font-size: 15px;
    cursor: pointer;
    transition: 0.2s;
}
.btn-ligar:hover {
    background: var(--roxo-escuro);
}
</style>

<script>
function ligar(nome, idSessao) {
    window.location.href = "ligacao.php?id=" + idSessao + "&nome=" + encodeURIComponent(nome);
}
</script>
</head>
<body>

<!-------------- NAV ---------- -->
<?php include "nav.php"; ?>


<h2>Atendimentos Agendados</h2>

<div class="tabela">
<table>
    <tr>
        <th>Paciente</th>
        <th>Data e Horário</th>
        <th>Ação</th>
    </tr>
    <?php while($row = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['Nome_usuario']) ?></td>
        <td><?= date("d/m/Y H:i", strtotime($row['Data_sessao'])) ?></td>
        <td>
            <button class="btn-ligar" onclick="ligar('<?= $row['Nome_usuario'] ?>', <?= $row['Cod_sessao'] ?>)">Ligar</button>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</div>

</body>
</html>
