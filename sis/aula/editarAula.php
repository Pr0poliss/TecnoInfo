<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM aula";
$result = mysqli_query($conn, $sql);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $id = $_POST['cod_aula'];
    $titulo = $_POST['titulo_aula'];
    $desc = $_POST['descricao_aula'];
    $cont = $_POST['conteudo_aula'];

    // Atualiza o registro no banco de dados
    $sql = "UPDATE aula SET titulo_aula='$titulo', descricao_aula='$desc', conteudo_aula='$conteudo' WHERE cod_aula='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
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


    <style>
        /* styles.css */


form {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

label {
    display: block;
    margin: 5px 0;
    font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="number"],
input[type="password"] {
    width: calc(100% - 22px);
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #19234E;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
}

input[type="submit"]:hover {
    background-color: #0D579C;
}

a {
    color: #19234E;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

    </style>
    <h1>Editar aula</h1>
    <form method="POST" action="?page=updateAula">
        <input type="hidden" name="cod_aula" value="<?php echo htmlspecialchars($row['cod_aula']); ?>">
        
        <label>Título:</label>
        <input type="text" name="titulo_aula" value="<?php echo htmlspecialchars($row['titulo_aula']); ?>" required><br>
        
        <label>Descrição:</label>
        <input type="text" name="descricao_aula" value="<?php echo htmlspecialchars($row['descricao_aula']); ?>" required><br>
        
        <label>Conteúdo:</label>
        <input type="text" name="conteudo_aula" value="<?php echo htmlspecialchars($row['conteudo_aula']); ?>" required><br>
        
        <input type="submit" value="Atualizar Aula">
    </form>
    <a href="?page=listarAula">Voltar para a lista de aulas</a>

