<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM aluno";
$result = mysqli_query($conn, $sql);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $mat_alu = $_POST['id'];
    $nome_alu = $_POST['nome'];
    $cpf_alu = $_POST['cpf_alu'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $sexo_alu = $_POST['sexo_alu'];
    $cod_matricula = $_POST['cod_matricula'];

    // Atualiza o registro no banco de dados
    $sql = "UPDATE aluno SET nome='$nome_alu', cpf_alu='$cpf_alu', idade='$idade', email='$email', senha='$senha', sexo_alu='$sexo_alu' WHERE id='$mat_alu'";

    if (mysqli_query($conn, $sql)) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
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
    background-color: #19234E
    ;
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
    color: #19234E
    ;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

    </style>
    </style>
    <h1>Editar Aluno</h1>
    <form method="POST" action="?page=updateAlu">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required><br>
        
        <label>CPF:</label>
        <input type="text" name="cpf_alu" value="<?php echo htmlspecialchars($row['cpf_alu']); ?>" required><br>
        
        <label>Idade:</label>
        <input type="number" name="idade" value="<?php echo htmlspecialchars($row['idade']); ?>" required><br>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required><br>
        
        <label>Senha:</label>
        <input type="password" name="senha" value="<?php echo htmlspecialchars($row['senha']); ?>" required><br>
        
        <label>Sexo:</label>
        <input type="text" name="sexo_alu" value="<?php echo htmlspecialchars($row['sexo_alu']); ?>" required><br>
        
        <!-- <label>Código de Matrícula:</label>
        <input type="number" name="cod_matricula" value="<?php echo htmlspecialchars($row['cod_matricula']); ?>" required><br> -->
        
        <input type="submit" value="Atualizar Aluno">
    </form>
    <a href="?page=listarAlu">Voltar para a lista de alunos</a>

