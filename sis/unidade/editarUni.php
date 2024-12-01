<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM unidade_ensino";
$result = mysqli_query($conn, $sql);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $id = $_POST['id_uni'];
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $tel = $_POST['tel'];

    // Atualiza o registro no banco de dados
    $sql = "UPDATE unidade_ensino SET nome='$nome', cnpj='$cnpj', tel ='$tel' WHERE id_uni='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Verifica se um ID foi fornecido para edição
if (isset($_GET['id_uni'])) {
    $id = $_GET['id_uni'];

    // Busca os dados do registro a ser editado
    $sql = "SELECT * FROM unidade_ensino WHERE id_uni='$id'";
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
   
    <h1>Editar unidade</h1>
    <form method="POST" action="?page=updateUni">
        <input type="hidden" name="id_uni" value="<?php echo htmlspecialchars($row['id_uni']); ?>">
        
        <label>Nome da unidade:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required><br>
        
        <label>CNPJ:</label>
        <input type="number" name="cnpj" value="<?php echo htmlspecialchars($row['cnpj']); ?>" required><br>

        <label>Telefone para contato:</label>
        <input type="text" name="tel" value="<?php echo htmlspecialchars($row['tel']); ?>" required><br>
        
      
        
        <input type="submit" value="Atualizar unidade">
    </form>
    <a href="?page=listarUni">Voltar para a lista de unidades</a>

