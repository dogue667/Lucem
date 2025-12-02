<?php
session_start();
?>

<?php
// Simulação de registro de emoção (sem banco de dados)
$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $emocao = $_POST["emocao"] ?? "";
    $descricao = $_POST["descricao"] ?? "";
    $fatores = isset($_POST["fatores"]) ? implode(", ", $_POST["fatores"]) : "Nenhum";
    $mensagem = "Emoções registradas: $emocao<br>Descrição: $descricao<br>Fatores: $fatores";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mapa Emocional da Semana</title>
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
/*       PADRÃO DA PÁGINA        */
/* ============================= */

body {
    margin: 0;
    padding: 0;
    font-family: "Poppins", sans-serif;
    background-color: var(--bg);
    color: var(--texto);
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* ============================= */
/*             HEADER            */
/* ============================= */

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

/* ---------- Submenu ---------- */
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

/* ---------- Ícone config ---------- */
.nav-icons {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.config-icon a {
    font-size: 1.5rem;
    color: var(--roxo-escuro);
    transition: 0.3s;
}

.config-icon a:hover {
    transform: rotate(20deg);
    color: var(--roxo);
}

/* ---------- RESPONSIVO MENU ---------- */
@media (max-width: 768px) {
    header { flex-direction: column; }
    nav ul { flex-direction: column; gap: 10px; }
    .logo { margin-bottom: 10px; }
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
