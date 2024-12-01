<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['cod_modulo'];
    $nome = $_POST['nome'];
    $qt = $_POST['qt'];
    $nivel = $_POST['nivel'];


    $mysqli->query("INSERT INTO modulo(cod_modulo, nome, qt, nivel) 
    VALUES ('$id', '$nome', '$qt', '$nivel'");

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
    <title>Adicionar módulo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
  <h1 style="text-align: center;">Adicionar matrícula</h1>

<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');
$sql = "select nome, id from aluno";
$result = mysqli_query($mysqli, $sql);
?>

<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');
$sql = "select nome_prof, cod_professor from unidade_ensino";
$resulta = mysqli_query($mysqli, $sql);
?>


<form action="inserirMat.php" method="POST">
    
    <label>Número da matrícula:</label>
    <input type="text" name="nome" required>
    
    <p>Selecione um aluno ou uma unidade de ensino:</p>
    <p>Aluno</p>
    <select name="aluno">
        <option value="selecione" selected>Selecione</option>
        <option value="selecione" selected>Nulo</option>
      <?php 
      while($dados = mysqli_fetch_assoc($result)) {
        ?>
        <option value="<?php echo $dados['id']?>">
            <?php echo $dados['nome']?>
        </option>
        <?php
      }
      ?>
    </select> 

    <p>Unidade de ensino</p>
    <select name="unidade">
        <option value="selecione" selected>Selecione</option> 
        <option value="selecione" selected>Nulo</option>
      <?php 
      while($dados = mysqli_fetch_assoc($resulta)) {
        ?>
        <option value="<?php echo $dados['cod_uni']?>">
            <?php echo $dados['nome']?>
        </option>
        <?php
      }
      ?>
    </select> 

    


        <button type="submit" class="btn-add">Salvar</button>
    </form>
</body>


</html>