    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "tecnoinfo";
    $conn = new mysqli($servername, $username, $password, $database);


    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $nivel_dificuldade = $_POST['nivel_dificuldade'];

    // Inserindo a avaliação
    $stmt = $conn->prepare("INSERT INTO avaliacoes (titulo, descricao, nivel_dificuldade) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titulo, $descricao, $nivel_dificuldade);
    $stmt->execute();
    $avaliacao_id = $stmt->insert_id; // ID da avaliação recém-inserida

    // Inserindo as questões relacionadas
    $enunciados = $_POST['enunciado'];
    $opcoes_a = $_POST['opcao_a'];
    $opcoes_b = $_POST['opcao_b'];
    $opcoes_c = $_POST['opcao_c'];
    $opcoes_d = $_POST['opcao_d'];
    $respostas_corretas = $_POST['resposta_correta'];

    for ($i = 0; $i < count($enunciados); $i++) {
        $stmt = $conn->prepare("INSERT INTO questoes (avaliacao_id, enunciado, opcao_a, opcao_b, opcao_c, opcao_d, resposta_correta) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $avaliacao_id, $enunciados[$i], $opcoes_a[$i], $opcoes_b[$i], $opcoes_c[$i], $opcoes_d[$i], $respostas_corretas[$i]);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    echo "Avaliação adicionada com sucesso!";
    ?>
