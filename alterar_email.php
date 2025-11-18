<?php
session_start();
include_once('conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    die("Erro: você precisa estar logado para alterar o e-mail.");
}

$usuario_id = $_SESSION['usuario_id'];
$novo_email = mysqli_real_escape_string($conexao, $_POST['novo_email']);

// Verifica se o e-mail já existe
$check = mysqli_query($conexao, 
    "SELECT * FROM Usuario WHERE Email_usuario = '$novo_email' AND Id_usuario != '$usuario_id'"
);

if (mysqli_num_rows($check) > 0) {
    echo "<p>⚠ Este e-mail já está em uso por outro usuário.</p>";
    echo "<a href='configuracoes.php'>Voltar</a>";
    exit();
}

// Atualiza o e-mail
$update = mysqli_query($conexao,
    "UPDATE Usuario SET Email_usuario = '$novo_email' WHERE Id_usuario = '$usuario_id'"
);

if ($update) {
    echo "<p>✔ E-mail alterado com sucesso!</p>";
    echo "<a href='configuracoes.php'>Voltar</a>";
} else {
    echo "<p>Erro ao atualizar o e-mail.</p>";
}
?>