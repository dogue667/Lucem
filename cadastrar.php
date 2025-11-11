<?php
session_start();
include_once('conexao.php');

$nome = mysqli_real_escape_string($conexao, $_POST['nome']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = $_POST['senha'];

// Criptografa a senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// Verifica se o e-mail já existe no banco
$check_email = mysqli_query($conexao, "SELECT * FROM Usuario WHERE Email_usuario = '$email'");

if(mysqli_num_rows($check_email) > 0){
    echo "<p>⚠ Este e-mail já está em uso. Tente outro!</p>";
    echo "<a href='index.html'>Voltar ao cadastro</a>";
    exit();
}

// Cadastra o usuário
$query = mysqli_query($conexao, 
    "INSERT INTO Usuario (Nome_usuario, Email_usuario, Senha_usuario) 
     VALUES ('$nome', '$email', '$senha_hash')"
) or die(mysqli_error($conexao));

// pega do usuário recém cadastrado
$usuario_id = mysqli_insert_id($conexao);

// cria sessao
$_SESSION['usuario_id'] = $usuario_id;
$_SESSION['usuario_nome'] = $nome;

// manda pra pagina principal
header("Location: index.php"); 
exit();
?>
