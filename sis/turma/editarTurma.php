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

    // Verifica se a turma foi especificada pela URL
    if (isset($_GET['idTurma'])) {
        $turmaId = $_GET['idTurma'];

        // Consulta para obter os dados da turma
        $sql_turma = "SELECT * FROM turma WHERE idTurma = ?";
        $stmt_turma = $conn->prepare($sql_turma);
        $stmt_turma->bind_param("i", $turmaId);
        $stmt_turma->execute();
        $result_turma = $stmt_turma->get_result();

        if ($result_turma->num_rows > 0) {
            $turma = $result_turma->fetch_assoc();
            $numeroTurma = $turma['numero_turma'];
            $limiteAlunos = $turma['limite_alunos'];
            $idTutor = $turma['idTutor'];
        } else {
            die("Turma não encontrada.");
        }
    } else {
        die("ID da turma não especificado.");
    }

    // Lógica de atualização de turma
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Captura dados do formulário
        $numeroTurma = $_POST['numero_turma'];
        $limiteAlunos = $_POST['limite_alunos'];
        $idTutor = $_POST['idTutor']; // Id do tutor selecionado
        $emails = $_POST['alunos']; // Array de e-mails dos alunos

        // Atualiza a turma
        $stmt_update_turma = $conn->prepare("UPDATE turma SET numero_turma = ?, limite_alunos = ?, idTutor = ? WHERE idTurma = ?");
        $stmt_update_turma->bind_param("iiii", $numeroTurma, $limiteAlunos, $idTutor, $turmaId);
        $stmt_update_turma->execute();

        // Atualiza os alunos (após remover os antigos)
        $stmt_delete_alunos = $conn->prepare("DELETE FROM aluno WHERE idTurma = ?");
        $stmt_delete_alunos->bind_param("i", $turmaId);
        $stmt_delete_alunos->execute();

        foreach ($emails as $email) {
            // Inserir os alunos na tabela 'aluno' com a turma associada
            $stmt_insert_aluno = $conn->prepare("INSERT INTO aluno (idTurma, email) VALUES (?, ?)");
            $stmt_insert_aluno->bind_param("is", $turmaId, $email);
            $stmt_insert_aluno->execute();
        }

        $_SESSION['mensagem'] = "Turma e alunos atualizados com sucesso!";
        header('Location: ?page=listarTurma');
        exit;
    }

    // Consulta para obter os tutores
    $sql = "SELECT idTutor, nome FROM tutor";
    $result = $conn->query($sql);

    // Consulta para obter os alunos associados à turma
    $sql_alunos = "SELECT email FROM aluno WHERE idTurma = ?";
    $stmt_alunos = $conn->prepare($sql_alunos);
    $stmt_alunos->bind_param("i", $turmaId);
    $stmt_alunos->execute();
    $result_alunos = $stmt_alunos->get_result();
    $emailsAlunos = [];
    while ($row = $result_alunos->fetch_assoc()) {
        $emailsAlunos[] = $row['email'];
    }
    ?>

    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Turma</title>
        <style>
            /* CSS mantido do addTurma.php */
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
        <h2>Editar Turma</h2>

        <form method="POST">
            <label for="numero_turma">Número da Turma:</label>
            <input type="number" name="numero_turma" id="numero_turma" value="<?= $numeroTurma ?>" required>

            <label for="limite_alunos">Limite de Alunos:</label>
            <input type="number" name="limite_alunos" id="limite_alunos" value="<?= $limiteAlunos ?>" required>

            <label for="idTutor">Selecionar Tutor:</label>
            <select name="idTutor" id="idTutor" required>
                <option value="">Selecione um Tutor</option>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <option value="<?= $row['idTutor']; ?>" <?= $row['idTutor'] == $idTutor ? 'selected' : ''; ?>><?= $row['nome']; ?></option>
                <?php } ?>
            </select>

            <label for="alunos">E-mails dos Alunos:</label>
            <div class="alunos-container" id="alunos-container">
                <input type="hidden" name="alunos[]" value="">
                <?php foreach ($emailsAlunos as $email) { ?>
                    <div class="aluno-input">
                        <input type="email" name="alunos[]" value="<?= $email ?>" required>
                        <button type="button" class="remove-aluno">Remover</button>
                    </div>
                <?php } ?>
            </div>
            <button type="button" id="add-aluno">Adicionar Aluno</button>

            <button type="submit">Atualizar</button>
        </form>

        <button class="btn-voltar" onclick="window.location.href='?page=listarTurma'">Voltar</button>

        <script>
            document.getElementById('add-aluno').addEventListener('click', function() {
                var container = document.getElementById('alunos-container');
                var inputDiv = document.createElement('div');
                inputDiv.classList.add('aluno-input');
                inputDiv.innerHTML = `
                    <input type="email" name="alunos[]" required>
                    <button type="button" class="remove-aluno">Remover</button>
                `;
                container.appendChild(inputDiv);
            });

            document.getElementById('alunos-container').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-aluno')) {
                    e.target.parentNode.remove();
                }
            });
        </script>
    </body>

    </html>
