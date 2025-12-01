<?php
session_start();
include_once("conexao.php");

// Verifica se o psicólogo está logado
if (!isset($_SESSION['psicologo_id'])) {
    header("Location: login_psicologo.php");
    exit();
}

$psicologo_id = $_SESSION['psicologo_id'];

// Buscar usuários cadastrados
$sql = $conexao->prepare("SELECT Cod_usuario, Nome_usuario, Email_usuario, Data_cadastro FROM Usuario ORDER BY Nome_usuario ASC");
$sql->execute();
$resultado = $sql->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Pacientes — LUCEM</title>
<style>
body { font-family: "Poppins", sans-serif; background:#f9efe4; color:#4d2f68; padding:30px;}
.tabela { width: 90%; max-width: 1000px; margin: auto; background:#fff; padding:25px; border-radius:15px; box-shadow:0 3px 10px rgba(0,0,0,0.08);}
table { width:100%; border-collapse: collapse; }
th, td { padding:12px; text-align:left; border-bottom:1px solid #ddd; }
th { background:#9b6bc2; color:#fff; border-radius:12px 12px 0 0; }
tr:hover td { background:#e3d3f5; }
.btn { background:#9b6bc2; color:#fff; border:none; padding:8px 14px; border-radius:10px; cursor:pointer; transition:0.2s; text-decoration:none;}
.btn:hover { background:#4d2f68; color:#fff; }
</style>
</head>
<body>

<h2>Pacientes Cadastrados</h2>

<div class="tabela">
<table>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Data Cadastro</th>
        <th>Ações</th>
    </tr>
    <?php while($row = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['Nome_usuario']) ?></td>
        <td><?= htmlspecialchars($row['Email_usuario']) ?></td>
        <td><?= date("d/m/Y", strtotime($row['Data_cadastro'])) ?></td>
        <td>
            <a class="btn" href="ficha_paciente.php?id=<?= $row['Cod_usuario'] ?>">Ver Ficha</a>
            <a class="btn" href="marcar_sessao.php?usuario_id=<?= $row['Cod_usuario'] ?>">Marcar Sessão</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</div>

</body>
</html>
