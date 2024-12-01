<?php
include "../../base/ch_pages.php";
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "tecnoinfo");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $nivel_acesso = $_POST["nivel_acesso"];  // ALUNO ou UE


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

    // Insere na tabela `usuarios`
    $sql_usuario = "INSERT INTO usuarios (nome, email, senha, foto, nivel_acesso) VALUES ('$nome', '$email', '$senha', '$foto', '$nivel_acesso')";

    if ($conn->query($sql_usuario) === TRUE) {
        // Pega o último ID inserido (id do usuário)
        $usuario_id = $conn->insert_id;

        // Verifica o tipo de usuário e insere na tabela correspondente
        if ($nivel_acesso == "aluno") {
            $sql_aluno = "INSERT INTO aluno (idUsu, nome, email, senha, foto) VALUES ('$usuario_id', '$nome', '$email', '$senha', '$foto')";
            if ($conn->query($sql_aluno) === TRUE) {
                echo "Cadastro de aluno realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar aluno: " . $conn->error;
            }
        }

        header("Location: ../login/login.php");
    } else {
        echo "Erro: " . $sql_usuario . "<br>" . $conn->error;
    }
}

$conn->close();
