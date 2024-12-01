<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $tel = $_POST['tel'];
      $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Senha com hash
 
    $mysqli->query("INSERT INTO responsavel(nome, tel, email, senha) VALUES ('$nome', '$tel','$email', '$senha')");

    if (mysqli_query($conn, $sql)) {
        echo "Novo registro criado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>


<style>
    @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');


    :root {
        --c01: #1C2321;
        --c02: #fff;
        --c03: #0D579C;

        --f01: "Nunito", system-ui;
        --f02: "League Spartan", system-ui;
        --f03: "Rubik", sans-serif;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: var(--f03);
        background: linear-gradient(200deg, #011231, #3184d1);
        background-repeat: no-repeat;
        background-size: cover;
    }

    .login-box {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 50px 40px;
        border-radius: 15px;
        box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.2);
        max-width: 900px;
        width: 100%;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    form {
        display: flex;
        flex-wrap: wrap;
        margin-top: 50px;
        justify-content: space-between;
    }

    h1 {
        margin-bottom: 10px;
        color: var(--c01);
        font-size: 28px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .input-group {
        width: 45%;
        /* margin-right: 10px; */
        margin-bottom: 20px;
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
    .input-group input[type="number"],
    .input-group>select {
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

    .input-group button[type="button"],
    .input-group button[type="submit"] {
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

    .input-group button[type="button"]:hover,
    .input-group button[type="submit"]:hover {
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
</style>

<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Cadastro de responsável da unidade</h1>
            <form action="inserirResp2.php" method="post">
                <div class="input-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" placeholder="Digite aqui." required>
                </div>
                <div class="input-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" placeholder="Digite aqui." required>
                </div>
                <div class="input-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="tel" placeholder="Digite aqui." required>
                </div>
                <div class="input-group">
                    <label for="cpf">CPF</label>
                    <input type="number" maxlength="11" minlength="11" name="cep" placeholder="Digite aqui." required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha-input" placeholder="********" required>
                </div>
                <div class="input-group">
                    <label for="confirmar-senha">Confirmar senha</label>
                    <input type="password" name="confirmar-senha" id="confirmar-senha-input" placeholder="********"
                        required>
                </div>
                <a class="input-group">
                   
                    <button type="submit" class="btn-add">Salvar</button>
                </a>
                <div>
                    <input type="checkbox" id="show-password-checkbox" onclick="togglePasswordVisibility()">
                    <label for="show-password-checkbox">Mostrar senhas</label>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const senhaInput = document.getElementById('senha-input');
            const confirmarSenhaInput = document.getElementById('confirmar-senha-input');
            const checkbox = document.getElementById('show-password-checkbox');

            if (checkbox.checked) {
                senhaInput.type = "text";
                confirmarSenhaInput.type = "text";
            } else {
                senhaInput.type = "password";
                confirmarSenhaInput.type = "password";
            }
            document.getElementById('show-password-checkbox').addEventListener('click', togglePasswordVisibility);
        }
    </script>
</body>

</html>