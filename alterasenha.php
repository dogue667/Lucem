<?php
session_start();
include_once("conexao.php");

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$senha_atual = $_POST['senha_atual'];
$nova_senha = $_POST['nova_senha'];
$confirmar_senha = $_POST['confirmar_senha'];

// 1. Busca usuário
$sql = "SELECT senha FROM usuarios WHERE id = '$usuario_id' LIMIT 1";
$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    // 2. Verifica senha atual
    if (!password_verify($senha_atual, $user['senha'])) {
        $_SESSION['erro_senha'] = "Senha atual incorreta.";
        header("Location: configuracoes.php");
        exit();
    }

    // 3. Confirma nova senha
    if ($nova_senha !== $confirmar_senha) {
        $_SESSION['erro_senha'] = "As senhas novas não coincidem.";
        header("Location: configuracoes.php");
        exit();
    }

    // 4. Atualiza senha
    $hash = password_hash($nova_senha, PASSWORD_DEFAULT);

    $update = mysqli_query($conexao, "UPDATE usuarios SET senha = '$hash' WHERE id = '$usuario_id'");

    if ($update) {
        $_SESSION['sucesso_senha'] = "Senha alterada com sucesso!";
    } else {
        $_SESSION['erro_senha'] = "Erro ao atualizar senha.";
    }
}

header("Location: configuracoes.php");
exit();
?>
