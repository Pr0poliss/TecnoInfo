    <?php
    $servername = "localhost"; // ou o endereço do servidor do banco de dados
    $username = "root";
    $password = "";
    $database = "tecnoinfo";
    $conn = new mysqli($servername, $username, $password, $database);

    $sql = "SELECT * FROM unidade";
    $result = mysqli_query($conn, $sql);
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recebe os dados do formulário
        $id = $_POST['id_uni'];
        $nome = $_POST['nome'];
        $cnpj = $_POST['cnpj'];
        $tel = $_POST['tel'];
    
        // Atualiza o registro no banco de dados
        $sql = "UPDATE unidade_ensino SET nome='$nome', cnpj='$cnpj', tel ='$tel' WHERE id_uni='$id'";

            if (mysqli_query($conn, $sql)) {
                echo "Registro atualizado com sucesso";
                header('Location: listarUni.php'); 
                exit();
            } else {
                echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Erro: O código fornecido não existe na tabela";
        }


    // Verifica se um ID foi fornecido para edição
    if (isset($_GET['id_uni'])) {
        $id = $_GET['id_uni'];

        // Busca os dados do registro a ser editado
        $sql = "SELECT * FROM unidade_ensino WHERE id_uni='$id'";
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