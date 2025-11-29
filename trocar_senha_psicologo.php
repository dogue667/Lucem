<?php
session_start();
include_once('conexao.php');

// Verifica sessão
if (!isset($_SESSION['psicologo_id'])) {
    header("Location: login_psicologo.php");
    exit();
}

$psicologo_id = $_SESSION['psicologo_id'];

$senha_atual = $_POST['senha_atual'] ?? '';
$senha_nova = $_POST['senha_nova'] ?? '';
$senha_confirmar = $_POST['senha_confirmar'] ?? '';

// 1 - Verificar se veio tudo
if (empty($senha_atual) || empty($senha_nova) || empty($senha_confirmar)) {
    echo "Preencha todos os campos!";
    exit();
}

// 2 - Confirmar se as senhas novas batem
if ($senha_nova !== $senha_confirmar) {
    echo "As senhas não coincidem!";
    exit();
}

// 3 - Buscar senha atual do psicólogo
$sql = "SELECT Senha_psicologo 
        FROM Psicologo 
        WHERE Cod_psicologo = ? 
        LIMIT 1";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $psicologo_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Erro ao localizar psicólogo!";
    exit();
}

$psi = $result->fetch_assoc();

// 4 - Verificar senha atual
if (!password_verify($senha_atual, $psi['Senha_psicologo'])) {
    echo "Senha atual incorreta!";
    exit();
}

// 5 - Gerar hash da senha nova
$senha_hash = password_hash($senha_nova, PASSWORD_DEFAULT);

// 6 - Atualizar senha
$sql_update = "UPDATE Psicologo 
               SET Senha_psicologo = ? 
               WHERE Cod_psicologo = ?";

$stmt_update = $conexao->prepare($sql_update);
$stmt_update->bind_param("si", $senha_hash, $psicologo_id);

if ($stmt_update->execute()) {
    echo "Senha alterada com sucesso!";
    header("refresh:1; url=configuracoes_psicologo.php");
    exit();
} else {
    echo "Erro ao atualizar senha!";
    exit();
}
?>
