<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT * FROM avaliacoes");

if (isset($_SESSION['email'])) {
    $nivel_acesso = $_SESSION['nivel_acesso'];
}
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

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #19234E;
            color: white;
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
   <?php if (isset($nivel_acesso) && $nivel_acesso == "ADMINISTRADOR"): ?>

    <h1 style="text-align: center;">Lista de Avaliações</h1>
    <a href="?page=addAv" class="btn-add">Adicionar Nova avaliação</a>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['titulo']; ?></td>
                    <td><?php echo $row['descricao']; ?></td>
                    <td>
                        <a style="margin-bottom: 10px;"href="?page=verAv&id=<?php echo $row['id']; ?>" class="btn-view">Ver</a>
                        <a style="margin-bottom: 10px;" href="?page=updateAv&id=<?php echo $row['id']; ?>" class="btn-edit">Editar</a>
                        <a style="margin-left: 22px;" href="delete&id=<?php echo $row['id']; ?>" class="btn-delete">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php elseif ($nivel_acesso == "ALUNO"): ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <div class="titulo-container">
            <hr class="line" style="width:30%">
            <h1 style="text-align: center;">Avaliações Disponíveis</h1>
            <hr class="line" style="width:30%;">
        </div>
            <style>
    .cursos {
    display: flex;
    justify-content: center;
    flex-wrap: nowrap;
    gap: 20px;
    padding: 20px;
    width: 100%;
    box-sizing: border-box;
}

.curso {
 
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    border-radius: 12px;
    margin: 20px;
    width: 280px;
    height: 320px;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background-color: #fff;
    transition: transform 0.3s, box-shadow 0.3s;
    
}

.curso:hover {
    transform: translateY(-10px);
    box-shadow: 0 0 8px #0060B8;

    color: white;
}

.btn {
    padding: 10px 20px;
    background-color: #0060B8;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    transition: background-color 0.3s;
    width: 60%;
    margin: 0 auto 15px;
}

.btn:hover {
    background-color: #19234E;
}

.capa {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-radius: 12px 12px 0 0;
    margin-bottom: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.oi {
    color: #19234E;
    font-size: 1.4em;
    font-weight: bold;
    text-align: center;
    margin: 20px auto;
    width: 100%;
    line-height: 1.3em;
}

.icons {
    font-size: 3.5em;
    color: #0060B8;
    margin: auto;
    transition: color 0.3s;
}

.curso:hover .icons {
    color: #19234E;
}

            </style>

<div class="cursos">
    <?php
    if ($result->num_rows > 0) {
        // Saída de cada avaliação
        while ($row = $result->fetch_assoc()) {
            echo '<div class="curso">';
            echo '<i class="fa-solid fa-file-alt icons"></i>'; // Ícone acima do título
            echo '<h3 class="oi">' . htmlspecialchars($row['titulo']) . '</h3>';
            echo '<a href="?page=verAv&id=' . $row['id'] . '" class="btn">Acessar avaliação</a>';
            echo '</div>';
        }
    } else {
        echo "Nenhuma avaliação encontrada.";
    }
    ?>
</div>

          
<?php endif; ?>
 
</body>

</html> 


