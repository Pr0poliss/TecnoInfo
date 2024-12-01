<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

// Verifique se a conexão foi bem-sucedida
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

$idTutor = $_GET['idTutor'];  // ID do tutor a ser editado

// Busca os dados do tutor no banco
$query = "SELECT * FROM tutor WHERE idTutor = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $idTutor);
$stmt->execute();
$result = $stmt->get_result();
$tutor = $result->fetch_assoc();

// Verifica se o tutor foi encontrado
if (!$tutor) {
    die("Tutor não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = $_POST['senha'] ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : $tutor['senha']; // Verifica se a senha foi alterada
    $autenticidade = $_POST['autenticidade'];
    
    // Atualiza os dados no banco
    $query = "UPDATE tutor SET nome = ?, cpf = ?, email = ?, senha = ?, autenticidade = ? WHERE idTutor = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssssi", $nome, $cpf, $email, $senha, $autenticidade, $idTutor);

    if ($stmt->execute()) {
        echo "Dados atualizados com sucesso.";
    } else {
        echo "Erro ao atualizar dados: " . $stmt->error;
    }

    // Atualiza a foto, se houver
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $fotoNome = $_FILES['foto']['name'];
        $fotoTmp = $_FILES['foto']['tmp_name'];
        $extensao = pathinfo($fotoNome, PATHINFO_EXTENSION);

        // Define o caminho para salvar a foto
        $fotoNovoNome = uniqid() . '.' . $extensao;
        $fotoDestino = '../../img/user/' . $fotoNovoNome;

        // Mover o arquivo para o diretório 'uploads'
        if (move_uploaded_file($fotoTmp, $fotoDestino)) {
            // Atualiza o nome da foto no banco de dados
            $query = "UPDATE tutor SET foto = ? WHERE idTutor = ?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param("si", $fotoDestino, $idTutor);
            $stmt->execute();
        }
    }
}

// Fecha a conexão
$stmt->close();
$mysqli->close();
?>
<style>
    /* Estilos gerais para o formulário */
h1 {
    font-family: Arial, sans-serif;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Estilizando a área do formulário */
form {
    width: 70%;
    margin: 0 auto;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Estilizando cada input dentro do formulário */
.input-group {
    margin-bottom: 15px;
}

.column {
    width: 100%;
    margin-left: 20px;
}

.column>div>input{
    width: 95%;
}

.input-group label {
    display: block;
    font-size: 14px;
    font-weight: bold;
    color: #555;
    margin-bottom: 5px;
}

.input-group input,
.input-group select {
    width: 96%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}

.input-group input[type="file"] {
    display: none; /* Esconde o input padrão de arquivo */
}

/* Estilo do botão de upload de foto */
.input-perfil {
    position: relative;
    min-width: 150px;
    height: 150px;
    margin-bottom: 20px;
    border-radius: 50%;
    background-image: url(../img/semfoto.png);
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    cursor: pointer;
    border: 3px solid #ffffff00;
    transition: 0.2s;
}

.input-perfil:hover {
    border: 3px solid #0096c7;
    opacity: 0.8;
}

.input-perfil input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.input-group input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #19234E;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.input-group input[type="submit"]:hover {
    background-color: #007ea7;
}

.input-group input[type="submit"]:active {
    background-color: #006f8e;
}

/* Estilos responsivos */
@media (max-width: 768px) {
    form {
        width: 90%;
    }

    .input-group {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .input-perfil {
        width: 120px;
        height: 120px;
    }

    .input-group input[type="submit"] {
        font-size: 14px;
        padding: 10px;
    }
}

</style>

<h1>Editar Tutor</h1>

<form action="?page=updateTutor&idTutor=?" method="post" enctype="multipart/form-data">
    <!-- Div de upload personalizada -->
    <div class="flex">
        <div class="input-perfil" id="input-perfil">
            <input type="file" name="foto" id="foto" accept="image/*" onchange="mostrarImagem(this)">
        </div>
        <div class="column">
            <div class="input-group">
                <label for="nome">Nome completo</label>
                <input type="text" name="nome" value="<?php echo $tutor['nome']; ?>" required>
            </div>
            <div class="input-group">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" maxlength="14" value="<?php echo $tutor['cpf']; ?>" oninput="mascaraCPF(this)" placeholder="000.000.000-00" required>
            </div>
        </div>
    </div>

    <div class="input-group">
        <label for="email">E-mail</label>
        <input type="email" name="email" value="<?php echo $tutor['email']; ?>" required>
    </div>

    <div class="input-group">
        <label for="senha">Senha</label>
        <input type="password" name="senha" placeholder="Deixe em branco para manter a senha atual">
    </div>
    
    <div class="input-group"><input type="submit" value="Atualizar"></div>
</form>
<a href="javascript:history.back()" style="display: inline-block; padding: 10px 20px; background-color: #19234E; color: white; font-size: 16px; text-decoration: none; border-radius: 5px; text-align: center; transition: background-color 0.3s;">
    Voltar
</a>


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

    function mascaraCPF(input) {
        let cpf = input.value;

        // Remove todos os caracteres não numéricos
        cpf = cpf.replace(/\D/g, '');

        // Formata o CPF
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Primeiro ponto
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); // Segundo ponto
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Traço

        input.value = cpf;
    }
</script>
