<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "lucem";

$conexao = new mysqli($servername, $username, $password, $dbname);

if ($conexao->connect_error) {
    die("Falha na conexão com o BD: " . $conexao->connect_error);
}

$conexao->set_charset("utf8mb4");
?>
