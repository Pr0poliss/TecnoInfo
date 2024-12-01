<?php
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "tecnoinfo");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

include "../../base/ch_pages.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    // Verifica se há um arquivo de foto
    $foto = NULL;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoNome = $_FILES['foto']['name'];
        $fotoTmp = $_FILES['foto']['tmp_name'];
        $extensao = pathinfo($fotoNome, PATHINFO_EXTENSION);

        // Define o caminho para salvar a foto
        $fotoNovoNome = uniqid() . '.' . $extensao;
        $fotoDestino = '../../img/adm/' . $fotoNovoNome;

        // Mover o arquivo para o diretório 'uploads'
        if (move_uploaded_file($fotoTmp, $fotoDestino)) {
            $foto = $fotoDestino;

            // Executa o código de inserção no banco de dados após o upload bem-sucedido
            $sql_usuario = "INSERT INTO usuarios (nome, email, senha, foto, nivel_acesso) VALUES ('$nome', '$email', '$senha', '$fotoDestino', 'ADMINISTRADOR')";

            if ($conn->query($sql_usuario) === TRUE) {
                // Pega o último ID inserido (id do usuário)
                $usuario_id = $conn->insert_id;

                // Insere na tabela `administrador`
                $sql_adm = "INSERT INTO administrador (idUsu, nome, email, senha, foto) VALUES ('$usuario_id', '$nome', '$email', '$senha', '$fotoDestino')";
                if ($conn->query($sql_adm) === TRUE) {
                    echo "<script>alert('Administrador cadastrado com sucesso!');</script>";
                    header("Location: ../login/login.php");
                } else {
                    echo "Erro ao cadastrar administrador: " . $conn->error;
                }
            } else {
                echo "Erro: " . $sql_usuario . "<br>" . $conn->error;
            }
        } else {
            echo "Erro ao fazer upload da foto.";
        }
    } else {
        echo "Nenhuma foto foi selecionada ou ocorreu um erro no upload.";
    }
}

$conn->close();
