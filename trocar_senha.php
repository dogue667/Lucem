<?php
session_start();
require_once "conexao.php";

// =====================================
// VERIFICA LOGIN
// =====================================
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

$usuario_id = intval($_SESSION['usuario_id']); // segurança extra

// =====================================
// RECEBE OS DADOS DO FORMULÁRIO
// =====================================
$senha_atual     = $_POST['senha_atual'] ?? '';
$senha_nova      = $_POST['senha_nova'] ?? '';
$senha_confirmar = $_POST['senha_confirmar'] ?? '';

// =====================================
// VALIDA CAMPOS
// =====================================
if (!$senha_atual || !$senha_nova || !$senha_confirmar) {
    echo "Preencha todos os campos!";
    exit();
}

if ($senha_nova !== $senha_confirmar) {
    echo "A nova senha e a confirmação não coincidem!";
    exit();
}

// =====================================
// BUSCA A SENHA ATUAL NO BANCO
// =====================================
$sql = "SELECT Senha_usuario FROM Usuario WHERE Cod_usuario = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Usuário não encontrado!";
    exit();
}

$user = $result->fetch_assoc();

// =====================================
// VERIFICA A SENHA ATUAL
// =====================================
if (!password_verify($senha_atual, $user['Senha_usuario'])) {
    echo "Senha atual incorreta!";
    exit();
}

// =====================================
// ATUALIZA A SENHA
// =====================================
$senha_hash = password_hash($senha_nova, PASSWORD_DEFAULT);

$update = "UPDATE Usuario SET Senha_usuario = ? WHERE Cod_usuario = ?";
$stmt2 = $conexao->prepare($update);
$stmt2->bind_param("si", $senha_hash, $usuario_id);
$stmt2->execute();

echo "Senha alterada com sucesso!";
header("refresh:1; url=configuracoes.php");
exit();

?>
