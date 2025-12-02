<?php
session_start();

// Bloqueia acesso sem estar logado
if (!isset($_SESSION['psicologo_id']) && !isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$nome = $_GET['nome'] ?? "Paciente";
$id = $_GET['id'] ?? 0;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>LUCEM — Ligação com <?= htmlspecialchars($nome) ?></title>
<link rel="stylesheet" href="nav.css">
<link rel="stylesheet" href="darkmode.css">

<style>
/* ======= ESTILO GERAL LUCEM ======= */
body {
    background: var(--bg, #fcefdc);
    font-family: 'Inter', sans-serif;
    color: var(--texto, #5b3a70);
    margin: 0;
    padding-top: 120px;
    text-align: center;
}

/* ======= VÍDEOS ======= */
video {
    width: 45%;
    max-width: 500px;
    border-radius: 16px;
    background: #000;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    margin: 10px;
}

/* ======= BOTÕES ======= */
.btn {
    background: #de8c78;
    padding: 14px 24px;
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    font-size: 1.1rem;
    transition: 0.3s;
}

.btn:hover {
    background: #c66f60;
    transform: scale(1.04);
}

/* ======= TÍTULO ======= */
h1 {
    font-size: 2.2rem;
    color: #c5745b;
    margin-bottom: 20px;
}
</style>
</head>
<body>

<!-------------- NAV ---------- -->
<?php include "nav.php"; ?>

<h1>Ligação com <?= htmlspecialchars($nome) ?></h1>

<video id="localVideo" autoplay playsinline></video>
<video id="remoteVideo" autoplay playsinline></video>

<br><br>
<button class="btn" onclick="iniciarLigacao()">📞 Iniciar Ligação</button>

<script>
let peer;
let localStream;

async function iniciarLigacao() {

    localStream = await navigator.mediaDevices.getUserMedia({
        video: true,
        audio: true
    });

    document.getElementById("localVideo").srcObject = localStream;

    peer = new RTCPeerConnection();

    localStream.getTracks().forEach(track => {
        peer.addTrack(track, localStream);
    });

    peer.ontrack = event => {
        document.getElementById("remoteVideo").srcObject = event.streams[0];
    };

    peer.onicecandidate = event => {
        if (event.candidate) {
            localStorage.setItem("ICE_<?= $id ?>", JSON.stringify(event.candidate));
        }
    };

    const offer = await peer.createOffer();
    await peer.setLocalDescription(offer);

    localStorage.setItem("OFFER_<?= $id ?>", JSON.stringify(offer));

    setInterval(async () => {
        let answerTxt = localStorage.getItem("ANSWER_<?= $id ?>");

        if (answerTxt) {
            let answer = JSON.parse(answerTxt);
            await peer.setRemoteDescription(new RTCSessionDescription(answer));
        }
    }, 1000);

    alert("Aguardando o outro lado entrar na sala...");
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
