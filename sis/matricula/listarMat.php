<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT * FROM matricula");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Matriculas</title>
</head>
<body>
<a href="../../dashboards/dashboardADM.php">Voltar</a>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
}

h2 {
    color: #333;
}

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

th, td {
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

.btn-add, .btn-view, .btn-edit, .btn-delete {
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

    <h1 style="text-align: center;">Lista de Matrículas</h1>
    
    <a href="addMat.php" class="btn-add">Adicionar Nova matrícula</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data da matrícula</th>
                <th>Instituição</th>
                <th>Nível</th>
                <th>Ativo</th>
                <th>Sexo</th>
                <th>Ações</th>
            </tr>
        </thead>
        </form>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['cod_matricula']; ?></td>
                    <td><?php echo $row['dt_mat']; ?></td>
                    <td><?php echo $row['curso_mat']; ?></td> 
                    <td><?php echo $row['idade']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['sexo_alu']; ?></td>
                    <td>
                        <a href="verAlu.php?id=<?php echo $row['id']; ?>" class="btn-view">Ver</a>
                        <a href="editarAlu.php?id=<?php echo $row['id']; ?>" class="btn-edit">Editar</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn-delete">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
