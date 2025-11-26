<?php
// Simulação de lista de clientes
$clientes = [
    ["id" => 1, "nome" => "Ana Souza", "idade" => 29, "ultimaSessao" => "10/11/2025", "emocao" => "Ansiosa"],
    ["id" => 2, "nome" => "Bruno Lima", "idade" => 34, "ultimaSessao" => "09/11/2025", "emocao" => "Grato"],
    ["id" => 3, "nome" => "Carla Mendes", "idade" => 41, "ultimaSessao" => "12/11/2025", "emocao" => "Triste"],
    ["id" => 4, "nome" => "Diego Rocha", "idade" => 22, "ultimaSessao" => "08/11/2025", "emocao" => "Feliz"],
    ["id" => 5, "nome" => "Eduarda Reis", "idade" => 27, "ultimaSessao" => "11/11/2025", "emocao" => "Calma"]
];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Clientes do Psicólogo</title>
 <link rel="stylesheet" href="darkmode.css">
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
        max-width: 750px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h2 {
        color: #6b3e26;
        text-align: center;
        margin-bottom: 25px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fcefdc;
        border-radius: 15px;
        overflow: hidden;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
    }

    th {
        background-color: #e49b84;
        color: white;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #fff8f0;
    }

    tr:hover {
        background-color: #fde3d0;
        transition: background-color 0.2s ease;
    }

    .emocao {
        padding: 5px 10px;
        border-radius: 8px;
        color: white;
        font-weight: bold;
        font-size: 0.9em;
        display: inline-block;
        text-align: center;
        min-width: 70px;
    }

    .Calma { background-color: #f2b179; }
    .Triste { background-color: #b08bb8; }
    .Grato { background-color: #b4cf8b; }
    .Ansiosa { background-color: #de8c8c; }
    .Feliz { background-color: #93b7d3; }

    .botao {
        background-color: #e49b84;
        color: white;
        padding: 8px 15px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 0.9em;
        transition: background-color 0.3s ease;
    }

    .botao:hover {
        background-color: #cf836d;
    }

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
    <h2>Lista de Clientes do Psicólogo</h2>

    <table>
        <tr>
            <th>Nome</th>
            <th>Idade</th>
            <th>Última Sessão</th>
            <th>Emoção Atual</th>
            <th>Ações</th>
        </tr>

        <?php foreach ($clientes as $c): ?>
        <tr>
            <td><?php echo htmlspecialchars($c["nome"]); ?></td>
            <td><?php echo $c["idade"]; ?></td>
            <td><?php echo $c["ultimaSessao"]; ?></td>
            <td><span class="emocao <?php echo htmlspecialchars($c["emocao"]); ?>"><?php echo htmlspecialchars($c["emocao"]); ?></span></td>
            <td><a href="cliente_detalhes.php?id=<?php echo $c["id"]; ?>" class="botao">Ver detalhes</a></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="registra_emocoes.php" class="botao-voltar">← Voltar ao Mapa Emocional</a>
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
