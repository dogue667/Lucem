<?php
// Dados simulados (em vez de banco de dados)
$historico = [
    1 => [
        "nome" => "Ana Souza",
        "idade" => 29,
        "registros" => [
            ["data" => "10/11/2025", "emocao" => "Ansiosa", "descricao" => "Dia cheio de trabalho, um pouco sobrecarregada.", "fatores" => "Trabalho, Sono"],
            ["data" => "07/11/2025", "emocao" => "Grata", "descricao" => "Consegui terminar um projeto importante.", "fatores" => "Trabalho, Amigos"]
        ]
    ],
    2 => [
        "nome" => "Bruno Lima",
        "idade" => 34,
        "registros" => [
            ["data" => "09/11/2025", "emocao" => "Grato", "descricao" => "Passei um ótimo fim de semana com a família.", "fatores" => "Amigos, Alimentação"]
        ]
    ],
    3 => [
        "nome" => "Carla Mendes",
        "idade" => 41,
        "registros" => [
            ["data" => "12/11/2025", "emocao" => "Triste", "descricao" => "Senti falta de tempo para mim mesma.", "fatores" => "Trabalho, Sono"]
        ]
    ],
    4 => [
        "nome" => "Diego Rocha",
        "idade" => 22,
        "registros" => [
            ["data" => "08/11/2025", "emocao" => "Feliz", "descricao" => "Dia de lazer com amigos, me senti leve.", "fatores" => "Amigos"]
        ]
    ],
    5 => [
        "nome" => "Eduarda Reis",
        "idade" => 27,
        "registros" => [
            ["data" => "11/11/2025", "emocao" => "Calma", "descricao" => "Dia tranquilo, consegui descansar bem.", "fatores" => "Sono"]
        ]
    ]
];

// Verifica ID do cliente
$id = $_GET["id"] ?? null;
$cliente = $historico[$id] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detalhes do Cliente</title>
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
        max-width: 700px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h2 {
        color: #6b3e26;
        margin-bottom: 20px;
    }

    .info {
        margin-bottom: 20px;
        background-color: #fcefdc;
        padding: 15px;
        border-radius: 12px;
    }

    .registro {
        background-color: #fff8f0;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .data {
        color: #6b3e26;
        font-weight: bold;
    }

    .emocao {
        padding: 5px 10px;
        border-radius: 8px;
        color: white;
        font-weight: bold;
        font-size: 0.9em;
        display: inline-block;
        min-width: 70px;
    }

    .Calma { background-color: #f2b179; }
    .Triste { background-color: #b08bb8; }
    .Grato { background-color: #b4cf8b; }
    .Ansiosa { background-color: #de8c8c; }
    .Feliz { background-color: #93b7d3; }

    .botao-voltar {
        display: inline-block;
        margin-top: 25px;
        background-color: #e49b84;
        color: white;
        text-decoration: none;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .botao-voltar:hover {
        background-color: #cf836d;
    }
</style>
</head>
<body>

<div class="container">
    <?php if ($cliente): ?>
        <h2>Histórico de <?php echo htmlspecialchars($cliente["nome"]); ?></h2>
        <div class="info">
            <b>Idade:</b> <?php echo $cliente["idade"]; ?><br>
            <b>Total de registros:</b> <?php echo count($cliente["registros"]); ?>
        </div>

        <?php foreach ($cliente["registros"] as $r): ?>
            <div class="registro">
                <div class="data"><?php echo $r["data"]; ?></div>
                <div class="emocao <?php echo $r["emocao"]; ?>"><?php echo $r["emocao"]; ?></div>
                <p><b>Descrição:</b> <?php echo $r["descricao"]; ?></p>
                <p><b>Fatores:</b> <?php echo $r["fatores"]; ?></p>
            </div>
        <?php endforeach; ?>

        <a href="clientes.php" class="botao-voltar">← Voltar à lista</a>
    <?php else: ?>
        <h2>Cliente não encontrado</h2>
        <a href="clientes.php" class="botao-voltar">← Voltar à lista</a>
    <?php endif; ?>
</div>

</body>
</html>
