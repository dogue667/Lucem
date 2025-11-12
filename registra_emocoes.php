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
        flex-direction: column;
        align-items: center;
    }

    h2 {
        color: #6b3e26;
        font-size: 1.6em;
        margin-bottom: 15px;
    }

    .container {
        background-color: #fff3e6;
        padding: 30px;
        border-radius: 20px;
        width: 90%;
        max-width: 700px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .semana {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
    }

    .dia {
        width: 14%;
        text-align: center;
        padding: 15px 0;
        border-radius: 12px;
        color: white;
        font-weight: bold;
    }

    .calmo { background-color: #f2b179; }
    .triste { background-color: #b08bb8; }
    .grato { background-color: #b4cf8b; }
    .ansioso { background-color: #de8c8c; }
    .feliz { background-color: #93b7d3; }
    .vazio { background-color: #e6d9c6; }

    textarea {
        width: 100%;
        border: none;
        border-radius: 10px;
        padding: 10px;
        font-size: 1em;
        background-color: #fff2e6;
        resize: none;
        margin-top: 10px;
        height: 80px;
    }

    .fatores {
        margin: 15px 0;
    }

    label {
        margin-right: 15px;
        font-size: 0.95em;
    }

    button {
        background-color: #e49b84;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 25px;
        font-size: 1em;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #cf836d;
    }

    .resumo {
        background-color: #fcefdc;
        padding: 15px;
        border-radius: 15px;
        margin-top: 25px;
        font-size: 0.95em;
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
        <div class="dia calmo">Calmo</div>
        <div class="dia triste">Triste</div>
        <div class="dia grato">Grato</div>
        <div class="dia ansioso">Ansioso</div>
        <div class="dia feliz">Feliz</div>
        <div class="dia vazio"></div>
    </div>

    <form method="POST">
        <label for="emocao"><b>Como você está se sentindo hoje?</b></label><br><br>
        <input type="text" name="emocao" id="emocao" placeholder="Digite sua emoção" style="width:100%;padding:10px;border-radius:10px;border:none;background-color:#fff2e6;">

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

    <div class="resumo">
        <b>Resumo da Semana</b><br><br>
        Você se sentiu mais calmo(a) em 3 dias.<br><br>
        <b>Sugestão Lucem:</b><br>
        Experimente o exercício de respiração 4x4 hoje.<br><br>
        <b>Sugestão Lucem:</b><br>
        Ouça uma meditação guiada de 1 minuto.
    </div>
</div>

</body>
</html>
