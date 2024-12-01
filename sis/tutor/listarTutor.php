<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT * FROM tutor");

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

    <h1 >Lista de tutores</h1>
    
    <a href="?page=addTutor" class="btn-add">Adicionar Novo tutor</a>
    <a href="?page=relTutor&gerar_pdf=1" class="btn-add right">Gerar Relatório</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Verificado(a)</th>
                <th>Ações</th>
            </tr>
        </thead>
        </form>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['idTutor']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['cpf']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['autenticidade']; ?></td>
                    
                    <td>
                        <a href="?page=verTutor&idTutor=<?php echo $row['idTutor']; ?>" class="btn-view">Ver</a>
                        <a href="?page=editarTutor&idTutor=<?php echo $row['idTutor']; ?>" class="btn-edit">Editar</a>
                        <a href="?page=deleteTutor&idTutor=<?php echo $row['idTutor']; ?>" class="btn-delete">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</body>
</html>
