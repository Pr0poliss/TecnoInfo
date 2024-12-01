<?php
ob_start(); // Iniciar o buffer de saída

// Conectar ao banco de dados
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

// Verifica se a conexão foi bem-sucedida
if ($mysqli->connect_error) {
    die('Erro na conexão: ' . $mysqli->connect_error);
}

if (isset($_SESSION['nivel_acesso']) && isset($_SESSION['email'])) {
    $nivel_acesso = $_SESSION['nivel_acesso'];
    $email = $_SESSION['email'];

    // Recuperar dados do formulário
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $senha_confirm = $_POST['senha_confirm'];
    $foto_atual = $_POST['foto_atual'];

    // Validação de senha
    if (!empty($senha) && $senha !== $senha_confirm) {
        // Senhas não coincidem, redireciona com erro
        echo "<script> alert('As senhas não coincidem. Nós validaremos apenas o campo senha e alteramos como foi desejado.')</script>";
        echo "<script> setTimeout(function() {window.location.href = '?page=editPerfil';}, 1); // redireciona após 3 segundos</script>";
        // return include "?page=editPerfil";
        // include "?page=editPerfil";
        // header("Location: editPerfil.php");
        
    }

    // Hash da nova senha se a senha foi alterada
    if (!empty($senha)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    } else {
        $senha_hash = null;
    }

    // Atualizar na tabela correspondente ao nível de acesso
    $stmt = $mysqli->prepare("UPDATE {$nivel_acesso} SET nome = ?, senha = ? WHERE email = ?");
    if ($senha_hash) {
        $stmt->bind_param("sss", $nome, $senha_hash, $email);
    } else {
        $stmt->bind_param("ss", $nome, $email);
    }
    $stmt->execute();

    $stmt = $mysqli->prepare("UPDATE usuarios SET nome = ?, senha = ? WHERE email = ?");
    if ($senha_hash) {
        $stmt->bind_param("sss", $nome, $senha_hash, $email);
    } else {
        $stmt->bind_param("ss", $nome, $email);
    }
    $stmt->execute();

    // Verificar se há uma nova foto
    if ($_FILES['foto']['error'] == 0) {
        // Definir o caminho absoluto para as fotos
        $foto_pasta = '../img/user/';
        
        // Verifique se o diretório existe, senão crie-o
        if (!is_dir($foto_pasta)) {
            mkdir($foto_pasta, 0777, true); // Cria a pasta, se necessário
        }

        $foto_temp = $_FILES['foto']['tmp_name'];
        $foto_nome = $_FILES['foto']['name'];
        $foto_novo_nome = uniqid() . '-' . $foto_nome;

        // Mover a foto para o diretório correto
        if (move_uploaded_file($foto_temp, $foto_pasta . $foto_novo_nome)) {
            // Atualizar a foto na tabela correspondente
            $stmt = $mysqli->prepare("UPDATE {$nivel_acesso} SET foto = ? WHERE email = ?");
            $stmt->bind_param("ss", $foto_novo_nome, $email);
            $stmt->execute();

            $stmt = $mysqli->prepare("UPDATE usuarios SET foto = ? WHERE email = ?");
            $stmt->bind_param("ss", $foto_novo_nome, $email);
            $stmt->execute();

            // Atualizar a foto na sessão
            $_SESSION['foto'] = $foto_novo_nome;  // Atualiza a foto na sessão
        } else {
            echo "Erro ao mover o arquivo de imagem.";
        }
    }

    // Após a atualização, redireciona para a página de perfil
    echo "<script> setTimeout(function() {window.location.href = '?page=perfil';}, 15); // redireciona após 3 segundos</script>";
} else {
    // Se o usuário não estiver logado, redireciona para login
    header("Location: ?page=login");
    exit;
}

ob_end_flush(); // Finaliza o buffer de saída
?>
