<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM plano";
$result = mysqli_query($conn, $sql);
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $id = $_POST['cod_plano'];
    $titulo = $_POST['titulo_plano'];
    $valor = $_POST['valor_plano'];
    $corpo = $_POST['corpo_plano'];
    $usuFinal = $_POST['usuFinal'];


        // Atualiza o registro no banco de dados
        $sql = "UPDATE plano SET titulo_plano='$titulo', valor_plano='$valor', corpo_plano='$corpo', usuFinal='$usuFinal' WHERE cod_plano='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "Registro atualizado com sucesso";
            echo "<script> setTimeout(function() {window.location.href = '?page=listarPlano';}, 1); // redireciona após 3 segundos</script>";
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Erro: O código do plano fornecido não existe na tabela.";
    }


// Verifica se um ID foi fornecido para edição
if (isset($_GET['cod_plano'])) {
    $id = $_GET['cod_plano'];

    // Busca os dados do registro a ser editado
    $sql = "SELECT * FROM plano WHERE cod_plano='$id'";
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