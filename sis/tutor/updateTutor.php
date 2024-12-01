<?php
// Verifica se o tutor está logado (idTutor precisa estar na sessão)
if (!isset($_SESSION['email'])) {
    die("Erro: Tutor não logado ou sessão inválida.");
}

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'tecnoinfo');

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $novo_nome = $_POST['nome']; // Novo nome do tutor
    $novo_email = $_POST['email']; // Novo e-mail do tutor
    $idTutor = $_GET['idTutor']; // ID do tutor logado

    // Atualizar o nome e o e-mail na tabela 'usuarios'
    $sql_usuario = "UPDATE usuarios SET nome = ?, email = ? WHERE idusu = (SELECT idUsu FROM tutor WHERE idTutor = ?)";
    $stmt_usuario = $conn->prepare($sql_usuario);
    $stmt_usuario->bind_param("ssi", $novo_nome, $novo_email, $idTutor);

    if ($stmt_usuario->execute()) {
        echo "Dados do usuário atualizados com sucesso!<br>";
    } else {
        echo "Erro ao atualizar dados do usuário: " . $conn->error . "<br>";
    }

    // Atualizar o nome e o e-mail na tabela 'tutor'
    $sql_tutor = "UPDATE tutor SET nome = ?, email = ? WHERE idTutor = ?";
    $stmt_tutor = $conn->prepare($sql_tutor);
    $stmt_tutor->bind_param("ssi", $novo_nome, $novo_email, $idTutor);

    if ($stmt_tutor->execute()) {
        echo "Dados do tutor atualizados com sucesso!<br>";
    } else {
        echo "Erro ao atualizar dados do tutor: " . $conn->error . "<br>";
    }

    // Fechar a conexão
    $conn->close();
} else {
    echo "Erro: Nenhum dado foi enviado.";
}
?>
