<?php
session_start();
include_once('conexao.php');

if(isset($_POST['email'], $_POST['senha'])) {

    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];

    // Busca o usuário pelo e-mail na tabela correta
    $sql = "SELECT * FROM Usuario WHERE Email_usuario = '$email' LIMIT 1";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) === 1) {

        $usuario = mysqli_fetch_assoc($result);

        if (password_verify($senha, $usuario['Senha_usuario'])) {

            // Cria sessão
            $_SESSION['usuario_id'] = $usuario['Cod_usuario'];
            $_SESSION['usuario_nome'] = $usuario['Nome_usuario'];
            $_SESSION['usuario_email'] = $usuario['Email_usuario'];

            // Redireciona imediatamente para index.php
            header("Location: index.php");
            exit;

        } else {
            $erro = "Senha incorreta!";
        }

    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>
