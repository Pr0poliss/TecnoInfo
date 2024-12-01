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


    <style>

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
            background-color: #19234E;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0D579C;
        }

        .btn-add {
            text-align: center;
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            color: white;
            background-color: #0D579C;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-add:hover {
            background-color: #45a049;
        }
    </style>
    <h1 style="text-align: center;">Adicionar módulo</h1>

    <?php
   $mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');
    $sql = "select titulo_aula, cod_aula from aula";
    $result = mysqli_query($mysqli, $sql);
    ?>

<?php
   $mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');
    $sql = "select titulo_av, cod_avaliacao from avaliacao";
    $resulta = mysqli_query($mysqli, $sql);
    ?>


    <form action="?page=inserirMod.php" method="POST">
    <button type="button" class="btn btn-primary btn-sm" onclick="window.history.go(-1)"> Voltar </button>
        <label>Título:</label>
        <input type="text" name="nome" required>

        
        <p>Selecione uma aula:</p>
        <select name="aula">
            <option value="selecione" selected>Selecione</option>
          <?php 
          while($dados = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $dados['cod_aula']?>">
                <?php echo $dados['titulo_aula']?>
            </option>
            <?php
          }
          ?>
        </select> 

        <p>Selecione uma avaliação:</p>
        <select name="avaliacao">
            <option value="selecione" selected>Selecione</option>
          <?php 
          while($dados = mysqli_fetch_assoc($resulta)) {
            ?>
            <option value="<?php echo $dados['cod_avaliacao']?>">
                <?php echo $dados['titulo_av']?>
            </option>
            <?php
          }
          ?>
        </select> 

        

        <label>Nível:</label>
        <input type="text" name="nivel" required>

        <label>Quantidade de módulos:</label>
        <input type="number" name="qt" required>

        <button type="submit" class="btn-add">Salvar</button>
    </form>
