<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUCEM — Equilíbrio e Autocuidado</title>
   <!-- DARK MODE CSS -->
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="darkmode.css">
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
        /* ---------- SEÇÃO INICIAL ---------- */
        .inicio {
            margin-top: 130px;
            text-align: center;
            background: var(--degrade);
            color: white;
            padding: 120px 20px 160px;
            border-radius: 70px;
            overflow: hidden;
        }

        .inicio img:hover {
            transform: scale(1.03);
        }

        .inicio h1 {
            font-family: "Playfair Display", serif;
            font-size: 2.6em;
            margin-bottom: 10px;
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
            margin-bottom: 15px;
        }

        .sobre p {
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1em;
            color: var(--texto);
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
            margin-bottom: 40px;
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
            margin-bottom: 10px;
        }

        .card p {
            font-size: 0.95em;
            color: var(--texto);
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

        .saude h2 {
            font-family: "Playfair Display", serif;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .saude p {
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
            font-size: 1.1em;
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

        .seguranca h2 {
            font-family: "Playfair Display", serif;
            font-size: 2em;
            color: var(--roxo-escuro);
            margin-bottom: 20px;
        }

        .seguranca p {
            max-width: 750px;
            margin: 0 auto 20px;
            font-size: 1.1em;
            color: var(--texto);
            line-height: 1.6;
        }

        .seguranca-destaque {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            margin-top: 30px;
        }

        .seguranca-destaque h3 {
            background: var(--degrade);
            color: white;
            padding: 16px 28px;
            border-radius: 40px;
            font-size: 1.05em;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .seguranca-destaque h3:hover {
            transform: translateY(-4px);
        }

        footer {
            background-color: var(--menu);
            text-align: center;
            padding: 25px;
            font-size: 0.9em;
            color: #866b95;
            margin-top: 50px;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.05);
        }

        /* ---------- ANIMAÇÕES ---------- */
        .fade {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s ease;
        }

        .fade.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>

<!-------------- NAV ---------- -->
<?php include "nav.php"; ?>
<!-- ---------- CONTEÚDO ---------- -->

<section class="inicio fade">
    <img src="lucem.png" alt="Ilustração LUCEM — menina acolhedora">
    <h1>Bem-vindo(a) ao LUCEM 🌞</h1>
    <p>Seu espaço de equilíbrio e autocuidado.<br>Cuide da mente, respire fundo e comece hoje.</p>

    <?php if (!isset($_SESSION['usuario_id'])): ?>
        <a href="cadastro.php" class="botao">Comece agora</a>
    <?php endif; ?>
</section>

<section class="sobre fade">
    <h2>Nosso Projeto</h2>
    <p>
        O LUCEM é um espaço digital criado para ajudar pessoas a acompanharem suas emoções,
        encontrarem apoio psicológico acessível e aprenderem sobre saúde mental de forma leve e acolhedora.
        Acreditamos que cuidar da mente deve ser tão natural quanto cuidar do corpo.
    </p>
</section>

<section class="funcoes fade">
    <h2>O que o LUCEM oferece</h2>
    <div class="cards">
        <div class="card">
            <h3>🌤️ Mapa Emocional</h3>
            <p>Acompanhe suas emoções e entenda como seus sentimentos evoluem ao longo da semana.</p>
        </div>
        <div class="card">
            <h3>🧘‍♀️ Exercícios Terapêuticos</h3>
            <p>Meditações e práticas que ajudam a aliviar o estresse e melhorar o foco.</p>
        </div>
        <div class="card">
            <h3>💬 Atendimento Psicológico</h3>
            <p>Converse com psicólogos parceiros em um ambiente seguro e confidencial.</p>
        </div>
        <div class="card">
            <h3>📚 Conteúdo Educativo</h3>
            <p>Artigos e dicas sobre saúde mental, autoestima e equilíbrio emocional.</p>
        </div>
    </div>
</section>

<section class="saude fade">
    <h2>Por que cuidar da saúde mental?</h2>
    <p>
        Cuidar da mente é um ato de amor-próprio.
        A saúde mental é a base para viver com leveza, resiliência e bem-estar.
        O LUCEM foi criado para te acompanhar nessa jornada — passo a passo,
        com empatia, ciência e acolhimento.
    </p>
</section>

<section class="seguranca fade">
    <h2>Sua Segurança em Primeiro Lugar 🔒</h2>
    <p>
        No LUCEM, a sua privacidade é prioridade. Todos os seus registros emocionais e informações pessoais
        são armazenados de forma segura e confidencial.
    </p>

    <div class="seguranca-destaque">
        <h3>✔️ Proteção de Dados</h3>
        <h3>🔐 Confidencialidade Total</h3>
        <h3>🧠 Ambiente Confiável</h3>
    </div>
</section>

<footer>
    © 2025 LUCEM — Todos os direitos reservados.
</footer>

<!-- ANIMAÇÃO -->
<script>
const faders = document.querySelectorAll(".fade");

const appearOptions = {
    threshold: 0.2,
    rootMargin: "0px 0px -100px 0px"
};

const appearOnScroll = new IntersectionObserver(function(entries, observer) {
    entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("visible");
        observer.unobserve(entry.target);
    });
}, appearOptions);

faders.forEach(fader => {
    appearOnScroll.observe(fader);
});
</script>

<script>
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
