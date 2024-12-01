<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $mysqli->query("INSERT INTO administrador(nome, email, senha) VALUES ('$nome', '$email', '$senha')");

    if (mysqli_query($conn, $sql)) {
        echo "Novo registro criado com sucesso";
        echo "<script> setTimeout(function() {window.location.href = '?page=listarAdm';}, 1); // redireciona após 3 segundos</script>";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>

<style>
    h2 {
        margin-bottom: 20px;
    }

    form {
        max-width: 80%;
        margin: auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="number"] {
        width: 90%;
        padding: 10px;
        margin: 0 auto 15px auto;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    input[type="number"]:focus {
        border-color: #4CAF50;
    }

    button[type="submit"] {
        width: 50%;
        padding: 10px;
        background-color: #19234E;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0D579C;
    }

    .btn-add {
        text-align: center;
        display: inline-block;
        margin-top: 15px;
        padding: 10px 20px;
        color: white;
        background-color: #4CAF50;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn-add:hover {
        background-color: #45a049;
    }

    /* Estilo para a div de perfil com imagem */
    .input-perfil {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 10px auto;
        overflow: hidden;
        background-image: url('../../img/user/semfoto.png');
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
<h1 style="text-align: center;">Adicionar Administrador</h1>
<form action="?page=inserirAdm" method="POST">
    <input type="hidden" name="nivel_acesso" value="ADMINISTRADOR">

    <p>Foto:</p>
    <div class="input-perfil" id="input-perfil">
        <input type="file" name="foto" id="foto" accept="image/*" onchange="mostrarImagem(this)">
    </div>

    <label>Nome:</label>
    <input type="text" name="nome" required>

    <label>Email:</label>
    <input type="text" name="email" required>

    <label>Senha:</label>
    <input type="password" name="senha" required> 
    
    <center><button type="submit" class="btn-add">Salvar</button></center>

</form>

<a class="btn btn-primary btn-sm" style="background-color: #19234E; text-decoration:none; color:white; padding:10px; width:70px; float:left; margin-top:40px; text-align:center; font-size:1.3em; border-radius:10px;" href="?page=listarAdm"> Voltar </a>
</body>
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

</html>