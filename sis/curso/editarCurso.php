<?php

$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

// Inicializa variáveis
$cursoId = isset($_GET['cod_curso']) ? intval($_GET['cod_curso']) : 0;
$nome = '';
$ch = 0;
$capa = '';
$modulos = [];

// Carrega os dados do curso
if ($cursoId > 0) {
    $result = $mysqli->query("SELECT * FROM curso WHERE cod_curso = $cursoId");
    if ($result && $row = $result->fetch_assoc()) {
        $nome = $row['nome'];
        $ch = $row['ch'];
        $capa = $row['capa'];
    }

    $moduloResult = $mysqli->query("SELECT * FROM modulo WHERE cod_curso = $cursoId");
    while ($modulo = $moduloResult->fetch_assoc()) {
        $moduloId = $modulo['cod_modulo'];
        $moduloData = [
            'id' => $moduloId,
            'nome_mod' => $modulo['nome_mod'],
            'aulas' => []
        ];

        $aulaResult = $mysqli->query("SELECT * FROM aula WHERE cod_modulo = $moduloId");
        while ($aula = $aulaResult->fetch_assoc()) {
            $moduloData['aulas'][] = [
                'id' => $aula['cod_aula'],
                'titulo_aula' => $aula['titulo_aula'],
                'intro_aula' => $aula['intro_aula'],
                'conteudo_aula' => $aula['conteudo_aula'],
                'ex_aula' => $aula['ex_aula'],
                'video_url' => $aula['video_url']
            ];
        }

        $modulos[] = $moduloData;
    }
}

// Salva as alterações
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['salvar'])) {
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $ch = isset($_POST['ch']) ? $_POST['ch'] : 0;

    // Atualiza o curso
    $stmt = $mysqli->prepare("UPDATE curso SET nome = ?, ch = ? WHERE cod_curso = ?");
    $stmt->bind_param("sii", $nome, $ch, $cursoId);
    $stmt->execute();

    // Atualiza ou adiciona módulos e aulas
    foreach ($_POST['modulos'] as $moduloIndex => $modulo) {
        $moduloId = isset($modulo['id']) ? intval($modulo['id']) : 0;
        $nome_mod = $modulo['nome_mod'];

        if ($moduloId > 0) {
            // Atualiza módulo existente
            $stmt = $mysqli->prepare("UPDATE modulo SET nome_mod = ? WHERE cod_modulo = ?");
            $stmt->bind_param("si", $nome_mod, $moduloId);
        } else {
            // Adiciona novo módulo
            $stmt = $mysqli->prepare("INSERT INTO modulo (cod_curso, nome_mod) VALUES (?, ?)");
            $stmt->bind_param("is", $cursoId, $nome_mod);
            $stmt->execute();
            $moduloId = $stmt->insert_id;
        }
        $stmt->execute();

        // Atualiza ou adiciona aulas
        foreach ($modulo['aulas'] as $aulaIndex => $aula) {
            $aulaId = isset($aula['cod_aula']) ? intval($aula['cod_aula']) : 0;
            $titulo_aula = $aula['titulo_aula'];
            $intro_aula = $aula['intro_aula'];
            $conteudo_aula = $aula['conteudo_aula'];
            $ex_aula = $aula['ex_aula'];
            $video_url = $aula['video_url'];

            if ($aulaId > 0) {
                // Atualiza aula existente
                $stmt = $mysqli->prepare("UPDATE aula SET titulo_aula = ?, intro_aula = ?, conteudo_aula = ?, ex_aula = ?, video_url = ? WHERE cod_aula = ?");
                $stmt->bind_param("sssssi", $titulo_aula, $intro_aula, $conteudo_aula, $ex_aula, $video_url, $aulaId);
            } else {
                // Adiciona nova aula
                $stmt = $mysqli->prepare("INSERT INTO aula (cod_modulo, titulo_aula, intro_aula, conteudo_aula, ex_aula, video_url) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssss", $moduloId, $titulo_aula, $intro_aula, $conteudo_aula, $ex_aula, $video_url);
            }
            $stmt->execute();
        }
    }

    echo "Curso atualizado com sucesso!";
    echo "<script> setTimeout(function() {window.location.href = '?page=listarCurso';}, 1);</script>";
}
?>

<!-- Formulário HTML -->


<style>
    /* Configuração geral */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f8fa;
    color: #333;
}

form {
    background-color: #ffffff;
    padding: 20px;
    margin: 20px auto;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    width: 90%;
}

/* Cabeçalho e botões */
a.btn {
    display: inline-block;
    text-decoration: none;
    color: #fff;
    background-color: #007bff;
    padding: 8px 12px;
    border-radius: 5px;
    font-size: 14px;
    margin-bottom: 20px;
    transition: background-color 0.3s;
}

a.btn:hover {
    background-color: #0056b3;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Campos de entrada */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

input[type="text"],
input[type="number"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
    min-height: 80px;
}

/* Divisões de módulos e aulas */
.modulo {
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.modulo label {
    font-size: 14px;
}

.aula {
    border: 1px dashed #ddd;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    background-color: #ffffff;
}

.aula label {
    font-size: 13px;
}

/* Responsividade */
@media (max-width: 768px) {
    form {
        padding: 15px;
    }

    a.btn,
    button[type="submit"] {
        font-size: 12px;
        padding: 8px 15px;
    }
}

    </style>
    <form action="" method="POST" enctype="multipart/form-data">
        <a class="btn btn-primary btn-sm" href="?page=listarCurso">Voltar</a>
        <label>Título do Curso:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($nome) ?>" required>

        <label>Carga horária:</label>
        <input type="number" name="ch" value="<?= htmlspecialchars($ch) ?>" required>

        <?php foreach ($modulos as $moduloIndex => $modulo): ?>
            <div class="modulo">
                <label>Título do Módulo:</label>
                <input type="text" name="modulos[<?= $moduloIndex ?>][nome_mod]" value="<?= htmlspecialchars($modulo['nome_mod']) ?>" required>
                <input type="hidden" name="modulos[<?= $moduloIndex ?>][id]" value="<?= $modulo['id'] ?>">

                <?php foreach ($modulo['aulas'] as $aulaIndex => $aula): ?>
                    <div class="aula">
                        <label>Título da Aula:</label>
                        <input type="text" name="modulos[<?= $moduloIndex ?>][aulas][<?= $aulaIndex ?>][titulo_aula]" value="<?= htmlspecialchars($aula['titulo_aula']) ?>" required>

                        <label>Introdução da Aula:</label>
                        <textarea name="modulos[<?= $moduloIndex ?>][aulas][<?= $aulaIndex ?>][intro_aula]" required><?= htmlspecialchars($aula['intro_aula']) ?></textarea>

                        <label>Conteúdo da Aula:</label>
                        <textarea name="modulos[<?= $moduloIndex ?>][aulas][<?= $aulaIndex ?>][conteudo_aula]" required><?= htmlspecialchars($aula['conteudo_aula']) ?></textarea>

                        <label>Exercícios da Aula:</label>
                        <textarea name="modulos[<?= $moduloIndex ?>][aulas][<?= $aulaIndex ?>][ex_aula]" required><?= htmlspecialchars($aula['ex_aula']) ?></textarea>

                        <label>URL do Vídeo:</label>
                        <input type="text" name="modulos[<?= $moduloIndex ?>][aulas][<?= $aulaIndex ?>][video_url]" value="<?= htmlspecialchars($aula['video_url']) ?>" required>

                        <input type="hidden" name="modulos[<?= $moduloIndex ?>][aulas][<?= $aulaIndex ?>][id]" value="<?= $aula['id'] ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <button type="submit" name="salvar">Salvar Alterações</button>
    </form>
