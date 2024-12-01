<?php
// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "", "tecnoinfo");

if ($mysqli->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Insere um novo usuário com o email fornecido
        $stmt = $mysqli->prepare("INSERT INTO aluno (email, nome) VALUES (?, 'Novo Aluno')");
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            echo "<p>Usuário cadastrado com sucesso! Email: $email</p>";
        } else {
            echo "<p>Erro ao cadastrar usuário: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Email inválido.</p>";
    }
}

$mysqli->close();
