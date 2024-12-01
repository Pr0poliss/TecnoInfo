<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

$sql = "SELECT * FROM avaliacao";
$result = mysqli_query($conn, $sql);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $id = $_GET['id'];
    $titulo = $_POST['titulo_av'];
    $corpo = $_POST['corpo_av'];

    // Atualiza o registro no banco de dados
    $sql = "UPDATE avaliacoes SET titulo_av='$titulo', corpo='$corpo_av'WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Verifica se um ID foi fornecido para edição
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca os dados do registro a ser editado
    $sql = "SELECT * FROM avaliacoes WHERE id='$id'";
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

        .btn-add {
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

        .btn-add:hover {
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
    </style>
    <h1>Editar Avaliação</h1>
    <form method="POST" action="?page=updateAv">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

        <label>Título:</label>
        <input type="text" name="titulo" value="<?php echo htmlspecialchars($row['titulo']); ?>" required><br>

        <label>Conteúdo:</label>
        <input type="text" name="descricao" value="<?php echo htmlspecialchars($row['descricao']); ?>" required><br>


        <div class="form-group col-md-3">
            <label for="dt_av">Data da avaliação</label>
            <input type="text" disabled="disabled" class="form-control" value="<?php echo date('d/m/Y'); ?>" name="dt_av">
        </div>

        <input type="submit" value="Atualizar Avaliação">
    </form>
    <a href="?page=listarAv" class="btn-add">Voltar para a lista de avaliações</a>
