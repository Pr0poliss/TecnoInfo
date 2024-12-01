<?php

// Conexão com o banco de dados
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Verifica o nível de acesso do usuário logado
$nivel_acesso = isset($_SESSION['nivel_acesso']) ? $_SESSION['nivel_acesso'] : null;

// Ajuste a consulta com base no nível de acesso
if ($nivel_acesso === "ADMINISTRADOR") {
    $result = $mysqli->query("SELECT * FROM plano");
} elseif ($nivel_acesso === "ALUNO") {
    $result = $mysqli->query("SELECT * FROM plano WHERE usuFinal = 'ALUNO'");
} elseif ($nivel_acesso === "UNIDADE_ENSINO") {
    $result = $mysqli->query("SELECT * FROM plano WHERE usuFinal = 'UNIDADE_ENSINO'");
} else {
    echo "Acesso negado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Planos</title>
</head>

<body>

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


        /* Estilos para o título e a linha horizontal */
        .titulo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            font-family: Arial, sans-serif;
            color: #19234E;
        }

        .titulo-container h1 {
            margin: 0;
        }

        .line {
            width: 40%;
            height: 2px;
            background-color: #19234E;
            border: none;
        }

        /* Estilos para os cartões de planos */
        .planos-container {
            display: flex;
            grid-template-columns: repeat(4, 1fr);
            flex-wrap: nowrap;
            gap: 20px;
            margin: 20px auto;
            max-width: 1200px;
            justify-content: center;
        }

        .camada3 {
            background-color: transparent;
            padding: 5px;
            width: 240px;
            border-radius: 10px;
            box-shadow: 0 0px 10px gray;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .camada2 {
            height: 100%;
            width: 220px;
            /* background-color: #19234E; */
            background-image: url(../img/wallpaper/granu.png);
            background-size: cover;
            background-repeat: repeat;
            object-fit: cover;
            padding: 10px;
            border-radius: 10px;
            /* box-shadow: 0 0px 10px gray; */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .plano-card {
            height: 100%;
            max-width: 120%;
            background-color: #fff;
            color: #19234E;
            padding: 20px 10px 60px 10px;
            border-radius: 10px;
            text-align: center;
            /* box-shadow: 0 0px 10px gray; */
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .plano-card h3 {
            font-size: 1em;
            font-weight: normal;
            margin-bottom: 5px;
        }

        .plano-card h2 {
            font-size: 2em;
            margin: 5px 0;
        }

        .plano-card h4 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #FFFFFF;
        }

        /* Estilo da lista de benefícios */
        .plano-card ul {
            list-style-type: disc;
            padding-left: 20px;
            text-align: left;
            margin-bottom: 20px;
        }

        .plano-card ul li {
            font-size: 0.9em;
            line-height: 1.5;
        }

        /* Botão de obter */
        .btn-obter {
            padding: 10px 20px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            position: absolute;
            margin-top: 320px;
            text-decoration: none;
        }

        .btn-obter:hover {
            background-color: #003d80;
        }

        /* Responsividade para telas menores */
        @media (max-width: 1200px) {
            .planos-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .planos-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .planos-container {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <?php if ($nivel_acesso === "ADMINISTRADOR"): ?>
        <h1 style="text-align: center;">Lista de Planos</h1>
        <a href="?page=addPlano" class="btn-add">Adicionar Novo Plano</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Valor</th>
                    <th>Benefícios</th>
                    <th>Usuário Final</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['cod_plano']; ?></td>
                        <td><?php echo $row['titulo_plano']; ?></td>
                        <td><?php echo $row['valor_plano']; ?></td>
                        <td><?php echo $row['corpo_plano']; ?></td>
                        <td><?php echo $row['usuFinal']; ?></td>
                        <td>
                            <a style="margin-bottom: 10px;"  href="?page=verPlano&cod_plano=<?php echo $row['cod_plano']; ?>" class="btn-view">Ver</a>
                            <a style="margin-bottom: 10px;" href="?page=editarPlano&cod_plano=<?php echo $row['cod_plano']; ?>" class="btn-edit">Editar</a>
                            <a style="margin-left: 22px;" href="?page=deletePlano&cod_plano=<?php echo $row['cod_plano']; ?>"
                                class="btn-delete">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    <?php elseif ($nivel_acesso === "ALUNO"): ?>
        <div class="titulo-container">
            <hr class="line">
            <h1>PLANOS</h1>
            <hr class="line">
        </div>
        <div class="planos-container">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="camada3" style="box-shadow: 0 0 10px gray;">
                    <div class="camada2">
                        <div class="plano-card">
                            <h3 style="color: black">Por Mês</h3>
                            <h2><?php echo 'R$' . number_format($row['valor_plano'], 2, ',', '.'); ?></h2>
                            <h4 style="color: #19234E;"><?php echo $row['titulo_plano']; ?></h4>
                            <ul>
                                <?php
                                $beneficios = explode(',', $row['corpo_plano']);
                                foreach ($beneficios as $beneficio): ?>
                                    <li><?php echo trim($beneficio); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="?page=verPlano&cod_plano=<?php echo $row['cod_plano']; ?>" class="btn-obter">Obter</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    <?php elseif ($nivel_acesso === "UNIDADE_ENSINO"): ?>
        <div class="titulo-container">
            <hr class="line">
            <h1>PLANOS</h1>
            <hr class="line">
        </div>
        <div class="planos-container">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="camada3" style="box-shadow: 0 0 10px gray;">
                    <div class="camada2">
                        <div class="plano-card">
                            <h3 style="color: black">Por Mês</h3>
                            <h2><?php echo 'R$' . number_format($row['valor_plano'], 2, ',', '.'); ?></h2>
                            <h4 style="color: #19234E;"><?php echo $row['titulo_plano']; ?></h4>
                            <ul>
                                <?php
                                $beneficios = explode(',', $row['corpo_plano']);
                                foreach ($beneficios as $beneficio): ?>
                                    <li><?php echo trim($beneficio); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="?page=verPlano&cod_plano=<?php echo $row['cod_plano']; ?>" class="btn-obter">Obter</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Acesso negado. Entre em contato com o administrador.</p>
    <?php endif; ?>

</body>

</html>