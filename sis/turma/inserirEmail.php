<?php
// Configurações de banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "tecnoinfo";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Lógica para inserir uma turma
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura dados do formulário
    $email = $_POST['email'];
    // Validações básicas
    if (empty($email)) {
        $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios!";
        header('Location: ?page=AddTurma');
        exit;
    }

    // Insere a turma no banco de dados
    $stmt = $conn->prepare("INSERT INTO aluno(id, usuario_id, nome, foto, email, senha) VALUES (?,?,?,?, ?, ?)");
    $stmt->bind_param("iii", $email);

    if ($stmt->execute()) {
        // ID da turma recém-criada
        $turmaId = $conn->insert_id;


        if ($stmt_tutor->num_rows > 0) {
            $stmt_tutor->bind_result($unidadeEnsinoId);
            $stmt_tutor->fetch();

            // Agora, associa todos os alunos existentes à turma e à unidade de ensino
            $queryAlunos = "SELECT id, email FROM aluno"; // Seleciona todos os alunos cadastrados
            $resultAlunos = $conn->query($queryAlunos);

            if ($resultAlunos->num_rows > 0) {
                while ($row = $resultAlunos->fetch_assoc()) {
                    $alunoId = $row['id'];

                    // Associa o aluno à turma e a unidade de ensino do tutor
                    $stmtAlunoTurma = $conn->prepare("INSERT INTO turma_aluno (turma_id, aluno_id, unidade_ensino_id) VALUES (?, ?, ?)");
                    $stmtAlunoTurma->bind_param("iii", $turmaId, $alunoId, $unidadeEnsinoId);
                    $stmtAlunoTurma->execute();
                    $stmtAlunoTurma->close();
                }

                $_SESSION['mensagem'] = "Turma cadastrada e todos os alunos associados com sucesso!";
                echo "<script> setTimeout(function() {window.location.href = '?page=listarTurma';}, 1);</script>";
            } else {
                $_SESSION['mensagem'] = "Não há alunos cadastrados no sistema.";
                header('Location: ?page=AddTurma');
            }
        } else {
            $_SESSION['mensagem'] = "Tutor não encontrado.";
            header('Location: ?page=AddTurma');
        }
    } else {
        $_SESSION['mensagem'] = "Erro ao inserir turma: " . $stmt->error;
        header('Location: ?page=listarTurma');
    }

    $stmt->close();
    $conn->close();
}
?>
