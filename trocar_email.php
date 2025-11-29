<?php
session_start();
include_once('conexao.php');

// Verifica sessão
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$senha_atual = $_POST['senha_atual'] ?? '';
$email_novo = trim($_POST['email_novo'] ?? '');

if (empty($senha_atual) || empty($email_novo)) {
    echo "Preencha todos os campos!";
    exit();
}

// 1 - Buscar usuário
$sql = "SELECT Email_usuario, Senha_usuario 
        FROM Usuario 
        WHERE Cod_usuario = ? 
        LIMIT 1";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Erro: usuário não encontrado.";
    exit();
}

$user = $result->fetch_assoc();

// 2 - Verificar senha
if (!password_verify($senha_atual, $user['Senha_usuario'])) {
    echo "Senha atual incorreta!";
    exit();
}

// 3 - Verificar se o e-mail já existe em outro usuário
$sql_check = "SELECT Cod_usuario 
              FROM Usuario 
              WHERE Email_usuario = ? 
              AND Cod_usuario != ? 
              LIMIT 1";

$stmt_check = $conexao->prepare($sql_check);
$stmt_check->bind_param("si", $email_novo, $usuario_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo "Este e-mail já está em uso!";
    exit();
}

// 4 - Atualizar e-mail
$sql_update = "UPDATE Usuario 
               SET Email_usuario = ? 
               WHERE Cod_usuario = ?";

$stmt_update = $conexao->prepare($sql_update);
$stmt_update->bind_param("si", $email_novo, $usuario_id);

if ($stmt_update->execute()) {
    $_SESSION['usuario_email'] = $email_novo;

    echo "E-mail alterado com sucesso!";
    header("refresh:1; url=configuracoes.php");
    exit();
} else {
    echo "Erro ao atualizar o e-mail!";
    exit();
}
?>
