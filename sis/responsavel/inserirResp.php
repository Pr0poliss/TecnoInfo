<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM responsavel";
$result = mysqli_query($conn, $sql);
$conn = mysqli_connect('localhost', 'root', '', 'tecnoinfo');

    $id = $_POST['cod_responsavel'];
    $nome = $_POST['nome'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];




    $sql = "INSERT INTO responsavel(cod_responsavel,nome, tel, email, senha) 
            VALUES ('$id','$nome', '$tel', '$email', '$senha')";

    $resultado = mysqli_query($conn, $sql);

    if($resultado){
        echo "Responsável inserido com sucesso inserido com sucesso";
        include "listarResp.php";
    } else {
        echo "Erro ao inserir o responsável: " . mysqli_error($conn);

    }
?>
