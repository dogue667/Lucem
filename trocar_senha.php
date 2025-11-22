<?php
session_start();
include_once('conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Recebe dados
$senha_atual = $_POST['senha_atual'] ?? '';
$senha_nova = $_POST['senha_nova'] ?? '';
$senha_confirmar = $_POST['senha_confirmar'] ?? '';

// Verifica se tudo veio
if (empty($senha_atual) || empty($senha_nova) || empty($senha_confirmar)) {
    echo "Preencha todos os campos!";
    exit();
}

// Verifica confirmação
if ($senha_nova !== $senha_confirmar) {
    echo "A nova senha e a confirmação não coincidem!";
    exit();
}

// Busca a senha do usuário
$sql = "SELECT Senha_usuario FROM Usuario WHERE ID_usuario = $usuario_id";
$query = mysqli_query($conexao, $sql);
$user = mysqli_fetch_assoc($query);

// Verifica senha atual
if (!password_verify($senha_atual, $user['Senha_usuario'])) {
    echo "Senha atual incorreta!";
    exit();
}

// Atualiza senha
$senha_hash = password_hash($senha_nova, PASSWORD_DEFAULT);

$update = "UPDATE Usuario SET Senha_usuario = '$senha_hash' WHERE ID_usuario = $usuario_id";
mysqli_query($conexao, $update);

echo "Senha alterada com sucesso!";
header("refresh:1; url=configuracoes.php");
exit();