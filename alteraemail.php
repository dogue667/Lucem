<?php
session_start();
include_once("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Recebe dados
$novo_email = mysqli_real_escape_string($conexao, $_POST['novo_email']);
$senha_atual = $_POST['senha_atual'];

// 1. Busca usuário
$sql = "SELECT email, senha FROM usuarios WHERE id = '$usuario_id' LIMIT 1";
$result = mysqli_query($conexao, $sql);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    // 2. Verifica senha
    if (!password_verify($senha_atual, $user['senha'])) {
        $_SESSION['erro_email'] = "Senha atual incorreta.";
        header("Location: configuracoes.php");
        exit();
    }

    // 3. Verifica se o e-mail já existe
    $check_email = mysqli_query($conexao, "SELECT id FROM usuarios WHERE email = '$novo_email' AND id != '$usuario_id'");
    
    if (mysqli_num_rows($check_email) > 0) {
        $_SESSION['erro_email'] = "Este e-mail já está em uso.";
        header("Location: configuracoes.php");
        exit();
    }

    // 4. Atualiza e-mail
    $update = mysqli_query($conexao, "UPDATE usuarios SET email = '$novo_email' WHERE id = '$usuario_id'");

    if ($update) {
        $_SESSION['sucesso_email'] = "E-mail atualizado com sucesso!";
    } else {
        $_SESSION['erro_email'] = "Erro ao atualizar e-mail.";
    }
}

header("Location: configuracoes.php");
exit();
?>
