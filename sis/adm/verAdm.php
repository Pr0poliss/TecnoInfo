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

// Verificar se o ID foi passado via GET (usando GET em vez de POST para exibição de detalhes)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prevenir SQL Injection
    $id = $conn->real_escape_string($id);

    // Consultar o registro com base no ID
    $sql = "SELECT * FROM administrador WHERE id = '$id'";
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


    <style>


p {
    font-size: 18px;
    margin-bottom: 15px;
}

strong {
    color: #007bff; /* Azul para destacar os rótulos */
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #0056b3; /* Azul mais escuro no hover */
}

.footer {
    text-align: center;
    margin-top: 30px;
    font-size: 14px;
    color: #6c757d;
}

.footer a {
    color: #007bff;
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}

    </style>
    <body>
   
        <h1>Detalhes do administrador</h1>
        <p><strong>ID:</strong> <?= htmlspecialchars($cep['id']); ?></p>
        <p><strong>Nome:</strong> <?= htmlspecialchars($cep['nome']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($cep['email']); ?></p>
        <p><strong>Senha:</strong> <?= htmlspecialchars($cep['senha']); ?></p>
        <p><strong>Foto:</strong> <?= htmlspecialchars($cep['foto']); ?></p>


        <a href="?page=listarAdm" class="btn">Voltar</a>

