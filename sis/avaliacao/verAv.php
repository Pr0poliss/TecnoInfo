<?php
$servername = "localhost"; // ou o endereço do servidor do banco de dados
$username = "root";
$password = "";
$database = "tecnoinfo";
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if (isset($_SESSION['email'])) {
    $nivel_acesso = $_SESSION['nivel_acesso'];
}

$avId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consulta a av com base no id;
$avQuery = $mysqli->query("SELECT * FROM avaliacoes WHERE id = $avId");
$av = $avQuery->fetch_assoc();

?>

<body>
    <?php if (isset($nivel_acesso) && $nivel_acesso == "ADMINISTRADOR"): ?>
 
        <!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da avaliação</title>
    <style>
         .btn-back {
            display: inline-block;
            margin: 20px;
            padding: 10px 20px;
            background-color: #2a9df4;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #1b7ac6;
        }

   

        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }

        .ul {
            list-style-type: none;
            padding: 0;
            margin: 10px 0;
        }

        .ul .li {
            font-size: 16px;
            background-color: #e6f2ff;
            padding: 8px;
            border-radius: 4px;
            margin: 4px 0;
            color: #2a9df4;
        }

        hr {
            border: 1px solid #e0e0e0;
            margin: 20px 0;
        }

        .question {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .question strong {
            color: #333;
        }
    </style>
</head>

<body>

    <?php if (isset($nivel_acesso) && $nivel_acesso == "ADMINISTRADOR"): ?>
        <a href="?page=listarAv" class="btn-back">Voltar</a>
        <center>
            <h1>Detalhes da Avaliação</h1>
        </center>
        <?php if ($av): ?>
            <h1><?php echo htmlspecialchars($av['titulo']); ?></h1>
            <p><strong>Descrição:</strong> <?php echo htmlspecialchars($av['descricao']); ?></p>
            <p><strong>Nível de Dificuldade:</strong> <?php echo htmlspecialchars($av['nivel_dificuldade']); ?></p>

            <bod?php
    <?php
            $stmt = $mysqli->prepare("SELECT enunciado, opcao_a, opcao_b, opcao_c, opcao_d, resposta_correta FROM questoes WHERE avaliacao_id = ?");
            $stmt->bind_param("i", $avId);
            $stmt->execute();
            $stmt->bind_result($enunciado, $opcao_a, $opcao_b, $opcao_c, $opcao_d, $resposta_correta);
?>
<?php
            echo "<h2>Questões:</h2>";
            while ($stmt->fetch()) {
                echo "<p><strong>Enunciado:</strong> " . htmlspecialchars($enunciado) . "</p>";
                echo "<ul>";
                echo "<p style='font-size: 16px; background-color: #e6f2ff; padding: 8px; border-radius: 4px; margin: 4px 0; color: #2a9df4;'>A) " . htmlspecialchars($opcao_a) . "</p>";
                echo "<p style='font-size: 16px; background-color: #e6f2ff; padding: 8px; border-radius: 4px; margin: 4px 0; color: #2a9df4;'>B) " . htmlspecialchars($opcao_b) . "</p>";
                echo "<p style='font-size: 16px; background-color: #e6f2ff; padding: 8px; border-radius: 4px; margin: 4px 0; color: #2a9df4;'>C) " . htmlspecialchars($opcao_c) . "</p>";
                echo "<p style='font-size: 16px; background-color: #e6f2ff; padding: 8px; border-radius: 4px; margin: 4px 0; color: #2a9df4;'>D) " . htmlspecialchars($opcao_d) . "</p>";
                echo "</ul>";
                echo "<p><strong>Resposta Correta:</strong> " . htmlspecialchars($resposta_correta) . "</p>";
                echo "<hr>";
            }
            $stmt->close();
            
            ?>
        <?php else: ?>
            <p>Avaliação não encontrada.</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Acesso negado. Você não tem permissão para visualizar esta página.</p>
    <?php endif; ?>
      





    <?php elseif ($nivel_acesso == "ALUNO"): ?>
        <style>
        .btn-back {
            display: inline-block;
            margin: 20px;
            padding: 10px 20px;
            background-color: #2a9df4;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #1b7ac6;
        }

        .question {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .question p {
            font-size: 1.2em;
            line-height: 1.5em;
        }

        .options {
            margin-left: 20px;
            padding: 10px 0;
        }

        label {
            display: block;
            font-size: 1.1em;
            margin-bottom: 10px;
            color: #333;
        }

        .result {
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }

        .correct {
            color: green;
        }

        .incorrect {
            color: red;
        }

        .btn, .btn-voltar {
            display: inline-block;
            background-color: #0056b3;
            color: white;
            text-align: center;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.1em;
            margin: 20px auto;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover, .btn-voltar:hover {
            background-color: #004494;
        }

    </style>
        <?php
    $avQuery = $mysqli->query("SELECT * FROM avaliacoes WHERE id = $avId");
    $questaoQuery = $mysqli->query("SELECT * FROM questoes WHERE avaliacao_id = $avId");

    $av = $avQuery->fetch_assoc();
    $questoes = [];
    while ($questao = $questaoQuery->fetch_assoc()) {
        $questoes[] = $questao;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $respostas = $_POST['resposta'];
        $resultado = [];
        $acertos = 0;

        foreach ($questoes as $index => $questao) {
            $resultado[$index] = [
                'enunciado' => $questao['enunciado'],
                'resposta_correta' => $questao['resposta_correta'],
                'resposta_aluno' => isset($respostas[$index]) ? $respostas[$index] : null,
                'acertou' => (isset($respostas[$index]) && $respostas[$index] === $questao['resposta_correta'])
            ];

            if ($resultado[$index]['acertou']) {
                $acertos++;
            }
        }
    }
    ?>

    <form method="post" action="">
        <?php foreach ($questoes as $index => $questao): ?>
            <div class="question">
                <p><strong><?php echo htmlspecialchars($questao['enunciado']); ?></strong></p>
                <div class="options">
                    <label><input type="radio" name="resposta[<?php echo $index; ?>]" value="a"> A) <?php echo htmlspecialchars($questao['opcao_a']); ?></label>
                    <label><input type="radio" name="resposta[<?php echo $index; ?>]" value="b"> B) <?php echo htmlspecialchars($questao['opcao_b']); ?></label>
                    <label><input type="radio" name="resposta[<?php echo $index; ?>]" value="c"> C) <?php echo htmlspecialchars($questao['opcao_c']); ?></label>
                    <label><input type="radio" name="resposta[<?php echo $index; ?>]" value="d"> D) <?php echo htmlspecialchars($questao['opcao_d']); ?></label>
                </div>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="btn">Enviar Respostas</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Resultados</h2>
        <p class="result">Você acertou <?php echo $acertos; ?> de <?php echo count($questoes); ?> questões.</p>

        <?php foreach ($resultado as $index => $res): ?>
            <div class="question <?php echo $res['acertou'] ? 'correct' : 'incorrect'; ?>">
                <p><strong><?php echo htmlspecialchars($res['enunciado']); ?></strong></p>
                <p><strong>Sua Resposta:</strong> <?php echo htmlspecialchars($res['resposta_aluno']); ?></p>
                <p><strong>Resposta Correta:</strong> <?php echo htmlspecialchars($res['resposta_correta']); ?></p>
            </div>
        <?php endforeach; ?>
        <a href="?page=listarAv" class="btn-voltar">Voltar</a>
    <?php endif; ?>

            <?php endif; ?>
</body>

