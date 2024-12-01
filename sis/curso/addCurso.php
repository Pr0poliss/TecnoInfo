<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

// Inicializa as variáveis
$nome = '';
$ch = 0;
$capa = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $modulos = isset($_POST['modulos']) ? $_POST['modulos'] : [];
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $ch = isset($_POST['ch']) ? $_POST['ch'] : 0;

    // Verifica se há um arquivo de capa
    if (isset($_FILES['capa']) && $_FILES['capa']['error'] == 0) {
        $capaNome = $_FILES['capa']['name'];
        $capaTmp = $_FILES['capa']['tmp_name'];
        $extensao = pathinfo($capaNome, PATHINFO_EXTENSION);

        // Define o caminho para salvar a capa
        $capaNovoNome = $capaNome . '.' . $extensao;
        $capaDestino = '/TecnoInfo/img/curso/capa/' . $capaNovoNome;
        $caminhoAbsoluto = $_SERVER['DOCUMENT_ROOT'] . $capaDestino;

        if (move_uploaded_file($capaTmp, $caminhoAbsoluto)) {
            $capa = $capaDestino;
        }
    }

    // Verifica qual ação foi acionada
    if (isset($_POST['add_modulo'])) {
        $modulos = adicionarModulo($modulos);
    } elseif (isset($_POST['add_aula'])) {
        $moduloIndex = isset($_POST['modulo_index']) ? intval($_POST['modulo_index']) : -1;
        if ($moduloIndex >= 0) {
            $modulos = adicionarAula($modulos, $moduloIndex);
        }
    } elseif (isset($_POST['salvar'])) {
        // Salvamento do curso
        $stmt = $mysqli->prepare("INSERT INTO curso(nome, ch, capa) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $nome, $ch, $capa);
        $stmt->execute();
        $cursoId = $stmt->insert_id;

        foreach ($modulos as $modulo) {
            $titulo_modulo = $modulo['nome_mod'];
            $stmt = $mysqli->prepare("INSERT INTO modulo(cod_curso, nome_mod) VALUES (?, ?)");
            $stmt->bind_param("is", $cursoId, $titulo_modulo);
            $stmt->execute();
            $moduloId = $stmt->insert_id;

            if (isset($modulo['aulas']) && is_array($modulo['aulas'])) {
                foreach ($modulo['aulas'] as $aula) {
                    $titulo_aula = $aula['titulo_aula'];
                    $intro_aula = $aula['intro_aula'];
                    $conteudo_aula = $aula['conteudo_aula'];
                    $ex_aula = $aula['ex_aula'];
                    $video_url = $aula['video_url'];

                    $stmt = $mysqli->prepare("INSERT INTO aula(cod_modulo, titulo_aula, intro_aula, conteudo_aula, ex_aula, video_url) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("isssss", $moduloId, $titulo_aula, $intro_aula, $conteudo_aula, $ex_aula, $video_url);
                    $stmt->execute();
                }
            }
        }

        echo "Curso cadastrado com sucesso!";
        echo "<script> setTimeout(function() {window.location.href = '?page=listarCurso';}, 1500); // redireciona após 3 segundos</script>";
    }
} else {
    // Inicializa a variável $modulos como um array vazio ao carregar a página
    $modulos = [];
}

// Função para adicionar um novo módulo
function adicionarModulo($modulos)
{
    $modulos[] = ['nome_mod' => '', 'aulas' => []];
    return $modulos;
}

// Função para adicionar uma nova aula ao módulo
function adicionarAula($modulos, $moduloIndex)
{
    // Verifica se o módulo existe e se tem o índice correto
    if (isset($modulos[$moduloIndex])) {
        // Verifica se o array de aulas já foi inicializado
        if (!isset($modulos[$moduloIndex]['aulas']) || !is_array($modulos[$moduloIndex]['aulas'])) {
            $modulos[$moduloIndex]['aulas'] = []; // Inicializa o array de aulas
        }

        // Adiciona uma nova aula com campos vazios
        $modulos[$moduloIndex]['aulas'][] = [
            'titulo_aula' => '',
            'intro_aula' => '',
            'conteudo_aula' => '',
            'ex_aula' => '',
            'video_url' => ''
        ];
    }

    return $modulos;
}
?>


<!-- Formulário HTML -->
<style>
    /* Estilos para o formulário */
    form {
        max-width: 600px;
        margin: auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #555;
      
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 550px;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s ease;
       
    }

    textarea{
        width: 480px;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus {
        border-color: #007BFF;
    }

        button.curso {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
        }

    button:hover {
        background-color: #0056b3;
    }

    .modulo {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #f9f9f9;
      
    }

    .aula {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        margin-top: 10px;
        background-color: #fff;
    }

    button[type="submit"]:last-of-type {
        background-color: #19234E;
    }

    button[type="submit"]:last-of-type:hover {
        background-color: #0D579C;
    }
</style>

<center>
    <form action="" method="POST" enctype="multipart/form-data">

        <label>Título do Curso:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($nome) ?>" required>

        <label>Capa do curso</label>
        <input type="file" name="capa">

        <label>Carga horária:</label>
        <input type="number" name="ch" value="<?= htmlspecialchars($ch) ?>" required>

        <?php foreach ($modulos as $moduloIndex => $modulo): ?>
            <div class="modulo">
                <label>Título do Módulo:</label>
                <input type="text"  name="modulos[<?= $moduloIndex ?>][nome_mod]" value="<?= htmlspecialchars($modulo['nome_mod']) ?>" required>

                <?php if (isset($modulo['aulas']) && is_array($modulo['aulas'])): ?>

                    <?php foreach ($modulo['aulas'] as $aulaIndex => $aula): ?>
                        <div class="aula">
                            <label>Título da Aula:</label>
                            <input type="text" style="width: 450px;"  name="modulos[<?= $moduloIndex ?>][aulas][<?= $aulaIndex ?>][titulo_aula]" value="<?= htmlspecialchars($aula['titulo_aula']) ?>" required>

                            <label>Introdução da Aula (breve resumo e boas vindas):</label>
                            <textarea name="modulos[<?= $moduloIndex ?>][aulas][<?= $aulaIndex ?>][intro_aula]" required><?= htmlspecialchars($aula['intro_aula']) ?></textarea>

                            <label>Conteúdo da Aula:</label>
                            <textarea name="modulos[<?= $moduloIndex ?>][aulas][<?= $aulaIndex ?>][conteudo_aula]" required><?= htmlspecialchars($aula['conteudo_aula']) ?></textarea>

                            <label>Exercícios da Aula:</label>
                            <textarea name="modulos[<?= $moduloIndex ?>][aulas][<?= $aulaIndex ?>][ex_aula]" required><?= htmlspecialchars($aula['ex_aula']) ?></textarea>

                            <label>URL do Vídeo:</label>
                            <input type="text" style="width: 450px;"  name="modulos[<?= $moduloIndex ?>][aulas][<?= $aulaIndex ?>][video_url]" value="<?= htmlspecialchars($aula['video_url']) ?>" required>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <button type="submit" class="curso" name="add_aula">Adicionar Aula</button>
                <input type="hidden" name="modulo_index" value="<?= $moduloIndex ?>">
            </div>
        <?php endforeach; ?>

        <button type="submit" class="curso" name="add_modulo">Adicionar Módulo</button>
        <button type="submit" class="curso"name="salvar">Salvar Curso</button>
    </form>
    <a style="background-color: #19234E; color:white; text-decoration:none; padding:10px; float:left; border-radius:7px; width: 70px;" href="?page=listarCurso">Voltar</a>
</center>