    <?php
    $mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Senha com hash
        $autenticidade = $_POST['autenticidade'];

        $mysqli->query("INSERT INTO tutor(nome, cpf, email, senha, autenticidade) VALUES ('$nome', '$cpf', '$email', '$senha', '$autenticidade')");

        if (mysqli_query($conn, $sql)) {
            echo "Novo registro criado com sucesso";
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Verifica se há um arquivo de foto
        $foto = NULL;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $fotoNome = $_FILES['foto']['name'];
            $fotoTmp = $_FILES['foto']['tmp_name'];
            $extensao = pathinfo($fotoNome, PATHINFO_EXTENSION);

            // Define o caminho para salvar a foto
            $fotoNovoNome = uniqid() . '.' . $extensao;
            $fotoDestino = '../../img/user/' . $fotoNovoNome;

            // Mover o arquivo para o diretório 'uploads'
            if (move_uploaded_file($fotoTmp, $fotoDestino)) {
                $foto = $fotoDestino;
            }
        }
    }
    ?>


    <style>
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
        .input-group input[type="file"],
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
            width: 100%;
            border: none;
            outline: none;
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

        /* Extra visual enhancements */
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

        /* Estilo para a div de perfil com imagem */
        .input-perfil {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin: 0 100px 10px auto;
            overflow: hidden;
            background-image: url('../img/semfoto.png');
            /* Imagem padrão */
            background-size: cover;
            background-position: center;
            cursor: pointer;
            position: relative;
            float: right;
            border: 2px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .input-perfil:hover {
            border: 2px solid #6e45e2;
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

        .btn-add {
            text-align: center;
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            color: white;
            background-color: #19234E;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-add:hover {
            background-color: #0D579C;
        }
    </style>
    <h1>Adicionar Tutor</h1>

    <form action="?page=inserirTutor" method="post" enctype="multipart/form-data">
        <input type="hidden" name="nivel_acesso" value="TUTOR">
        <input type="hidden" name="autenticidade" value="NÃO">

        <!-- Div de upload personalizada -->
        <div class="input-perfil" id="input-perfil">
            <input type="file" name="foto" id="foto" accept="image/*" onchange="mostrarImagem(this)">
        </div>

        <div class="input-group" style="width:60%">
            <label for="nome">Nome completo</label>
            <input type="text" name="nome" placeholder="Digite seu nome aqui." required>
        </div>

        <div class="input-group" style="width:60%">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" maxlength="14" oninput="mascaraCPF(this)" placeholder="000.000.000-00" required>
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
        <button onclick="window.history.back()" style="background-color: #19234E; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
    Voltar
</button>

    </form>

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

    <script>
        function mascaraCPF(input) {
            let cpf = input.value;

            // Remove todos os caracteres não numéricos
            cpf = cpf.replace(/\D/g, '');

            // Formata o CPF
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Primeiro ponto
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Segundo ponto
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Traço

            input.value = cpf;
        }
    </script>

<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

// Verifique se a conexão foi bem-sucedida
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Senha com hash
    $autenticidade = $_POST['autenticidade'];

    // Consulta preparada para evitar SQL Injection
    $stmt = $mysqli->prepare("INSERT INTO tutor (nome, cpf, email, senha, autenticidade) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $cpf, $email, $senha, $autenticidade);

    if ($stmt->execute()) {
        echo "Novo tutor registrado com sucesso.";
    } else {
        echo "Erro ao registrar o tutor: " . $stmt->error;
    }

    // Verifica se há um arquivo de foto
    $foto = NULL;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoNome = $_FILES['foto']['name'];
        $fotoTmp = $_FILES['foto']['tmp_name'];
        $extensao = pathinfo($fotoNome, PATHINFO_EXTENSION);

        // Define o caminho para salvar a foto
        $fotoNovoNome = uniqid() . '.' . $extensao;
        $fotoDestino = '../../img/user/' . $fotoNovoNome;

        // Mover o arquivo para o diretório 'uploads'
        if (move_uploaded_file($fotoTmp, $fotoDestino)) {
            $foto = $fotoDestino;
        }
    }

    // Fechar a declaração preparada
    $stmt->close();
}
?>
