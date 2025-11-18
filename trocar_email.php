<?php
session_start();
include_once('conexao.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$senha_atual = $_POST['senha_atual'] ?? '';
$email_novo = mysqli_real_escape_string($conexao, $_POST['email_novo'] ?? '');

// Verifica se veio tudo
if (empty($senha_atual) || empty($email_novo)) {
    echo "Preencha todos os campos!";
    exit();
}

// Busca dados
$sql = "SELECT Email_usuario, Senha_usuario FROM Usuario WHERE ID_usuario = $usuario_id";
$query = mysqli_query($conexao, $sql);
$user = mysqli_fetch_assoc($query);

// Verifica senha atual
if (!password_verify($senha_atual, $user['Senha_usuario'])) {
    echo "Senha atual incorreta!";
    exit();
}

// Verifica se o novo email já existe
$check = mysqli_query($conexao, "SELECT * FROM Usuario WHERE Email_usuario = '$email_novo'");
if (mysqli_num_rows($check) > 0) {
    echo "Este e-mail já está em uso!";
    exit();
}

// Atualiza email
$update = "UPDATE Usuario SET Email_usuario = '$email_novo' WHERE ID_usuario = $usuario_id";
mysqli_query($conexao, $update);

// Atualiza sessão
$_SESSION['usuario_email'] = $email_novo;

echo "E-mail alterado com sucesso!";
header("refresh:1; url=configuracoes.php");
exit();