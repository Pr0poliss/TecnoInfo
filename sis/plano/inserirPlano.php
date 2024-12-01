<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM adm";
$result = mysqli_query($conn, $sql);
$conn = mysqli_connect('localhost', 'root', '', 'tecnoinfo');

    $id = $_POST['cod_plano'];
    $titulo = $_POST['titulo_plano'];
    $valor = $_POST['valor_plano'];
    $corpo = $_POST['corpo_plano'];
    $usuFinal = $_POST['usuFinal'];

    $sql = "INSERT INTO plano(titulo_plano, valor_plano, corpo_plano, usuFinal) 
            VALUES ('$titulo', '$valor', '$corpo', '$usuFinal')";

    $resultado = mysqli_query($conn, $sql);

    if($resultado){
        echo "plano inserido com sucesso";
        echo "<script> setTimeout(function() {window.location.href = '?page=listarPlano';}, 1); // redireciona após 3 segundos</script>";
    } else {
        echo "Erro ao inserir o plano: " . mysqli_error($conn);

    }
?>
