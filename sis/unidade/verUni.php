<?php
// Conexão com o banco de dados
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

// Verificação de erro na conexão
if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Verifica se o ID foi passado pela URL
if (isset($_GET['idUni'])) {
    $idUni = intval($_GET['idUni']); // Obtém o ID da unidade de ensino

    // Consulta SQL para buscar os detalhes da unidade de ensino
    $result = $mysqli->query("SELECT * FROM unidade_ensino WHERE idUni = $idUni");

    // Verifica se a consulta retornou resultados
    if ($result->num_rows > 0) {
        // Obtém a unidade de ensino
        $row = $result->fetch_assoc();
    } else {
        echo "Unidade de ensino não encontrada.";
        exit();
    }
} else {
    echo "ID da unidade de ensino não fornecido.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Unidade de Ensino</title>
    <style>
        /* Estilos para a página */
     
        .details {
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .details h2 {
            color: #19234E;
        }
        .details p {
            font-size: 18px;
            color: #555;
        }
        .details img {
            max-width: 150px;
            margin: 10px 0;
        }
        .btn-back {
            padding: 10px 20px;
            background-color: #19234E;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .btn-back:hover {
            background-color: #2365a3;
        }
    </style>
</head>
<body>

    <h1>Detalhes da Unidade de Ensino</h1>

    <div class="details">
        <h2><?php echo $row['nome']; ?></h2>

        <!-- Exibe a foto da unidade de ensino, se houver -->
        <?php if ($row['foto']): ?>
            <img src="uploads/<?php echo $row['foto']; ?>" alt="Foto da unidade de ensino">
        <?php endif; ?>

        <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
        <p><strong>CNPJ:</strong> <?php echo $row['cnpj']; ?></p>
        <p><strong>Telefone:</strong> <?php echo $row['tel']; ?></p>
        <p><strong>Inscrição Estadual:</strong> <?php echo $row['insc_est']; ?></p>
        <p><strong>Nível de Ensino:</strong> <?php echo $row['nivel_ensino']; ?></p>
    </div>

    <a href="?page=listarUni" class="btn-back">Voltar para a Lista</a>


</body>
</html>