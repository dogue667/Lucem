<?php
session_start();
include_once("conexao.php");

// Verifica login
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$mensagem = "";

// Se enviou formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Emoções selecionadas
    $emocaoSelecionada = $_POST["emocao"] ?? "";
    $descricao = $_POST["descricao"] ?? "";
    $fatores = isset($_POST["fatores"]) ? implode(", ", $_POST["fatores"]) : "";

    if ($emocaoSelecionada != "") {

        // --- 1. INSERIR EM TABELA EMOCAO ---
        $sql_emocao = $conexao->prepare("
            INSERT INTO Emocao (Tipo_emocao, Intensidade, Causa_emocao)
            VALUES (?, ?, ?)
        ");
        $intensidade_padrao = 3; // você pode mudar depois
        $causa = $descricao . " | Fatores: " . $fatores;

        $sql_emocao->bind_param("sis",
            $emocaoSelecionada,
            $intensidade_padrao,
            $causa
        );
        $sql_emocao->execute();

        $codEmocao = $sql_emocao->insert_id;

        // --- 2. INSERIR EM HISTORICO_EMOCAO ---
        $sql_hist = $conexao->prepare("
            INSERT INTO Historico_emocao (Observacao, Cod_usuario, Cod_emocao)
            VALUES (?, ?, ?)
        ");
        $sql_hist->bind_param("sii",
            $descricao,
            $usuario_id,
            $codEmocao
        );
        $sql_hist->execute();

        $mensagem = "Registro salvo com sucesso!";
    } else {
        $mensagem = "Selecione ao menos uma emoção!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mapa Emocional da Semana</title>
<link rel="stylesheet" href="nav.css">
<link rel="stylesheet" href="darkmode.css">
<style>
/* ============================= */
/*           PALETA LUCEM        */
/* ============================= */
:root {
    --bg: #ffe9d6;
    --menu: #ffffff;
    --texto: #4d2f68;
    --roxo: #9b6bc2;
    --roxo-escuro: #5b3a70;
    --hover: #f3d7bd;

    --calmo: #f2b179;
    --triste: #b08bb8;
    --grato: #b4cf8b;
    --ansioso: #de8c8c;
    --feliz: #93b7d3;
    --outro: #d4ed9f;
}

/* ============================= */
/*       CONTAINER PRINCIPAL     */
/* ============================= */

.container {
    background-color: #fff3e6;
    padding: 30px;
    border-radius: 20px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    margin-top: 130px; 
}

/* ============================= */
/*         EMOÇÕES — BOTÕES      */
/* ============================= */

.semana {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}

.dia {
    flex: 1;
    text-align: center;
    padding: 12px 0;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: transform 0.2s ease, opacity 0.3s ease;
    border: none;
}

.dia:hover { transform: scale(1.05); }

.calmo { background-color: var(--calmo); }
.triste { background-color: var(--triste); }
.grato { background-color: var(--grato); }
.ansioso { background-color: var(--ansioso); }
.feliz { background-color: var(--feliz); }
.outro { background-color: var(--outro); }

.selecionado {
    outline: 3px solid var(--roxo-escuro);
    opacity: 0.9;
}

/* ============================= */
/*           INPUTS/TEXTOS       */
/* ============================= */

input[type="text"], textarea {
    width: 100%;
    border: none;
    border-radius: 10px;
    padding: 12px;
    background-color: #ffe7d0;
    font-size: 1em;
    margin-top: 5px;
}

textarea { height: 90px; resize: none; }

label { font-size: 1em; }

/* ============================= */
/*             CHECKBOX          */
/* ============================= */

.fatores { margin: 15px 0; }
.fatores label { margin-right: 15px; }

/* ============================= */
/*             BOTÃO             */
/* ============================= */

button[type="submit"] {
    background-color: var(--roxo);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 12px 25px;
    font-size: 1em;
    cursor: pointer;
    transition: 0.3s ease;
}

button[type="submit"]:hover {
    background-color: var(--roxo-escuro);
}

/* ============================= */
/*          MENSAGEM RETORNO     */
/* ============================= */

.mensagem {
    margin-top: 20px;
    background-color: #dff3d9;
    border-radius: 12px;
    padding: 12px;
    color: #3d602c;
    font-weight: 500;
}

/* RESPONSIVIDADE */
@media (max-width: 600px) {
    .semana { flex-direction: column; }
}

</style>

</head>
<body>

<!-------------- NAV ---------- -->
<?php include "nav.php"; ?>
  
<div class="container">
    <h2>Seu Mapa Emocional da Semana</h2>

    <div class="semana">
        <button type="button" class="dia calmo" onclick="alternarEmocao(this, 'Calmo')">Calmo</button>
        <button type="button" class="dia triste" onclick="alternarEmocao(this, 'Triste')">Triste</button>
        <button type="button" class="dia grato" onclick="alternarEmocao(this, 'Grato')">Grato</button>
        <button type="button" class="dia ansioso" onclick="alternarEmocao(this, 'Ansioso')">Ansioso</button>
        <button type="button" class="dia feliz" onclick="alternarEmocao(this, 'Feliz')">Feliz</button>
        <button type="button" class="dia outro" onclick="alternarEmocao(this, 'Outro')">Outro</button>
    </div>

    <form method="POST">
        <label for="emocao"><b>Como você está se sentindo hoje?</b></label>
        <input type="text" name="emocao" id="emocao" placeholder="Selecione uma ou mais emoções" readonly>

        <h3>Descreva seu dia em palavras</h3>
        <textarea name="descricao" placeholder="Descreva seu dia em palavras..."></textarea>

        <h3>O que ajudou ou piorou seu humor?</h3>
        <div class="fatores">
            <label><input type="checkbox" name="fatores[]" value="Amigos"> Amigos</label>
            <label><input type="checkbox" name="fatores[]" value="Trabalho"> Trabalho</label>
            <label><input type="checkbox" name="fatores[]" value="Sono"> Sono</label>
            <label><input type="checkbox" name="fatores[]" value="Alimentação"> Alimentação</label>
        </div>

        <button type="submit">Salvar registro</button>
    </form>

    <?php if ($mensagem): ?>
    <div class="mensagem">
        <?php echo $mensagem; ?>
    </div>
    <?php endif; ?>
</div>

<script>
let selecionadas = [];
function alternarEmocao(botao, emocao) {
    const index = selecionadas.indexOf(emocao);
    if (index > -1) {
        selecionadas.splice(index, 1);
        botao.classList.remove('selecionado');
    } else {
        selecionadas.push(emocao);
        botao.classList.add('selecionado');
    }
    document.getElementById('emocao').value = selecionadas.join(", ");
}
</script>

</body>
</html>
