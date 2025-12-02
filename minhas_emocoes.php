<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include_once "conexao.php";

$usuario_id = $_SESSION['usuario_id'];

// Pega mês e ano pela URL (para navegar entre os meses)
$mes = isset($_GET['mes']) ? intval($_GET['mes']) : date("m");
$ano = isset($_GET['ano']) ? intval($_GET['ano']) : date("Y");

// Ajusta ano quando muda de 1 para 12 e vice-versa
if ($mes < 1) { $mes = 12; $ano--; }
if ($mes > 12) { $mes = 1; $ano++; }

// Buscar dias com emoções registradas
$sql = "SELECT DATE(Data_registro) AS dia 
        FROM Historico_emocao 
        WHERE Cod_usuario = ? 
        AND MONTH(Data_registro)=? 
        AND YEAR(Data_registro)=?
        GROUP BY DATE(Data_registro)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("iii", $usuario_id, $mes, $ano);
$stmt->execute();
$result = $stmt->get_result();

$dias_com_emocao = [];
while ($row = $result->fetch_assoc()) {
    $dias_com_emocao[] = $row['dia'];
}

// Dados do calendário
$primeiroDia = "$ano-$mes-01";
$inicioSemana = date("w", strtotime($primeiroDia));
$diasNoMes = date("t", strtotime($primeiroDia));

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Minhas Emoções — Calendário</title>

<style>

/* ---------- SUA PALETA DE CORES ---------- */
:root {
    --bg: #f9efe4;
    --menu: #ffffff;
    --texto: #5b3a70;
    --roxo: #9b6bc2;
    --roxo-escuro: #4d2f68;
    --hover: #e7d3f5;
    --degrade: linear-gradient(135deg, #d1b3f1, #a57cd3, #8a68b0);
    --bege: #f3dcc5;
}

body {
    margin: 0;
    font-family: "Inter", sans-serif;
    background-color: var(--bg);
    color: var(--texto);
}

/* ---------- TÍTULO ---------- */
.titulo-calendario {
    text-align: center;
    margin-top: 40px;
    font-family: "Playfair Display", serif;
    font-size: 2.2em;
    color: var(--roxo-escuro);
}

/* ---------- BOTÕES DE NAVEGAÇÃO ---------- */
.cal-nav {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 15px 0 25px;
}

.nav-btn {
    background-color: var(--menu);
    padding: 10px 22px;
    border-radius: 25px;
    color: var(--roxo-escuro);
    text-decoration: none;
    font-weight: 600;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.nav-btn:hover {
    background: var(--hover);
    transform: translateY(-3px);
}

.central {
    background: var(--roxo);
    color: white;
}
.central:hover {
    background: var(--roxo-escuro);
}

/* ---------- CAIXA DO CALENDÁRIO ---------- */
.calendario-container {
    max-width: 650px;
    margin: auto;
    background: var(--menu);
    border-radius: 25px;
    padding: 25px;
    box-shadow: 0 5px 18px rgba(0,0,0,0.1);
}

/* Dias da semana */
.dias-semana {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
    font-weight: bold;
    color: var(--roxo-escuro);
    margin-bottom: 10px;
}

/* Corpo do calendário */
.calendario {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 8px;
}

/* Estilo dos dias */
.dia {
    padding: 14px;
    background: var(--bege);
    border-radius: 12px;
    text-align: center;
    color: var(--roxo-escuro);
    font-weight: 600;
    transition: 0.3s;
    text-decoration: none;
}

.dia:hover {
    background: var(--hover);
}

/* Dia com emoção registrada */
.emocao {
    background: var(--roxo);
    color: white;
}
.emocao:hover {
    background: var(--roxo-escuro);
}

/* RESPONSIVO */
@media (max-width: 500px) {
    .dia { padding: 10px; font-size: 0.9em; }
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


</style>
</head>
<body>
<!-- ---------- MENU SUPERIOR ---------- -->
<header>
    <div class="logo">🌞 LUCEM</div>

    <nav>
        <ul>
            <li>
                <a href="index.php" style="font-weight:600; color:var(--roxo);">Sobre</a>
            </li>

            <?php if (isset($_SESSION['psicologo_id'])): ?>
                <li><a href="lista_usuarios.php">Pacientes</a></li>
                <li><a href="artigos.php">Artigos</a></li>
                <li><a href="atendimento.php">Atendimento</a></li>
                <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>

            <?php elseif (isset($_SESSION['usuario_id'])): ?>
                <li><a href="registra_emocoes.php">Registrar Emoções</a></li>
                <li><a href="minhas_emocoes.php">Minhas Emoções</a></li>
                <li><a href="ligacao_paciente.php">Atendimento Psicológico</a></li>
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
<h2 class="titulo-calendario">
    Minhas Emoções — <?php echo str_pad($mes, 2, "0", STR_PAD_LEFT) . "/$ano"; ?>
</h2>

<!-- Navegação -->
<div class="cal-nav">
    <a href="?mes=<?php echo $mes - 1; ?>&ano=<?php echo $ano; ?>" class="nav-btn">◀ Anterior</a>
    <a href="?mes=<?php echo date('m'); ?>&ano=<?php echo date('Y'); ?>" class="nav-btn central">Hoje</a>
    <a href="?mes=<?php echo $mes + 1; ?>&ano=<?php echo $ano; ?>" class="nav-btn">Próximo ▶</a>
</div>

<!-- Calendário -->
<div class="calendario-container">

    <div class="dias-semana">
        <div>Dom</div>
        <div>Seg</div>
        <div>Ter</div>
        <div>Qua</div>
        <div>Qui</div>
        <div>Sex</div>
        <div>Sáb</div>
    </div>

    <div class="calendario">
        <?php
        for ($i = 0; $i < $inicioSemana; $i++) echo "<div></div>";

        for ($dia = 1; $dia <= $diasNoMes; $dia++) {

            $dataCompleta = "$ano-$mes-" . str_pad($dia, 2, '0', STR_PAD_LEFT);

            $temEmocao = in_array($dataCompleta, $dias_com_emocao);

            $classe = $temEmocao ? "dia emocao" : "dia";

            echo "
                <a class='$classe' href='registra_emocoes.php?data=$dataCompleta'>
                    $dia
                </a>
            ";
        }
        ?>
    </div>

</div>

</body>
</html>
