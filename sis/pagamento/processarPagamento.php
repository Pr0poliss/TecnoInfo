<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexão com o banco de dados
    $conn = new mysqli('localhost', 'root', '', 'tecnoinfo');

    // Verificar conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Receber os dados do formulário
    $card_number = $conn->real_escape_string($_POST['card_number']);
    $expiry_date = $conn->real_escape_string($_POST['expiry_date']);
    $cvc = $conn->real_escape_string($_POST['cvc']);
    $card_name = $conn->real_escape_string($_POST['card_name']);

    // Obter o e-mail do usuário logado da sessão (assumindo que o e-mail esteja armazenado na variável de sessão)
    $email_usuario = $_SESSION['email']; // A variável de sessão 'email' deve conter o e-mail do usuário logado

    // Buscar o idUsu a partir do e-mail
    $sql_usuario = "SELECT idUsu FROM usuarios WHERE email = '$email_usuario'";
    $result_usuario = $conn->query($sql_usuario);

    if ($result_usuario->num_rows > 0) {
        // Se encontrar o usuário, pega o idUsu
        $row = $result_usuario->fetch_assoc();
        $idUsu = $row['idUsu'];
    } else {
        die("Erro: Usuário não encontrado.");
    }

    // Verificar se o código do plano foi passado na sessão
    if (isset($_POST['cod_plano'])) {
        $cod_plano = $_POST['cod_plano']; // A variável de POST 'cod_plano' deve conter o código do plano escolhido
    } else {
        die("Erro: Código do plano não encontrado.");
    }

    // Inserir os dados na tabela 'pagamentos'
    $sql_pagamento = "INSERT INTO pagamentos (idUsu, cod_plano, card_number, expiry_date, cvc, card_name) 
                      VALUES ('$idUsu', '$cod_plano', '$card_number', '$expiry_date', '$cvc', '$card_name')";

    if ($conn->query($sql_pagamento) === TRUE) {
        echo "<h1>Pagamento registrado com sucesso!</h1>";
        echo "<script> setTimeout(function() {window.location.href = '?page=listarCurso';}, 1); // redireciona após 3 segundos</script>";
 
        
            } else {
        echo "Erro: " . $conn->error;
    }

    // Fechar conexão
    $conn->close();
}
?>
