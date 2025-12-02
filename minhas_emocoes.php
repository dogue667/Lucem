<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include_once "conexao.php";

$usuario_id = $_SESSION['usuario_id'];

// Mes e ano
$mes = isset($_GET['mes']) ? intval($_GET['mes']) : date("m");
$ano = isset($_GET['ano']) ? intval($_GET['ano']) : date("Y");

if ($mes < 1) { $mes = 12; $ano--; }
if ($mes > 12) { $mes = 1; $ano++; }

// Emoções registradas
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

$primeiroDia = "$ano-$mes-01";
$inicioSemana = date("w", strtotime($primeiroDia));
$diasNoMes = date("t", strtotime($primeiroDia));

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Minhas Emoções — Calendário</title>
<link rel="stylesheet" href="nav.css">
<style>
/* ---------- CORES ---------- */
:root {
    --bg: #f9efe4;
    --menu: #ffffff;
    --texto: #5b3a70;
    --roxo: #9b6bc2;
    --roxo-escuro: #4d2f68;
    --hover: #e3d3f5;
    --bege: #f3dcc5;
}

/* Geral */
body {
    margin: 0;
    font-family: "Inter", sans-serif;
    background: var(--bg);
    color: var(--texto);
}
/* ---------- CALENDÁRIO ---------- */
.titulo-calendario {
    margin-top: 120px;
    text-align: center;
    font-size: 2.2em;
    font-family: "Playfair Display", serif;
    color: var(--roxo-escuro);
}

/* Navegação */
.cal-nav {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 15px 0 25px;
}

.nav-btn {
    background: var(--menu);
    padding: 10px 22px;
    border-radius: 25px;
    color: var(--roxo-escuro);
    text-decoration: none;
    font-weight: 600;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    transition: .3s;
}

.nav-btn:hover {
    background: var(--hover);
    transform: translateY(-3px);
}

.central { background: var(--roxo); color: #fff; }
.central:hover { background: var(--roxo-escuro); }

/* Caixa calendário */
.calendario-container {
    max-width: 650px;
    margin: auto;
    background: var(--menu);
    padding: 25px;
    border-radius: 25px;
    box-shadow: 0 5px 18px rgba(0,0,0,0.1);
}

.dias-semana {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
    font-weight: bold;
    color: var(--roxo-escuro);
}

.calendario {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 8px;
    margin-top: 10px;
}

.dia {
    padding: 14px;
    background: var(--bege);
    border-radius: 12px;
    text-align: center;
    font-weight: 600;
    text-decoration: none;
    color: var(--roxo-escuro);
    transition: .3s;
}

.dia:hover {
    background: var(--hover);
}

/* Dia com emoção */
.emocao {
    background: var(--roxo);
    color: #fff;
}
.emocao:hover {
    background: var(--roxo-escuro);
}

/* RESPONSIVO */
@media (max-width: 768px) {
    header { flex-direction: column; gap: 12px; }
    nav ul { flex-direction: column; }
}
</style>
</head>
<body>

<!-------------- NAV ---------- -->
<?php include "nav.php"; ?>
  


<h2 class="titulo-calendario">
    Minhas Emoções — <?php echo str_pad($mes,2,"0",STR_PAD_LEFT)."/$ano"; ?>
</h2>

<div class="cal-nav">
    <a href="?mes=<?php echo $mes-1; ?>&ano=<?php echo $ano; ?>" class="nav-btn">◀ Anterior</a>
    <a href="?mes=<?php echo date("m"); ?>&ano=<?php echo date("Y"); ?>" class="nav-btn central">Hoje</a>
    <a href="?mes=<?php echo $mes+1; ?>&ano=<?php echo $ano; ?>" class="nav-btn">Próximo ▶</a>
</div>

<div class="calendario-container">
    <div class="dias-semana">
        <div>Dom</div><div>Seg</div><div>Ter</div><div>Qua</div>
        <div>Qui</div><div>Sex</div><div>Sáb</div>
    </div>

    <div class="calendario">
        <?php
        for ($i=0; $i < $inicioSemana; $i++) echo "<div></div>";

        for ($dia = 1; $dia <= $diasNoMes; $dia++) {
            $dataCompleta = "$ano-$mes-" . str_pad($dia,2,'0',STR_PAD_LEFT);
            $classe = in_array($dataCompleta, $dias_com_emocao) ? "dia emocao" : "dia";

            echo "<a class='$classe' href='registra_emocoes.php?data=$dataCompleta'>$dia</a>";
        }
        ?>
    </div>
</div>

</body>
</html>
