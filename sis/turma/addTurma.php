<?php
// Configurações de banco de dados
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Lógica de inserção de turma
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura dados do formulário
    $numeroTurma = $_POST['numero_turma'];
    $limiteAlunos = $_POST['limite_alunos'];
    $idTutor = $_POST['idTutor']; // Id do tutor selecionado
    $emails = $_POST['alunos']; // Array de e-mails dos alunos
    $nivel_acesso = $_POST['nivel_acesso'];

    // Verifica se o formulário foi preenchido corretamente
    if (empty($emails) || count($emails) == 0) {
        $_SESSION['mensagem'] = "Por favor, adicione pelo menos um aluno.";
        header('Location: ?page=AddTurma');
        exit;
    }

    $query = "SELECT COUNT(*) FROM tutor WHERE idTutor = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idTutor); // Substitua $idTutor pelo valor que você está passando.
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->free_result(); // Libera o resultado após o uso
    if ($count == 0) {
        die("Erro: O tutor associado não existe.");
    }

    // Inserir a turma
    $stmt = $conn->prepare("INSERT INTO turma (numero_turma, limite_alunos, idTutor) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $numeroTurma, $limiteAlunos, $idTutor);
    $stmt->execute();

    // Obter o ID da turma recém-criada
    $turmaId = $conn->insert_id;

    // Obter o ID da unidade de ensino associada ao tutor
    $stmt_tutor = $conn->prepare("SELECT unidade_ensino_id FROM tutor WHERE idTutor = ?");
    $stmt_tutor->bind_param("i", $idTutor); // Corrigido para usar $idTutor
    $stmt_tutor->execute();
    $stmt_tutor->store_result();

    if ($stmt_tutor->num_rows > 0) {
        $stmt_tutor->bind_result($unidadeEnsinoId);
        $stmt_tutor->fetch();
        $stmt_tutor->free_result(); // Libera o resultado após o uso
    } else {
        $_SESSION['mensagem'] = "Tutor não encontrado.";
        header('Location: ?page=AddTurma');
        exit;
    }

    // Verifique se unidade_ensino_id está associado corretamente
    if (is_null($unidadeEnsinoId)) {
        $_SESSION['mensagem'] = "O tutor não tem uma unidade de ensino associada.";
        header('Location: ?page=AddTurma');
        exit;
    }

    // Inserir os alunos na tabela 'aluno' com a turma e unidade de ensino associadas
    foreach ($emails as $email) {
        // Verificar se o e-mail já existe na tabela 'usuarios'
        $stmt_check = $conn->prepare("SELECT idusu FROM usuarios WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        // Se o aluno não existir, insere na tabela 'usuarios' e depois na tabela 'aluno'
        if ($stmt_check->num_rows == 0) {
            // Inserir aluno na tabela 'usuarios' com o nível de acesso 'ALUNO'
            $stmt_insert_usuario = $conn->prepare("INSERT INTO usuarios (nome, email, senha, nivel_acesso, foto) VALUES (?, ?, ?, ?, ?)");
            $nome = 'Aluno'; // Nome genérico, pode ser alterado
            $senhaHash = password_hash('Aluno@123', PASSWORD_DEFAULT); // Senha para os alunos
            $nivelAcesso = 'ALUNO';
            $foto = "../../img/semfoto.png";
            $stmt_insert_usuario->bind_param("sssss", $nome, $email, $senhaHash, $nivel_acesso, $foto);
            $stmt_insert_usuario->execute();
            
            $stmt_insert_usuario = $conn->prepare("INSERT INTO aluno (nome, email, senha, foto) VALUES (?, ?, ?, ?)");
            $nome = 'Aluno'; // Nome genérico, pode ser alterado
            $foto = "../../img/semfoto.png";
            $senhaHash = password_hash('Aluno@123', PASSWORD_DEFAULT); // Senha para os alunos
            $stmt_insert_usuario->bind_param("ssss", $nome, $email, $senhaHash, $foto);
            $stmt_insert_usuario->execute();

            // // Obter o ID do usuário recém-criado
            // $usuarioId = $conn->insert_id;

            // // Inserir o aluno na tabela 'aluno'
            // $stmt_insert_aluno = $conn->prepare("INSERT INTO aluno (idTurma, nome, email, unidade_ensino_id) VALUES (?, ?, ?, ?)");
            // $stmt_insert_aluno->bind_param("issi",  $turmaId, $nome, $email, $unidadeEnsinoId);
            // $stmt_insert_aluno->execute();
        } else {
            // Caso o aluno já exista
            $_SESSION['mensagem'] = "O aluno com o e-mail $email já está cadastrado.";
            header('Location: ?page=listarTurma');
            exit;
        }
    }

    $_SESSION['mensagem'] = "Turma e alunos cadastrados com sucesso!";
    header('Location: ?page=listarTurma');
    exit;
}

// Consulta para obter os tutores
$sql = "SELECT idTutor, nome FROM tutor";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Turma</title>
    <style>
        form {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
            padding: 20px 30px;
            box-sizing: border-box;
        }

        label {
            display: block;
            font-weight: bold;
            color: #2c3e50;
            margin-top: 15px;
        }

        input[type="text"],
        input[type="number"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #ccd1d9;
            border-radius: 4px;
            font-size: 14px;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #5dade2;
            box-shadow: 0 0 4px rgba(93, 173, 226, 0.5);
        }

        button {
            background-color: #5dade2;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 15px;
        }

        button:hover {
            background-color: #3498db;
        }

        button[type="submit"] {
            width: 100%;
            margin-top: 20px;
        }

        button[type="button"] {
            width: auto;
            margin-top: 10px;
        }

        .alunos-container {
            margin-top: 20px;
        }

        .aluno-input {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .aluno-input input {
            flex: 1;
        }

        .aluno-input button {
            background-color: #e74c3c;
            color: #fff;
            padding: 5px 10px;
            font-size: 12px;
        }

        .aluno-input button:hover {
            background-color: #c0392b;
        }

        p {
            text-align: center;
            color: #e74c3c;
            font-size: 14px;
        }

        .btn-voltar {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            text-align: center;
        }

        .btn-voltar:hover {
            background-color: #2980b9;
        }

        .btn-voltar:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.7);
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 10 10%22%3E%3Cpolygon points=%220,0 10,0 5,5%22 fill=%22%23bbb%22/%3E%3C/svg%3E') no-repeat right 10px center;
            background-size: 8px;
            padding-right: 30px;
        }
    </style>
</head>

<body>
    <h2>Adicionar Nova Turma</h2>

    <form method="POST">
        <label for="numero_turma">Número da Turma:</label>
        <input type="number" name="numero_turma" id="numero_turma" required>

        <label for="limite_alunos">Limite de Alunos:</label>
        <input type="number" name="limite_alunos" id="limite_alunos" required>

        <label for="idTutor">Selecionar Tutor:</label>
        <select name="idTutor" id="idTutor" required>
            <option value="">Selecione um Tutor</option>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <option value="<?= $row['idTutor']; ?>"><?= $row['nome']; ?></option>
            <?php } ?>
        </select>

        <label for="alunos">E-mails dos Alunos:</label>
        <div class="alunos-container" id="alunos-container">
            <input type="hidden" name="nivel_acesso" value="ALUNO">
            <div class="aluno-input">
                <input type="email" name="alunos[]" placeholder="E-mail do Aluno" required>
                <button type="button" onclick="adicionarAluno()">Adicionar</button>
            </div>
        </div>

        <button type="submit">Cadastrar Turma</button>
    </form>

    <button class="btn-voltar" onclick="window.location.href='?page=listarTurma'">Voltar</button>

    <script>
        function adicionarAluno() {
            const container = document.getElementById('alunos-container');
            const inputAluno = document.createElement('div');
            inputAluno.classList.add('aluno-input');
            inputAluno.innerHTML = `  
                <input type="email" name="alunos[]" placeholder="E-mail do Aluno" required> 
                <button type="button" onclick="removerAluno(this)">Remover</button> 
            `;
            container.appendChild(inputAluno);
        }

        function removerAluno(button) {
            button.parentElement.remove();
        }
    </script>
</body>

</html>