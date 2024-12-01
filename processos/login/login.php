<?php
    include "../../base/ch_pages.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
    <link rel="shortcut icon" href="../../img/logo/logo-figure_colorida.png" type="image/x-icon">
</head>

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
        background: linear-gradient(165deg, #3184d1, #011231);
    }

    #voltar {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 10px;
    }

    #voltar>img {
        width: 100%;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        max-width: 900px;
        height: 100%;
    }

    .welcome-box {
        width: 40%;
        padding: 50px;
        background-color: rgba(0, 123, 255, 0.8);
        color: white;
        text-align: center;
        border-radius: 15px 0 0 15px;
        box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.2);
    }

    .welcome-box h2 {
        font-size: 36px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .welcome-box p {
        font-size: 18px;
        line-height: 1.6;
    }

    .login-box {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 50px 40px;
        border-radius: 15px;
        box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.2);
        width: 50%;
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
    .input-group input[type="password"] {
        width: 100%;
        padding: 12px;
        border: 2px solid #ddd;
        border-radius: 25px;
        font-size: 16px;
        background-color: #f7f7f7;
        transition: border 0.3s ease;
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

    .login-box::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(110, 69, 226, 0.15);
        border-radius: 50%;
        z-index: 0;
    }

    .login-box::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        background: rgba(136, 211, 206, 0.15);
        border-radius: 50%;
        z-index: 0;
    }

    .login-box form {
        position: relative;
        z-index: 1;
    }

    .input-senha {
        margin: -20px 0 10px 5px;
        float: left;
    }
</style>

<body>
<a href="?page=index" id="voltar"><img src="../../img/icons/Voltar.png" alt=""></a>
    <div class="container">
        <div class="welcome-box">
            <h2 style="color:white;">Bem-vindo de volta!</h2>
            <p>Bem-vindo de volta! Estamos prontos para continuar sua jornada. A cada login, você está mais perto de dominar o que realmente importa!</p>
        </div>

        <div class="login-box">
            <h2>Login</h2>
            <form action="login_process.php" method="post">
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" placeholder="Senha" required>
                </div>

                <div class="input-senha">
                    <input type="checkbox" id="show-password-checkbox" onclick="togglePasswordVisibility()">
                    <label for="show-password-checkbox">Mostrar senhas</label>
                </div>

                <div class="input-group">
                    <input type="submit" value="Entrar">
                </div>

                <div class="forgot-password">
                    <a href="#">Esqueceu sua senha?</a>
                </div>

                <div class="forgot-password">
                    Ainda não possui sua conta? <a href="?page=opc_cadastro">Cadastre-se agora!</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const senhaInput = document.getElementById('senha');
            const checkbox = document.getElementById('show-password-checkbox');

            if (checkbox.checked) {
                senhaInput.type = "text";
            } else {
                senhaInput.type = "password";
            }
        }
    </script>
</body>

</html>
