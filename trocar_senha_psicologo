<?php
session_start();
include_once('conexao.php');

if (!isset($_SESSION['psicologo_id'])) {
    header("Location: login_psicologo.html");
    exit();
}

$psicologo_id = $_SESSION['psicologo_id'];

$senha_atual = $_POST['senha_atual'] ?? '';
$senha_nova = $_POST['senha_nova'] ?? '';
$senha_confirmar = $_POST['senha_confirmar'] ?? '';

if (empty($senha_atual) || empty($senha_nova) || empty($senha_confirmar)) {
    echo "Preencha todos os campos!";
    exit();
}

if ($senha_nova !== $senha_confirmar) {
    echo "As senhas não coincidem!";
    exit();
}

$sql = "SELECT Senha_psicologo FROM Psicologo WHERE ID_psicologo = $psicologo_id";
$query = mysqli_query($conexao, $sql);
$psi = mysqli_fetch_assoc($query);

if (!password_verify($senha_atual, $psi['Senha_psicologo'])) {
    echo "Senha atual incorreta!";
    exit();
}

$senha_hash = password_hash($senha_nova, PASSWORD_DEFAULT);

$update = "UPDATE Psicologo SET Senha_psicologo = '$senha_hash' WHERE ID_psicologo = $psicologo_id";
mysqli_query($conexao, $update);

echo "Senha alterada com sucesso!";
header("refresh:1; url=configuracoes_psicologo.php");
exit();
