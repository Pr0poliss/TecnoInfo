<?php 
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

// Verificar se houve erro na conexão
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Senha com hash
    $autenticidade = $_POST['autenticidade'];
    $nivel_acesso = $_POST['nivel_acesso'];

    // Início da transação para garantir integridade de dados
    $mysqli->begin_transaction();

    try {
        // Inserção na tabela usuarios
        $stmt_usuario = $mysqli->prepare("INSERT INTO usuarios (nome, email, senha, nivel_acesso) VALUES (?, ?, ?, ?)");
        if (!$stmt_usuario) {
            die("Erro na preparação da consulta SQL para 'usuarios': " . $mysqli->error);  // Exibe o erro SQL
        }
        $stmt_usuario->bind_param("ssss",   $nome, $email, $senha, $nivel_acesso);
        $stmt_usuario->execute();

        // Pega o ID do último usuário inserido
        $usuario_id = $stmt_usuario->insert_id;

        // Verifique se o usuario_id foi obtido corretamente
        if ($usuario_id <= 0) {
            throw new Exception("Erro: o ID do usuário não foi gerado corretamente. ID retornado: $usuario_id");
        }

        // Agora inserimos na tabela tutor
        $foto = 'img/user/semfoto.png'; // Foto padrão

        // Verifica se foi enviado um arquivo de foto
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $fotoNome = $_FILES['foto']['name'];
            $fotoTmp = $_FILES['foto']['tmp_name'];
            $extensao = pathinfo($fotoNome, PATHINFO_EXTENSION);

            // Define o caminho para salvar a foto
            $fotoNovoNome = uniqid() . '.' . $extensao;
            $fotoDestino = '../img/user/' . $fotoNovoNome;

            // Mover o arquivo para o diretório 'uploads'
            if (move_uploaded_file($fotoTmp, $fotoDestino)) {
                $foto = $fotoDestino; // Atualiza o caminho da foto
            }
        }

        // Verifique se o campo CPF não está vazio ou nulo
        if (empty($cpf)) {
            throw new Exception("O CPF não pode estar vazio.");
        }

        // Inserção na tabela tutor (com a chave estrangeira 'usuario_id')
        $stmt_tutor = $mysqli->prepare("INSERT INTO tutor (idUsu, nome, cpf, email, senha, autenticidade, foto) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if (!$stmt_tutor) {
            throw new Exception("Erro na preparação da consulta SQL para 'tutor': " . $mysqli->error);  // Exibe o erro SQL
        }

        // Bind dos parâmetros para a tabela tutor
        $stmt_tutor->bind_param("issssss", $usuario_id, $nome, $cpf, $email, $senha, $autenticidade, $foto);

        // Executa a consulta para inserir o tutor
        if ($stmt_tutor->execute()) {
            if ($stmt_tutor->affected_rows > 0) {
                // Inserção bem-sucedida
                echo "Tutor inserido com sucesso!";
            } else {
                // Caso nenhuma linha tenha sido afetada, algo deu errado
                throw new Exception("Erro: Nenhuma linha afetada na tabela 'tutor'.");
            }
        } else {
            // Caso falhe a execução
            throw new Exception("Erro ao executar a consulta para 'tutor': " . $stmt_tutor->error);
        }

        // Commit da transação (se tudo deu certo)
        $mysqli->commit();

        // Redirecionar após o sucesso
        echo "<script> setTimeout(function() {window.location.href = '?page=listarTutor';}, 1); // redireciona após 1.5 segundos</script>";
    } catch (Exception $e) {
        // Caso ocorra um erro, desfaz as alterações
        $mysqli->rollback();
        echo "Erro ao registrar o tutor: " . $e->getMessage();
    }
}
?>
