<?php
include "../../base/ch_pages.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro</title>
    <link rel="stylesheet" href="../../style.css">
    <link rel="shortcut icon" href="../../img/logo/logo-figure_colorida.png" type="image/x-icon">
</head>

<style>
    #voltar {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 10px;
    }

    #voltar>img {
        width: 100%;
    }
</style>

<body>
    <div class="container">
        <!-- Divisão Quero ser Aluno -->
        <div class="option" id="option-aluno">
            <h1>Quero ser um aluno</h1>
            <button class="cta" onclick="window.location.href='cadastro_aluno_ue.php?nivel_acesso=aluno'">Vamos lá</button>
        </div>
        
        <!-- Divisão Unidade de Ensino -->
        <div class="option" id="option-unidade">
            <h1>Unidade de Ensino</h1>
            <button class="cta" onclick="window.location.href='cadastro_aluno_ue.php?nivel_acesso=unidade'">Vamos lá</button>
        </div>
        <a href="?page=index" id="voltar"><img src="../../img/icons/Voltar.png" alt=""></a>
    </div>



</body>

</html>