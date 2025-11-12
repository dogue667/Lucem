<?php
session_start();
include_once('conexao.php');

if (isset($_POST['email'], $_POST['senha'])) {

    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM Usuario WHERE Email_usuario = '$email' LIMIT 1";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) === 1) {
        $usuario = mysqli_fetch_assoc($result);

        if (password_verify($senha, $usuario['Senha_usuario'])) {
            // Cria sessão
            $_SESSION['usuario_id'] = $usuario['Cod_usuario'];
            $_SESSION['usuario_nome'] = $usuario['Nome_usuario'];
            $_SESSION['usuario_email'] = $usuario['Email_usuario'];

            // Redireciona
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
