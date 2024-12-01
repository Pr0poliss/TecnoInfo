<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM modulo";
$result = mysqli_query($conn, $sql);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $id = $_POST['cod_modulo'];
    $nome = $_POST['nome'];
    $qt = $_POST['qt'];
    $nivel = $_POST['nivel'];

    // Atualiza o registro no banco de dados
    $sql = "UPDATE modulo SET nome='$nome', qt='$qt', nivel ='$nivel' 'WHERE cod_modulo='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Verifica se um ID foi fornecido para edição
if (isset($_GET['cod_modulo'])) {
    $id = $_GET['cod_modulo'];

    // Busca os dados do registro a ser editado
    $sql = "SELECT * FROM modulo WHERE cod_modulo='$id'";
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

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar módulo</title>
</head>
<body>
    <style>
        /* styles.css */

body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f4f4f4;
    color: #333;
}

h1 {
    color: #4CAF50;
    margin-bottom: 20px;
}

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
    background-color: #4CAF50;
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
    background-color: #45a049;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

table th {
    background-color: #4CAF50;
    color: white;
}

table tr:nth-child(even) {
    background-color: #f2f2f2;
}

table tr:hover {
    background-color: #ddd;
}

a {
    color: #4CAF50;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

    </style>
    </style>
    <h1>Editar módulo</h1>
    <form method="POST" action="updateMod.php">
        <input type="hidden" name="cod_modulo" value="<?php echo htmlspecialchars($row['cod_modulo']); ?>">
        
        <label>Título:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required><br>
        
        <label>Quantidade de módulos:</label>
        <input type="text" name="qt" value="<?php echo htmlspecialchars($row['qt']); ?>" required><br>

        <label>Nível:</label>
        <input type="text" name="nivel" value="<?php echo htmlspecialchars($row['nivel']); ?>" required><br>
        
      
        
        <input type="submit" value="Atualizar módulo">
    </form>
    <a href="listarMod.php">Voltar para a lista de módulos</a>
</body>
</html>
