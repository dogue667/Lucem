<?php
session_start();
include_once('conexao.php');

// Verifica login
if (!isset($_SESSION['usuario_id'])) {
    die("Erro: você precisa estar logado para alterar a senha.");
}

$usuario_id = $_SESSION['usuario_id'];

$senha_atual = $_POST['senha_atual'];
$nova_senha = $_POST['nova_senha'];

// Busca a senha atual no banco
$result = mysqli_query($conexao, 
    "SELECT Senha_usuario FROM Usuario WHERE Id_usuario = '$usuario_id'"
);

$dados = mysqli_fetch_assoc($result);

// Confere se a senha atual está correta
if (!password_verify($senha_atual, $dados['Senha_usuario'])) {
    echo "<p>❌ Senha atual incorreta.</p>";
    echo "<a href='configuracoes.php'>Voltar</a>";
    exit();
}

// Criptografa a nova senha
$nova_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

// Atualiza a nova senha
$update = mysqli_query($conexao,
    "UPDATE Usuario SET Senha_usuario = '$nova_hash' WHERE Id_usuario = '$usuario_id'"
);

if ($update) {
    echo "<p>✔ Senha alterada com sucesso!</p>";
    echo "<a href='configuracoes.php'>Voltar</a>";
} else {
    echo "<p>Erro ao atualizar a senha.</p>";
}
?>
