<?php
// Iniciar a sessão

// Conectar ao banco de dados
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');
if ($mysqli->connect_error) {
    die('Erro na conexão: ' . $mysqli->connect_error);
}

// Verifique se o nível de acesso está definido na sessão
if (isset($_SESSION['nivel_acesso']) && isset($_SESSION['email'])) {
    $nivel_acesso = $_SESSION['nivel_acesso'];
    $email = $_SESSION['email'];

?>
    <h1>Seu perfil, <?php echo $_SESSION['nome']; ?></h1>
    <fieldset>
        <?php
        // Ações para cada nível de acesso
        if ($nivel_acesso == "ADMINISTRADOR") {
            // Preparar a query para o administrador
            $stmt = $mysqli->prepare("SELECT * FROM administrador WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $dados_admin = $result->fetch_assoc();
            $foto = htmlspecialchars($dados_admin['foto']);
            $pasta = "/TecnoInfo/";
            $destino = $pasta . "img/user/";
        ?>
            <div class="foto">
                <div class="input-perfil" id="input-perfil" style="background-image: url('<?php echo $destino . $foto; ?>');">
                </div>
                <center style="margin-top: 10px;"><label for="input-perfil" class="label-input-perfil">Sua foto de perfil</label></center>
            </div>
            <div class="info">
                <label for="nome">Nome</label>
                <div class="input-group">
                    <div class="input nome"><?php echo htmlspecialchars($dados_admin['nome']); ?></div>
                </div>
                <label for="email">Email</label>
                <div class="input-group">
                    <div class="input email"><?php echo htmlspecialchars($dados_admin['email']); ?></div>
                </div>
                <label for="senha">Senha</label>
                <div class="input-group ultimo">
                    <input type="password" class="input senha" value="<?php echo htmlspecialchars($dados_aluno['senha']); ?>"
                        disabled>
                </div>
            </div>

        <?php
        } elseif ($nivel_acesso == "ALUNO") {
            // Preparar a query para o aluno
            $stmt = $mysqli->prepare("SELECT * FROM aluno WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $dados_aluno = $result->fetch_assoc();
            $foto = isset($_SESSION['foto']) ? $_SESSION['foto'] : htmlspecialchars($dados_aluno['foto']);
        ?>
            <div class="foto">
                <div class="input-perfil" id="input-perfil" style="background-image: url('/TecnoInfo/img/user/<?php echo $foto; ?>?v=<?php echo time(); ?>');"></div>
                <center style="margin-top: 10px;">
                    <label for="input-perfil" class="label-input-perfil">Sua foto de perfil</label>
                </center>
            </div>
            <div class="info">
                <label for="nome">Nome</label>
                <div class="input-group">
                    <div class="input nome"><?php echo htmlspecialchars($dados_aluno['nome']); ?></div>
                </div>
                <label for="email">Email</label>
                <div class="input-group">
                    <div class="input email"><?php echo htmlspecialchars($dados_aluno['email']); ?></div>
                </div>
                <label for="senha">Senha</label>
                <div class="input-group ultimo">
                    <input type="password" class="input senha" value="<?php echo htmlspecialchars($dados_aluno['senha']); ?>" disabled>
                </div>
            </div>

            <script>
                function mostrarImagem(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('input-perfil').style.backgroundImage = 'url(' + e.target.result + ')';
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>

        <?php
        } elseif ($nivel_acesso == "UNIDADE_ENSINO") {
            // Preparar a query para a unidade de ensino
            $stmt = $mysqli->prepare("SELECT * FROM unidade_ensino WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $dados_unidade = $result->fetch_assoc();
            $foto = htmlspecialchars($dados_unidade['foto']);
            $pasta = "/TecnoInfo/";
            $destino = $pasta . "img/user/";
        ?>

            <div class="foto">
                <div class="input-perfil" id="input-perfil"
                    style="background-image: url('<?php echo $destino . $foto; ?>');"></div>
                <center style="margin-top: 10px;"><label for="input-perfil" class="label-input-perfil">Sua foto de
                        perfil</label></center>
            </div>
            <div class="info">
                <label for="nome">Nome</label>
                <div class="input-group">
                    <div class="input nome"><?php echo htmlspecialchars($dados_unidade['nome']); ?></div>
                </div>

                <div class="flex">
                    <div class="dado">
                        <label for="cnpj">CNPJ</label>
                        <div class="input-group">
                            <div class="input cnpj"><?php echo htmlspecialchars($dados_unidade['cnpj']); ?></div>
                        </div>
                    </div>

                    <div class="dado">
                        <label for="tel">Telefone</label>
                        <div class="input-group" id="last">
                            <div class="input tel"><?php echo htmlspecialchars($dados_unidade['tel']); ?></div>
                        </div>
                    </div>
                </div>

                <div class="flex">
                    <div class="dado">
                        <label for="insc_est">Inscrição Estadual</label>
                        <div class="input-group">
                            <div class="input insc_est"><?php echo htmlspecialchars($dados_unidade['insc_est']); ?></div>
                        </div>
                    </div>


                    <div class="dado">
                        <label for="nivel_ensino">Nível de Ensino</label>
                        <div class="input-group" id="last">
                            <div class="input nivel_ensino"><?php echo htmlspecialchars($dados_unidade['nivel_ensino']); ?></div>
                        </div>
                    </div>
                </div>

                <label for="email">Email</label>
                <div class="input-group">
                    <div class="input email"><?php echo htmlspecialchars($dados_unidade['email']); ?></div>
                </div>


                <label for="senha">Senha</label>
                <div class="input-group ultimo">
                    <input type="password" class="input senha" value="<?php echo htmlspecialchars($dados_unidade['senha']); ?>"
                        disabled>
                </div>


            </div>

            <script>
                function mostrarImagem(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('input-perfil').style.backgroundImage = 'url(' + e.target.result + ')';
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>

    <?php } else {
            echo "Nível de acesso inválido.";
        }
    } else {
        echo "Nível de acesso ou email não definido. Por favor, faça login.";
    }
    ?>

    </fieldset>

    <a href="?page=editPerfil" class="btn">Editar perfil</a>

    <style>
        fieldset {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .label-input-perfil {
            margin: 10px auto;
        }

        .info {
            width: 80%;
        }

        .foto {
            margin-right: 100px;
        }

        .flex {
            display: flex;
            width: 60%;
        }

        .dado {
            width: 90%;
        }
        
        .dado>.input-group {
            width: 95%;
        }

        #last {
            width: 100%;
        }

        .dado>.input-group>.input {
            width: 90%;
        }

        /* Estilo para a div de perfil com imagem */
        .input-perfil {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-image: url('../img/user/semfoto.png');
            background-size: cover;
            background-position: center;
            border: 2px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .input-group {
            width: 60%;
            height: 50px;
            border-radius: 20px;
            border: 2px solid gray;
            margin: 10px 0;
        }

        .input {
            border: none;
            background-color: transparent;
            padding: 15px;
            color: gray;
        }

        .ultimo {
            margin-bottom: 20px;
        }

        .btn {
            margin: 25px 0 0 0;
            padding: 10px;
            border-radius: 10px;
            background-color: #2365a3;
            cursor: pointer;
            color: #fff;
            text-decoration: none;
            float: right;
        }

        .btn:hover {
            background-color: #19234E;
        }
    </style>