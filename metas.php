<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LUCEM — Exercícios e Metas</title>
   <link rel="stylesheet" href="darkmode.css">
  <style>
    /* NAVBAR */
.navbar {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 70px;
  background: #ffffffcc;
  backdrop-filter: blur(6px);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 40px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  z-index: 999;
}

.nav-left {
  display: flex;
  align-items: center;
  gap: 10px;
}

.logo-icone {
  font-size: 28px;
}

.logo-texto {
  font-size: 26px;
  font-weight: 700;
  color: #000;
}

.nav-links {
  list-style: none;
  display: flex;
  gap: 35px;
  margin: 0;
  padding: 0;
}

.nav-links a {
  text-decoration: none;
  font-weight: 600;
  color: #000;
  transition: color 0.3s ease;
}

.nav-links a:not(:first-child) {
  color: #e53935;
}

.nav-links a:hover {
  text-decoration: underline;
}

.nav-right .btn-dark {
  border: 2px solid #333;
  border-radius: 12px;
  background: transparent;
  padding: 6px 10px;
  cursor: pointer;
  font-size: 16px;
}

    :root {
      --bg: #f9efe4;
      --roxo: #9b6bc2;
      --roxo-escuro: #4d2f68;
      --hover: #e7d3f5;
      --degrade: linear-gradient(135deg, #cda9f1, #a57cd3, #7f56b1);
      --texto: #5b3a70;
      --card: #ffffff;
    }

    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background: var(--bg);
      color: var(--texto);
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 20px;
      min-height: 100vh;
      overflow-x: hidden;
      padding-top: 110px;
}

    

    h1 {
      color: var(--roxo-escuro);
      font-size: 2.4rem;
      margin-bottom: 15px;
    }

    .intro {
      max-width: 900px;
      background: var(--card);
      border-radius: 25px;
      padding: 35px;
      box-shadow: 0 10px 25px rgba(155, 107, 194, 0.2);
      text-align: center;
      margin-bottom: 40px;
      animation: fadeIn 1s ease forwards;
    }

    .intro h2 {
      color: var(--roxo-escuro);
      font-size: 1.8rem;
      margin-bottom: 15px;
    }

    .intro p {
      line-height: 1.6;
      font-size: 1rem;
      color: var(--texto);
    }

    .intro strong {
      color: var(--roxo);
    }

    .tabs {
      display: flex;
      gap: 10px;
      margin-bottom: 25px;
    }

    .tab {
      padding: 10px 25px;
      border-radius: 25px;
      border: 2px solid var(--roxo);
      background: transparent;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s ease;
      color: var(--roxo-escuro);
    }

    .tab.active {
      background: var(--degrade);
      color: #fff;
      box-shadow: 0 5px 15px rgba(155, 107, 194, 0.3);
    }

    .grid-metas {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      width: 100%;
      max-width: 900px;
    }

    .meta-card {
      background: var(--card);
      border-radius: 25px;
      box-shadow: 0 6px 18px rgba(155, 107, 194, 0.15);
      padding: 25px 20px;
      text-align: center;
      transition: all 0.3s ease;
      position: relative;
    }

    .meta-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 25px rgba(155, 107, 194, 0.25);
    }

    .meta-icon {
      font-size: 50px;
      margin-bottom: 10px;
      transition: transform 0.3s ease;
    }

    .meta-card:hover .meta-icon {
      transform: scale(1.15) rotate(5deg);
    }

    .meta-title {
      font-weight: 700;
      font-size: 1.2rem;
      color: var(--roxo-escuro);
      margin-bottom: 5px;
    }

    .meta-desc {
      font-size: 0.9rem;
      color: var(--texto);
      margin-bottom: 15px;
    }

    .meta-desc a {
      color: var(--roxo);
      font-weight: 600;
      text-decoration: none;
    }

    .meta-desc a:hover {
      color: var(--roxo-escuro);
      text-decoration: underline;
    }

    .btn-area {
      display: flex;
      justify-content: center;
      gap: 10px;
    }

    .meta-btn {
      border: none;
      padding: 9px 18px;
      border-radius: 25px;
      background: var(--degrade);
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      transition: transform 0.2s ease;
    }

    .meta-btn:hover {
      transform: scale(1.08);
    }

    .undo-btn {
      border: 2px solid var(--roxo);
      background: transparent;
      color: var(--roxo-escuro);
    }

    .undo-btn:hover {
      background: var(--hover);
    }

    .meta-card.done {
      opacity: 0.7;
      background: #f2e6f8;
      border: 2px solid var(--roxo);
      text-decoration: line-through;
    }

    .hidden {
      display: none;
    }

    h3 {
      margin-top: 40px;
      color: var(--roxo-escuro);
      font-size: 1.5rem;
    }

    .conquistas {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 15px;
      max-width: 900px;
    }

    .badge {
      background: var(--degrade);
      color: white;
      padding: 10px 18px;
      border-radius: 30px;
      font-weight: 600;
      font-size: 0.9rem;
      box-shadow: 0 4px 10px rgba(155, 107, 194, 0.25);
      opacity: 0;
      transform: translateY(10px);
      animation: fadeBadge 0.6s forwards;
    }

    .parabens {
      font-size: 1.3rem;
      color: var(--roxo-escuro);
      background: #fff;
      border-radius: 20px;
      padding: 20px 30px;
      box-shadow: 0 6px 20px rgba(155, 107, 194, 0.2);
      text-align: center;
      margin-top: 25px;
    }

    @keyframes fadeBadge {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(15px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <nav class="navbar">
  <div class="nav-left">
    <span class="logo-icone">🌞</span>
    <span class="logo-texto">LUCEM</span>
  </div>

  <ul class="nav-links">
    <li><a href="index.php">Sobre</a></li>
    <li><a href="registra_emocoes.php" style="color:#6d4af0;">Registrar Emoções</a></li>
    <li><a href="minhas_emocoes.php">Minhas Emoções</a></li>
    <li><a href="atendimento.php">Atendimento Psicológico</a></li>
    <li><a href="artigos.php">Artigos</a></li>
    <li><a href="metas.php">Exercícios & Metas</a></li>
    <li><a href="logout.php" style="color:#d9534f;">Sair</a></li>
  </ul>

  <div class="nav-right">
    <button class="btn-dark" onclick="toggleDarkMode()">🌗</button>
  </div>
</nav>



  <h1>🌞 Exercícios e Metas</h1>

  <section class="intro">
    <h2>Seu espaço de equilíbrio e autocuidado</h2>
    <p>
      Aqui você encontra atividades que ajudam a <strong>melhorar o bem-estar físico e mental</strong>.  
      Complete suas metas diárias e ganhe conquistas únicas!  
      <br><br>
      🌿 <strong>Exercício</strong> — movimento e energia<br>
      💧 <strong>Hidratação</strong> — cuidar do corpo<br>
      🧘 <strong>Meditação</strong> — acalmar a mente<br>
      💖 <strong>Gratidão</strong> — cultivar positividade<br>
      📖 <strong>Leitura</strong> — expandir o conhecimento<br>
      😴 <strong>Sono</strong> — restaurar suas forças
    </p>
  </section>

  <div class="tabs">
    <button class="tab active" onclick="mostrar('pendentes')">Pendentes</button>
    <button class="tab" onclick="mostrar('concluidas')">Completas</button>
  </div>

  <div id="pendentes" class="grid-metas">
    <div class="meta-card" data-id="1">
      <div class="meta-icon">💧</div>
      <div class="meta-title">Hidratação</div>
      <div class="meta-desc">Beber 2L de água — <a href="https://www.gov.br/saude/pt-br/assuntos/noticias/2023/julho/hidratacao-entenda-a-importancia-e-quanto-beber-de-agua-por-dia" target="_blank">saiba mais</a></div>
      <div class="btn-area"><button class="meta-btn" onclick="concluirMeta(this, 1)">Concluir</button></div>
    </div>

    <div class="meta-card" data-id="2">
      <div class="meta-icon">🏃‍♀️</div>
      <div class="meta-title">Exercício</div>
      <div class="meta-desc">30 minutos de movimento corporal — <a href="https://www.gov.br/saude/pt-br/assuntos/noticias/2024/abril/beneficios-da-atividade-fisica-para-a-saude" target="_blank">saiba mais</a></div>
      <div class="btn-area"><button class="meta-btn" onclick="concluirMeta(this, 2)">Concluir</button></div>
    </div>

    <div class="meta-card" data-id="3">
      <div class="meta-icon">🧘</div>
      <div class="meta-title">Meditação</div>
      <div class="meta-desc">10 minutos de respiração consciente — <a href="https://www.gov.br/saude/pt-br/assuntos/noticias/2022/outubro/meditacao-pode-ajudar-a-reduzir-ansiedade-e-estresse" target="_blank">saiba mais</a></div>
      <div class="btn-area"><button class="meta-btn" onclick="concluirMeta(this, 3)">Concluir</button></div>
    </div>

    <div class="meta-card" data-id="4">
      <div class="meta-icon">💖</div>
      <div class="meta-title">Gratidão</div>
      <div class="meta-desc">Anote 3 coisas boas do seu dia — <a href="https://www.gov.br/saude/pt-br/assuntos/noticias/2023/fevereiro/praticar-gratidao-pode-aumentar-o-bem-estar" target="_blank">saiba mais</a></div>
      <div class="btn-area"><button class="meta-btn" onclick="concluirMeta(this, 4)">Concluir</button></div>
    </div>

    <div class="meta-card" data-id="5">
      <div class="meta-icon">📖</div>
      <div class="meta-title">Leitura</div>
      <div class="meta-desc">Leia ao menos 10 páginas — <a href="https://www.gov.br/pt-br/noticias/cultura/2021/04/beneficios-da-leitura-para-a-saude-mental" target="_blank">saiba mais</a></div>
      <div class="btn-area"><button class="meta-btn" onclick="concluirMeta(this, 5)">Concluir</button></div>
    </div>

    <div class="meta-card" data-id="6">
      <div class="meta-icon">😴</div>
      <div class="meta-title">Sono</div>
      <div class="meta-desc">Durma 8 horas de qualidade — <a href="https://www.gov.br/saude/pt-br/assuntos/noticias/2023/marco/sono-saude-importancia-e-dicas-para-dormir-bem" target="_blank">saiba mais</a></div>
      <div class="btn-area"><button class="meta-btn" onclick="concluirMeta(this, 6)">Concluir</button></div>
    </div>
  </div>

  <div id="concluidas" class="grid-metas hidden"></div>

  <div id="conquistas-area" class="hidden">
    <h3>🌟 Conquistas</h3>
    <div id="conquistas" class="conquistas"></div>
    <div id="parabens" class="parabens hidden">🎉 Parabéns! Você concluiu todas as metas de hoje!</div>
  </div>

  <script>
    const pendentes = document.getElementById('pendentes');
    const concluidas = document.getElementById('concluidas');
    const conquistasArea = document.getElementById('conquistas-area');
    const conquistas = document.getElementById('conquistas');
    const parabens = document.getElementById('parabens');

    function mostrar(tipo) {
      document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
      document.querySelectorAll('.grid-metas').forEach(div => div.classList.add('hidden'));
      conquistasArea.classList.add('hidden');

      if (tipo === 'pendentes') {
        pendentes.classList.remove('hidden');
        document.querySelector('.tab:nth-child(1)').classList.add('active');
      } else {
        concluidas.classList.remove('hidden');
        document.querySelector('.tab:nth-child(2)').classList.add('active');
        conquistasArea.classList.remove('hidden');
      }
    }

    function concluirMeta(btn, id) {
      const card = btn.closest('.meta-card');
      card.classList.add('done');

      const undo = document.createElement('button');
      undo.className = 'meta-btn undo-btn';
      undo.textContent = 'Desfazer';
      undo.onclick = () => desfazerMeta(card, id);

      const area = card.querySelector('.btn-area');
      area.innerHTML = '';
      area.appendChild(undo);

      concluidas.appendChild(card);

      const nome = card.querySelector('.meta-title').textContent;
      const badge = document.createElement('div');
      badge.className = 'badge';
      badge.textContent = `🏅 ${nome} concluída!`;
      conquistas.appendChild(badge);

      checarTudoConcluido();
    }

    function desfazerMeta(card, id) {
      card.classList.remove('done');
      const area = card.querySelector('.btn-area');
      area.innerHTML = `<button class="meta-btn" onclick="concluirMeta(this, ${id})">Concluir</button>`;
      pendentes.appendChild(card);
      parabens.classList.add('hidden');
    }

    function checarTudoConcluido() {
      if (pendentes.children.length === 0) {
        parabens.classList.remove('hidden');
      }
    }
  </script>
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