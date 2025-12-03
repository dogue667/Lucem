<?php
session_start();
include_once("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $emocao_texto = $_POST["emocao"] ?? "";
    $descricao    = $_POST["descricao"] ?? "";
    $fatores      = isset($_POST["fatores"]) ? implode(", ", $_POST["fatores"]) : "Nenhum";

    // Salva cada emoção separadamente
    $emocoes = array_map('trim', explode(",", $emocao_texto));
    foreach ($emocoes as $tipo_emocao) {
        if ($tipo_emocao !== "") {
            // Verifica se a emoção já existe
            $stmt = $conexao->prepare("SELECT Cod_emocao FROM Emocao WHERE Tipo_emocao=? LIMIT 1");
            $stmt->bind_param("s", $tipo_emocao);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($cod_emocao);
                $stmt->fetch();
            } else {
                // Insere nova emoção
                $intensidade = 3; // valor padrão
                $causa_emocao = $fatores;
                $insert = $conexao->prepare("INSERT INTO Emocao (Tipo_emocao, Intensidade, Causa_emocao) VALUES (?, ?, ?)");
                $insert->bind_param("sis", $tipo_emocao, $intensidade, $causa_emocao);
                $insert->execute();
                $cod_emocao = $insert->insert_id;
                $insert->close();
            }
            $stmt->close();

            // Insere no histórico do usuário
            $hist = $conexao->prepare("INSERT INTO Historico_emocao (Cod_usuario, Cod_emocao, Observacao) VALUES (?, ?, ?)");
            $hist->bind_param("iis", $usuario_id, $cod_emocao, $descricao);
            $hist->execute();
            $hist->close();
        }
    }

    $mensagem = "Registro de emoções salvo com sucesso!";
}
?>
