<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $tel = $_POST['tel'];
      $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Senha com hash
 
    $mysqli->query("INSERT INTO responsave(nome, tel, email, senha) VALUES ('$nome', '$tel','$email', '$senha')");

    if (mysqli_query($conn, $sql)) {
        echo "Novo registro criado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Responsável</title>
</head>
<body>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
}

h2 {
    color: #333;
    margin-bottom: 20px;
}

form {
    max-width: 600px;
    margin: auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
input[type="number"]:focus {
    border-color: #4CAF50;
}

button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

.btn-add {
    text-align: center;
    display: inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    color: white;
    background-color: #4CAF50;
    text-decoration: none;
    border-radius: 5px;
}

.btn-add:hover {
    background-color: #45a049;
}

</style>
    <h2>Adicionar Responsável</h2>
    <form action="inserirResp.php" method="POST">
        <label>Nome:</label>
        <input type="text" name="nome" required>
        
        <label>Telefone:</label>
        <input type="number" name="tel" required>
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Senha:</label>
        <input type="password" name="senha" required>
        
        <button type="submit" class="btn-add">Salvar</button>
    </form>
</body>
</html>
