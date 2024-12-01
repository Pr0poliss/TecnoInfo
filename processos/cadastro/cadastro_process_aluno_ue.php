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
    
    $doc_unid = NULL;
    if (isset($_FILES['doc_unid']) && $_FILES['doc_unid']['error'] == 0) {
        $doc_unidNome = $_FILES['doc_unid']['name'];
        $doc_unidTmp = $_FILES['doc_unid']['tmp_name'];
        $extensao = pathinfo($doc_unidNome, PATHINFO_EXTENSION);

        // Define o caminho para salvar a foto
        $doc_unidNovoNome = uniqid() . '.' . $extensao;
        $doc_unidDestino = '../../img/ue/doc_unid/' . $doc_unidNovoNome;

        // Mover o arquivo para o diretório 'ue/doc_unid'
        if (move_uploaded_file($doc_unidTmp, $doc_unidDestino)) {
            $doc_unid = $doc_unidDestino;
        }
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

    // Insere na tabela `usuarios`
    $sql_usuario = "INSERT INTO usuarios (nome, email, senha, foto, nivel_acesso) VALUES ('$nome', '$email', '$senha', '$foto', '$nivel_acesso')";
    
    if ($conn->query($sql_usuario) === TRUE) {
        // Pega o último ID inserido (id do usuário)
        $usuario_id = $conn->insert_id;

        // Verifica o tipo de usuário e insere na tabela correspondente
        if ($nivel_acesso == "aluno") {
            $sql_aluno = "INSERT INTO aluno (usuario_id, nome, email, senha, foto) VALUES ('$usuario_id', '$nome', '$email', '$senha', '$foto')";
            if ($conn->query($sql_aluno) === TRUE) {
                echo "Cadastro de aluno realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar aluno: " . $conn->error;
            }
        } else if ($nivel_acesso == "UE") {
            $cnpj = $_POST["cnpj"];
            $tel = $_POST["tel"];
            $insc_est = $_POST["insc_est"];
            $nivel_ensino = $_POST["nivel_ensino"];
            $sql_ue = "INSERT INTO unidade_ensino (usuario_id, nome, cnpj, tel, insc_est, doc_unid, nivel_ensino, email, senha, nivel_acesso, foto) VALUES ('$usuario_id', '$nome', '$cnpj', '$tel', '$insc_est', '$doc_unid', '$nivel_ensino', '$email', '$senha', '$nivel_acesso', '$foto')";
            if ($conn->query($sql_ue) === TRUE) {
                echo "Cadastro de unidade de ensino realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar unidade de ensino: " . $conn->error;
            }
        }

        header("Location: ../login/login.php");
    } else {
        echo "Erro: " . $sql_usuario . "<br>" . $conn->error;
    }
}

$conn->close();
?>
