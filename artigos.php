<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LUCEM — Artigos e Inspirações</title>

  <!-- FONTES -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg: #f9efe4;
      --menu: #ffffff;
      --texto: #5b3a70;
      --roxo: #9b6bc2;
      --roxo-escuro: #4d2f68;
      --hover: #e7d3f5;
      --degrade: linear-gradient(135deg, #d1b3f1, #a57cd3, #8a68b0);
    }

    body {
      margin: 0;
      font-family: "Inter", sans-serif;
      background-color: var(--bg);
      color: var(--texto);
    }

    /* ===== NAV NOVA (VERSÃO 1) ===== */
    header {
      width: 100%;
      background: #ffffffd0;
      backdrop-filter: blur(10px);
      border-bottom: 1px solid #e5e5e5;
      position: fixed;
      top: 0;
      z-index: 100;
    }

    nav {
      max-width: 1250px;
      height: 75px;
      margin: auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 25px;
    }

    .logo {
      font-family: "Playfair Display", serif;
      font-weight: 700;
      font-size: 1.7em;
      color: var(--roxo-escuro);
      display: flex;
      align-items: center;
      gap: 5px;
    }

    nav ul {
      list-style: none;
      display: flex;
      align-items: center;
      gap: 28px;
      margin: 0;
      padding: 0;
    }

    nav ul li a {
      text-decoration: none;
      color: var(--roxo-escuro);
      font-weight: 500;
      padding: 8px 12px;
      border-radius: 8px;
      transition: 0.2s;
    }

    nav ul li a:hover {
      background-color: var(--hover);
      color: var(--roxo);
    }

    .nav-icons {
      display: flex;
      align-items: center;
      gap: 18px;
    }

    .nav-icons a {
      text-decoration: none;
      font-size: 1.3rem;
      color: var(--roxo-escuro);
      transition: 0.2s;
    }

    .nav-icons a:hover {
      color: var(--roxo);
    }

    /* ---------- BANNER ---------- */
    .banner {
      margin-top: 130px;
      text-align: center;
      background: var(--degrade);
      color: white;
      padding: 100px 20px 130px;
      border-radius: 60px;
    }

    .banner h1 {
      font-family: "Playfair Display", serif;
      font-size: 2.6em;
      margin-bottom: 10px;
    }

    .banner p {
      font-size: 1.2em;
      max-width: 600px;
      margin: 0 auto;
      line-height: 1.6;
    }

    /* ---------- ARTIGOS ---------- */
    .artigos {
      padding: 90px 40px;
      text-align: center;
    }

    .artigos h2 {
      font-family: "Playfair Display", serif;
      font-size: 2em;
      color: var(--roxo-escuro);
      margin-bottom: 50px;
    }

    .lista-artigos {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .artigo {
      background-color: var(--menu);
      border-radius: 20px;
      box-shadow: 0 6px 12px rgba(0,0,0,0.08);
      width: 300px;
      text-align: left;
      overflow: hidden;
      transition: 0.3s;
    }

    .artigo:hover {
      transform: translateY(-6px);
      background-color: var(--hover);
    }

    .artigo img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .conteudo-artigo {
      padding: 20px;
    }

    .conteudo-artigo h3 {
      color: var(--roxo);
      margin-top: 0;
      margin-bottom: 10px;
      font-size: 1.2em;
    }

    .conteudo-artigo p {
      font-size: 0.95em;
      color: var(--texto);
      line-height: 1.5;
    }

    .leia-mais {
      display: inline-block;
      margin-top: 12px;
      color: var(--roxo-escuro);
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }

    .leia-mais:hover {
      color: var(--roxo);
    }

    /* ---------- CTA ---------- */
    .cta {
      background: var(--degrade);
      color: white;
      text-align: center;
      padding: 80px 20px;
      border-radius: 50px;
      margin: 60px 40px;
    }

    .cta h2 {
      font-family: "Playfair Display", serif;
      font-size: 2em;
      margin-bottom: 20px;
    }

    .cta a {
      background: white;
      color: var(--roxo-escuro);
      padding: 14px 34px;
      border-radius: 30px;
      font-weight: 600;
      text-decoration: none;
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
      transition: 0.3s;
    }

    .cta a:hover {
      background: var(--roxo-escuro);
      color: white;
      transform: translateY(-2px);
    }

    footer {
      background-color: var(--menu);
      text-align: center;
      padding: 25px;
      font-size: 0.9em;
      color: #866b95;
      margin-top: 60px;
      box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.05);
    }

    .fade {
      opacity: 0;
      transform: translateY(40px);
      transition: all 1s ease;
    }

    .fade.visible {
      opacity: 1;
      transform: translateY(0);
    }

    @media (max-width: 768px) {
      nav ul { flex-direction: column; gap: 10px; }
      .artigo { width: 90%; }
    }
  </style>
</head>
<body>

<!-- ===== NAV NOVA (VERSÃO 1) ===== -->
<header>
  <nav>
    <div class="logo">☀ LUCEM</div>

    <ul>
      <li><a href="index.php">Início</a></li>
      <li><a href="registra_emocoes.php">Registrar Emoções</a></li>
      <li><a href="artigos.php">Artigos e Inspirações</a></li>
      <li><a href="metas.php">Exercícios & Metas</a></li>
      <?php if(isset($_SESSION['tipo']) && $_SESSION['tipo'] === "psicologo"): ?>
        <li><a href="dashboard_psicologo.php">Área do Psicólogo</a></li>
      <?php endif; ?>
    </ul>

    <div class="nav-icons">
      <?php if(isset($_SESSION['usuario_id'])): ?>
        <a href="configuracoes.php">⚙️</a>
        <a href="logout.php">⎋</a>
      <?php else: ?>
        <a href="login.php">Entrar</a>
      <?php endif; ?>
    </div>
  </nav>
</header>

<!-- ============================= -->

  <!-- ---------- BANNER ---------- -->
  <section class="banner fade">
    <h1>Artigos e Inspirações 💭</h1>
    <p>Conteúdos que acolhem, informam e fortalecem sua jornada de autocuidado.</p>
  </section>

  <section class="artigos">
  <h2>Explore nossos conteúdos</h2>
  <div class="lista-artigos">

    <!-- ARTIGOS ORIGINAIS -->
    <div class="artigo fade">
      <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=800&q=80" alt="Meditação">
      <div class="conteudo-artigo">
        <h3>O Poder da Respiração Consciente</h3>
        <p>Descubra como pequenas pausas e respirações profundas podem transformar seu dia e aliviar a ansiedade.</p>
        <a href="https://integrativa.pt/transforme-a-sua-vida-com-a-respiracao-consciente-como-integrar-esta-pratica-poderosa-no-seu-dia-a-dia/" target="_blank" class="leia-mais">Leia mais →</a>
      </div>
    </div>

    <div class="artigo fade">
      <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=800&q=80" alt="Autoestima">
      <div class="conteudo-artigo">
        <h3>Reconstruindo a Autoestima</h3>
        <p>Entenda como a autocompaixão é um passo essencial para fortalecer sua autoestima e bem-estar emocional.</p>
        <a href="https://www.conexasaude.com.br/blog/a-autocompaixao/" target="_blank" class="leia-mais">Leia mais →</a>
      </div>
    </div>

    <div class="artigo fade">
      <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=800&q=80" alt="Rotina saudável">
      <div class="conteudo-artigo">
        <h3>Rotina Saudável, Mente Equilibrada</h3>
        <p>Como pequenos hábitos diários, como o sono e a alimentação, impactam sua saúde mental.</p>
        <a href="https://avancebsb.com.br/equilibrio-o-segredo-para-uma-vida-saudavel-mente-e-corpo" target="_blank" class="leia-mais">Leia mais →</a>
      </div>
    </div>

    <div class="artigo fade">
      <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=800&q=80" alt="Terapia">
      <div class="conteudo-artigo">
        <h3>Por que buscar ajuda profissional?</h3>
        <p>Desmistificando a terapia: entenda como ela pode ser uma aliada poderosa no seu processo de cura.</p>
        <a href="http://sandramarisadasilva.com/desmistificando-a-terapia-mitos-e-verdades-sobre-o-processo-terapeutico/" target="_blank" class="leia-mais">Leia mais →</a>
      </div>
    </div>

    <!-- NOVOS ARTIGOS -->
    <div class="artigo fade">
      <img src="https://images.unsplash.com/photo-1531983412531-1f49a365ffed?auto=format&fit=crop&w=800&q=80" alt="Gratidão">
      <div class="conteudo-artigo">
        <h3>Praticando a Gratidão no Dia a Dia</h3>
        <p>Saiba como cultivar a gratidão pode melhorar seu humor, fortalecer relacionamentos e aumentar o bem-estar.</p>
        <a href="https://institutoacorde.org.br/a-importancia-da-gratidao-em-nossas-vidas/" target="_blank" class="leia-mais">Leia mais →</a>
      </div>
    </div>

    <div class="artigo fade">
      <img src="https://images.unsplash.com/photo-1504196606672-aef5c9cefc92?auto=format&fit=crop&w=800&q=80" alt="Mindfulness">
      <div class="conteudo-artigo">
        <h3>Depressão: Compreendendo e Superando a Tristeza Profunda</h3>
        <p>Aprenda a reconhecer os sinais da depressão e descubra formas de cuidar da mente e recuperar o equilíbrio emocional.</p>
        <a href="https://www.gov.br/saude/pt-br/assuntos/saude-de-a-a-z/d/depressao" target="_blank" class="leia-mais">Leia mais →</a>
      </div>
    </div>

    <div class="artigo fade">
      <img src="https://images.unsplash.com/photo-1522205408450-add114ad53fe?auto=format&fit=crop&w=800&q=80" alt="Relacionamentos saudáveis">
      <div class="conteudo-artigo">
        <h3>Relacionamentos Saudáveis</h3>
        <p>Aprenda como o respeito, a confiança e o diálogo fortalecem laços e promovem relações mais leves e verdadeiras.</p>
        <a href="https://www.casadosaber.com.br/blog/relacionamento-saudavel-pilares-dicas-e-praticas-diarias#:~:text=O%20que%20%C3%A9%20um%20relacionamento,v%C3%ADnculo%20que%20sustenta%20as%20diferen%C3%A7as." target="_blank" class="leia-mais">Leia mais →</a>
      </div>
    </div>

    <div class="artigo fade">
      <img src="https://images.unsplash.com/photo-1531983412531-1f49a365ffed?auto=format&fit=crop&w=800&q=80" alt="Autoconhecimento">
      <div class="conteudo-artigo">
        <h3>Autoconhecimento e Propósito no Trabalho</h3>
        <p>Explore como conhecer a si mesmo — seus valores, forças e paixões — pode revelar seu propósito e tornar o trabalho uma fonte de felicidade.</p>
        <a href="https://talentosconsultoria.com.br/dicas/como-autoconhecimento-e-proposito-estao-relacionados-com-felicidade-no-trabalho/" target="_blank" class="leia-mais">Leia mais →</a>
      </div>
    </div>

    <div class="artigo fade">
      <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=800&q=80" alt="Sono e saúde mental">
      <div class="conteudo-artigo">
        <h3>Sono e Saúde Mental</h3>
        <p>Entenda como a qualidade do sono influencia o equilíbrio emocional e por que a insônia pode ser um sinal de alerta para a saúde mental.</p>
        <a href="https://www.saude.ce.gov.br/2023/03/16/sono-e-saude-mental-insonia-pode-ser-indicio-de-algum-transtorno-psiquiatrico/#:~:text=Uma%20boa%20noite%20de%20sono,um%20desafio%20para%20muitas%20pessoas." target="_blank" class="leia-mais">Leia mais →</a>
      </div>
    </div>

  </div>
  </section>

  <!-- ---------- CTA ---------- -->
  <section class="cta fade">
    <h2>Cuide da sua mente</h2>
    <p>Encontre conteúdos confiáveis sobre saúde mental no site oficial do Governo Federal.</p>
    <a href="https://www.gov.br/saude/pt-br" target="_blank">Leia mais artigos em gov.br</a>
  </section>

  <!-- ---------- FOOTER ---------- -->
  <footer>
    © 2025 LUCEM — Todos os direitos reservados.
  </footer>

  <!-- ---------- SCRIPT DE ANIMAÇÃO ---------- -->
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
</body>
</html>
