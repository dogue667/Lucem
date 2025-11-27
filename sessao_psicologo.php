<?php
session_start();
include_once('conexao.php');

if (isset($_POST['email'], $_POST['senha'])) {

    // Protege contra injeção de SQL
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];

    // Verifica se o e-mail existe na tabela Psicologo
    $sql = "SELECT * FROM Psicologo WHERE Email_psicologo = '$email' LIMIT 1";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) === 1) {
        $psicologo = mysqli_fetch_assoc($result);

        // Verifica a senha criptografada
        if (password_verify($senha, $psicologo['Senha_psicologo'])) {

            // Cria a sessão
            $_SESSION['psicologo_id'] = $psicologo['Cod_psicologo'];
            $_SESSION['psicologo_nome'] = $psicologo['Nome_psicologo'];
            $_SESSION['psicologo_email'] = $psicologo['Email_psicologo'];

            // Redireciona para página principal (ou página específica)
            header("Location: index.php");
            exit;
        } else {
            // Senha incorreta
            header("Location: login_psicologo.php?erro=Senha incorreta!");
            exit;
        }
    } else {
        // Psicólogo não encontrado
        header("Location: login_psicologo.php?erro=E-mail não cadastrado!");
        exit;
    }

} else {
    // Campos vazios
    header("Location: login_psicologo.php?erro=Preencha todos os campos!");
    exit;
}
?>
