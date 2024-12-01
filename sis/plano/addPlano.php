<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo_plano'];
    $valor = $_POST['valor_plano'];
    $beneficios = $_POST['beneficios']; // Recebe os benefícios como array
    $usuFinal = $_POST['usuFinal'];

    // Converte o array de benefícios em uma string separada por vírgulas (ou outro delimitador)
    $beneficiosConcatenados = implode(', ', $beneficios);

    // Prepara a query para inserir no banco
    $sql = "INSERT INTO plano (titulo_plano, valor_plano, corpo_plano, usuFinal) VALUES ('$titulo', '$valor', '$beneficiosConcatenados', '$usuFinal')";

    if ($mysqli->query($sql)) {
        echo "Novo registro criado com sucesso";
        echo "<script> setTimeout(function() {window.location.href = '?page=listarPlano';}, 1); // redireciona após 3 segundos</script>";
    } else {
        echo "Erro: " . $sql . "<br>" . $mysqli->error;
    }
}
?>

<style>
    /* Seu CSS permanece igual */
    form {
        max-width: 600px;
        margin: auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #333;
    }

    input[type="text"],
    select,
    input[type="number"] {
        width: 96%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    select {
        width: 100%;
    }

    button[type="submit"],
    button[type="button"] {
        width: 80%;
        margin-left: 55px;
        margin-bottom: 30px;
        padding: 10px;
        background-color: #19234E;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #0D579C;
    }

    #voltar {
        margin-left: 1px;
        width: 80px;
    }
</style>

<form action="" method="POST">
    <button type="button" class="btn btn-primary btn-sm" id="voltar" onclick="window.history.go(-1)"> Voltar </button>

    <label>Título:</label>
    <input type="text" name="titulo_plano" required>

    <label>Valor:</label>
    <input type="text" id="valor_plano" name="valor_plano" required>

    <label for="usuFinal">Usuário Final</label>
    <select name="usuFinal" id="usuFinal">
        <option value="">Selecione</option>
        <option value="ALUNO">Aluno</option>
        <option value="UNIDADE_ENSINO">Unidade de Ensino</option>
    </select>

    <label>Benefícios:</label>
    <div id="beneficios-container">
        <input type="text" name="beneficios[]" required>
    </div>
    <button type="button" onclick="adicionarBeneficio()">Adicionar Benefício</button>

    <button type="submit" class="btn-add">Salvar</button>
</form>
<a style="background-color: #19234E; color:white; text-decoration:none; padding:10px; float:left; border-radius:7px; width: 70px; text-align:center;" href="?page=listarPlano">Voltar</a>

<script>
    // Função para adicionar campo de benefício
    function adicionarBeneficio() {
        const container = document.getElementById('beneficios-container');
        const novoCampo = document.createElement('input');
        novoCampo.type = 'text';
        novoCampo.name = 'beneficios[]';
        novoCampo.required = true;
        container.appendChild(novoCampo);
    }

    // Função de máscara para valor decimal
    document.getElementById('valor_plano').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/\D/g, ''); // Remove todos os caracteres que não são números
        value = (parseInt(value) / 100).toFixed(2); // Divide por 100 para ajustar o valor decimal
        e.target.value = value.replace('.', ','); // Troca ponto por vírgula, se necessário
    });
</script>