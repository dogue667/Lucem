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
    /* ---------- MENU SUPERIOR ---------- */
    :root {
        --menu-bg: #fff3e4;
        --menu-texto: #4b2b12;
        --menu-hover: #6d4af0;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #fff8f0;
        color: #4a3b2a;
        margin: 0;
        padding-top: 100px; /* Espaço para o menu fixo */
        display: flex;
        justify-content: center;
    }

    header {
        background-color: var(--menu-bg);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 40px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
    }

    .logo {
        font-family: "Playfair Display", serif;
        font-weight: 700;
        font-size: 1.7em;
        color: var(--menu-texto);
    }

    nav ul {
        list-style: none;
        display: flex;
        gap: 20px;
        margin: 0;
        padding: 0;
    }

    nav ul li a {
        text-decoration: none;
        color: var(--menu-texto);
        font-weight: 500;
        padding: 8px 14px;
        border-radius: 8px;
        transition: 0.3s;
    }

    nav ul li a:hover {
        background-color: var(--menu-hover);
        color: #fff;
    }

    /* ---------- CONTAINER ---------- */
    .container {
        background-color: #fff3e6;
        padding: 30px;
        border-radius: 20px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
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

<!-- MENU SUPERIOR -->
<header>
    <div class="logo">🌞 LUCEM</div>
    <nav>
        <ul>
            <li><a href="index.php">Sobre</a></li>
            <li><a href="registra_emocoes.php" style="color:#6d4af0;">Registrar Emoções</a></li>
            <li><a href="minhas_emocoes.php">Minhas Emoções</a></li>
            <li><a href="atendimento.php">Atendimento Psicológico</a></li>
            <li><a href="artigos.php">Artigos</a></li>
            <li><a href="metas.php">Exercícios & Metas</a></li>
            <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>
        </ul>
    </nav>
</header>

<!-- CONTEÚDO -->
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
