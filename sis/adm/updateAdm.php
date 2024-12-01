<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM administrador";
$result = mysqli_query($conn, $sql);
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $foto = $_POST['foto'];


    // Atualiza o registro no banco de dados
    $sql = "UPDATE administrador SET nome='$nome', email='$email', senha='$senha' , foto='$foto' where id= $id";
    if (mysqli_query($conn, $sql)) {
?>
        <script>
            window.onload = function() {
                // Exibe o alerta quando a página for carregada
                alert(<a href='?page=listarAdm'>Voltar</a>);
                // window.history.go(-2);
            }
        </script>
<?php
        exit();
    } else {
        exit();
    }
} else {
    echo "Erro: O código do administrador fornecido não existe na tabela matricula.";
}


// Verifica se um ID foi fornecido para edição
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do registro a ser editado
    $sql = "SELECT * FROM administrador WHERE id='$id'";
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