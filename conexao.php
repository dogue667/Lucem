<?php
// conexao.php
$host     = "localhost";    // Servidor MySQL
$user     = "root";  // Usuário do banco
$senha    = "";    // Senha do banco
$banco    = "lucem";   // Nome do banco de dados

// Cria conexão
$conexao = new mysqli($host, $user, $senha, $banco);

// Verifica conexão
if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Define charset UTF-8
$conexao->set_charset("utf8mb4");
?>
