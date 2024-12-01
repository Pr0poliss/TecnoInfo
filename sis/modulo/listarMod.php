<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Verifique se o usuário está logado
if (isset($_SESSION['email'])) {
    $nivel_acesso = $_SESSION['nivel_acesso'];
}

$result = $mysqli->query("SELECT * FROM modulo ORDER BY cod_modulo");

?>

 
<style>
        table {
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #19234E;
            color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #19234E;
            color: white;
            width: 10%;
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

    <h1 style="text-align: center;">Lista de módulos</h1>

    <?php if($nivel_acesso == "ADM"){ ?>
        <a href="?page=addMod" class="btn-add">Adicionar Novo módulo</a>
        <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Código do módulo</th>
                <th>Código do curso</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nome_mod']; ?></td>
                    <td><?php echo $row['cod_modulo']; ?></td>
                    <td><?php echo $row['cod_curso']; ?></td>
                    <td>
                        <a href="?page=verMod&cod_modulo=<?php echo $row['cod_modulo']; ?>" class="btn-view">Ver</a>
                        <a href="?page=editarMod&cod_modulo=<?php echo $row['cod_modulo']; ?>" class="btn-edit">Editar</a>
                        <a href="delete&cod_modulo=<?php echo $row['cod_modulo']; ?>" class="btn-delete">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php } elseif($nivel_acesso == "ALUNO") {?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nome_mod']; ?></td>
                    <td>
                        <a href="?page=listarAula&cod_modulo=<?php echo $row['cod_modulo']; ?>" class="btn-view">Aulas</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php } ?>
</body>

</html>

