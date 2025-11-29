<?php
session_start();
include_once('conexao.php');

// Verifica sessão
if (!isset($_SESSION['psicologo_id'])) {
    header("Location: login_psicologo.php");
    exit();
}

$psicologo_id = $_SESSION['psicologo_id'];

// Recebe dados
$senha_atual = $_POST['senha_atual'] ?? '';
$email_novo = trim($_POST['email_novo'] ?? '');

if (empty($senha_atual) || empty($email_novo)) {
    echo "Preencha todos os campos!";
    exit();
}

// 1 - Buscar psicólogo
$sql = "SELECT Email_psicologo, Senha_psicologo 
        FROM Psicologo 
        WHERE Cod_psicologo = ? 
        LIMIT 1";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $psicologo_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Erro: psicólogo não encontrado.";
    exit();
}

$psi = $result->fetch_assoc();

// 2 - Verificar senha
if (!password_verify($senha_atual, $psi['Senha_psicologo'])) {
    echo "Senha atual incorreta!";
    exit();
}

// 3 - Verificar se o e-mail já está em uso por outro psicólogo
$sql_email = "SELECT Cod_psicologo 
              FROM Psicologo 
              WHERE Email_psicologo = ? 
              AND Cod_psicologo != ? 
              LIMIT 1";

$stmt_email = $conexao->prepare($sql_email);
$stmt_email->bind_param("si", $email_novo, $psicologo_id);
$stmt_email->execute();
$res_email = $stmt_email->get_result();

if ($res_email->num_rows > 0) {
    echo "Este e-mail já está em uso!";
    exit();
}

// 4 - Atualizar e-mail
$sql_update = "UPDATE Psicologo 
               SET Email_psicologo = ? 
               WHERE Cod_psicologo = ?";

$stmt_update = $conexao->prepare($sql_update);
$stmt_update->bind_param("si", $email_novo, $psicologo_id);

if ($stmt_update->execute()) {
    $_SESSION['psicologo_email'] = $email_novo;
    echo "E-mail alterado com sucesso!";
    header("refresh:1; url=configuracoes_psicologo.php");
    exit();
} else {
    echo "Erro ao atualizar e-mail!";
    exit();
}
?>
