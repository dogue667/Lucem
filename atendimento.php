<?php
session_start();
?>


// Verifica se o psicólogo está logado
if (!isset($_SESSION['ID_psicologo'])) {
    header("Location: login_psicologo.php");
    exit();
}

$id_psicologo = $_SESSION['ID_psicologo'];

// Buscar sessões agendadas no banco
$sql = $conexao->prepare("
    SELECT Sessao.ID_sessao, Sessao.Data_sessao, Usuario.Nome_usuario
    FROM Sessao
    INNER JOIN Usuario ON Sessao.ID_usuario = Usuario.ID_usuario
    WHERE Sessao.ID_psicologo = ?
    ORDER BY Sessao.Data_sessao ASC
");
$sql->bind_param("i", $id_psicologo);
$sql->execute();
$resultado = $sql->get_result();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Atendimentos — LUCEM</title>

<style>
    body {
        font-family: 'Inter', sans-serif;
        background: #fcefdc;
        margin: 0;
        padding: 120px 20px 40px;
        color: #4a3026;
    }

    /* NAVBAR IGUAL AO SEU SITE */
    nav.menu {
        width: 100%;
        background-color: #fdebd3;
        padding: 0.9rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #f4c29d;
        position: fixed;
        top: 0;
        z-index: 100;
    }

    .menu-left .logo {
        font-size: 1.6rem;
        font-weight: 700;
        color: #c5745b;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .menu-links {
        list-style: none;
        display: flex;
        gap: 1.6rem;
        margin: 0;
    }

    .menu-links li a {
        text-decoration: none;
        color: #7c5b4a;
        font-weight: 600;
        transition: 0.2s;
    }

    .menu-links li a:hover {
        color: #c5745b;
    }

    .sair {
        color: #d25555 !important;
        font-weight: 700;
    }

    /* Tabela */
    h2 {
        text-align: center;
        color: #c5745b;
        margin-bottom: 20px;
        font-size: 2rem;
    }

    .tabela {
        width: 90%;
        max-width: 900px;
        margin: auto;
        background: #fff9f5;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #f4c29d;
        font-size: 1.1rem;
    }

    th {
        color: #c5745b;
        font-weight: 700;
        background: #f7dfd5;
    }

    .btn-ligar {
        background-color: #de8c78;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-ligar:hover {
        background-color: #c66f60;
    }
</style>

<script>
function ligar(nome) {
    alert("📞 Iniciando ligação com " + nome + "...");
}
</script>
</head>

<body>

<!-- NAVBAR -->
<div class="logo">🌞 LUCEM</div>

    <nav>
        <ul>
            <li>
                <a href="index.php" style="font-weight:600; color:var(--roxo);">Sobre</a>
            </li>

            <?php if (isset($_SESSION['psicologo_id'])): ?>
                <li><a href="agendar.php">Agendar Consultas</a></li>
                <li><a href="lista_paciente.php">Meus Pacientes</a></li>
                <li><a href="artigos.php">Artigos</a></li>
                <li><a href="atendimento.php">Atendimentos</a></li>
                <li><a href="logout.php" style="color:#d9534f; font-weight:600;">Sair</a></li>

            <?php elseif (isset($_SESSION['usuario_id'])): ?>
                <li><a href="registra_emocoes.php">Registrar Emoções</a></li>
                <li><a href="minhas_emocoes.php">Minhas Emoções</a></li>
                <li><a href="atendimento_usuario.php">Atendimento Psicológico</a></li>
                <li><a href="artigos.php">Artigos</a></li>
                <li><a href="metas.php">Exercícios & Metas</a></li>
                <li><a href="logout.php" style="color:#d9534f; font-weight:600;">Sair</a></li>

            <?php else: ?>
                <li><a href="cadastro.html" style="color:#d9534f;">Criar Conta</a></li>
                <li><a href="login.php" style="color:#d9534f;">Fazer Login</a></li>
                <li><a href="login.psicologo.php" style="color:#d9534f;">Login Psicólogo</a></li>
                <li><a href="cadastrar_psicologo.html" style="color:#d9534f;">Cadastro Psicólogo</a></li>
            <?php endif; ?>
        </ul>
    </nav>

<h2>Atendimentos Agendados</h2>

<div class="tabela">
<table>
    <tr>
        <th>Paciente</th>
        <th>Data e Horário</th>
        <th>Ação</th>
    </tr>

    <?php while($row = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['Nome_usuario']) ?></td>

        <td>
            <?= date("d/m/Y H:i", strtotime($row['Data_sessao'])) ?>
        </td>

        <td>
            <button class="btn-ligar" onclick="ligar('<?= $row['Nome_usuario'] ?>')">
                Ligar
            </button>
        </td>
    </tr>
    <?php endwhile; ?>

</table>
</div>

</body>
</html>

