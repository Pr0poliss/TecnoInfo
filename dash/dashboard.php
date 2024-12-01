<?php
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Função para renderizar a sidebar com base no nível de acesso
function renderSidebar($nivel_acesso)
{
    switch ($nivel_acesso) {
        case 'ADMINISTRADOR':
            include '../base/sidebar_ADM.php'; // Sidebar para Administrador
            break;
        case 'ALUNO':
            include '../base/sidebar_ALU.php'; // Sidebar para Aluno
            break;
        case 'UNIDADE_ENSINO':
            include '../base/sidebar_UE.php'; // Sidebar para Unidade de Ensino
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../img/logo/logo-figure_colorida.png" type="image/x-icon">
</head>
<link rel="stylesheet" href="../css/style.css">

<style>
    @charset "UTF-8";

    /* Importação de fontes */
    @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap');
    /* Importação da font Sparta */
    @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');
    /* Importação da font Nunito */

    /* Cadastro de cores e fontes */
    :root {
        --c01: #1C2321;
        /*  Preto               */
        --c02: #fff;
        /*  Branco              */
        --c03: #0060B8;
        /*  Azul-logo           */
        --c04: #0D579C;
        /*  Quebra-azul-logo    */
        --c05: #ffffff7e;
        /*  Branco 50%          */

        --f01: "Nunito", sans-serif;
        --f02: "League Spartan", sans-serif;
    }
    body{
        font-family: var(--f01);
    }
    /* Estilo do conteúdo principal */
    main {
        min-height: 100vh; /* Garantir que o main ocupe toda a altura da tela */
        width: 100%;
        margin-left: 220px; /* Padrão: margem para a sidebar aberta */
        padding: 50px 100px;
        transition: all 0.3s ease; /* Transição suave para a centralização */
    }

    .main-centered {
        margin-left: 0; /* Remove a margem quando a sidebar está fechada */
        padding: 50px 0;
        display: flex;
        justify-content: center; /* Centraliza o conteúdo horizontalmente */
        align-items: center; /* Centraliza verticalmente */
    }

    .line {
        width: 50%;
        height: 2px;
        background-color: #19234E;
        border: none;
    }

    .titulo-container {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
        font-family: Arial, sans-serif;
        color: #19234E;
    }

    .boas-vindas {
        display: flex;
        justify-content: end;
    }

    #voltar{
        background-color: #19234E;
    }

    #voltar:hover{
        background-color: #0D579C;

    }

    .search {
        display: flex;
        border: 2px solid gray;
        width: 350px;
        background: #fff;
        border-radius: 20px;
        height: 40px;
        align-items: center;
    }

    .search>input {
        padding-left: 10px;
        background-color: transparent;
        border: none;
        outline: none;
        width: 90%;
    }

    .search>.hr {
        width: 1px;
        height: 70%;
        background-color: gray;
    }

    .search>button {
        margin: 0 5px;
        background-color: transparent;
        border-radius: 0 20px 20px 0;
        cursor: pointer;
    }

    .sidebar {
        border-radius: none;
    }

    .dash-content {
        width: 100%;
    }

    .fullscreen {
        margin-left: 0;
        /* Remove margem quando em tela cheia */
        padding-left: 0;
        /* Remove padding quando em tela cheia */
    }

    .flex{
        display: flex;
    }

    .ponta-ponta{
        justify-content: space-between;
    }

    .centro-y{
        align-items: center;
    }

    .mt-1{
        margin-top: 10px;
    }

    .right {
        float: right
    }
</style>


<body>
    <div class="container">
        <nav class="sidebar" style="position: fixed; border-radius: none;">
            <?php renderSidebar($_SESSION['nivel_acesso']); ?>
        </nav>
        <main>
            <div class="boas-vindas">
    
                <div class="search">
                    <input type="search" name="buscar" id="buscar" placeholder="Buscar...">
                    <div class="hr"></div>
                    <button><img src="../img/icons/search.png"></button>
                </div>
            </div>
            <div class="dash-content fullscreen">
                <?php include "../base/ch_pages.php"; ?>
            </div>
        </main>
    </div>
</body>

</html>
