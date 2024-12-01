<?php
include "../../base/ch_pages.php";
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(200deg, #011231, #3184d1);
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }

    .login-box {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 50px 40px;
        border-radius: 15px;
        box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.2);
        max-width: 800px;
        width: 100%;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    h2 {
        margin-bottom: 30px;
        color: #333;
        font-size: 28px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .input-group {
        margin-bottom: 30px;
        text-align: left;
    }

    .input-group label {
        display: block;
        margin-bottom: 10px;
        font-size: 14px;
        color: #555;
    }

    .input-group input[type="text"],
    .input-group input[type="email"],
    .input-group input[type="password"],
    .input-group>select {
        width: 100%;
        padding: 12px;
        border: 2px solid #ddd;
        border-radius: 25px;
        font-size: 16px;
        background-color: #f7f7f7;
        transition: border 0.3s ease;
    }

    .input-group input[type="file"] {
        display: none;
        /* Esconde o input de arquivo */
    }

    .input-group input[type="email"]:focus,
    .input-group input[type="password"]:focus {
        border-color: #6e45e2;
        background-color: #fff;
        outline: none;
    }

    .input-group input[type="submit"] {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 25px;
        background-color: #202e9c;
        color: white;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .input-group input[type="submit"]:hover {
        background-color: #011231;
    }

    .forgot-password {
        margin-top: 15px;
        font-size: 14px;
    }

    .forgot-password a {
        text-decoration: none;
        color: #030f55;
        transition: color 0.3s;
    }

    .forgot-password a:hover {
        color: #1f3299;
    }

    /* Estilo para a div de perfil com imagem */
    .input-perfil {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 10px auto;
        overflow: hidden;
        background-image: url('../../img/semfoto.png');
        /* Imagem padrão */
        background-size: cover;
        background-position: center;
        cursor: pointer;
        position: relative;
        border: 2px solid #ddd;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .input-perfil:hover {
        border-color: #6e45e2;
    }

    .input-perfil input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
</style>

<link rel="shortcut icon" href="../../img/logo/logo-figure_colorida.png" type="image/x-icon">

<div class="login-container">
    <div class="login-box">
        <form action="cadastro_process_adm.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="nivel_acesso" value="ADMINISTRADOR">

            <!-- Div de upload personalizada -->
            <div class="input-perfil" id="input-perfil">
                <input type="file" name="foto" id="foto" accept="image/*" onchange="mostrarImagem(this)">
            </div>

            <div class="input-group">
                <label for="nome">Nome completo</label>
                <input type="text" name="nome" placeholder="Digite seu nome aqui." required>
            </div>
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Digite seu e-mail aqui." required>
            </div>
            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" placeholder="Digite sua senha aqui." required>
            </div>

            <div class="input-group"><input type="submit" value="Registrar"></div>
        </form>
    </div>
</div>

<script>
    function mostrarImagem(input) {
        // Verifica se o usuário selecionou um arquivo
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            // Quando o arquivo for carregado
            reader.onload = function(e) {
                // Define o background da div com a imagem selecionada
                document.getElementById('input-perfil').style.backgroundImage = 'url(' + e.target.result + ')';
            }

            // Lê o arquivo como uma URL de dados
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>