<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Avaliação</title>
</head>
<body>

<style>
form {
    background-color: #ffffff; /* Branco */
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 123, 255, 0.1);
    max-width: 600px;
    margin: auto;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

input[type="text"],
textarea,
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #007bff; /* Azul */
    border-radius: 4px;
    transition: border-color 0.3s;
    width: 95%;
}

input[type="text"]:focus,
textarea:focus,
select:focus {
    border-color: #0056b3; /* Azul mais escuro ao focar */
    outline: none;
   
}

textarea {
    resize: vertical;
}

button {
    background-color: #007bff; /* Azul padrão */
    color: white;
    border: none;
    border-radius: 4px;
    padding: 10px 15px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3; /* Azul mais escuro ao passar o mouse */
}

.questao {
    margin-bottom: 20px;
    padding: 15px;
    background-color: #e9f5ff; /* Azul muito claro */
    border: 1px solid #cce5ff; /* Azul claro */
}
</style>
    <h1>Adicionar Avaliação</h1>
    <form action="?page=inserirAv" method="POST">
        <label for="titulo">Título da Avaliação:</label>
        <input type="text" name="titulo" id="titulo" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" required></textarea><br><br>

        <label for="nivel_dificuldade">Nível de Dificuldade:</label>
        <select name="nivel_dificuldade" id="nivel_dificuldade">
            <option value="facil">Fácil</option>
            <option value="medio">Médio</option>
            <option value="dificil">Difícil</option>
        </select><br><br>

        <h2>Adicionar Questões</h2>
        <div id="questoes">
            <div class="questao">
                <label>Enunciado:</label>
                <textarea name="enunciado[]" required></textarea><br>

                <label>Opção A:</label>
                <input type="text" name="opcao_a[]" required><br>

                <label>Opção B:</label>
                <input type="text" name="opcao_b[]" required><br>

                <label>Opção C:</label>
                <input type="text" name="opcao_c[]" required><br>

                <label>Opção D:</label>
                <input type="text" name="opcao_d[]" required><br>

                <label>Resposta Correta:</label>
                <select name="resposta_correta[]" required>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                </select><br><br>
            </div>
        </div>
        
        <button type="button" onclick="adicionarQuestao()">Adicionar Mais Questões</button><br><br>
        <button type="submit">Salvar Avaliação</button>
    </form>

    <script>
        function adicionarQuestao() {
            const questoesDiv = document.getElementById('questoes');
            const novaQuestao = document.querySelector('.questao').cloneNode(true);
            questoesDiv.appendChild(novaQuestao);
        }
    </script>
</body>
</html>
