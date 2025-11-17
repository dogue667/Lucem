<?php
// CONFIGURAÇÃO DE BANCO DE DADOS
$host = "localhost";
$user = "root";      // coloque o usuário do seu MySQL
$pass = "";          // coloque a senha do seu MySQL
$dbname = "emocao_app";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro ao conectar ao banco: " . $conn->connect_error);
}

// Verifica se existe um ID selecionado
$id = $_GET["id"] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Sistema Emocional</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fff8f0;
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

    h2 { color: #6b3e26; }

    .cliente {
        background-color: #fcefdc;
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 12px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .registro {
        background-color: #fff8f0;
        padding: 15px;
        border-radius: 12px;
        margin-bottom: 15px;
    }

    .data { font-weight: bold; color: #6b3e26; }

    .emocao {
        padding: 5px 10px;
        border-radius: 6px;
        color: white;
        font-weight: bold;
        display: inline-block;
    }

    .Ansiosa { background: #de8c8c; }
    .Grata, .Grato { background: #b4cf8b; }
    .Triste { background: #b08bb8; }
    .Feliz { background: #93b7d3; }
    .Calma { background: #f2b179; }

    .botao-voltar {
        display: inline-block;
        margin-top: 20px;
        background-color: #e49b84;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
    }

</style>
</head>

<body>
<div class="container">

<?php
// ===============================
//   SE UM CLIENTE FOI SELECIONADO
// ===============================
if ($id) {

    // Buscar cliente
    $sql = "SELECT * FROM clientes WHERE id = $id";
    $res = $conn->query($sql);

    if ($res->num_rows == 0) {
        echo "<h2>Cliente não encontrado</h2>";
        echo '<a href="index.php" class="botao-voltar">← Voltar</a>';
    } else {

        $cliente = $res->fetch_assoc();

        echo "<h2>Histórico de {$cliente['nome']}</h2>";

        // Buscar registros
        $sql2 = "SELECT * FROM registros WHERE cliente_id = $id ORDER BY data_registro DESC";
        $reg = $conn->query($sql2);

        echo "<div class='cliente'>
                <b>Idade:</b> {$cliente['idade']}<br>
                <b>Total de registros:</b> {$reg->num_rows}
              </div>";

        if ($reg->num_rows > 0) {
            while ($r = $reg->fetch_assoc()) {
                echo "
                <div class='registro'>
                    <div class='data'>".date('d/m/Y', strtotime($r['data_registro']))."</div>
                    <div class='emocao {$r['emocao']}'>{$r['emocao']}</div>
                    <p><b>Descrição:</b> {$r['descricao']}</p>
                    <p><b>Fatores:</b> {$r['fatores']}</p>
                </div>";
            }
        } else {
            echo "<p>Nenhum registro encontrado.</p>";
        }

        echo '<a href="index.php" class="botao-voltar">← Voltar à lista</a>';
    }

} else {

// ===============================
//     EXIBE LISTA DE CLIENTES
// ===============================
    echo "<h2>Lista de Clientes</h2>";

    $sql = "SELECT * FROM clientes ORDER BY nome";
    $res = $conn->query($sql);

    while ($c = $res->fetch_assoc()) {
        echo "
        <div class='cliente'>
            <a href='index.php?id={$c['id']}'>
                {$c['nome']} — {$c['idade']} anos
            </a>
        </div>
        ";
    }
}
?>

</div>
</body>
</html>
