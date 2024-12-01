<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM plano";
$result = mysqli_query($conn, $sql);



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
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
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

<style>
    /* styles.css */

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin: 5px 0;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    select,
    input[type="number"],
    input[type="password"] {
        width: calc(100% - 22px);
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    
    select {
        width: 100%;
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
<h1>Editar plano</h1>
<form method="POST" action="?page=updatePlano">
    <input type="hidden" name="cod_plano" value="<?php echo htmlspecialchars($row['cod_plano']); ?>">

    <label>Título:</label>
    <input type="text" name="titulo_plano" value="<?php echo htmlspecialchars($row['titulo_plano']); ?>" required><br>

    <label>Valor:</label>
    <input type="number" name="valor_plano" value="<?php echo htmlspecialchars($row['valor_plano']); ?>" required><br>

    <label for="usuFinal">Usuário Final</label>
    <select name="usuFinal" id="usuFinal">
        <option value="<?php echo htmlspecialchars($row['usuFinal']); ?>">Selecione</option>
        <option value="ALUNO">Aluno</option>
        <option value="UNIDADE_ENSINO">Unidade de Ensino</option>
    </select>

    <label>Benefícios:</label>
    <input type="text" name="corpo_plano" value="<?php echo htmlspecialchars($row['corpo_plano']); ?>" required><br>

    <input type="submit" value="Atualizar plano">
</form>
<a href="?page=listarPlano">Voltar para a lista de planos</a>