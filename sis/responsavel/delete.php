<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM responsavel";
$result = mysqli_query($conn, $sql);


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['cod_responsavel'];

    $sql = "DELETE FROM responsavel WHERE cod_responsavel='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    header('Location: listarResp.php'); // Redireciona para a lista de alunos
}
?>
