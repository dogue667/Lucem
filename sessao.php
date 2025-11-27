<?php
session_start();
require_once "conexao.php";

if (!empty($_POST['email']) && !empty($_POST['senha'])) {

    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];

    // Busca usuário
    $sql = "SELECT ID_usuario, Nome_usuario, Email_usuario, Senha_usuario FROM Usuario WHERE Email_usuario = ? LIMIT 1";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['Senha_usuario'])) {

            // SESSÕES
            $_SESSION['usuario_id'] = $usuario['ID_usuario'];
            $_SESSION['usuario_nome'] = $usuario['Nome_usuario'];
            $_SESSION['usuario_email'] = $usuario['Email_usuario'];

            header("Location: index.php");
            exit;

        } else {
            header("Location: login.php?erro=Senha incorreta!");
            exit;
        }
    } else {
        header("Location: login.php?erro=Usuário não encontrado!");
        exit;
    }

} else {
    header("Location: login.php?erro=Preencha todos os campos!");
    exit;
}
?>
