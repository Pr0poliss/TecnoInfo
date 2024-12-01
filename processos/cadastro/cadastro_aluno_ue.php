<?php
// Verifica se o parâmetro 'tipo' foi passado na URL
if (isset($_GET['nivel_acesso'])) {
    $nivel_acesso = $_GET['nivel_acesso'];

?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
        <link rel="shortcut icon" href="../../img/logo/logo-figure_colorida.png" type="image/x-icon">
    </head>
    
    <body>
        <div class="login-container">
            <div class="login-box">
                <?php
                // Valida o parâmetro e inclui o formulário correspondente
                    if ($nivel_acesso == 'aluno') {
                        include 'cadastro_alu.php';  // Incluir o formulário de cadastro de aluno
                    } elseif ($nivel_acesso == 'unidade') {
                        include 'cadastro_ue.php';   // Incluir o formulário de cadastro de unidade de ensino
                    } else {
                        echo "Tipo de cadastro inválido.";
                    }
                    } else {
                        
                    }
                ?>
                </form>
            </div>
        </div>
    </body>
    </html>