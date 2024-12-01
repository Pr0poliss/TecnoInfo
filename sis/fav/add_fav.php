<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Verifica se a sessão está ativa e se o ID do usuário está definido
if (!isset($_SESSION['nivel_acesso'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não logado.']);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
$cursoId = intval($data['curso_id']);
$usuarioId = $_SESSION['id_usuario'];

// Adiciona o curso à tabela de favoritos
$stmt = $mysqli->prepare("INSERT INTO favoritos (usuario_id, curso_id) VALUES (?, ?)");
$stmt->bind_param('ii', $usuarioId, $cursoId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao adicionar aos favoritos.']);
}

$stmt->close();
$mysqli->close();
?>
