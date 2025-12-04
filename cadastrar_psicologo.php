<?php
session_start();
include_once('conexao.php');

// Só processa se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verifica se todos os campos obrigatórios vieram
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $crp = $_POST['crp'] ?? '';
    $especialidade = $_POST['especialidade'] ?? '';

    // Validação básica
    if (empty($nome) || empty($email) || empty($senha) || empty($crp)) {
        echo "<p style='color:red; text-align:center; font-weight:600;'>⚠ Preencha todos os campos obrigatórios!</p>";
        exit();
    }

    // Escapa strings para o MySQL
    $nome = mysqli_real_escape_string($conexao, $nome);
    $email = mysqli_real_escape_string($conexao, $email);
    $crp = mysqli_real_escape_string($conexao, $crp);
    $especialidade = mysqli_real_escape_string($conexao, $especialidade);

    // Criptografa a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Verifica se já existe e-mail ou CRP cadastrado
    $check = mysqli_query($conexao, "SELECT * FROM Psicologo WHERE Email_psicologo = '$email' OR CRP = '$crp'");
    if (!$check) {
        die("Erro ao verificar banco: " . mysqli_error($conexao));
    }

    if (mysqli_num_rows($check) > 0) {
        echo "<p style='color:red; text-align:center; font-weight:600;'>⚠ E-mail ou CRP já cadastrados!</p>";
        echo "<div style='text-align:center; margin-top:15px;'>
                <a href='cadastro_psicologo.html' style='color:#6a4fb6; text-decoration:none; font-weight:600;'>Voltar</a>
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
        header("Location: index.php");
        exit();
    } else {
        echo "<p style='color:red; text-align:center;'>Erro ao cadastrar: " . mysqli_error($conexao) . "</p>";
    }

} else {
    // Se acessar a página sem enviar o formulário
    header("Location: cadastro_psicologo.html");
    exit();
}
?>
