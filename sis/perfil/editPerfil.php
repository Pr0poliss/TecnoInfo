<?php
// Iniciar a sessão e verificar o nível de acesso
// session_start();

// Conectar ao banco de dados
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');
if ($mysqli->connect_error) {
    die('Erro na conexão: ' . $mysqli->connect_error);
}
?>

<style>
    form {
        display: flex;
        flex-direction: column;
        width: 50%;
        margin: 0 auto;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="file"] {
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    button {
        padding: 10px;
        background-color: #2365a3;
        color: white;
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #19234e;
    }
</style>

<?php
if (isset($_SESSION['nivel_acesso']) && isset($_SESSION['email'])) {
    $nivel_acesso = $_SESSION['nivel_acesso'];
    $email = $_SESSION['email'];

    // Recuperar os dados do usuário
    if ($nivel_acesso == "ADMINISTRADOR") {
        $stmt = $mysqli->prepare("SELECT * FROM administrador WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $dados = $result->fetch_assoc();
    } elseif ($nivel_acesso == "ALUNO") {
        $stmt = $mysqli->prepare("SELECT * FROM aluno WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $dados = $result->fetch_assoc();
    } elseif ($nivel_acesso == "UNIDADE_ENSINO") {
        $stmt = $mysqli->prepare("SELECT * FROM unidade_ensino WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $dados = $result->fetch_assoc();
    } else {
        echo "Nível de acesso inválido.";
        exit;
    }

    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $senha_confirm = $_POST['senha_confirm'];
        $foto_atual = $dados['foto'];

        // Validar senha (se estiver alterando)
        if ($senha != $senha_confirm) {
            $erro = "As senhas não coincidem!";
        } else {
            // Preparar a query de atualização
            if (!empty($senha)) {
                $stmt = $mysqli->prepare("UPDATE {$nivel_acesso} SET nome = ?, senha = ? WHERE email = ?");
                $stmt->bind_param("sss", $nome, password_hash($senha, PASSWORD_DEFAULT), $email);
            } else {
                $stmt = $mysqli->prepare("UPDATE {$nivel_acesso} SET nome = ? WHERE email = ?");
                $stmt->bind_param("ss", $nome, $email);
            }

            $stmt->execute();

            // Atualizar foto
            if ($_FILES['foto']['error'] == 0) {
                $foto_temp = $_FILES['foto']['tmp_name'];
                $foto_nome = $_FILES['foto']['name'];
                $foto_pasta = '/TecnoInfo/img/user/';
                $foto_novo_nome = uniqid() . '-' . $foto_nome;
                move_uploaded_file($foto_temp, $foto_pasta . $foto_novo_nome);

                // Atualizar a foto no banco de dados
                $stmt = $mysqli->prepare("UPDATE {$nivel_acesso} SET foto = ? WHERE email = ?");
                $stmt->bind_param("ss", $foto_novo_nome, $email);
                $stmt->execute();
            }

            // Redirecionar para a tela de perfil com uma mensagem de sucesso
            header("Location: perfil.php");
            exit;
        }
    }
    ?>
    <h1>Editar perfil</h1>
    <form method="POST" action="?page=editProcess" enctype="multipart/form-data">
        <label for="nome">Nome</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($dados['nome']); ?>" required>

        <label for="email">Email</label>
        <input type="email" value="<?php echo htmlspecialchars($dados['email']); ?>" disabled>

        <label for="senha">Nova senha</label>
        <input type="password" name="senha" placeholder="Digite a nova senha (se quiser mudar)" required>

        <label for="senha_confirm">Confirmar nova senha</label>
        <input type="password" name="senha_confirm" placeholder="Confirme a nova senha" required>

        <label for="foto">Nova foto de perfil</label>
        <input type="file" name="foto">

        <input type="hidden" name="foto_atual" value="<?php echo $dados['foto']; ?>">
        
        <div class="acao">
            <a href="?page=perfil"><button type="button">Cancelar</button></a>
            <button type="submit">Salvar alterações</button>
        </div>
    </form>

    <?php if (isset($erro)) {
        echo "<p>$erro</p>";
    } ?>
<?php
} else {
    echo "Você não está logado. Faça login para editar seu perfil.";
}
?>