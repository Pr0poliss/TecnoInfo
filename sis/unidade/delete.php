<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM unidade_ensino";
$result = mysqli_query($conn, $sql);


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id_uni'];

    $sql = "DELETE FROM unidade_ensino WHERE id_uni='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    header('Location: listarUni.php'); // Redireciona para a lista de alunos
}
?>
