<?php 
// Certifique-se de que não há espaços em branco antes desta linha
ob_start();
?>
<link rel="stylesheet" href="../css/style.css">
<link rel="shortcut icon" href="../img/logo/logo-figure_colorida.png" type="image/x-icon">

<style>
    /* Estilos para a sidebar */
    .sidebar {
        width: 250px; /* Largura da sidebar */
        background-color: #19234E; /* Cor de fundo */
        position: fixed; /* Fixa na lateral */
        top: 0; /* Fixa no topo */
        left: -250px; /* Começa fora da tela */
        height: 100%; /* Ocupa a altura total da tela */
        transition: left 0.3s; /* Animação suave para a transição */
        z-index: 1000; /* Fica acima de outros elementos */
    }

    .sidebar.open {
        left: 0; /* Abre a sidebar */
    }

    .sidebar ul {
        list-style-type: none; /* Remove os marcadores da lista */
        padding: 0; /* Remove o padding */
    }

    .logo {
        text-decoration: none;
        display: flex;
        color: #fff;
        padding: 0 0 20px 20px;
        align-items: center;
        border-bottom: 1px solid gray;
        width: 100%;
        margin: 0 auto;
    }

    .logo > img {
        width: 40px;
        height: 40px;
        margin: 0 10px 0 0px;
    }

    .nome {
        font-size: 1.2em;
    }

    .logo > .a > h2 {
        color: #fff;
        font-size: 1em;
        font-weight: 500;
    }

    /* Estilos para o botão de toggle */
    #toggleButton {
        position: fixed;
        top: 29px; /* Distância do topo */
        left: 5px; /* Distância da esquerda */
        z-index: 1001; /* Fica acima da sidebar */
        border-radius: 50%; /* Faz o botão ser circular */
        padding: 10px 10px 5px 10px; /* Adiciona um pouco de espaço interno */
        background-color: #19234E; /* Cor de fundo do botão de fechar */
        color: white; /* Cor do texto */
        border: none; /* Remove a borda */
        cursor: pointer; /* Cursor de ponteiro ao passar sobre o botão */
        display: flex;
        align-items: center;
        justify-content: center; /* Centraliza o ícone no botão */
        transition-delay: 2s;
        opacity: 0%;
    }

    /* Oculta o botão quando a sidebar está aberta */
    #toggleButton.hidden {
        opacity: 0; /* Torna o botão invisível */
        pointer-events: none; /* Desabilita os eventos do mouse */
    }

    /* Estilo para o corpo quando a sidebar está fechada */
    .fullscreen {
        margin-left: 0; /* Remove margem quando em tela cheia */
        padding-left: 0; /* Remove padding quando em tela cheia */
    }

    /* Estilo do botão "Fechar" */
    .closeButton {
        background-color: #19234E; /* Cor de fundo do botão de fechar */
        border: none; /* Remove a borda */
        cursor: pointer; /* Cursor de ponteiro ao passar sobre o botão */
        padding: 10px 10px 5px 10px; /* Adiciona um pouco de espaço interno */
        margin: 10px 0 0 255px; /* Margem ao redor do botão */
        border-radius: 50%; /* Bordas arredondadas */
        position: absolute;
    }

    /* Ícone do botão */
    .icon {
        width: 20px; /* Tamanho do ícone */
        height: 20px; /* Tamanho do ícone */
    }
</style>

<button id="toggleButton">
    <img src="../img/icons/menu.png" width="1px" alt="Menu" class="icon">
</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <button class="closeButton" id="closeButton">
        <img src="../img/icons/menu.png" width="10px" alt="">
    </button> <!-- Botão para fechar a sidebar -->
    <a href="../home.php" class="logo">
        <img src="../img/logo/logo-figure_colorida.png" alt="">
        <div class="a">
            <h2>
                <span class="nome">TecnoInfo</span> <br>
                Capacitando Futuros.
            </h2>
        </div>
    </a>

    <ul>
        <li>
            <a href="../index.php">
                <img src="../img/icons/inicio.png" alt="início" class="icon">Início
            </a>
        </li>
        <li>
            <a href="?page=perfil" class="<?= ($_GET['page'] == 'perfil') ? 'active' : ''; ?>">
                <img src="../img/icons/adm.png" alt="aluno" class="icon">Meu perfil
            </a>
        </li>
        <li>
            <a href="?page=relatorio" class="<?= ($_GET['page'] == 'relatorio') ? 'active' : ''; ?>">
                <img src="../img/icons/relatorio.png" alt="aula" class="icon"> Visão Geral
            </a>
        </li>
   
        <li>
            <a href="?page=listarTurma" class="<?= ($_GET['page'] == 'listarTurma') ? 'active' : ''; ?>">
                <img src="../img/icons/turma.png" alt="turma" class="icon">Turmas
            </a>
        </li>
        <li>
            <a href="?page=listarTutor" class="<?= ($_GET['page'] == 'listarTutor') ? 'active' : ''; ?>">
                <img src="../img/icons/professor.png" alt="Tutores" class="icon">Tutores
            </a>
        </li>
        <li>
            <a href="?page=listarPlano" class="<?= ($_GET['page'] == 'listarPlano') ? 'active' : ''; ?>">
                <img src="../img/icons/plano.png" alt="Tutores" class="icon">Plano
            </a>
        </li>
        <li>
            <a href="../processos/login/logout.php">Sair</a>
        </li>
    </ul>
</div>

<script>
    const toggleButton = document.getElementById('toggleButton');
    const sidebar = document.getElementById('sidebar');
    const body = document.body;
    const closeButton = document.getElementById('closeButton');

    // Recupera o estado da sidebar do localStorage
    if (localStorage.getItem('sidebarOpen') === 'true') {
        sidebar.classList.add('open');
        body.classList.add('fullscreen');
        toggleButton.classList.add('hidden');
    }

    toggleButton.addEventListener('click', () => {
        const isOpen = sidebar.classList.toggle('open');
        body.classList.toggle('fullscreen', isOpen);
        toggleButton.classList.toggle('hidden', isOpen);

        // Atualiza o estado da sidebar no localStorage
        localStorage.setItem('sidebarOpen', isOpen);
    });

    closeButton.addEventListener('click', () => {
        sidebar.classList.remove('open');
        body.classList.remove('fullscreen');
        toggleButton.classList.remove('hidden');

        // Atualiza o estado da sidebar no localStorage
        localStorage.setItem('sidebarOpen', 'false');
    });
</script>
