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
/* CENTRALIZAÇÃO GERAL */
body {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-direction: column;
    min-height: 100vh;
    background-color: #ffe9d6;
}

/* ---------- MENU ---------- */
header {
    background-color:white;
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


/* ---------- CONTEÚDO CENTRAL ---------- */
.container {
    background-color: #fff3e6;
    padding: 30px;
    border-radius: 20px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    margin-top: 130px; /* Afasta do header fixo */
    align-self: center;
}

h2 {
    color: #6b3e26;
    margin-bottom: 20px;
}

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
    padding: 10px 0;
    border: none;
    border-radius: 10px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: transform 0.2s ease, opacity 0.3s ease;
}

.dia:hover { transform: scale(1.05); }

.calmo { background-color: #f2b179; }
.triste { background-color: #b08bb8; }
.grato { background-color: #b4cf8b; }
.ansioso { background-color: #de8c8c; }
.feliz { background-color: #93b7d3; }
.outro { background-color: #d4ed9f; }

.selecionado { outline: 3px solid #6b3e26; opacity: 0.9; }

input[type="text"], textarea {
    width: 100%;
    border: none;
    border-radius: 10px;
    padding: 10px;
    background-color: #fff2e6;
    font-size: 1em;
    margin-top: 5px;
}

textarea { resize: none; height: 80px; }

.fatores { margin: 15px 0; }
label { margin-right: 15px; font-size: 0.95em; }   

button[type="submit"] {
    background-color: #e49b84;
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px 25px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover { background-color: #cf836d; }

.mensagem {
    margin-top: 20px;
    background-color: #dff3d9;
    border-radius: 10px;
    padding: 10px;
    color: #3d602c;
}

/* Responsividade */
@media (max-width: 600px) {
    .semana { flex-direction: column; }
    nav ul { flex-direction: column; gap: 10px; }
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
