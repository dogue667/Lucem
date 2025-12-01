<?php
session_start();
include_once("conexao.php");

if (!isset($_SESSION['psicologo_id'])) {
    header("Location: login_psicologo.php");
    exit();
}

$psicologo_id = $_SESSION['psicologo_id'];
$usuario_id = $_GET['usuario_id'] ?? 0;

// Verifica se formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data_sessao = $_POST['data_sessao'];
    
    $sql = $conexao->prepare("INSERT INTO Sessao (Data_sessao, Cod_usuario, Cod_psicologo) VALUES (?, ?, ?)");
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
<style>
body { font-family: "Poppins", sans-serif; background:#f9efe4; color:#4d2f68; padding:30px;}
.box { background:#fff; padding:25px; border-radius:15px; max-width:400px; margin:auto; box-shadow:0 3px 10px rgba(0,0,0,0.08);}
label { display:block; margin:15px 0 5px; }
input[type=datetime-local] { width:100%; padding:10px; border-radius:10px; border:1px solid #ccc; }
button { background:#9b6bc2; color:#fff; border:none; padding:12px 20px; border-radius:12px; cursor:pointer; margin-top:15px;}
button:hover { background:#4d2f68; }
.msg { margin-top:15px; color:green; font-weight:bold; }
</style>
</head>
<body>

<div class="box">
    <h2>Marcar Sessão</h2>
    <p><b><?= htmlspecialchars($usuario['Nome_usuario']) ?></b> (<?= htmlspecialchars($usuario['Email_usuario']) ?>)</p>
    <form method="post">
        <label for="data_sessao">Data e Hora da Sessão:</label>
        <input type="datetime-local" id="data_sessao" name="data_sessao" required>
        <button type="submit">Marcar Sessão</button>
    </form>
    <?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>
</div>

</body>
</html>
