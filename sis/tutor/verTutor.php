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
if (isset($_GET['idTutor'])) {
    $id = $_GET['idTutor'];

    // Prevenir SQL Injection
    $id = $conn->real_escape_string($id);

    // Consultar o registro com base no ID
    $sql = "SELECT * FROM tutor WHERE idTutor = '$id'";
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

 .container {
    /* max-width: 600px;
    margin: 50px auto;
    background: white; */
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);

} 

h1 {
    color: #343a40;
    text-align: center;
    margin-bottom: 20px;
}

p {
    font-size: 18px;
    margin-bottom: 15px;
}

strong {
    color: #007bff; /* Azul para destacar os rótulos */
}

.btn, .btn-add {
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

        <h1>Detalhes do professor</h1>
        <p><strong>ID:</strong> <?= htmlspecialchars($cep['idTutor']); ?></p>
        <p><strong>Nome:</strong> <?= htmlspecialchars($cep['nome']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($cep['email']); ?></p>
        <p><strong>Senha:</strong> <?= htmlspecialchars($cep['senha']); ?></p>
        <p><strong>Autêntico(a):</strong> <?= htmlspecialchars($cep['autenticidade']); ?></p>
        <p><strong>CPF:</strong> <?= htmlspecialchars($cep['cpf']); ?></p>

        <a href="?page=listarTutor" class="btn">Voltar</a>

      


     