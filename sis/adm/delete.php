<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão apenas se ainda não estiver ativa
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "tecnoinfo";
$conn = new mysqli($servername, $username, $password, $database);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mat = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id='$mat'";
    $sql = "DELETE FROM administrador WHERE id='$mat'";

    if (mysqli_query($conn, $sql)) {
        ?>
        <script>
            window.onload = function() {
                // Exibe o alerta quando a página for carregada
                alert('Feito!');
                window.location.href='?page=listarAdm';
                // window.history.back(0);
            }
        </script>
        <?php
        exit(); // Certifique-se de sair após o redirecionamento
    } else {
        header('Location: /dash/dashboard.php?page=listaAdm&msg=2');
        exit(); // Certifique-se de sair após o redirecionamento
    }
}

mysqli_close($conn); // Fecha a conexão se necessário
?>