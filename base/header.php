<?php
session_start(); // Inicie a sessão para acessar as variáveis de sessão
include "base/ch_pages.php";
// Exemplo de verificação de login
// Verifique se a sessão 'user_id' (ou outra informação) está definida
if (isset($_SESSION['nome'])) {
    // O usuário está logado, exiba o botão de perfil
    $headerDashButton = '<a href="?page=dash_relatorio" class="cta-list">Minha área</a>';
    $headerButton = '<a href="?page=home-perfil" class="cta-invertido">Perfil</a>';
} else {
    // O usuário não está logado, exiba o botão de login
    $headerDashButton = '<a href="?page=opc_cadastro" class="cta-list" style="text-decoration: none">Cadastre-se</a>';
    $headerButton = '<a href="?page=login"  class="cta-invertido" style="text-decoration: none">Login</a>';
}
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/logo/logo-figure_colorida.png" type="image/x-icon">
</head>

<body>

    <style>
        header {
            width: 100%;
            height: 100px;
            padding: 10px 100px;

            display: flex;
            justify-content: space-between;
            align-items: center;

            background-color: #BAE2E8;
        }

        .fig_logo {
            height: 100%;
            display: flex;
            align-items: center;
        }

        header>nav {
            width: 30%;
            height: 100%;
            align-items: center;
            display: flex;    
        }
        
        header>nav>ul {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-around;
        }


        header>nav>ul>.cta-list {
            width: 150px;
            height: 40px;

            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            transition: 0.5s;
        }

        header>nav>ul>li {
            list-style: none;
            color: var(--c04);
            margin: 5px;
            transition: 0.5s;
            font-family: var(--f02);
            font-size: 1em;
        }

        header>nav>ul>.cta-list:hover {
            text-decoration: underline;
        }
    </style>

    <header>
        <a href="?page=home">
            <figure class="fig_logo">
                <img src="img/logo/logo-texto_preta.png" alt="Logo_TecnoInfo">
            </figure>
        </a>

        <nav>
            <ul>
                <li><?php echo $headerDashButton; ?></li>
                <li><?php echo $headerButton; ?></li>
            </ul>
        </nav>
    </header>