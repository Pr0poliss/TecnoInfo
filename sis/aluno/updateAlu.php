<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM aluno";
$result = mysqli_query($conn, $sql);
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $mat_alu = $_POST['id'];
    $nome_alu = $_POST['nome'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    // $cod_matricula = $_POST['cod_matricula'];

    // Verifica se o cod_matricula é válido
    // $sql_check = "SELECT cod_matricula FROM matricula WHERE cod_matricula='$cod_matricula'";
    // $result_check = mysqli_query($conn, $sql_check);


        // Atualiza o registro no banco de dados
        $sql = "UPDATE aluno SET nome='$nome_alu', idade='$idade', email='$email', senha='$senha' WHERE id='$mat_alu'";

        if (mysqli_query($conn, $sql)) {
            echo "Registro atualizado com sucesso";
            header('Location: ?page=listarAlu'); // Redireciona para a lista de alunos após a atualização
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Erro: O código de matrícula fornecido não existe na tabela matricula.";
    }


// Verifica se um ID foi fornecido para edição
if (isset($_GET['id'])) {
    $mat_alu = $_GET['id'];

    // Busca os dados do registro a ser editado
    $sql = "SELECT * FROM aluno WHERE id='$mat_alu'";
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