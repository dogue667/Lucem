<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Página de Emoções — CSS Elaborado</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Playfair+Display:wght@600&display=swap" rel="stylesheet">

  <style>
    :root{
        --bg-1: #4f46e5;
        --bg-2: #06b6d4;
        --card-bg: rgba(255,255,255,0.15);
        --glass-border: rgba(255,255,255,0.35);
        --text: #ffffff;
        --neon: #7cf4ff;
    }

    *{box-sizing:border-box;margin:0;padding:0}
    html,body{height:100%}

    body{
        font-family: "Inter", system-ui;
        background: linear-gradient(135deg, var(--bg-1), var(--bg-2));
        display:flex;
        align-items:center;
        justify-content:center;
        padding:2rem;
        color:var(--text);
        overflow:hidden;
        animation: rainbowFlash 0.5s infinite;
    }

    @keyframes rainbowFlash {
      0% { background: red; }
      16% { background: orange; }
      33% { background: yellow; }
      50% { background: green; }
      66% { background: blue; }
      83% { background: indigo; }
      100% { background: violet; }
    }

    .page-card {
        width: min(950px, 95%);
        background: var(--card-bg);
        border-radius:18px;
        padding:3rem 3.5rem;
        backdrop-filter: blur(18px) saturate(180%);
        border:1.5px solid var(--glass-border);
        box-shadow: 0 20px 40px rgba(0,0,0,0.35);
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        position: relative;
        z-index: 5;
    }

    h1{
        font-size: clamp(2.2rem, 6vw, 4rem);
        font-weight:800;
        letter-spacing:2px;
        text-shadow: 0 0 12px var(--neon);
        animation: spin 4s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .meme {
      position: absolute;
      width: 150px;
      height: auto;
      animation: floaty 6s infinite ease-in-out;
      filter: drop-shadow(0 0 10px #000);
      z-index: 1;
    }
.meme {
  position: absolute;
  width: 150px;
  height: auto;
  animation: floaty 6s infinite ease-in-out;
  filter: drop-shadow(0 0 10px #000);
  z-index: 1;
}

/* CANTO SUPERIOR ESQUERDO */
.m1 {
  top: 5%;
  left: 5%;
}

/* CANTO SUPERIOR DIREITO */
.m2 {
  top: 5%;
  right: 5%;
}

/* CANTO INFERIOR ESQUERDO */
.m3 {
  bottom: 5%;
  left: 5%;
}

/* CANTO INFERIOR DIREITO */
.m4 {
  bottom: 5%;
  right: 5%;
}

/* LATERAL ESQUERDA CENTRAL (ENTRE TOPO E FUNDO, BEM AFASTADO) */
.m5 {
  top: 50%;
  left: 2%;
  transform: translateY(-50%);
}

    @keyframes floaty {
      0% { transform: translateY(0); }
      50% { transform: translateY(-20px); }
      100% { transform: translateY(0); }
    }

  </style>
</head>

<body class="wf-fallback">

  <audio id="music" autoplay loop>
      <source src="SUA_MUSICA_AQUI.mp3" type="audio/mpeg">
  </audio>
  <img class="meme m1" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqoJFr1uPdWM4chI1mwOOWSAY1xSrLnqOJcg&s">
    <img class="meme m2" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSuaHNAmPDywsppYJ16z7v9nnBR2teG3E5RpA&s">
    <img class="meme m3" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSskvEwZ7G5_xC2uAWt4LOBIQRx7pm-B_NOYQ&s">
    <img class="meme m4" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTC_3eIIzogwsc1YBPmJbnMxGuaYx42eOh-NaThzfBRQNyZSaNOH3al5T1QIyqeoGKLytQ&usqp=CAU">
    <img class="meme m5" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxEZniv09qWG4hvtreZ5qGLnsOOVQ6y4Xjc6aT6sVkeez0HsbTCwwu3dF7ystonQAJKNY&usqp=CAU">

  <main class="page-card">
    <h1>SE VC DEU A BUNDINHA PARA MIM,SORRIA</h1>

  </main>

  <script>
      document.addEventListener("click", () => {
          const audio = document.getElementById("music");
          if (audio.paused) audio.play();
      });
  </script>

</body>
</html>
