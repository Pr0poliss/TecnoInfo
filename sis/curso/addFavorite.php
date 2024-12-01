<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se o usuário está autenticado
    if (isset($_SESSION['email'])) {
        $cod_curso = intval($_POST['cod_curso']);
        $email = $_SESSION['email'];

        // Inserir o curso na tabela de favoritos
        $stmt = $mysqli->prepare("INSERT INTO favoritos (email, cod_curso) VALUES (?, ?)");
        $stmt->bind_param("si", $email, $cod_curso);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao adicionar aos favoritos.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuário não autenticado.']);
    }
}
$mysqli->close();
?>
