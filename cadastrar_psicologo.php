<?php
session_start();
include_once('conexao.php');

// Verifica se veio tudo do formulário
if (isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['crp'], $_POST['especialidade'])) {

    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = $_POST['senha'];
    $crp = mysqli_real_escape_string($conexao, $_POST['crp']);
    $especialidade = mysqli_real_escape_string($conexao, $_POST['especialidade']);

    // Criptografa a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Verifica se já existe e-mail ou CRP cadastrado
    $check = mysqli_query($conexao, 
        "SELECT * FROM Psicologo WHERE Email_psicologo = '$email' OR CRP = '$crp'"
    );

    if (mysqli_num_rows($check) > 0) {
        echo "<p style='color:red; text-align:center; font-weight:600;'>⚠ E-mail ou CRP já cadastrados!</p>";
        echo "<div style='text-align:center; margin-top:15px;'>
                <a href='cadastro_psicologo.html' 
                   style='color:#6a4fb6; text-decoration:none; font-weight:600;'>Voltar</a>
              </div>";
        exit();
    }

    // Insere no banco
    $query = "INSERT INTO Psicologo (Nome_psicologo, Email_psicologo, Senha_psicologo, CRP, Especialidade)
              VALUES ('$nome', '$email', '$senha_hash', '$crp', '$especialidade')";

    if (mysqli_query($conexao, $query)) {

        // Cria sessão automaticamente
        $_SESSION['psicologo_id'] = mysqli_insert_id($conexao);
        $_SESSION['psicologo_nome'] = $nome;
        $_SESSION['psicologo_email'] = $email;

        // Redireciona para o painel
        header("Location: painel_psicologo.php");
        exit();

    } else {
        echo "<p style='color:red; text-align:center;'>Erro ao cadastrar: " . mysqli_error($conexao) . "</p>";
    }

} else {
    echo "<p style='color:red; text-align:center;'>Preencha todos os campos!</p>";
}
?>
