<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo_aula'];
    $desc = $_POST['descricao_aula'];
    $cont = $_POST['conteudo_aula'];

    $mysqli->query("INSERT INTO aula(titulo_aula, descricao_aula, conteudo_aula) VALUES ('$titulo', '$desc', $cont)");

    if (mysqli_query($conn, $sql)) {
        echo "Novo registro criado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>


<style>


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
input[type="email"],
input[type="password"],
input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
input[type="number"]:focus {
    border-color: #4CAF50;
}

button[type="submit"] {
    width: 100%;
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

.btn-add {
    text-align: center;
    display: inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    color: white;
    background-color: #19234E;
    text-decoration: none;
    border-radius: 5px;
}

.btn-add:hover {
    background-color: #0D579C;
}

</style>
    <h1 style="text-align: center;">Adicionar aula</h1>
    <form action="?page=inserirAula" method="POST">
    <button type="button" class="btn btn-primary btn-sm" onclick="window.history.go(-1)"> Voltar </button>
        <label>Título:</label>
        <input type="text" name="titulo_aula" required>
        
        <label>Descrição:</label>
        <input type="text" name="descricao_aula" required>
        
        <label>Conteúdo:</label>
        <textarea name="conteudo_aula" id="conteudo_aula" name="conteudo_aulas" rows="15" style="width:100%"></textarea>
        
       
        
        <button type="submit" class="btn-add">Salvar</button>
    </form>

