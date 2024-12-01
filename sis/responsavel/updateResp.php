<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM responsavel";
$result = mysqli_query($conn, $sql);
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $id = $_POST['cod_responsavel'];
    $nome = $_POST['nome'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

        // Atualiza o registro no banco de dados
        $sql = "UPDATE responsavel SET nome='$nome', tel='$tel', email='$email', senha='$senha' WHERE cod_responsavel='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "Registro atualizado com sucesso";
            header('Location: listarResp.php'); // Redireciona para a lista de alunos após a atualização
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Erro: O código fornecido não existe na tabela matricula.";
    }


// Verifica se um ID foi fornecido para edição
if (isset($_GET['cod_responsavel'])) {
    $id = $_GET['cod_responsavel'];

    // Busca os dados do registro a ser editado
    $sql = "SELECT * FROM responsavel WHERE cod_responsavel='$id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        // Dados encontrados, exibe o formulário de edição
    } else {
        echo "Nenhum registro encontrado.";
        exit();
    }
} else {
    echo "ID não fornecido.";
    exit();
}

mysqli_close($conn);
?>