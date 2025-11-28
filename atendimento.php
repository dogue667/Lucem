<<<<<<< HEAD
=======
<?php
session_start();
require "conexao.php";

// Verifica se o psicólogo está logado
if (!isset($_SESSION['ID_psicologo'])) {
    header("Location: login_psicologo.php");
    exit();
}

$id_psicologo = $_SESSION['ID_psicologo'];

// Buscar sessões agendadas do psicólogo
$sql = $conexao->prepare("
    SELECT Sessao.ID_sessao, Sessao.Data_sessao, Usuario.Nome_usuario
    FROM Sessao
    INNER JOIN Usuario ON Sessao.ID_usuario = Usuario.ID_usuario
    WHERE Sessao.ID_psicologo = ?
    ORDER BY Sessao.Data_sessao ASC
");
$sql->bind_param("i", $id_psicologo);
$sql->execute();
$resultado = $sql->get_result();
?>

>>>>>>> dae46c000c1437e266934e29e0a3bb2a7ea41a72
<!DOCTYPE html>
<html lang="pt-BR">

<head>
<<<<<<< HEAD
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Atendimento Psicológico - Lucem</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

    :root {
      --cor-fundo: #fcefdc;
      --cor-primaria: #de8c78;
      --cor-secundaria: #f4c29d;
      --cor-texto-escuro: #4a3026;
      --cor-texto-claro: #7c5b4a;
      --cor-input-fundo: #f9e6db;
      --cor-input-placeholder: #b78d7a;
      --cor-borda: #e8bfa9;
      --cor-depoimento-bg: #f7dfd5;
    }

    * {
      box-sizing: border-box;
    }
=======
<meta charset="UTF-8">
<title>Atendimento — LUCEM</title>
>>>>>>> dae46c000c1437e266934e29e0a3bb2a7ea41a72

<style>
    body {
<<<<<<< HEAD
      margin: 0;
      font-family: 'Inter', sans-serif;
      background-color: var(--cor-fundo);
      color: var(--cor-texto-escuro);
    }

    /* ============================
       MENU SUPERIOR
    =============================== */

    nav.menu {
      width: 100%;
      background-color: #fdebd3;
      padding: 0.9rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 2px solid #f4c29d;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .menu-left .logo {
      font-size: 1.6rem;
      font-weight: 700;
      color: #c5745b;
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }

    .menu-links {
      list-style: none;
      display: flex;
      gap: 1.6rem;
      margin: 0;
      padding: 0;
    }

    .menu-links li a {
      text-decoration: none;
      color: #7c5b4a;
      font-weight: 600;
      transition: 0.2s ease;
    }

    .menu-links li a:hover {
      color: #c5745b;
=======
        font-family: Arial, sans-serif;
        background: #f8f4ef;
        padding: 120px 20px 40px;
    }

    h2 {
        color: #4c2b72;
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.2em;
    }

    .tabela {
        width: 90%;
        max-width: 900px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-size: 1.1em;
    }

    th {
        background-color: #e7daf3;
        color: #4c2b72;
    }

    .btn-ligar {
        background-color: #7d46c2;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-ligar:hover {
        background-color: #5c2c96;
    }

    /* NAVBAR IGUAL AO SEU SITE */
    header {
        background-color: var(--menu, #fff);
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
        color: var(--roxo-escuro, #4c2b72);
        margin-right: 80px;
    }

    nav ul {
        list-style: none;
        display: flex;
        gap: 25px;
        margin: 0;
        padding: 0;
    }

    nav ul li a {
        text-decoration: none;
        color: var(--roxo-escuro, #4c2b72);
        padding: 10px 16px;
        border-radius: 10px;
        font-weight: 500;
        transition: 0.3s;
    }

    nav ul li a:hover {
        background-color: var(--hover, #e7daf3);
        color: var(--roxo, #7d46c2);
>>>>>>> dae46c000c1437e266934e29e0a3bb2a7ea41a72
    }
</style>

<<<<<<< HEAD
    .menu-links .sair {
      color: #d25555;
      font-weight: 700;
    }

    .menu-links .sair:hover {
      color: #b44242;
    }

    /* Responsivo menu */
    @media (max-width: 800px) {
      .menu-links {
        flex-wrap: wrap;
        gap: 0.8rem;
        justify-content: flex-end;
      }
    }

    /* ============================ */

    .container {
      max-width: 900px;
      margin: 2rem auto;
      padding: 1rem 2rem 3rem 2rem;
      background: #fff9f5;
      border-radius: 8px;
      box-shadow: 0 0 15px rgb(0 0 0 / 0.05);
    }

    header {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin-bottom: 2rem;
    }

    header .logo-sun {
      width: 30px;
      height: 30px;
      fill: var(--cor-primaria);
    }

    header h1 {
      font-weight: 600;
      font-size: 1.4rem;
      margin: 0;
      color: var(--cor-primaria);
      letter-spacing: 1px;
    }

    main h2 {
      color: var(--cor-primaria);
      margin-top: 0;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    section {
      margin-bottom: 2.5rem;
    }

    /* Formulário */
    form {
      background-color: var(--cor-input-fundo);
      padding: 1.5rem 1.8rem;
      border-radius: 6px;
      border: 1px solid var(--cor-borda);
    }

    form label {
      display: block;
      margin-bottom: 0.25rem;
      font-weight: 600;
      color: var(--cor-texto-claro);
    }

    form input[type="text"],
    form input[type="email"],
    form input[type="tel"],
    form input[type="date"],
    form input[type="time"] {
      width: 100%;
      padding: 0.5rem 0.75rem;
      margin-bottom: 1.25rem;
      border: 1.5px solid var(--cor-borda);
      border-radius: 6px;
      font-size: 1rem;
      font-family: 'Inter', sans-serif;
      color: var(--cor-texto-escuro);
      background-color: var(--cor-fundo);
      transition: border-color 0.3s ease;
    }

    form input::placeholder {
      color: var(--cor-input-placeholder);
    }

    form input:focus {
      outline: none;
      border-color: var(--cor-primaria);
      background-color: #fff;
    }

    form button {
      background-color: var(--cor-primaria);
      color: white;
      padding: 0.7rem 1.5rem;
      font-size: 1.1rem;
      font-weight: 600;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      display: block;
      margin-top: 0.5rem;
    }

    form button:hover {
      background-color: #c66f60;
    }

    /* Psicólogo */
    .psicologo {
      background-color: var(--cor-input-fundo);
      padding: 1.5rem 1.8rem;
      border-radius: 6px;
      border: 1px solid var(--cor-borda);
      display: flex;
      gap: 1.5rem;
      align-items: center;
    }

    .psicologo img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid var(--cor-primaria);
    }

    .psicologo-info {
      flex: 1;
    }

    .psicologo-info h3 {
      margin: 0 0 0.3rem 0;
      font-weight: 700;
      color: var(--cor-primaria);
      font-size: 1.3rem;
    }

    .psicologo-info p {
      margin: 0;
      color: var(--cor-texto-claro);
      font-size: 0.95rem;
      line-height: 1.3;
    }

    /* Depoimentos */
    .depoimentos {
      background-color: var(--cor-depoimento-bg);
      padding: 1.5rem 1.8rem;
      border-radius: 6px;
      border: 1px solid var(--cor-borda);
    }

    .depoimentos h2 {
      margin-top: 0;
    }

    .depoimento-item {
      margin-bottom: 1.5rem;
      border-left: 4px solid var(--cor-primaria);
      padding-left: 1rem;
      font-style: italic;
      color: var(--cor-texto-claro);
    }

    .depoimento-item:last-child {
      margin-bottom: 0;
    }

    .depoimento-autor {
      font-weight: 600;
      color: var(--cor-primaria);
      font-size: 0.95rem;
    }

    /* Contato */
    .contato {
      background-color: var(--cor-input-fundo);
      padding: 1.5rem 1.8rem;
      border-radius: 6px;
      border: 1px solid var(--cor-borda);
      color: var(--cor-texto-claro);
    }

    .contato a {
      color: var(--cor-primaria);
      font-weight: 600;
      text-decoration: none;
    }

    .contato a:hover {
      text-decoration: underline;
    }

  </style>
</head>
<body>

  <!-- MENU SUPERIOR ADICIONADO -->
  <nav class="menu">
    <div class="menu-left">
      <span class="logo">🦁 LUCEM</span>
    </div>

    <ul class="menu-links">
      <li><a href="#">Sobre</a></li>
      <li><a href="#">Registrar Emoções</a></li>
      <li><a href="#">Minhas Emoções</a></li>
      <li><a href="#">Atendimento Psicológico</a></li>
      <li><a href="#">Artigos</a></li>
      <li><a href="#">Exercícios & Metas</a></li>
      <li><a href="#" class="sair">Sair</a></li>
    </ul>
  </nav>

  <div class="container" role="main">

    <header>
      <svg class="logo-sun" viewBox="0 0 24 24"><circle cx="12" cy="12" r="5"/><g fill="var(--cor-primaria)">
          <circle cx="12" cy="12" r="5"/>
          <path d="M12 1v3M12 20v3M4.22 4.22l2.12 2.12M17.66 17.66l2.12 2.12M1 12h3M20 12h3M4.22 19.78l2.12-2.12M17.66 6.34l2.12-2.12"/>
        </g></svg>
      <h1>LUCEM</h1>
    </header>

    <section class="psicologo">
      <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=90&q=80" alt="Foto do psicólogo" />
      <div class="psicologo-info">
        <h3>Guilherme Silva, CRP 12345</h3>
        <p>Psicólogo clínico especializado em terapia cognitivo-comportamental...</p>
      </div>
    </section>

    <section>
      <h2>Agende sua consulta</h2>
      <form id="form-agendamento">
        <label>Nome completo</label>
        <input type="text" placeholder="Seu nome completo" required />

        <label>E-mail</label>
        <input type="email" placeholder="seuemail@exemplo.com" required />

        <label>Telefone</label>
        <input type="tel" placeholder="(99) 99999-9999" required />

        <label>Data desejada</label>
        <input type="date" id="data" required />

        <label>Hora desejada</label>
        <input type="time" required />

        <button type="submit">Enviar Agendamento</button>
      </form>
    </section>

    <section class="depoimentos">
      <h2>Depoimentos</h2>
      <article class="depoimento-item">
        <p>"O atendimento com o Guilherme mudou minha vida."</p>
        <p class="depoimento-autor">- Ana M.</p>
      </article>
      <article class="depoimento-item">
        <p>"Melhora significativa no bem-estar."</p>
        <p class="depoimento-autor">- João P.</p>
      </article>
    </section>

    <section class="contato">
      <h2>Contato</h2>
      <p>Telefone: <a href="tel:+5511999999999">(11) 99999-9999</a></p>
      <p>WhatsApp: <a href="https://wa.me/5511999999999" target="_blank">(11) 99999-9999</a></p>
      <p>E-mail: <a href="mailto:contato@lucem.com.br">contato@lucem.com.br</a></p>
    </section>

  </div>

  <script>
    const dataInput = document.getElementById('data');
    const hoje = new Date().toISOString().split('T')[0];
    dataInput.min = hoje;

    document.getElementById('form-agendamento').addEventListener('submit', function(e){
      e.preventDefault();
      alert('Agendamento enviado com sucesso!');
      this.reset();
    });
  </script>
=======
<script>
function ligar(nome) {
    alert("📞 Iniciando ligação com " + nome + "... (simulação)");
}
</script>

</head>
<body>

<header>
    <div class="logo">LUCEM</div>
    <nav>
        <ul>
            <li><a href="painel_psicologo.php">Início</a></li>
            <li><a href="atendimento.php">Atendimentos</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </nav>
</header>

<h2>Atendimentos Agendados</h2>

<div class="tabela">
<table>
    <tr>
        <th>Paciente</th>
        <th>Horário</th>
        <th>Ação</th>
    </tr>

    <?php while($row = $resultado->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['Nome_usuario']) ?></td>

        <td>
            <?= date("d/m/Y H:i", strtotime($row['Data_sessao'])) ?>
        </td>

        <td>
            <button class="btn-ligar" onclick="ligar('<?= $row['Nome_usuario'] ?>')">
                Ligar
            </button>
        </td>
    </tr>
    <?php endwhile; ?>

</table>
</div>
>>>>>>> dae46c000c1437e266934e29e0a3bb2a7ea41a72
 
</body>
</html>
