<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tecnoinfo";

// Criação da conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $database);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para pegar dados da tabela pagamentos
$query = "SELECT 
    pagamentos.idPag, 
    usuarios.idUsu, 
    plano.cod_plano,
    pagamentos.card_number AS card_number,
    pagamentos.expiry_date AS expiry_date,
    pagamentos.cvc AS cvc,
    pagamentos.card_name AS card_name,
    pagamentos.status_pagamento AS status_pagamento,
    pagamentos.data_pagamento AS data_pagamento
FROM pagamentos
LEFT JOIN usuarios ON pagamentos.idPag = usuarios.idUsu
LEFT JOIN plano ON pagamentos.cod_plano = plano.cod_plano";

// Executando a consulta
$result = $conn->query($query);  // Correção: usar $conn, não $mysqli

// Pegando dados do formulário
$numberCard = $_POST['card_number'];
$expiry_date = $_POST['expiry_date'];
$cvc = $_POST['cvc'];
$card = $_POST['card_name'];
$cod_plano = $_POST['cod_plano'];

// SQL para inserir dados na tabela pagamentos
$sql = "INSERT INTO pagamentos(card_number, expiry_date, cvc, card_name, cod_plano) 
        VALUES ('$numberCard', '$expiry_date', '$cvc', '$card', '$cod_plano')";

// Executando a inserção
$resultado = $conn->query($sql);  // Correção: usar $conn, não mysqli_query

// Verificando se a inserção foi bem-sucedida
if ($resultado) {
    echo "Pagamento inserido com sucesso";
    echo "<script> setTimeout(function() {window.location.href = '?page=listarPlano';}, 1); </script>";
} else {
    echo "Erro ao inserir o pagamento: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
