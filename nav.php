<header>
    <div class="logo">🌞 LUCEM</div>

  <nav>
    <ul class="menu-principal">
        <li><a href="index.php">Sobre</a></li>

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
            <li><a href="cadastro.php" style="color:#d9534f;">Criar Conta</a></li>
            <li><a href="login.php" style="color:#d9534f;">Fazer Login</a></li>
            <li><a href="login.psicologo.php" style="color:#d9534f;">Login Psicólogo</a></li>
            <li><a href="cadastrar_psicologo.php" style="color:#d9534f;">Cadastro Psicólogo</a></li>
        <?php endif; ?>

        <!-- ENGENHARIA AQUI -->
        <li><a href="configuracoes.php" class="config-icon">⚙️</a></li>
    </ul>
</nav>
</header>
