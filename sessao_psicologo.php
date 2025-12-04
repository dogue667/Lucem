<?php
session_start();
require_once "conexao.php";

if (!empty($_POST['email']) && !empty($_POST['senha'])) {

    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];

    $sql = "SELECT Cod_psicologo, Nome_psicologo, Email_psicologo, Senha_psicologo 
            FROM Psicologo 
            WHERE Email_psicologo = ? 
            LIMIT 1";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {

        $psicologo = $resultado->fetch_assoc();

        if (password_verify($senha, $psicologo['Senha_psicologo'])) {

            $_SESSION['psicologo_id'] = $psicologo['Cod_psicologo'];
            $_SESSION['psicologo_nome'] = $psicologo['Nome_psicologo'];
            $_SESSION['psicologo_email'] = $psicologo['Email_psicologo'];

            header("Location: index.php");
            exit;

        } else {
            header("Location: login_psicologo.php?erro=Senha incorreta!");
            exit;
        }

    } else {
        header("Location: login_psicologo.php?erro=E-mail não encontrado!");
        exit;
    }

} else {
    header("Location: login_psicologo.php?erro=Preencha todos os campos!");
    exit;
}
?>
