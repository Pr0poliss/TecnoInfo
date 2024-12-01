<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id='$id'";
    $sql = "DELETE FROM {$nivel_acesso} WHERE id='$usuario_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    header('Location: listarUsu.php'); // Redireciona para a lista de alunos
}

