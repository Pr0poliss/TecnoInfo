<?php
// Conexão com o banco de dados
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

// Verifica se houve erro na conexão
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $nivel_acesso = $mysqli->real_escape_string($_POST['nivel_acesso']);
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Criptografa a senha

    // Manipulação da imagem de perfil (se houver)
    $foto = null;
    if (!empty($_FILES['foto']['name'])) {
        $diretorio = '../../img/user/';
        $nomeArquivo = uniqid() . '_' . basename($_FILES['foto']['name']);
        $caminhoCompleto = $diretorio . $nomeArquivo;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminhoCompleto)) {
            $foto = $nomeArquivo;
        } else {
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    }

    // Insira primeiro na tabela 'usuarios'
$sqlUsuario = "INSERT INTO usuarios (nome, email, nivel_acesso) VALUES ('$nome', '$email', '$nivel_acesso')";
if ($mysqli->query($sqlUsuario)) {
    $idUsu = $mysqli->insert_id; // Captura o ID gerado automaticamente
} else {
    die("Erro ao inserir usuário: " . $mysqli->error);
}

$sqlAdmin = "INSERT INTO administrador (idUsu, nome, email, senha, foto) VALUES ('$idUsu', '$nome', '$email', '$senha', '$foto')";
if ($mysqli->query($sqlAdmin)) {
    echo "<script> setTimeout(function() {window.location.href = '?page=listarAdm';}, 1); // redireciona após 3 segundos</script>";
    exit;
} else {
    die("Erro ao inserir administrador: " . $mysqli->error);
}


    // Executa a query e verifica o resultado
    if ($mysqli->query($sql)) {
        echo "<script> setTimeout(function() {window.location.href = '?page=listarAdm';}, 1); // redireciona após 3 segundos</script>";
    } else {
        echo "Erro: " . $mysqli->error;
    }
}

// Fecha a conexão com o banco de dados
$mysqli->close();
?>