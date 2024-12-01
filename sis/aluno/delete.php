<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM aluno";
$result = mysqli_query($conn, $sql);


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mat = $_GET['cod_matricula'];

    $sql = "DELETE FROM aluno WHERE cod_matricula='$mat'";

    if (mysqli_query($conn, $sql)) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    header('Location: listar_alu.php'); // Redireciona para a lista de alunos
}

