<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Consulta para buscar as turmas e seus respectivos tutores
$query = "
SELECT turma.idTurma AS idTurma, turma.numero_turma, turma.limite_alunos, tutor.nome AS idTutor FROM turma
LEFT JOIN tutor ON turma.idTutor = tutor.idTutor;

";
$result = $mysqli->query($query);

if (!$result) {
    die('Erro na consulta: ' . $mysqli->error);
}
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

<h1>Lista de turmas</h1>

<a href="?page=addTurma" class="btn-add">Adicionar Nova turma</a>
<a href="?page=relTurma&gerar_pdf=1" class="btn-add right">Gerar relatório</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Número da turma</th>
            <th>Quantidade de alunos</th>
            <th>Tutor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['idTurma']; ?></td>
                <td><?php echo $row['numero_turma']; ?></td>
                <td><?php echo $row['limite_alunos']; ?></td>
                <td><?php echo $row['idTutor'] ?: 'Sem tutor'; ?></td> <!-- Exibe "Sem tutor" caso não tenha -->
                <td>
                    <a href="?page=verTurma&idTurma=<?php echo $row['idTurma']; ?>" class="btn-view">Ver</a>
                    <a href="?page=editarTurma&idTurma=<?php echo $row['idTurma']; ?>" class="btn-edit">Editar</a>
                    <a href="?page=deleteTurma&idTurma=<?php echo $row['idTurma']; ?>" class="btn-delete">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
