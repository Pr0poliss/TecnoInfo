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
    $id = $_POST['cod_avaliacao'];
    $titulo = $_POST['titulo_av'];
    $corpo = $_POST['corpo_av'];


        // Atualiza o registro no banco de dados
        $sql = "UPDATE avaliacao SET titulo_av='$titulo', corpo_av='$corpo' WHERE cod_avaliacao='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "Registro atualizado com sucesso";
            header('Location: listarAv.php'); 
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Erro: O código da avaliação fornecida não existe na tabela.";
    }


// Verifica se um ID foi fornecido para edição
if (isset($_GET['cod_avaliacao'])) {
    $id = $_GET['cod_avaliacao'];

    // Busca os dados do registro a ser editado
    $sql = "SELECT * FROM avaliacao WHERE cod_avaliacao='$id'";
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