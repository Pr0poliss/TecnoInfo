<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $ch = $_POST['ch'];
    $cursoId = $_GET['cod_curso']; // Certifique-se de que o ID do curso é capturado corretamente.

    // Atualiza o curso
    $mysqli->query("UPDATE curso SET nome = '$nome', ch = '$ch' WHERE cod_curso = '$cursoId'");

    // Atualiza os módulos e aulas
    if (isset($_POST['modulos'])) {
        foreach ($_POST['modulos'] as $modulo) {
            if (isset($modulo['cod_modulo'])) {
                $cod_modulo = $modulo['cod_modulo']; // ID do módulo
                $nome_mod = $modulo['nome_mod']; // Nome do módulo

                // Atualiza o módulo
                $mysqli->query("UPDATE modulo SET nome_mod = '$nome_mod' WHERE cod_modulo = '$cod_modulo'");

                // Atualiza as aulas
                if (isset($modulo['aulas'])) {
                    foreach ($modulo['aulas'] as $aula) {
                        if (isset($aula['cod_aula'])) {
                            $cod_aula = $aula['cod_aula']; // ID da aula
                            $titulo_aula = $aula['titulo_aula'];
                            $conteudo_aula = $aula['conteudo_aula'];
                            $video_url = $aula['video_url'];

                            // Atualiza a aula
                            $mysqli->query("UPDATE aula SET titulo_aula = '$titulo_aula', conteudo_aula = '$conteudo_aula', video_url = '$video_url' WHERE cod_aula = '$cod_aula'");
                        }
                    }
                }
            }
        }
    }

    // Redireciona após a atualização
   include "listarCurso.php"; 
    exit;
}
  ?>