<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM avaliacoes";
$result = mysqli_query($conn, $sql);
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];


        // Atualiza o registro no banco de dados
        $sql = "UPDATE avaliacoes SET titulo='$titulo', descricao='$descricao' WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "Registro atualizado com sucesso";
            header('Location: ?page=listarAv'); 
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Erro: O código da avaliação fornecida não existe na tabela.";
    }


// Verifica se um ID foi fornecido para edição
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do registro a ser editado
    $sql = "SELECT * FROM avaliacoes WHERE id='$id'";
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
