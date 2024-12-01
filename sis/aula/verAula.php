<?php
// Configuração de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "tecnoinfo";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se o ID foi passado via GET (usando GET em vez de POST para exibição de detalhes)
if (isset($_GET['cod_aula'])) {
    $id = $_GET['cod_aula'];

    // Prevenir SQL Injection
    $id = $conn->real_escape_string($id);

    // Consultar o registro com base no ID
    $sql = "SELECT * FROM aula WHERE cod_aula = '$id'";
    $result = $conn->query($sql);

    // Verificar se encontrou o registro
    if ($result->num_rows > 0) {
        // Recuperar os dados
        $cep = $result->fetch_assoc();
    } else {
        echo "Nenhum registro encontrado.";
        exit;
    }
} else {
    echo "ID não fornecido.";
    exit;
}

$sql_module = "SELECT COUNT(*) as total_aulas FROM aula WHERE cod_modulo = (SELECT cod_modulo FROM aula WHERE cod_aula = '$id')";
$result_module = $conn->query($sql_module);
$module_data = $result_module->fetch_assoc();
$total_aulas = $module_data['total_aulas'];

// Consultar a próxima aula
$sql_next = "SELECT cod_aula FROM aula WHERE cod_modulo = (SELECT cod_modulo FROM aula WHERE cod_aula = '$id') AND cod_aula > '$id' ORDER BY cod_aula ASC LIMIT 1";
$result_next = $conn->query($sql_next);
$next_aula = $result_next->fetch_assoc();
$next_aula_id = $next_aula ? $next_aula['cod_aula'] : null;

if (isset($_SESSION['email'])) {
    $nivel_acesso = $_SESSION['nivel_acesso'];
}

// Fechar a conexão
$conn->close();
?>

<body>
    <style>
        html,
        body {
            height: 100%;
            width: 100%;
        }

        p {
            font-size: 18px;
            margin-bottom: 15px;
        }

        strong {
            color: #007bff;
            /* Azul para destacar os rótulos */
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
            /* Azul mais escuro no hover */
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #6c757d;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>

    <body>
        <?php if ($nivel_acesso == "ADM") { ?>

            <h1>Detalhes da aula</h1>
            <p><strong>ID:</strong> <?= htmlspecialchars($cep['cod_aula']); ?></p>
            <p><strong>Título:</strong> <?= htmlspecialchars($cep['titulo_aula']); ?></p>
            <p><strong>Introdução:</strong> <?= htmlspecialchars($cep['intro_aula']); ?></p>
            <p><strong>Conteúdo:</strong> <?= htmlspecialchars($cep['conteudo_aula']); ?></p>
            <p><strong>Exercícios:</strong> <?= htmlspecialchars($cep['ex_aula']); ?></p>

            <a href="?page=listarAula" class="btn">Voltar</a>
        <?php } elseif ($nivel_acesso == "ALUNO") {

            // Conectar ao banco de dados
            $mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

            // Verifique se a conexão foi bem-sucedida
            if ($mysqli->connect_error) {
                die("Falha na conexão: " . $mysqli->connect_error);
            }

            // ID da aula (suponha que o ID venha da URL ou seja passado por parâmetro)
            $cod_aula = isset($_GET['cod_aula']) ? intval($_GET['cod_aula']) : 0;

            if ($cod_aula > 0) {
                // Consulta para obter as informações da aula
                $query = "SELECT titulo_aula, intro_aula, conteudo_aula, ex_aula, video_url FROM aula WHERE cod_aula = ?";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param('i', $cod_aula);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $aula = $result->fetch_assoc();
                    $titulo_aula = $aula['titulo_aula'];
                    $intro_aula = $aula['intro_aula'];
                    $conteudo_aula = $aula['conteudo_aula'];
                    $ex_aula = $aula['ex_aula'];
                    $video_url = $aula['video_url'];

                    // Verifica se o link é do YouTube e converte para o formato embed
                    if (preg_match('/v=([a-zA-Z0-9_-]+)/', $video_url, $matches)) {
                        $video_id = $matches[1];
                        $embed_link = "https://www.youtube.com/embed/" . $video_id;
                    } else {
                        // Caso o link não seja do YouTube, ou algum erro
                        $embed_link = null;
                    }
                } else {
                    echo "Aula não encontrada.";
                    exit;
                }
            } else {
                echo "ID da aula inválido.";
                exit;
            }
        ?>

            <!DOCTYPE html>
            <html lang="pt-br">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php echo htmlspecialchars($titulo_aula); ?></title>
            </head>

            <body>

                <style>
                    .intro {
                        padding: 20px;
                        margin-top: 30px;

                        border: 1px solid black;
                        border-radius: 20px;
                        box-shadow: 0 0 15px grey;
                    }

                    .expand-btn {
                        color: blue;
                        cursor: pointer;
                        text-align: center;
                        margin-top: 10px;
                    }

                    .intro,
                    .conteudo,
                    .exercicios {
                        padding: 20px;
                        margin: 20px auto;
                        border: 1px solid black;
                        border-radius: 10px;
                        box-shadow: 0 0 10px grey;
                        max-width: 1200px;
                        background-color: #f9f9f9;
                    }

                    .exercicios {
                        margin-bottom: 20px;
                    }
                </style>


                <title class="tit_aula"><?php echo htmlspecialchars($titulo_aula); ?></title>
                <style>
                    /* Estilos gerais */
                    .intro,
                    .conteudo,
                    .exercicios,
                    .div-conteudo {
                        padding: 20px;
                        margin: 20px auto;

                        border-radius: 10px;

                        max-width: 1200px;

                    }

                    .exercicios {
                        margin-bottom: 20px;
                    }

                    /* Estilo para a impressão */
                    @media print {
                        body * {
                            visibility: hidden;
                            /* Esconde todos os elementos */
                        }

                        .exercicios,
                        .exercicios * {
                            visibility: visible;
                            /* Mostra apenas os exercícios */
                        }

                        .exercicios {
                            position: absolute;
                            /* Remove do fluxo normal para evitar espaços */
                            left: 0;
                            top: 0;
                            /* Posiciona no canto superior esquerdo da página */
                        }
                    }

                    /* Outros estilos que você já possui */
                    .expand-btn {
                        color: white;
                        cursor: pointer;
                        text-align: center;
                        margin-top: 10px;
                        background-color: #0056b3;
                        padding: 7px;
                        width: 100px;
                        margin: 20px auto 0 auto;
                        border-radius: 10px;
                    }

                    .tit_aula,
                    .detalhe {
                        text-align: center;
                    }

                    .hr {
                        width: 100%;
                        height: 1px;
                        background-color: gray;
                        margin: 20px 0;
                    }
                </style>
                </head>

                <body>

                    <div class="titulo-container">
                        <h1><?php echo htmlspecialchars($titulo_aula); ?></h1>
                    </div>

                    <h2 class="detalhe">Vídeo da Aula:</h2>
                    <?php if ($embed_link): ?>
                        <div class="video" style="display:flex; justify-content:center;">
                            <iframe width="960" height="490" src="<?php echo $embed_link; ?>" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    <?php else: ?>
                        <p>Vídeo não disponível ou link inválido.</p>
                    <?php endif; ?>

                    <div class="intro">
                        <h2>Introdução da Aula:</h2>
                        <p><?php echo nl2br(htmlspecialchars($intro_aula)); ?></p>
                    </div>

                    <!-- Conteúdo -->
                    <div class="div-conteudo">
                        <div class="hr"></div>
                        <h2>Conteúdo da Aula:</h2>
                        <div id="conteudo-text"
                            style="max-height: 150px; overflow: hidden; transition: max-height 0.4s ease;">
                            <p><?php echo nl2br(htmlspecialchars($conteudo_aula)); ?></p>
                        </div>
                        <div class="expand-btn" onclick="toggleContent()">Ler mais</div>
                        <div class="hr"></div>
                    </div>

                    <div class="exercicios">
                        <h2>Exercícios:</h2>
                        <p><?php echo nl2br(htmlspecialchars($cep['ex_aula'])); ?></p>
                        <button onclick="function imprimirExercicios() {
        var exercicios = document.querySelector('.exercicios');
        var originalDisplay = exercicios.style.display;
        // Exibe os exercícios para a impressão
        exercicios.style.display = 'block';

        window.print();

        // Restaura o display original após a impressão
        exercicios.style.display = originalDisplay;
    }"
                            style="margin-top: -30px; float: right; padding: 10px 20px; background-color: #0056b3; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            Imprimir Exercícios
                        </button>

                    </div>

                    <?php if ($next_aula_id) { ?>
                        <a href="?page=verAula&cod_aula=<?= $next_aula_id ?>" class="btn right">Próxima Aula</a>
                    <?php } else { ?>
                        <a href="?page=listarCurso" class="btn right">Finalizar Curso</a>
                    <?php } ?>
                    <a href="javascript:history.back()" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; transition: background-color 0.3s; margin-top: 20px;">Voltar</a>


                    <title><?php echo htmlspecialchars($titulo_aula); ?></title>



                    <style>
                        /* Seus estilos existentes */
                        .btn {
                            display: inline-block;
                            padding: 10px 20px;
                            background-color: #007bff;
                            color: white;
                            text-decoration: none;
                            border-radius: 5px;
                            margin-top: 20px;
                            transition: background-color 0.3s;
                        }

                        .btn:hover {
                            background-color: #0056b3;
                            /* Azul mais escuro no hover */
                        }
                    </style>

                    <script>
                        function imprimirExercicios() {
                            var exercicios = document.querySelector('.exercicios');
                            var originalDisplay = exercicios.style.display;
                            // Exibe os exercícios para a impressão
                            exercicios.style.display = 'block';

                            window.print();

                            // Restaura o display original após a impressão
                            exercicios.style.display = originalDisplay;
                        }

                        function toggleContent() {
                            var conteudoText = document.getElementById("conteudo-text");
                            var expandBtn = document.querySelector(".expand-btn");
                            if (conteudoText.style.maxHeight == "none") {
                                conteudoText.style.maxHeight = "150px";
                                expandBtn.innerHTML = "Expandir";
                            } else {
                                conteudoText.style.maxHeight = "none";
                                expandBtn.innerHTML = "Recolher";
                            }
                        }
                    </script>

                <?php
            }
                ?>