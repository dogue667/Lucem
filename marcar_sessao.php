<?php
session_start();
include_once("conexao.php");

if (!isset($_SESSION['psicologo_id'])) {
    header("Location: login_psicologo.php");
    exit();
}

$psicologo_id = $_SESSION['psicologo_id'];
$usuario_id = $_GET['usuario_id'] ?? 0;

// Se enviou o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_sessao = $_POST['data_sessao'];
    
    $sql = $conexao->prepare("
        INSERT INTO Sessao (Data_sessao, Cod_usuario, Cod_psicologo) 
        VALUES (?, ?, ?)
    ");
    $sql->bind_param("sii", $data_sessao, $usuario_id, $psicologo_id);

    if($sql->execute()){
        $msg = "Sessão marcada com sucesso!";
    } else {
        $msg = "Erro ao marcar sessão!";
    }
}

// Buscar dados do usuário
$stmt = $conexao->prepare("SELECT Nome_usuario, Email_usuario FROM Usuario WHERE Cod_usuario = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Marcar Sessão — <?= htmlspecialchars($usuario['Nome_usuario']) ?></title>
<link rel="stylesheet" href="nav.css">
<!-- DARK MODE -->
<link rel="stylesheet" href="darkmode.css">

<style>
/* ------------------ ESTILO GERAL ------------------ */
body { 
    font-family: "Poppins", sans-serif; 
    background: var(--bg, #f9efe4); 
    color: var(--texto, #4d2f68); 
    padding-top: 120px; /* por causa do header fixo */
    margin: 0;
}

/* ------------------ CAIXA CENTRAL ------------------ */
.box { 
    background: #ffffff; 
    padding: 30px; 
    border-radius: 18px; 
    max-width: 430px; 
    margin: auto; 
    box-shadow: 0 3px 12px rgba(0,0,0,0.15);
    text-align: center;
    animation: fade .3s ease;
}

@keyframes fade {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
}

h2 {
    color: var(--roxo-escuro);
    margin-bottom: 10px;
}

label {
    display: block;
    text-align: left;
    margin: 18px 0 6px;
    color: var(--roxo-escuro);
    font-weight: 600;
}

input[type=datetime-local] {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 1.5px solid #c7c7c7;
    font-size: 1rem;
    background: #fff;
    color: var(--texto);
    transition: .2s;
}

input[type=datetime-local]:focus {
    border-color: var(--roxo);
    outline: none;
}

/* Botão */
button { 
    background: var(--roxo); 
    color: #fff; 
    border: none; 
    padding: 12px 20px; 
    border-radius: 12px; 
    cursor: pointer; 
    margin-top: 20px;
    font-size: 1.1rem;
    transition: .3s;
    width: 100%;
}
button:hover { background: var(--roxo-escuro); }

.msg { 
    margin-top: 15px; 
    color: green; 
    font-weight: bold; 
}


</style>

</head>
<body>

<!-------------- NAV ---------- -->
<?php include "nav.php"; ?>
  

<div class="box">
    <h2>Marcar Sessão</h2>

    <p>
        <b><?= htmlspecialchars($usuario['Nome_usuario']) ?></b>  
        (<?= htmlspecialchars($usuario['Email_usuario']) ?>)
    </p>

    <form method="post">
        <label for="data_sessao">Data e Hora:</label>
        <input type="datetime-local" id="data_sessao" name="data_sessao" required>

        <button type="submit">Confirmar</button>
    </form>

    <?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
</div>

<script src="darkmode.js"></script>

</body>
</html>
