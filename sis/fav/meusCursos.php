<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$usuarioId = $_SESSION['id_usuario'];

// Consulta para obter os cursos favoritos do usuário
$favoritosQuery = $mysqli->query("
    SELECT c.cod_curso, c.nome, c.capa, c.ch 
    FROM favoritos f
    JOIN curso c ON f.curso_id = c.cod_curso
    WHERE f.usuario_id = $usuarioId
");

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Cursos Favoritos</title>
    <style>
        .cursos-favoritos {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .curso {
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px;
            padding: 10px;
            width: calc(33% - 20px); /* Três cursos por linha */
        }
        .capa {
            border: 2px solid black;
            width: 100%;
            height: 200px;
            overflow: hidden;
            margin-bottom: 10px;
            border-radius: 10px;
        }
        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        h2 {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <a href="?page=listarCurso" class="btn-back">Voltar</a>
    <h1>Meus Cursos Favoritos</h1>

    <div class="cursos-favoritos">
        <?php if ($favoritosQuery->num_rows > 0): ?>
            <?php while ($curso = $favoritosQuery->fetch_assoc()): ?>
                <div class="curso">
                    <div class="capa">
                        <img src="<?php echo htmlspecialchars($curso['capa']); ?>" alt="Capa do Curso">
                    </div>
                    <h2><?php echo htmlspecialchars($curso['nome']); ?></h2>
                    <p><strong>Carga Horária:</strong> <?php echo htmlspecialchars($curso['ch']); ?> horas</p>
                    <a href="?page=verCurso&cod_curso=<?php echo $curso['cod_curso']; ?>" class="btn-ver-curso">Ver Curso</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Você ainda não tem cursos favoritos.</p>
        <?php endif; ?>
    </div>

</body>
</html>

<?php
$mysqli->close();
?>
