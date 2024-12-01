<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT * FROM responsavel");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de responsáveis</title>
</head>
<body>
<a href="../../dash/dashboard.php">Voltar</a>
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

    <h1 style="text-align: center;">Lista de responsáveis</h1>
    
    <a href="addResp.php" class="btn-add">Adicionar Novo responsável</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Senha</th>
                <th>Ações</th>
            </tr>
        </thead>
        </form>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['cod_responsavel']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['tel']; ?></td> 
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['senha']; ?></td>
                    <td>
                        <a href="verResp.php?cod_responsavel=<?php echo $row['cod_responsavel']; ?>" class="btn-view">Ver</a>
                        <a href="editarResp.php?cod_responsavel=<?php echo $row['cod_responsavel']; ?>" class="btn-edit">Editar</a>
                        <a href="delete.php?cod_responsavel=<?php echo $row['cod_responsavel']; ?>" class="btn-delete">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
