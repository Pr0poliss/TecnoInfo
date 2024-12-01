<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM pagamentos";
$result = mysqli_query($conn, $sql);


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['idPag'];

    $sql = "DELETE FROM pagamentos WHERE idPag='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    header('Location: ?page=listarPag'); // Redireciona para a lista de alunos
    exit;
}
?>
