<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de unidade</title>
    <link rel="shortcut icon" href="../../img/logo/logo-figure_colorida.png" type="image/x-icon">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    #voltar {
        position: absolute;
        top: 20px;
        left: 20px;
        width: 10px;
    }

    #voltar>img {
        width: 100%;
    }

    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: var(--f03);
        background: linear-gradient(170deg, #ffff, #8E8E8E);
        background-repeat: no-repeat;
        background-size: cover;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }

    .login-box {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 50px 40px;
        border-radius: 15px;
        box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.2);
        max-width: 1100px;
        width: 100%;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .form-container {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    h2 {
        margin-bottom: 30px;
        color: #333;
        font-size: 28px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .input-group {
        margin-bottom: 10px;
        text-align: left;
    }

    .input-group label {
        display: block;
        margin-bottom: 10px;
        font-size: 14px;
        color: #555;
    }

    .input-group input[type="text"],
    .input-group input[type="email"],
    .input-group input[type="password"],
    .input-group input[type="number"],
    .input-group input[type="tel"],
    .input-group>select {
        width: 100%;
        padding: 12px;
        border: 2px solid #ddd;
        border-radius: 25px;
        font-size: 16px;
        background-color: #f7f7f7;
        transition: border 0.3s ease;
    }

    .input-group input[type="file"] {
        width: 100%;
        padding: 9px;
        border: 2px solid #ddd;
        border-radius: 25px;
        font-size: 16px;
        background-color: #f7f7f7;
        transition: border 0.3s ease;
    }


    #login {
        width: 49%;
    }


    .input-group input[type="email"]:focus,
    .input-group input[type="password"]:focus {
        border-color: #6e45e2;
        background-color: #fff;
        outline: none;
    }

    .input-group input[type="submit"] {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 25px;
        background-color: #202e9c;
        color: white;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .input-group input[type="submit"]:hover {
        background-color: #011231;
    }

    .forgot-password {
        margin-top: 15px;
        font-size: 14px;
    }

    .forgot-password a {
        text-decoration: none;
        color: #030f55;
        transition: color 0.3s;
    }

    .forgot-password a:hover {
        color: #1f3299;
    }

    /* Extra visual enhancements */
    .login-box::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(110, 69, 226, 0.15);
        border-radius: 50%;
        z-index: 0;
    }

    .login-box::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        background: rgba(136, 211, 206, 0.15);
        border-radius: 50%;
        z-index: 0;
    }

    .login-box form {
        position: relative;
        z-index: 1;
    }

    /* Estilo para a div de perfil com imagem */
    .input-perfil {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        margin: 10px 20px 10px auto;
        overflow: hidden;
        background-image: url('../../img/semfoto.png');
        /* Imagem padrão */
        background-size: cover;
        background-position: center;
        cursor: pointer;
        position: relative;
        border: 2px solid #ddd;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .input-perfil:hover {
        border-color: #6e45e2;
    }

    .input-perfil input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .flex {
        display: flex;
        justify-content: space-between;
    }

    #dados {
        width: 33%;
    }

    .column {
        width: 80%;
    }
</style>

<body>
    <a href="../../?page=opc_cadastro" id="voltar"><img src="../../img/icons/Voltar.png" alt=""></a>
    <div class="login-container">
        <form action="cadastro_process_ue.php" method="post" enctype="multipart/form-data" class="form-container">
            <input type="hidden" name="nivel_acesso" value="UNIDADE_ENSINO">

            <!-- Div de upload personalizada -->
            <div class="perfil">
                <div class="input-perfil" id="input-perfil">
                    <input type="file" name="foto" id="foto" accept="image/*" onchange="mostrarImagem(this)">
                </div>
            </div>
            <div class="column">
                <div class="input-group">
                    <label for="nome">Nome da unidade</label>
                    <input type="text" name="nome" placeholder="Digite seu nome aqui." required>
                </div>
                <div class="flex">
                    <div class="input-group" id="login">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" placeholder="Digite seu e-mail aqui." required>
                    </div>
                    <div class="input-group" id="login">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" placeholder="Digite sua senha aqui." required>
                    </div>
                </div>
                <div class="flex">
                    <div class="input-group" id="dados">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" name="cnpj" maxlength="18" oninput="mascaraCNPJ(this)" placeholder="00.000.000/0000-00" required>
                    </div>
                    <div class="input-group" id="dados">
                        <label for="text">Telefone</label>
                        <input type="tel" name="tel" maxlength="15" oninput="mascaraTelefone(this)" required>
                    </div>
                    <div class="input-group" id="dados">
                        <label for="insc_est">Inscrição Estadual</label>
                        <input type="number" name="insc_est" placeholder="Apresente a Inscrição Estadual de sua Unidade de Ensino" required>
                    </div>
                </div>
                <div class="input-group">
                    <label for="nivel_ensino">Nível de ensino</label>
                    <select name="nivel_ensino">
                        <option>Selecione</option>
                        <option value="fundamental">Fundamental</option>
                        <option value="medio">Médio</option>
                        <option value="todos">Os dois</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="doc_unid">Documento da unidade</label>
                    <input type="file" name="doc_unid" placeholder="Carregue a documentação de sua unidade" required>
                </div>
                <div class="input-group"><input type="submit" value="Registrar"></div>
            </div>

            <script>
                function mostrarImagem(input) {
                    // Verifica se o usuário selecionou um arquivo
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        // Quando o arquivo for carregado
                        reader.onload = function(e) {
                            // Define o background da div com a imagem selecionada
                            document.getElementById('input-perfil').style.backgroundImage = 'url(' + e.target.result + ')';
                        }

                        // Lê o arquivo como uma URL de dados
                        reader.readAsDataURL(input.files[0]);
                    }
                }


                // funcoe mascara
                function mascaraTelefone(input) {
    let telefone = input.value;

    // Remove todos os caracteres não numéricos
    telefone = telefone.replace(/\D/g, '');

    // Formata o telefone
    telefone = telefone.replace(/^(\d{2})(\d)/, '($1) $2'); // Código de área
    telefone = telefone.replace(/(\d{5})(\d{4})$/, '$1-$2'); // Número do telefone

    input.value = telefone;
}

function mascaraCNPJ(input) {
    let cnpj = input.value;

    // Remove todos os caracteres não numéricos
    cnpj = cnpj.replace(/\D/g, '');

    // Adiciona a máscara no formato XX.XXX.XXX/XXXX-XX
    cnpj = cnpj.replace(/^(\d{2})(\d)/, '$1.$2');
    cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
    cnpj = cnpj.replace(/^(\d{2})\.(\d{3})\.(\d{3})(\d)/, '$1.$2.$3/$4');
    cnpj = cnpj.replace(/^(\d{2})\.(\d{3})\.(\d{3})\/(\d{4})(\d)/, '$1.$2.$3/$4-$5');

    input.value = cnpj;
}




            </script>
        </form>
    </div>
</body>

</html>