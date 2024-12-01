<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Verifique se o usuário está logado
if (isset($_SESSION['email'])) {
    $nivel_acesso = $_SESSION['nivel_acesso'];
}

$result = $mysqli->query("SELECT * FROM aula");

?>

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

<h1 style="text-align: center;">Lista de aulas</h1>

<?php if ($nivel_acesso == "ADM") { ?>
    <a href="?page=addAula" class="btn-add">Adicionar Nova aula</a>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Conteúdo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['cod_aula']; ?></td>
                    <td><?php echo $row['titulo_aula']; ?></td>
                    <td><?php echo $row['conteudo_aula']; ?></td>
                    <td><?php echo $row['video_url']; ?></td>
                    <td>
                        <a href="?page=verAula&cod_aula=<?php echo $row['cod_aula']; ?>" class="btn-view">Ver</a>
                        <a href="?page=editarAula&cod_aula=<?php echo $row['cod_aula']; ?>" class="btn-edit">Editar</a>
                        <a href="delete&cod_aula=<?php echo $row['cod_aula']; ?>" class="btn-delete">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php } elseif ($nivel_acesso == "ALUNO") { ?>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Conteúdo</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['cod_aula']; ?></td>
                    <td><?php echo $row['titulo_aula']; ?></td>
                    <td><?php echo $row['conteudo_aula']; ?></td>
                    <td><?php echo $row['video_url']; ?></td>
                    <td>
                        <a href="?page=verAula&cod_aula=<?php echo $row['cod_aula']; ?>" class="btn-view">Ver</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php } ?>