<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Verifique se o usuário está logado
if (isset($_SESSION['email'])) {
    $nivel_acesso = $_SESSION['nivel_acesso'];
}

$result = $mysqli->query("SELECT * FROM curso ORDER BY cod_curso");

?>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    thead {
        background-color: #19234E;
        color: #fff;

    }


    td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        width: 20%;
    }

    th {
        background-color: #19234E;
        color: white;
        padding: 15px;

    }

    tr:hover {
        background-color: #9aceff;
    }

    .btn-add,
    .btn-view,
    .btn-edit,
    .btn-delete {
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
        margin-right: 5px;
        display: inline-block;
    }

    .btn-add {
        background-color: #19234E;
        color: white;
    }

    .btn-view {
        background-color: #007bff;
        color: white;
    }

    .btn-edit {
        background-color: #ffc107;
        color: white;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .btn-view:hover {
        background-color: #0056b3;
    }

    .btn-edit:hover {
        background-color: #e0a800;
    }

    .btn-add:hover {
        background-color: #2365a3;
    }
</style>
</head>

<body>

    <?php if ($nivel_acesso == "ADMINISTRADOR") { ?>

        <h1>Lista de Cursos</h1>
        <a href="?page=addCurso" class="btn-add">Adicionar Novo Curso</a>
        <a href="?page=relCurso" class="btn-add right">Gerar relatório</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <?php while ($row = $result->fetch_assoc()) { ?>
                <tbody>

                    <tr>
                        <td><?php echo $row['cod_curso']; ?></td>
                        <td><?php echo $row['nome']; ?></td>
                        <td>
                            <a href="?page=verCurso&cod_curso=<?php echo $row['cod_curso']; ?>" class="btn-view">Ver</a>
                            <a href="?page=editarCurso&cod_curso=<?php echo $row['cod_curso']; ?>" class="btn-edit">Editar</a>
                            <a href="?page=deleteCurso&cod_curso=<?php echo $row['cod_curso']; ?>"
                                class="btn-delete">Excluir</a>
                        </td>
                    </tr>
                </tbody>
            <?php }
    } elseif ($nivel_acesso == "ALUNO") {
        ?>
            <h1>Cursos Disponíveis</h1>
            <style>
                .cursos {
                    display: flex;
                    justify-content: space-around;
                    flex-wrap: wrap;
                    width: 100%;
                }

                .curso {
                    box-shadow: 0 0 15px gray;
                    border-radius: 10px;
                    margin: 30px 10px;
                    width: 300px;
                    height: 250px;
                    text-align: center;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    padding-bottom: 50px;
                }

                /* .curso img {
                        max-width: 100%;
                        height: auto;
                        border-radius: 5px;
                    } */

                .btn {
                    padding: 10px 15px;
                    background-color: #007BFF;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    text-decoration: none;
                    width: 50%;
                    /* position: absolute; */
                    margin: 0 auto;

                }

                .capa {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;

                    max-height: 160px;
                    overflow: hidden;
                    border-radius: 10px 10px 0 0;
                    margin-bottom: 31px;
                }
            </style>

            <div class="cursos">
                <?php
                if ($result->num_rows > 0) {
                    // Saída de cada curso
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="curso">'; ?>

                        <!-- Exibindo a capa do curso -->
                        <img src="<?php echo htmlspecialchars($row['capa']); ?>" class="capa" alt="Capa do Curso">

                        <?php
                        echo '<h3 style="color:black; text-align:center;">' . htmlspecialchars($row['nome']) . '</h3>';
                        $curso_id = $row['cod_curso'];

                        echo '<a href="?page=verCurso&cod_curso=' . $row['cod_curso'] . '" class="btn">Acessar Curso</a>';


                        echo '</div>';
                    }
                } else {
                    echo "Nenhum curso encontrado.";
                }
                ?>

            </div>

    </body>

    </html>

    <?php
    $mysqli->close();
    ?>
<?php

    } elseif ($nivel_acesso == "UNIDADE_ENSINO") {
        ?>
            <h1>Cursos Disponíveis</h1>
            <style>
                .cursos {
                    display: flex;
                    justify-content: space-around;
                    flex-wrap: wrap;
                    width: 100%;
                }

                .curso {
                    box-shadow: 0 0 15px gray;
                    border-radius: 10px;
                    margin: 30px 10px;
                    width: 300px;
                    height: 250px;
                    text-align: center;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    padding-bottom: 50px;
                }

                /* .curso img {
                        max-width: 100%;
                        height: auto;
                        border-radius: 5px;
                    } */

                .btn {
                    padding: 10px 15px;
                    background-color: #007BFF;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    text-decoration: none;
                    width: 50%;
                    /* position: absolute; */
                    margin: 0 auto;

                }

                .capa {
                    width: 100%;
                    min-height: 160px;
                    object-fit: cover;

                    max-height: 160px;
                    overflow: hidden;
                    border-radius: 10px 10px 0 0;
                    margin-bottom: 31px;
                }
            </style>

            <div class="cursos">
                <?php
                if ($result->num_rows > 0) {
                    // Saída de cada curso
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="curso">'; ?>

                        <!-- Exibindo a capa do curso -->
                        <img src="<?php echo htmlspecialchars($row['capa']); ?>" class="capa" alt="Capa do Curso">

                        <?php
                        echo '<h3 style="color:black;">' . htmlspecialchars($row['nome']) . '</h3>';
                        echo '<h3 style="color:black;"><span style="color:#19234E;">Carga Horária:</span> ' . htmlspecialchars($row['ch']) . ' Horas</h3>';
                        $curso_id = $row['cod_curso'];

                        echo '</div>';
                    }
                } else {
                    echo "Nenhum curso encontrado.";
                }
                ?>

            </div>

    </body>

    </html>

    <?php
    $mysqli->close();
    ?>
<?php
}

?>

</body>

</html>