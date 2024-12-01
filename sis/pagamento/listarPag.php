<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT * FROM pagamentos");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pagamentos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #19234E;
            color: #fff;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #19234E;
            color: white;
        }

        tr:hover {
            background-color: #9aceff;
        }

        .btn-add,
        .btn-view,
        .btn-edit,
        .btn-delete {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 5px;
            display: inline-block;
        }

        .btn-add {
            background-color: #19234E;
            color: white;
        }

        .btn-view {
            background-color: #007bff;
            color: white;
        }

        .btn-edit {
            background-color: #ffc107;
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-view:hover {
            background-color: #0056b3;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-add:hover {
            background-color: #2365a3;
        }
    </style>
</head>
<body>

<h1 style="text-align: center;">Lista de Pagamentos</h1>
<a href="?page=relPag&gerar_pdf=1" class="btn-add">Gerar Relatório</a>
<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Usuário</th>
            <th>Plano</th>
            <th>Número do Cartão</th>
            <th>Data de Pagamento</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['idPag']; ?></td>
                <td>
                    <?php
                    // Buscar o nome do usuário baseado no idUsu
                    $user_result = $mysqli->query("SELECT email FROM usuarios WHERE idUsu = {$row['idUsu']}");
                    $user = $user_result->fetch_assoc();
                    echo $user['email']; // Exibe o email do usuário
                    ?>
                </td>
                <td>
                    <?php
                    // Buscar o nome do plano baseado no cod_plano
                    $plan_result = $mysqli->query("SELECT titulo_plano FROM plano WHERE cod_plano = {$row['cod_plano']}");
                    $plan = $plan_result->fetch_assoc();
                    echo $plan['titulo_plano']; // Exibe o nome do plano
                    ?>
                </td>
                <td><?php echo $row['card_number']; ?></td>
                <td><?php echo $row['data_pagamento']; ?></td>
                <td>
                    <a href="?page=verPag&idPag=<?php echo $row['idPag']; ?>" class="btn-view">Ver</a>
                    <a href="?page=deletePag&idPag=<?php echo $row['idPag']; ?>" class="btn-delete">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
