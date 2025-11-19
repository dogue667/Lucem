<?php
session_start();
include_once('conexao.php');

if (!isset($_SESSION['psicologo_id'])) {
    header("Location: login_psicologo.html");
    exit();
}

$psicologo_id = $_SESSION['psicologo_id'];

$senha_atual = $_POST['senha_atual'] ?? '';
$email_novo = mysqli_real_escape_string($conexao, $_POST['email_novo'] ?? '');

if (empty($senha_atual) || empty($email_novo)) {
    echo "Preencha todos os campos!";
    exit();
}

$sql = "SELECT Email_psicologo, Senha_psicologo 
        FROM Psicologo 
        WHERE ID_psicologo = $psicologo_id";

$query = mysqli_query($conexao, $sql);
$psi = mysqli_fetch_assoc($query);

if (!password_verify($senha_atual, $psi['Senha_psicologo'])) {
    echo "Senha atual incorreta!";
    exit();
}

// Verifica se email já existe
$check = mysqli_query($conexao, 
    "SELECT * FROM Psicologo WHERE Email_psicologo = '$email_novo'"
);

if (mysqli_num_rows($check) > 0) {
    echo "Este e-mail já está em uso!";
    exit();
}

// Atualiza
$update = "UPDATE Psicologo SET Email_psicologo = '$email_novo' WHERE ID_psicologo = $psicologo_id";
mysqli_query($conexao, $update);

$_SESSION['psicologo_email'] = $email_novo;

echo "E-mail alterado com sucesso!";
header("refresh:1; url=configuracoes_psicologo.php");
exit();
