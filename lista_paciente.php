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
