    <?php
    $servername = "localhost"; // ou o endereço do servidor do banco de dados
    $username = "root";
    $password = "";
    $database = "tecnoinfo";
    $conn = new mysqli($servername, $username, $password, $database);

    $sql = "SELECT * FROM pagamento";
    $result = mysqli_query($conn, $sql);
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recebe os dados do formulário
        $id = $_POST['cod_pagamento'];
        $nome = $_POST['nome_quem_pagou'];
        $valor = $_POST['valor_pago'];
        $dt = $_POST['datapg'];
        $modo = $_POST['modo_pgto'];



            // Atualiza o registro no banco de dados
            $sql = "UPDATE pagamento SET nome_quem_pagou='$nome', valor_pago='$valor', datapg ='$dt', modo_pgto='$modo' WHERE cod_PAGAMENTO='$id'";

            if (mysqli_query($conn, $sql)) {
                echo "Registro atualizado com sucesso";
                header('Location: listarPag.php'); 
                exit();
            } else {
                echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Erro: O código da avaliação fornecido não existe na tabela matricula.";
        }


    // Verifica se um ID foi fornecido para edição
    if (isset($_GET['cod_pagamento'])) {
        $id = $_GET['cod_pagamento'];

        // Busca os dados do registro a ser editado
        $sql = "SELECT * FROM pagamento WHERE cod_pagamento='$id'";
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