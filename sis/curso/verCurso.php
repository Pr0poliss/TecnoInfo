<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

if (isset($_SESSION['email'])) {
    $nivel_acesso = $_SESSION['nivel_acesso'];
}

$cursoId = isset($_GET['cod_curso']) ? intval($_GET['cod_curso']) : 0;

// Consulta o curso com base no cod_curso
$cursoQuery = $mysqli->query("SELECT * FROM curso WHERE cod_curso = $cursoId");
$curso = $cursoQuery->fetch_assoc();

$modulosQuery = $mysqli->query("SELECT * FROM modulo WHERE cod_curso = $cursoId");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Curso</title>
    <style>
        .pai {
            margin-top: 100px;
            display: flex;
            float: left;
        }

        .module {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .aula {
            margin-top: 10px;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
        }

        .btn {
            background-color: #19234E;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            padding: 8px 12px;
            /* position: absolute; */
            float: right;
        }

        .btn:hover {
            background-color: #2365a3;
        }

        .btn-back {
            background-color: #19234E;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            padding: 8px 12px;
            position: absolute;
            float: left;
        }

        .btn-back:hover {
            background-color: #2365a3;
        }

        .capa {
            border: 2px solid black;
            width: 100%;
            max-height: 500px;
            overflow: hidden;
            margin: 50px 0;
            border-radius: 20px;
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Estilo de layout em formato de tabela */
        .tabela-modulos {
            display: flex;
            flex-direction: column;
            gap: 10px;
            /* Espaçamento entre módulos */
        }

        /* Cada linha de módulo */
        .linha-modulo {
            display: flex;
            flex-direction: column;
            background-color: #e0ecff;
            /* Azul claro */
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Cabeçalho do módulo */
        .modulo-titulo {
            background-color: #4f72ff;
            /* Azul mais escuro */
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }

        .modulo-titulo h2 {
            margin: 0;
        }

        /* Botão de expandir/recolher */
        .toggle {
            background-color: #fff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .toggle:hover {
            background-color: #f0f0f0;
        }

        /* Seções de aulas (inicialmente ocultas) */
        .aulas {
            display: none;
            background-color: #f5f9ff;
            /* Cor clara para a área das aulas */
            padding: 15px;
            border-top: 1px solid #ddd;
        }

        /* Lista de aulas */
        .aulas ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .aulas li {
            padding: 10px;
            background-color: #fff;
            margin-bottom: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
            cursor: pointer;
        }

        .aulas li:hover {
            background-color: #eef3ff;
            /* Efeito hover nas aulas */
        }

        /* Estilos adicionais */
        button.toggle:before {
            content: '\25BC';
            /* Seta para baixo */
            font-size: 18px;
        }

        button.toggle.expandido:before {
            content: '\25B2';
            /* Seta para cima */
        }
    </style>
</head>

<body>

    <?php if (isset($nivel_acesso) && $nivel_acesso == "ADMINISTRADOR"): ?>
        <a href="?page=listarCurso" class="btn-back">Voltar</a>
        <center>
            <h1>Detalhes do Curso</h1>
        </center>
        <?php if ($curso): ?>
            <figure class="capa">
                <!-- Exibindo a capa do curso -->
                <img src="<?php echo htmlspecialchars($curso['capa']); ?>" alt="Capa do Curso">
            </figure>

            <h2> Nome do curso: <?php echo htmlspecialchars($curso['nome']); ?></h2>
            <p><strong>Carga Horária:</strong> <?php echo htmlspecialchars($curso['ch']); ?> horas</p>

            <?php while ($modulo = $modulosQuery->fetch_assoc()): ?>
                <div class="pai">
                    <div class="module">
                        <h3><?php echo htmlspecialchars($modulo['nome_mod']); ?></h3>

                        <?php
                        $moduloId = $modulo['cod_modulo'];
                        $aulasQuery = $mysqli->query("SELECT * FROM aula WHERE cod_modulo = $moduloId");
                        while ($aula = $aulasQuery->fetch_assoc()):
                        ?>
                            <div class="aula">
                                <h4><?php echo htmlspecialchars($aula['titulo_aula']); ?></h4>
                                <h4><?php echo htmlspecialchars($aula['intro_aula']); ?></h4>
                                <p><strong>Conteúdo:</strong> <?php echo nl2br(htmlspecialchars($aula['conteudo_aula'])); ?></p>
                                <h4><?php echo htmlspecialchars($aula['ex_aula']); ?></h4>
                                <p><strong>URL do Vídeo:</strong> <a href="<?php echo htmlspecialchars($aula['video_url']); ?>" target="_blank">Assistir Vídeo</a></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Curso não encontrado.</p>
        <?php endif; ?>





    <?php elseif ($nivel_acesso == "ALUNO"): ?>
        <a href="?page=listarCurso" class="btn-back">Voltar</a>
        <a href="?page=certificado&gerar_pdf=1" class="btn-add right"  style="background-color: #19234E; padding:10px; margin-top:20px; color:white; font-size:1.1em; text-decoration:none; border-radius:7px;">Gerar certificado</a>


        <!-- <button type="button" onclick="addToFavorites(<?php echo $curso['cod_curso']; ?>)" class="btn">Adicionar aos Favoritos</button> -->

        <script>
            function addToFavorites(cursoId) {
                fetch('addFavorite.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            cod_curso: cursoId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Curso adicionado aos favoritos!');
                        } else {
                            alert('Erro ao adicionar curso aos favoritos: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                    });
            }
        </script>



        <br>
        <?php if ($curso): ?>
            <figure class="capa">
                <!-- Exibindo a capa do curso -->
                <img src="<?php echo htmlspecialchars($curso['capa']); ?>" alt="Capa do Curso">
            </figure>

            <h1><?php echo htmlspecialchars($curso['nome']); ?></h1>
            <p><strong>Carga Horária:</strong> <?php echo htmlspecialchars($curso['ch']); ?> horas</p>

      
               


            <?php
            // Conectar ao banco de dados
            $dsn = 'mysql:host=localhost;dbname=tecnoinfo;charset=utf8mb4';
            $usuario = 'root'; // Seu usuário do banco de dados
            $senha = ''; // Sua senha do banco de dados

            try {
                $pdo = new PDO($dsn, $usuario, $senha);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erro na conexão: ' . $e->getMessage());
            }

            // ID do curso (pode vir de uma requisição GET, por exemplo)
            $curso_id = $_GET['cod_curso']; // Exemplo de como pegar o ID do curso da URL

            // Obter informações do curso
            $stmtCurso = $pdo->prepare('SELECT * FROM curso WHERE cod_curso = :cod_curso');
            $stmtCurso->bindParam(':cod_curso', $curso_id);
            $stmtCurso->execute();
            $curso = $stmtCurso->fetch(PDO::FETCH_ASSOC);

            if ($curso) {
                // Obter os módulos e aulas do curso
                $stmtModulos = $pdo->prepare('
                    SELECT m.cod_modulo, m.nome_mod, a.cod_aula, a.titulo_aula 
                    FROM modulo m
                    LEFT JOIN aula a ON m.cod_modulo = a.cod_modulo
                    WHERE m.cod_curso = :cod_curso
                ');
                $stmtModulos->bindParam(':cod_curso', $curso_id);
                $stmtModulos->execute();
                $modulos = $stmtModulos->fetchAll(PDO::FETCH_ASSOC);

                // Organizar dados em um array associativo
                $dados_curso = [];
                foreach ($modulos as $modulo) {
                    $modulo_id = $modulo['cod_modulo'];

                    // Se o módulo não está no array, adicionamos ele
                    if (!isset($dados_curso[$modulo_id])) {
                        $dados_curso[$modulo_id] = [
                            'nome_modulo' => $modulo['nome_mod'],
                            'aulas' => []
                        ];
                    }

                    // Adicionar as aulas ao módulo
                    if ($modulo['titulo_aula']) {
                        $dados_curso[$modulo_id]['aulas'][] = [
                            'titulo' => $modulo['titulo_aula'],
                            'id' => $modulo['cod_aula'], // ID da aula para redirecionamento
                        ];
                    }
                }
            } else {
                die('Curso não encontrado.');
            }
            ?>

            <?php if (count($dados_curso) > 0): ?>
                <div class="tabela-modulos">
                    <?php foreach ($dados_curso as $modulo_id => $modulo): ?>
                        <div class="linha-modulo">
                            <div class="modulo-titulo">
                                <h2 style="color:white;"> <?php echo htmlspecialchars($modulo['nome_modulo']); ?></h2>
                                <button class="toggle"></button>
                            </div>
                            <div class="aulas" style="display:none;">
                                <ul>
                                    <?php foreach ($modulo['aulas'] as $aula): ?>
                                        <li onclick="window.location.href='?page=verAula&cod_aula=<?php echo $aula['id']; ?>'">
                                            <?php echo htmlspecialchars($aula['titulo']); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Nenhum módulo ou aula encontrado para este curso.</p>
            <?php endif; ?>
            </div>

            <script>
                // Script para expandir e recolher os módulos
                document.querySelectorAll('.toggle').forEach(button => {
                    button.addEventListener('click', function() {
                        const aulasDiv = this.closest('.linha-modulo').querySelector('.aulas');
                        if (aulasDiv.style.display === 'none') {
                            aulasDiv.style.display = 'block';
                            this.classList.add('expandido');
                        } else {
                            aulasDiv.style.display = 'none';
                            this.classList.remove('expandido');
                        }
                    });
                });
            </script>

        <?php else: ?>
            <p>Curso não encontrado.</p>
        <?php endif; ?>

    <?php endif; ?>

</body>

</html>