<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['idPag'];
    $numbeCard = $_POST['card_number'];
    $exp = $_POST['expciry_date'];
    $cvc = $_POST['cvc'];
    $card = $_POST['card_name'];
    $plano = $_POST["plano"];

    $mysqli->query("INSERT INTO pagamentos(idPag, card_number, card_number, cvc, card_name, cod_plano) 
    VALUES (''$id','$numberCard', '$exp', '$cvc', '$card', '$plano')");


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
            background-color: #19234E;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-add:hover {
            background-color: #0D579C;
        }
    </style>
    <h1 style="text-align: center;">Adicionar pagamento</h1>

    <?php
   $mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');
    $sql = "select titulo_plano, cod_plano from plano";
    $result = mysqli_query($mysqli, $sql);
    ?>

    <form action="?page=inserirPag" method="POST">
    <button type="button" class="btn btn-primary btn-sm" onclick="window.history.go(-1)"> Voltar </button>
        <label>Usuário:</label>
        <input type="text" name="nome_quem_pagou" required>

        <p>Selecione seu plano:</p>
        <select name="plano">
            <option value="selecione" selected>Selecione</option>
          <?php 
          while($dados = mysqli_fetch_assoc($result)) {
            ?>
            <option value="<?php echo $dados['cod_plano']?>">
                <?php echo $dados['titulo_plano']?>
            </option>
            <?php
          }
          ?>
        </select>



        <label>Valor pago:</label>
        <input type="text" name="valor_pago" required>
        

        <div class="form-group col-md-3">
            <label for="data">Data do pagamento</label>
            <input type="text" disabled="disabled" class="form-control" value="<?php echo date('d/m/Y'); ?>" name="datapg">
        </div>

        <label>Modo de pagamento:</label>
        <input type="text" name="modo_pgto" required>

        <button type="submit" class="btn-add">Salvar</button>
    </form>
