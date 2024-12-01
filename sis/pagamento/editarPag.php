<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM pagamento";
$result = mysqli_query($conn, $sql);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $id = $_POST['cod_pagamento'];
    $nome = $_POST['nome_quem_pagou'];
    $valor = $_POST['valor_pago'];
    $dt = $_POST['datapg'];
    $modo = $_POST['modo_pgto'];


    // Atualiza o registro no banco de dados
    $sql = "UPDATE pagamento SET nome_quem_pagou='$nome', valor_pago='$valor', datapg ='$dt', modo_pgto='$modo' 'WHERE cod_maticula='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Verifica se um ID foi fornecido para edição
if (isset($_GET['cod_pagamento'])) {
    $id = $_GET['cod_pagamento'];

    // Busca os dados do registro a ser editado
    $sql = "SELECT * FROM pagamento WHERE cod_pagamento='$id'";
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

    <h1>Editar avaliação</h1>
    <form method="POST" action="?page=updatePag">
        <input type="hidden" name="cod_pagamento" value="<?php echo htmlspecialchars($row['cod_pagamento']); ?>">
        
        <label>Usuário:</label>
        <input type="text" name="nome_quem_pagou" value="<?php echo htmlspecialchars($row['nome_quem_pagou']); ?>" required><br>
        
        <label>Valor pago:</label>
        <input type="text" name="valor_pago" value="<?php echo htmlspecialchars($row['valor_pago']); ?>" required><br>

        <label>Modo de pagamento:</label>
        <input type="text" name="modo_pgto" value="<?php echo htmlspecialchars($row['modo_pgto']); ?>" required><br>
        
      
        
        <input type="submit" value="Atualizar pagamento">
    </form>
    <a href="?page=listarPag">Voltar para a lista de pagamentos</a>
