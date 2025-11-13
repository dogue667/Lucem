<?php
// Simulação de registro de emoção (sem banco de dados)
$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $emocao = $_POST["emocao"] ?? "";
    $descricao = $_POST["descricao"] ?? "";
    $fatores = isset($_POST["fatores"]) ? implode(", ", $_POST["fatores"]) : "Nenhum";
    $mensagem = "Emoção registrada: $emocao<br>Descrição: $descricao<br>Fatores: $fatores";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mapa Emocional da Semana</title>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #fff8f0;
        color: #4a3b2a;
        margin: 0;
        padding: 40px;
        display: flex;
        justify-content: center;
    }

    .container {
        background-color: #fff3e6;
        padding: 30px;
        border-radius: 20px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-align: left;
    }

    h2 {
        color: #6b3e26;
        text-align: left;
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
        transition: transform 0.2s ease;
    }

    .dia:hover {
        transform: scale(1.05);
    }

    .calmo { background-color: #f2b179; }
    .triste { background-color: #b08bb8; }
    .grato { background-color: #b4cf8b; }
    .ansioso { background-color: #de8c8c; }
    .feliz { background-color: #93b7d3; }
    .outro { background-color: #d4ed9f; }

    input[type="text"], textarea {
        width: 100%;
        border: none;
        border-radius: 10px;
        padding: 10px;
        background-color: #fff2e6;
        font-size: 1em;
        margin-top: 5px;
    }

    textarea {
        resize: none;
        height: 80px;
    }

    .fatores {
        margin: 15px 0;
    }

    label {
        margin-right: 15px;
        font-size: 0.95em;
    }

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

    button[type="submit"]:hover {
        background-color: #cf836d;
    }

    .mensagem {
        margin-top: 20px;
        background-color: #dff3d9;
        border-radius: 10px;
        padding: 10px;
        color: #3d602c;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Seu Mapa Emocional da Semana</h2>

    <div class="semana">
        <button type="button" class="dia calmo">Calmo</button>
        <button type="button" class="dia triste">Triste</button>
        <button type="button" class="dia grato">Grato</button>
        <button type="button" class="dia ansioso">Ansioso</button>
        <button type="button" class="dia feliz">Feliz</button>
        <button type="button" class="dia outro">Outro</button>
    </div>

    <form method="POST">
        <label for="emocao"><b>Como você está se sentindo hoje?</b></label>
        <input type="text" name="emocao" id="emocao" placeholder="Digite sua emoção">

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

</body>
</html>
