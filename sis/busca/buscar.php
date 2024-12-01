<?php
$searchTerm = $_GET['search'] ?? '';

if (!empty($searchTerm)) {
    // Conectar ao banco e fazer a consulta
    // Exemplo: Buscar em cursos
    $query = "SELECT * FROM cursos WHERE nome LIKE ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute(["%$searchTerm%"]);

    if ($stmt->rowCount() > 0) {
        echo "<h2>Resultados de busca para: " . htmlspecialchars($searchTerm) . "</h2>";
        while ($curso = $stmt->fetch()) {
            echo "<p>" . htmlspecialchars($curso['nome']) . "</p>";
        }
    } else {
        echo "<p>Nenhum resultado encontrado para '" . htmlspecialchars($searchTerm) . "'</p>";
    }
} else {
    echo "<p>Digite um termo para pesquisar.</p>";
}
?>
