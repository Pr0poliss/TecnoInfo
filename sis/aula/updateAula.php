<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM aula";
$result = mysqli_query($conn, $sql);
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $id = $_POST['cod_aula'];
    $titulo = $_POST['titulo_aula'];
    $desc = $_POST['descricao_aula'];
    $cont = $_POST['conteudo_aula'];


        // Atualiza o registro no banco de dados
        $sql = "UPDATE aula SET titulo_aula='$titulo', descricao_aula='$desc', conteudo_aula='$cont' WHERE cod_aula='$id'";

        if (mysqli_query($conn, $sql)) {
            echo "Registro atualizado com sucesso";
            header('Location: listarAula.php'); 
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Erro: O códigofornecido não existe na tabela";
    }


// Verifica se um ID foi fornecido para edição
if (isset($_GET['cod_aula'])) {
    $id = $_GET['cod_aula'];

    // Busca os dados do registro a ser editado
    $sql = "SELECT * FROM aula WHERE cod_aula='$id'";
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