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
if (isset($_GET['cod_plano'])) {
    $id = $_GET['cod_plano'];

    // Prevenir SQL Injection
    $id = $conn->real_escape_string($id);

    // Consultar o registro com base no ID
    $sql = "SELECT * FROM plano WHERE cod_plano = '$id'";
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

if (isset($_SESSION['email'])) {
    $nivel_acesso = $_SESSION['nivel_acesso'];
}
// Fechar a conexão
$conn->close();

if ($nivel_acesso == "ADMINISTRADOR") {
    ?>

    <style>
        p {
            font-size: 18px;
            margin-bottom: 15px;
        }

        strong {
            color: #007bff;
            /* Azul para destacar os rótulos */
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #19234E;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0D579C;
            /* Azul mais escuro no hover */
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #6c757d;
        }

        .footer a {
            color: #19234E;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>


    <h1>Detalhes do plano</h1>
    <p><strong>ID:</strong> <?= htmlspecialchars($cep['cod_plano']); ?></p>
    <p><strong>Título:</strong> <?= htmlspecialchars($cep['titulo_plano']); ?></p>
    <p><strong>Valor:</strong> <?= htmlspecialchars($cep['valor_plano']); ?></p>
    <p><strong>Usuário Final:</strong> <?= htmlspecialchars($cep['usuFinal']); ?></p>
    <p><strong>Benefícios:</strong> <?= htmlspecialchars($cep['corpo_plano']); ?></p>

    <a href="?page=listarPlano" class="btn">Voltar</a>

    <?php
} else if ($nivel_acesso == "ALUNO") {
    ?>
     <style>
            /* DIV MODO-PAGAMENTO */
            .payment-form-container {
                margin: 40px auto;
                max-width: 800px;
                background-color: #fff;
                padding: 20px 15px;
                border-radius: 8px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            .payment-form-container h2 {
                margin-bottom: 20px;
                color: #19234E;
            }

            .form-group {
                margin-bottom: 15px;
                text-align: left;
            }

            label {
                display: block;
                font-size: 14px;
                color: #333;
                margin-bottom: 5px;
            }

            input[type="text"] {
                width: 95%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 14px;
                outline: none;
                transition: border-color 0.3s;
            }

            input[type="text"]:focus {
                border-color: #19234E;
            }

            .submit-btn {
                width: 100%;
                padding: 12px;
                background-color: #19234E;
                color: #fff;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .submit-btn:hover {
                background-color: #2365a3;
            }



            /* Container do plano */
            .plano-container {
                max-width: 900px;
                margin: 40px auto;
                padding: 20px 15px;
                background-color: #f4f6f9;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                font-family: Arial, sans-serif;
            }

            /* Cabeçalho do plano */
            .plano-header h1 {
                font-size: 2.5em;
                color: #19234E;
                margin-bottom: 10px;
            }

            .plano-header h2 {
                font-size: 1.8em;
                color: #007bff;
            }

            /* Detalhes do plano */
            .plano-details {
                margin-top: 30px;
            }

            .plano-details p {
                font-size: 1.2em;
                line-height: 1.6;
                color: #333;
            }

            .plano-benefits {
                margin-top: 30px;
            }

            .plano-benefits h3 {
                font-size: 1.5em;
                color: #19234E;
                margin-bottom: 10px;
            }

            .plano-benefits ul {
                list-style-type: disc;
                padding-left: 20px;
                color: #333;
            }

            .plano-benefits ul li {
                font-size: 1.1em;
                line-height: 1.8;
            }

            /* Botão de assinar */
            .btn-assinar {
                display: inline-block;
                padding: 15px 30px;
                color: white;
                text-decoration: none;
                font-size: 1.2em;
                border-radius: 5px;
                text-align: center;
                margin-top: -10px;
                cursor: pointer;
                background-color: #19234E;

            }

            .btn-assinar:hover {
                background-color: #003d80;
            }

            .voltar {
                display: inline-block;
                padding: 15px 30px;
                background-color: #19234E;
                color: white;
                text-decoration: none;
                font-size: 1.2em;
                border-radius: 5px;
                text-align: center;
                margin-top: -10px;
                cursor: pointer;
            }

            .voltar:hover {
                background-color: #003d80;
            }

            /* Responsividade */
            @media (max-width: 768px) {
                .plano-header h1 {
                    font-size: 2em;
                }

                .plano-header h2 {
                    font-size: 1.5em;
                }

                .plano-details p {
                    font-size: 1.1em;
                }

                .plano-benefits h3 {
                    font-size: 1.3em;
                }

                .btn-assinar {
                    font-size: 1em;
                    padding: 12px 25px;
                }
            }
        </style>
        <?php
        //Conexão com o banco de dados
        $mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');
        if ($mysqli->connect_error) {
            die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }

        // Pegando o ID do plano da URL
        $plano_id = isset($_GET['cod_plano']) ? (int) $_GET['cod_plano'] : 0;

        // Buscando o plano no banco de dados
        $query = "SELECT * FROM plano WHERE cod_plano = $plano_id";
        $result = $mysqli->query($query);
        $plano = $result->fetch_assoc();

        // Verifica se o plano foi encontrado
        if (!$plano) {
            echo "Plano não encontrado.";
            exit;
        }
        ?>

        <div class="plano-container">
            <div class="plano-header">
                <h1 style="text-align:center;"><?php echo $plano['titulo_plano']; ?></h1>
                <h2>Por Mês: R$<?php echo number_format($plano['valor_plano'], 2, ',', '.'); ?></h2>
            </div>
            <div class="plano-details">


                <div class="plano-benefits">
                    <h3>Benefícios do Plano</h3>
                    <ul>
                        <?php
                        $beneficios = explode(',', $plano['corpo_plano']);
                        foreach ($beneficios as $beneficio): ?>
                            <li><?php echo trim($beneficio); ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>

                <hr style="border: 1px solid grey; margin-top:35px;">


                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mask-plugin/1.14.16/jquery.mask.min.js"></script>



                <div class="payment-form-container">
                    <h2>Método de Pagamento</h2>
                    <form action="?page=processarPagamento&idPlano=?" method="post">
                        <input type="hidden" name="cod_plano" value="<?php echo $plano['cod_plano']; ?>">
                        <input type="hidden" name="idUsu" value="<?php echo $_SESSION['email']; ?>">

                        <div class="form-group">
                            <label for="card-number">Número do Cartão</label>
                            <input type="text" id="card-number" name="card_number" placeholder="0000 0000 0000 0000"
                                maxlength="19" required>
                        </div>
                        <div class="form-group" style="display: flex; justify-content: space-between;width:100%;">

                            <div class="item" style="width: 50%;">
                                <label for="expiry-date">Prazo (MM/AA)</label>
                                <input type="text" id="expiry-date" name="expiry_date" placeholder="MM/AA" required
                                    style="width:80%;" maxlength="5">
                            </div>

                            <div class="item" style="width: 50%;">
                                <label for="cvc">CVC/CVV</label>
                                <input type="text" id="cvc" name="cvc" placeholder="123" required style="width:90%;" maxlength="3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="card-name">Nome no Cartão</label>
                            <input type="text" id="card-name" name="card_name" placeholder="Nome completo" required>
                        </div>
                        
                        <button type="submit" class="btn-assinar">Assinar Agora</button>
                    </form>
                </div>

                <a href="?page=listarPlano" class="btn-assinar">Voltar</a>


    


                    <script>
                            document.getElementById('card-number').addEventListener('input', function (e) {
                                let value = e.target.value.replace(/\D/g, '');
                                e.target.value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
                            });

                        document.getElementById('expiry-date').addEventListener('input', function (e) {
                            let value = e.target.value.replace(/\D/g, '');
                            e.target.value = value.replace(/(\d{2})(?=\d)/, '$1/');
                        });
                    </script>




            </div>
        </div>

<?php } elseif ($nivel_acesso == "UNIDADE_ENSINO") {
    ?>
    <style>
            /* DIV MODO-PAGAMENTO */
            .payment-form-container {
                margin: 40px auto;
                max-width: 800px;
                background-color: #fff;
                padding: 20px 15px;
                border-radius: 8px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            .payment-form-container h2 {
                margin-bottom: 20px;
                color: #19234E;
            }

            .form-group {
                margin-bottom: 15px;
                text-align: left;
            }

            label {
                display: block;
                font-size: 14px;
                color: #333;
                margin-bottom: 5px;
            }

            input[type="text"] {
                width: 95%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 14px;
                outline: none;
                transition: border-color 0.3s;
            }

            input[type="text"]:focus {
                border-color: #19234E;
            }

            .submit-btn {
                width: 100%;
                padding: 12px;
                background-color: #19234E;
                color: #fff;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .submit-btn:hover {
                background-color: #2365a3;
            }



            /* Container do plano */
            .plano-container {
                max-width: 900px;
                margin: 40px auto;
                padding: 20px 15px;
                background-color: #f4f6f9;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                font-family: Arial, sans-serif;
            }

            /* Cabeçalho do plano */
            .plano-header h1 {
                font-size: 2.5em;
                color: #19234E;
                margin-bottom: 10px;
            }

            .plano-header h2 {
                font-size: 1.8em;
                color: #007bff;
            }

            /* Detalhes do plano */
            .plano-details {
                margin-top: 30px;
            }

            .plano-details p {
                font-size: 1.2em;
                line-height: 1.6;
                color: #333;
            }

            .plano-benefits {
                margin-top: 30px;
            }

            .plano-benefits h3 {
                font-size: 1.5em;
                color: #19234E;
                margin-bottom: 10px;
            }

            .plano-benefits ul {
                list-style-type: disc;
                padding-left: 20px;
                color: #333;
            }

            .plano-benefits ul li {
                font-size: 1.1em;
                line-height: 1.8;
            }

            /* Botão de assinar */
            .btn-assinar {
                display: inline-block;
                padding: 15px 30px;
                color: white;
                text-decoration: none;
                font-size: 1.2em;
                border-radius: 5px;
                text-align: center;
                margin-top: -10px;
                cursor: pointer;
                background-color: #19234E;

            }

            .btn-assinar:hover {
                background-color: #003d80;
            }

            .voltar {
                display: inline-block;
                padding: 15px 30px;
                background-color: #19234E;
                color: white;
                text-decoration: none;
                font-size: 1.2em;
                border-radius: 5px;
                text-align: center;
                margin-top: -10px;
                cursor: pointer;
            }

            .voltar:hover {
                background-color: #003d80;
            }

            /* Responsividade */
            @media (max-width: 768px) {
                .plano-header h1 {
                    font-size: 2em;
                }

                .plano-header h2 {
                    font-size: 1.5em;
                }

                .plano-details p {
                    font-size: 1.1em;
                }

                .plano-benefits h3 {
                    font-size: 1.3em;
                }

                .btn-assinar {
                    font-size: 1em;
                    padding: 12px 25px;
                }
            }
        </style>
                <script>
               document.getElementById('card-number').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    let maskedValue = value.slice(0, -4).replace(/\d/g, '*') + value.slice(-4); // Mascara os números, mantendo os últimos 4 visíveis
    e.target.value = maskedValue.replace(/(\d{4})(?=\d)/g, '$1 '); // Formata a saída com espaços a cada 4 dígitos
});


                    document.getElementById('expiry-date').addEventListener('input', function (e) {
                        let value = e.target.value.replace(/\D/g, '');
                        e.target.value = value.replace(/(\d{2})(?=\d)/, '$1/');
                    });
                </script>
        <?php
        //Conexão com o banco de dados
        $mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');
        if ($mysqli->connect_error) {
            die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
        }

        // Pegando o ID do plano da URL
        $plano_id = isset($_GET['cod_plano']) ? (int) $_GET['cod_plano'] : 0;

        // Buscando o plano no banco de dados
        $query = "SELECT * FROM plano WHERE cod_plano = $plano_id";
        $result = $mysqli->query($query);
        $plano = $result->fetch_assoc();

        // Verifica se o plano foi encontrado
        if (!$plano) {
            echo "Plano não encontrado.";
            exit;
        }
        ?>

        <div class="plano-container">
            <div class="plano-header">
                <h1 style="text-align:center;"><?php echo $plano['titulo_plano']; ?></h1>
                <h2>Por Mês: R$<?php echo number_format($plano['valor_plano'], 2, ',', '.'); ?></h2>
            </div>
            <div class="plano-details">


                <div class="plano-benefits">
                    <h3>Benefícios do Plano</h3>
                    <ul>
                        <?php
                        $beneficios = explode(',', $plano['corpo_plano']);
                        foreach ($beneficios as $beneficio): ?>
                            <li><?php echo trim($beneficio); ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>

                <hr style="border: 1px solid grey; margin-top:35px;">


                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mask-plugin/1.14.16/jquery.mask.min.js"></script>



                <?php
                // Simulando o ID do usuário logado (dinâmico no sistema real)
            
                $idUsuLogado = $_SESSION['idUsu'] ?? 1; // Use o ID da sessão do usuário autenticado
            
                // Simulando o ID do plano escolhido (dinâmico no sistema real)
                $cod_plano = $_GET['cod_plano'] ?? 1; // Recebido de uma página anterior ou via URL
                ?>
                <div class="payment-form-container">
                    <h2>Método de Pagamento</h2>
                    <form action="?page=processarPagamento&idPlano=?" method="post">
                        <input type="hidden" name="cod_plano" value="<?php echo $plano['cod_plano']; ?>">
                        <input type="hidden" name="idUsu" value="<?php echo $_SESSION['email']; ?>">

                        <div class="form-group">
                            <label for="card-number">Número do Cartão</label>
                            <input type="text" id="card-number" name="card_number" placeholder="0000 0000 0000 0000"
                                maxlength="19" required>
                        </div>
                        <div class="form-group" style="display: flex; justify-content: space-between;width:100%;">

                            <div class="item" style="width: 50%;">
                                <label for="expiry-date">Prazo (MM/AA)</label>
                                <input type="text" id="expiry-date" name="expiry_date" placeholder="MM/AA" required
                                    style="width:80%;" maxlength="5">
                            </div>

                            <div class="item" style="width: 50%;">
                                <label for="cvc">CVC/CVV</label>
                                <input type="text" id="cvc" name="cvc" placeholder="123" required style="width:90%;" maxlength="3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="card-name">Nome no Cartão</label>
                            <input type="text" id="card-name" name="card_name" placeholder="Nome completo" required>
                        </div>
                        
                        <button type="submit" class="btn-assinar">Assinar Agora</button>
                    </form>
                </div>
                    <a href="?page=listarPlano" class="btn-assinar">Voltar</a>

                <script>
                            document.getElementById('card-number').addEventListener('input', function (e) {
                                let value = e.target.value.replace(/\D/g, '');
                                e.target.value = value.replace(/(\d{4})(?=\d)/g, '$1 ');
                            });

                        document.getElementById('expiry-date').addEventListener('input', function (e) {
                            let value = e.target.value.replace(/\D/g, '');
                            e.target.value = value.replace(/(\d{2})(?=\d)/, '$1/');
                        });
                    </script>




            </div>
        </div>

    <?php
}
?>