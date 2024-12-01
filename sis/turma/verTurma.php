<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Consulta para obter os detalhes da turma e o nome do tutor
$sql = "SELECT t.idTurma AS idTurma, t.numero_turma, t.limite_alunos, tut.nome AS tutor_nome 
        FROM turma t 
        LEFT JOIN tutor tut ON t.idTutor = tut.idTutor
        WHERE t.idTurma = ?";


if ($stmt = $mysqli->prepare($sql)) {
    // Recebe o ID da turma via GET
    $stmt->bind_param('i', $_GET['idTurma']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $turma_id = $row['idTurma'];
        $numero_turma = $row['numero_turma'];
        $limite_alunos = $row['limite_alunos'];
        $tutor_nome = $row['tutor_nome'] ? $row['tutor_nome'] : 'Não atribuído';
    }
    $stmt->close();
} else {
    echo "Erro na consulta: " . $mysqli->error;
}

// Consulta para listar os alunos associados à turma (utilizando a tabela de relacionamento)
$sql_alunos = "SELECT a.idAlu AS aluno_id, a.nome, a.email 
               FROM aluno a 
               INNER JOIN turma t ON a.idTurma = t.idTurma
               WHERE t.idTurma = ?";

if ($stmt_alunos = $mysqli->prepare($sql_alunos)) {
    // Recebe o ID da turma via GET
    $stmt_alunos->bind_param('i', $_GET['id']);
    $stmt_alunos->execute();
    $result_alunos = $stmt_alunos->get_result();
} else {
    echo "Erro na consulta de alunos: " . $mysqli->error;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Turma</title>
    <style>
        /* Seu CSS */
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

      p{
        font-size: 1.3em;
      }

        .btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #0056b3; /* Azul mais escuro no hover */
}

strong {
    color: #007bff; /* Azul para destacar os rótulos */
}
    </style>
</head>
<body>
    <h1>Detalhes da Turma</h1>
    <p><strong>ID da Turma:</strong> <?php echo $turma_id; ?></p>
    <p><strong>Número da Turma:</strong> <?php echo $numero_turma; ?></p>
    <p><strong>Limite de Alunos:</strong> <?php echo $limite_alunos; ?></p>
    <p><strong>Tutor:</strong> <?php echo $tutor_nome; ?></p>

    <a href="?page=listarTurma" class="btn">Voltar</a>


</body>
</html>
