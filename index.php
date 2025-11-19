<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUCEM — Equilíbrio e Autocuidado</title>

    <style>
        /* ---------- CORES ---------- */
        :root {
            --bg: #f9efe4;
            --menu: #ffffff;
            --texto: #5b3a70;
            --roxo: #9b6bc2;
            --roxo-escuro: #4d2f68;
            --hover: #e7d3f5;
            --degrade: linear-gradient(135deg, #d1b3f1, #a57cd3, #8a68b0);
            --bege: #f3dcc5;
        }

        body {
            margin: 0;
            font-family: "Inter", sans-serif;
            background-color: var(--bg);
            color: var(--texto);
            overflow-x: hidden;
        }

        /* ---------- MENU ---------- */
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
        nav ul li {
            position: relative;
        }

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

        /* Ícone de configurações */
        .nav-icons {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .config-icon {
            font-size: 1.5rem;
            color: var(--roxo-escuro);
            transition: 0.3s;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .config-icon:hover {
            transform: rotate(20deg);
            color: var(--roxo);
        }

        @media (max-width: 768px) {
            header { flex-direction: column; }
            nav ul { flex-direction: column; gap: 10px; }
            .logo { margin: 0 0 10px 0; }
        }

        /* ---------- SEÇÃO INICIAL ---------- */
        .inicio {
            margin-top: 130px;
            text-align: center;
            background: var(--degrade);
            color: white;
            padding: 120px 20px 160px;
            border-radius: 70px;
        }

        .inicio img:hover { transform: scale(1.03); }

        .inicio h1 {
            font-family: "Playfair Display", serif;
            font-size: 2.6em;
        }

        .inicio p {
            font-size: 1.2em;
            max-width: 600px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }

        .botao {
            background: var(--menu);
            color: var(--roxo-escuro);
            padding: 14px 34px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            transition: 0.3s;
        }

        .botao:hover {
            background: var(--roxo-escuro);
            color: white;
            transform: translateY(-2px);
        }

        /* ---------- SEÇÃO SOBRE ---------- */
        .sobre {
            text-align: center;
            padding: 90px 20px;
            background-color: var(--bege);
            border-radius: 60px;
            margin: 70px auto;
            max-width: 1000px;
        }

        .sobre h2 {
            font-family: "Playfair Display", serif;
            font-size: 2em;
            color: var(--roxo-escuro);
        }

        .sobre p {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1em;
            line-height: 1.6;
        }

        /* ---------- FUNÇÕES ---------- */
        .funcoes {
            text-align: center;
            padding: 70px 20px;
        }

        .funcoes h2 {
            font-family: "Playfair Display", serif;
            font-size: 2em;
            color: var(--roxo-escuro);
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
        }

        .card {
            background-color: var(--menu);
            border-radius: 20px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.08);
            width: 250px;
            padding: 25px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-6px);
            background-color: var(--hover);
        }

        .card h3 {
            color: var(--roxo);
        }

        .card p {
            font-size: 0.95em;
        }

        /* ---------- SAÚDE ---------- */
        .saude {
            background: var(--degrade);
            color: white;
            text-align: center;
            padding: 90px 20px;
            border-radius: 60px;
            margin: 70px 0;
        }

        /* ---------- SEGURANÇA ---------- */
        .seguranca {
            background-color: var(--menu);
            text-align: center;
            padding: 90px 20px;
            border-radius: 60px;
            margin: 70px auto;
            max-width: 1000px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        }

        .seguranca-destaque {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            margin-top: 30px;
        }

        footer {
            background-color: var(--menu);
            text-align: center;
            padding: 25px;
            font-size: 0.9em;
            margin-top: 50px;
            box-shadow: 0 -2px 8px rgba(0,0,0,0.05);
            color: #866b95;
        }

        /* ---------- ANIMAÇÕES ---------- */
        .fade {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s ease;
        }

        .visible {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .inicio img { width: 250px; }
        }
    </style>

</head>
<body>

<header>
    <div class="logo">🌞 LUCEM</div>

    <nav>
        <ul>
            <li><a href="index.php" style="font-weight:600; color:var(--roxo);">Sobre</a></li>

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

    <!-- BOTÃO DARK MODE -->
    <button onclick="toggleDarkMode()" 
        style="margin-left:20px; padding:8px 14px; border-radius:10px; cursor:pointer;">🌓</button>
</header>

<section class="inicio fade">
    <img src="lucem.png" alt="Ilustração LUCEM — menina acolhedora">

    <h1>Bem-vindo(a) ao LUCEM 🌞</h1>
    <p>Seu espaço de equilíbrio e autocuidado.<br>Cuide da mente, respire fundo e comece hoje.</p>

    <?php if (!isset($_SESSION['usuario_id'])): ?>
        <a href="cadastro.html" class="botao">Comece agora</a>
    <?php endif; ?>
</section>

<section class="sobre fade">
    <h2>Nosso Projeto</h2>
    <p>
        O LUCEM é um espaço digital criado para ajudar pessoas a acompanharem suas emoções,
        encontrarem apoio psicológico acessível e aprenderem sobre saúde mental de forma acolhedora.
    </p>
</section>

<section class="funcoes fade">
    <h2>O que o LUCEM oferece</h2>

    <div class="cards">
        <div class="card">
            <h3>🌤️ Mapa Emocional</h3>
            <p>Acompanhe suas emoções ao longo da semana.</p>
        </div>

        <div class="card">
            <h3>🧘‍♀️ Exercícios Terapêuticos</h3>
            <p>Práticas e meditações guiadas.</p>
        </div>

        <div class="card">
            <h3>💬 Atendimento Psicológico</h3>
            <p>Converse com especialistas.</p>
        </div>

        <div class="card">
            <h3>📚 Conteúdo Educativo</h3>
            <p>Dicas e artigos sobre saúde mental.</p>
        </div>
    </div>
</section>

<section class="saude fade">
    <h2>Por que cuidar da saúde mental?</h2>
    <p>
        Cuidar da mente é fundamental para uma vida leve e equilibrada.  
        O LUCEM te acompanha nessa jornada com ciência, empatia e acolhimento.
    </p>
</section>

<section class="seguranca fade">
    <h2>Sua Segurança em Primeiro Lugar 🔒</h2>

    <p>Suas informações são guardadas com total privacidade e segurança.</p>

    <div class="seguranca-destaque">
        <h3>✔️ Proteção de Dados</h3>
        <h3>🔐 Confidencialidade Total</h3>
        <h3>🧠 Ambiente Confiável</h3>
    </div>
</section>

<footer>© 2025 LUCEM — Todos os direitos reservados.</footer>

<script>
const faders = document.querySelectorAll(".fade");

const appearOnScroll = new IntersectionObserver(function(entries, observer) {
    entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("visible");
        observer.unobserve(entry.target);
    });
}, { threshold: 0.2 });

faders.forEach(el => appearOnScroll.observe(el));
</script>

<script src="darkmode.js"></script>

</body>
</html>
