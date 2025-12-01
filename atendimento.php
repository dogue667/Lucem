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

   /* ---------- MENU ---------- */
header {
    background-color: var(--menu);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 18px 40px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 100;
}

.logo {
    font-family: "Playfair Display", serif;
    font-weight: 700;
    font-size: 1.7em;
    color: var(--roxo-escuro);
    letter-spacing: 1px;
    margin-right: 80px;
}

nav ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
    gap: 25px;
}

nav ul li {
    position: relative;
}

nav ul li a {
    text-decoration: none;
    color: var(--roxo-escuro);
    font-weight: 500;
    font-size: 1em;
    padding: 10px 16px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

nav ul li a:hover {
    background-color: var(--hover);
    color: var(--roxo);
}

/* Submenu */
nav ul ul {
    display: none;
    position: absolute;
    background-color: var(--menu);
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    top: 45px;
    padding: 10px 0;
    min-width: 160px;
}

nav ul li:hover > ul {
    display: block;
}

nav ul ul li a {
    display: block;
    padding: 10px 15px;
}

.nav-icons {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.config-icon a {
    font-size: 1.5rem;
    color: var(--roxo-escuro);
    transition: 0.3s;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.config-icon a:hover {
    transform: rotate(20deg);
    color: var(--roxo);
}

/* RESPONSIVO */
@media (max-width: 768px) {
    header { flex-direction: column; }
    nav ul { flex-direction: column; gap: 10px; }
    .logo { margin: 0 0 10px 0; }
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
<header>
    <div class="logo">🌞 LUCEM</div>

    <nav>
        <ul>
            <li>
                <a href="index.php" style="font-weight:600; color:var(--roxo);">Sobre</a>
            </li>

            <?php if (isset($_SESSION['psicologo_id'])): ?>
                <li><a href="painel_psicologo.php">Painel</a></li>
                <li><a href="lista_paciente.php">Meus Pacientes</a></li>
                <li><a href="artigos.php">Artigos</a></li>
                <li><a href="config_psicologo.php">Configurações</a></li>
                <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>
            <?php elseif (isset($_SESSION['usuario_id'])): ?>
                <li><a href="registra_emocoes.php">Registrar Emoções</a></li>
                <li><a href="minhas_emocoes.php">Minhas Emoções</a></li>
                <li><a href="atendimento.php">Atendimento Psicológico</a></li>
                <li><a href="artigos.php">Artigos</a></li>
                <li><a href="metas.php">Exercícios & Metas</a></li>
                <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>
            <?php else: ?>
                <li><a href="cadastro.html" style="color:#d9534f;">Criar Conta</a></li>
                <li><a href="login.php" style="color:#d9534f;">Fazer Login</a></li>
                <li><a href="login.psicologo.php" style="color:#d9534f;">Login Psicólogo</a></li>
                <li><a href="cadastrar_psicologo.html" style="color:#d9534f;">Cadastro Psicólogo</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="nav-icons">
        <a href="configuracoes.php" class="config-icon">⚙️</a>
    </div>
</header>

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

