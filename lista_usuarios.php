<?php
session_start();
include_once("conexao.php");

// Verifica se o psicólogo está logado
if (!isset($_SESSION['psicologo_id'])) {
    header("Location: login_psicologo.php");
    exit();
}

$psicologo_id = $_SESSION['psicologo_id'];

// Buscar usuários cadastrados
$sql = $conexao->prepare("SELECT Cod_usuario, Nome_usuario, Email_usuario, Data_cadastro FROM Usuario ORDER BY Nome_usuario ASC");
$sql->execute();
$resultado = $sql->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Pacientes — LUCEM</title>
<link rel="stylesheet" href="darkmode.css">
<style>
/* ==========================
    VARIÁVEIS DO TEMA LUCEM
========================== */
:root {
    --bg: #f9efe4;
    --menu: #ffffff;
    --texto: #5b3a70;
    --roxo: #9b6bc2;
    --roxo-escuro: #4d2f68;
    --hover: #e3d3f5;
}

/* ---------------- MENU ---------------- */
header {
    background-color: var(--menu);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 40px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.12);
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
}

/* NAV */
nav ul {
    list-style: none;
    display: flex;
    gap: 25px;
    margin: 0;
    padding: 0;
}

nav ul li a {
    text-decoration: none;
    color: var(--roxo-escuro);
    font-weight: 500;
    padding: 10px 16px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

nav ul li a:hover {
    background-color: var(--hover);
    color: var(--roxo);
}

.nav-icons a {
    font-size: 1.5rem;
    color: var(--roxo-escuro);
    transition: 0.3s;
}

.nav-icons a:hover {
    transform: rotate(20deg);
    color: var(--roxo);
}

/* ---------------- BODY / GERAL ---------------- */
body {
    font-family: "Poppins", sans-serif;
    background: var(--bg);
    color: var(--texto);
    padding-top: 120px;
    margin: 0;
}

/* ---------------- LISTA ---------------- */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: var(--roxo-escuro);
    font-weight: 600;
}

.tabela {
    width: 90%;
    max-width: 1000px;
    margin: auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.08);
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: var(--roxo);
    color: #fff;
    padding: 14px;
    font-size: 1.05em;
    text-align: left;
}

td {
    padding: 14px;
    border-bottom: 1px solid #e8e8e8;
}

tr:hover td {
    background: var(--hover);
}

/* ---------------- BOTÕES ---------------- */
/* BOTÕES NAS AÇÕES */
td .btn {
    background: var(--roxo);
    color: #fff;
    padding: 8px 14px;
    border-radius: 10px;
    text-decoration: none;
    transition: 0.2s;
    display: inline-block;
}

/* AGRUPA OS BOTÕES COM ESPAÇAMENTO */
.btn-group {
    display: flex;
    gap: 12px; /* espaço entre os botões */
}

/* HOVER */
td .btn:hover {
    background: var(--roxo-escuro);
}

/* MOBILE */
@media (max-width: 600px) {
    .btn-group {
        flex-direction: column; 
        gap: 8px;
    }
}

/* ---------------- RESPONSIVIDADE ---------------- */
@media (max-width: 768px) {
    header {
        flex-direction: column;
        gap: 10px;
        padding: 15px 20px;
    }

    nav ul {
        flex-wrap: wrap;
        justify-content: center;
    }

    .tabela {
        width: 95%;
        padding: 15px;
    }

    table {
        font-size: 0.9em;
    }

    .btn {
        padding: 6px 10px;
        font-size: 0.8em;
    }
}
</style>

</head>

<body>

<header>
    <div class="logo">🌞 LUCEM</div>

    <nav>
        <ul>
            <li><a href="index.php">Sobre</a></li>
            <li><a href="lista_usuarios.php" style="font-weight:600; color:var(--roxo);">Pacientes</a></li>
            <li><a href="artigos.php">Artigos</a></li>
            <li><a href="atendimento.php">Atendimento</a></li>
            <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>
        </ul>
    </nav>

    <div class="nav-icons">
        <a href="configuracoes.php">⚙️</a>
    </div>
</header>

<h2>Pacientes Cadastrados</h2>

<div class="tabela">
<table>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Data Cadastro</th>
        <th>Ações</th>
    </tr>

    <?php while($row = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['Nome_usuario']) ?></td>
        <td><?= htmlspecialchars($row['Email_usuario']) ?></td>
        <td><?= date("d/m/Y", strtotime($row['Data_cadastro'])) ?></td>
        <td>
    <div class="btn-group">
        <a class="btn" href="ficha_paciente.php?id=<?= $row['Cod_usuario'] ?>">Ver Ficha</a>
        <a class="btn" href="marcar_sessao.php?usuario_id=<?= $row['Cod_usuario'] ?>">Marcar Sessão</a>
    </div>
</td>
    </tr>
    <?php endwhile; ?>

</table>
</div>
 <script>
  // Salva o dark mode no navegador
function toggleDarkMode() {
    document.body.classList.toggle("dark-mode");

    // Se estiver ativo, salva "1". Se não, salva "0".
    if (document.body.classList.contains("dark-mode")) {
        localStorage.setItem("darkmode", "1");
    } else {
        localStorage.setItem("darkmode", "0");
    }
}

// Ao carregar qualquer página, aplica o darkmode salvo
document.addEventListener("DOMContentLoaded", () => {
    if (localStorage.getItem("darkmode") === "1") {
        document.body.classList.add("dark-mode");
    }
});
</script>
 <script src="darkmode.js"></script>

</body>
</html>
