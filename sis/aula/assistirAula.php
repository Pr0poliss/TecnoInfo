<?php
// Configuração de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "tecnoinfo";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_SESSION['email'])) {
    $nivel_acesso = $_SESSION['nivel_acesso'];
}

// Verificar se o ID foi passado via GET (usando GET em vez de POST para exibição de detalhes)
if (isset($_GET['cod_modulo'])) {
    $cod_modulo = $_GET['cod_modulo'];

    // Prevenir SQL Injection
    $cod_modulo = $conn->real_escape_string($cod_modulo);

    // Consultar o registro com base no ID
    $sqlMod = "SELECT * FROM modulo WHERE cod_modulo = '$cod_modulo'";
    $result = $conn->query($sqlMod);

    // Verificar se encontrou o registro
    if ($result->num_rows > 0) {
        // Recuperar os dados
        $row = $result->fetch_assoc();
    } else {
        echo "Nenhum registro encontrado.";
        exit;
    }
} else {
    echo "ID não fornecido.";
    exit;
}

// Verificar se o ID foi passado via GET (usando GET em vez de POST para exibição de detalhes)
if (isset($_GET['cod_aula'])) {
    $id = $_GET['cod_aula'];

    // Prevenir SQL Injection
    $id = $conn->real_escape_string($id);

    // Consultar o registro com base no ID
    $sql = "SELECT * FROM aula WHERE cod_aula = '$id'";
    $result = $conn->query($sql);

    // Verificar se encontrou o registro
    if ($result->num_rows > 0) {
        // Recuperar os dados
        $cep = $result->fetch_assoc();
    } else {
        echo "Nenhum registro encontrado.";
        exit;
    }
} else {
    echo "ID não fornecido.";
    exit;
}

// Fechar a conexão
$conn->close();
?>
<body background="green">
    <main>
        <h1>Funfando</h1>
    </main>
</body>