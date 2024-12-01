    <?php
    $servername = "localhost"; // ou o endereço do servidor do banco de dados
    $username = "root";
    $password = "";
    $database = "tecnoinfo";
    $conn = new mysqli($servername, $username, $password, $database);

    $sql = "SELECT * FROM modulo";
    $result = mysqli_query($conn, $sql);
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recebe os dados do formulário
        $id = $_POST['cod_modulo'];
        $nome = $_POST['nome'];
        $qt = $_POST['qt'];
        $nivel = $_POST['nivel'];
    
        // Atualiza o registro no banco de dados
        $sql = "UPDATE modulo SET nome='$nome', qt='$qt', nivel ='$nivel' WHERE cod_modulo='$id'";

            if (mysqli_query($conn, $sql)) {
                echo "Registro atualizado com sucesso";
                header('Location: listarMod.php'); 
                exit();
            } else {
                echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Erro: O código fornecido não existe na tabela";
        }


    // Verifica se um ID foi fornecido para edição
    if (isset($_GET['cod_modulo'])) {
        $id = $_GET['cod_modulo'];

        // Busca os dados do registro a ser editado
        $sql = "SELECT * FROM modulo WHERE cod_modulo='$id'";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            // Dados encontrados, exibe o formulário de edição
        } else {
            echo "Nenhum registro encontrado.";
            exit();
        }
    } else {
        echo "ID não fornecido.";
        exit();
    }

    mysqli_close($conn);
    ?>