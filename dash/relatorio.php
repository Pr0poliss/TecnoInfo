<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>

<style>
    .box {
        box-shadow: 0 0 10px black;
        border-radius: 20px;
        margin-bottom: 70px;
        padding: 20px 50px 20px 20px;
    }

    .status {
        display: flex;
        justify-content: space-between;
    }

    #imagem {
        height: 200px;
        margin-left: -30px;
    }

    .hr-ADM {
        border: 1px solid gray;
        width: 80%;
        margin: 20px auto 0 auto;
    }

    .hr-alu {
        height: 200px;
        margin: 0 50px;
        border: 1px solid gray;
    }

    .escolas {
        box-shadow: 0 0 10px black;
        border-radius: 10px;
        padding: 50px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        margin-top: 20px;
        align-items: center;
        justify-content: space-around;
    }

    .escola {
        /* display: flex; */
        flex-direction: column;
        flex-wrap: wrap;
        text-align: center;
        width: 200px;
        height: 300px;
        padding: 10px 15px;
        border: 2px solid #19234E;
        box-shadow: 0px 5px 10px grey;
        border-radius: 10px;
    }

    .escola>figure {
        width: 150px;
        height: 150px;
        margin: 0 auto;
    }

    .escola>figure>img {
        width: 100%;
        height: 100%;
        overflow: hidden;
        border-radius: 50%;
    }

    .btn {
        margin: 10px 0 0 0;
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

    canvas {
        max-width: 600px;
        margin-top: 20px;
    }
</style>

<h1>Relatório semanal de <?php echo $_SESSION['nome']; ?></h1>

<?php if ($_SESSION['nivel_acesso'] == 'ADMINISTRADOR') {
    // Consulta para obter as unidades de ensino
    $result = $mysqli->query("SELECT * FROM unidade_ensino");
    ?>

    <h2>Unidades de ensino cadastradas</h2>
    <div class="escolas">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="escola">
                <figure>
                    <img src="tecnoinfo/<?php echo htmlspecialchars($row['foto']); ?>"
                        alt="<?php echo htmlspecialchars($row['nome']); ?>">
                </figure>
                <div class="hr-ADM"></div>
                <div class="info">
                    <p>Nome da unidade: <br> <?php echo htmlspecialchars($row['nome']); ?></p>
                    <p>Nível de ensino: <br> <?php echo htmlspecialchars($row['nivel_ensino']); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <a href="?page=listarUni" class="btn">Ver todas as escolas</a>

<?php } elseif ($_SESSION['nivel_acesso'] == 'ALUNO') { ?>

    <div class="box">
        <h2>Rendimento</h2>
        <div class="status">
            <!-- Gráfico de Pizza com tamanho maior -->
            <div id="grafico-pizza-container">
                <canvas id="graficoPizza" width="320" height="320" style="margin-top:20px ;"></canvas>
                <!-- Aumentado para 400x400 -->
            </div>

            <div class="hr-alu" style="height: 400px;"></div>

            <!-- Gráfico de Barras com tamanho proporcional ao gráfico de pizza -->
            <div id="grafico-container">
                <canvas id="graficoSemanal" width="400" height="300"></canvas> <!-- Aumentado para 300x300 -->
            </div>
        </div>

        <div class="p" style="margin-left:700px;">
            <strong>
                <p>Total de horas esta semana: 49 horas</p>
            </strong>
        </div>

    </div>

    <script>
        // Dados para o gráfico de barras (rendimento semanal)
        var dadosGraficoSemanal = {
            labels: ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"], // Dias da semana
            datasets: [{
                label: 'Horas de Estudo',
                data: [6, 7, 8, 6, 5, 4, 3], // Horas de estudo por dia
                backgroundColor: 'rgba(38, 132, 255, 0.5)',
                borderColor: 'rgba(38, 132, 255, 1)',
                borderWidth: 1
            }]
        };

        var configGraficoSemanal = {
            type: 'bar',
            data: dadosGraficoSemanal,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Criação do gráfico de barras
        var ctxSemanal = document.getElementById('graficoSemanal').getContext('2d');
        new Chart(ctxSemanal, configGraficoSemanal);

        // Dados para o gráfico de pizza (distribuição de tarefas ou algo similar)
        var dadosGraficoPizza = {
            labels: ["Concluídas", "Pendentes", "Em progresso"], // Tarefas ou status
            datasets: [{
                label: 'Distribuição de Tarefas',
                data: [50, 30, 20], // Percentuais (substitua com dados reais)
                backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384'],
                hoverOffset: 4
            }]
        };

        var configGraficoPizza = {
            type: 'pie',
            data: dadosGraficoPizza,
            options: {
                responsive: true
            }
        };

        // Criação do gráfico de pizza
        var ctxPizza = document.getElementById('graficoPizza').getContext('2d');
        new Chart(ctxPizza, configGraficoPizza);
    </script>

<?php } elseif ($_SESSION['nivel_acesso'] == 'UNIDADE_ENSINO') { ?>

    <?php

    // Contando o número de tutores
$queryTutores = "SELECT COUNT(*) AS total_tutores FROM tutor";
$resultTutores = $mysqli->query($queryTutores);
$tutores = $resultTutores->fetch_assoc();
$totalTutores = $tutores['total_tutores'];

// Contando o número de turmas
$queryTurmas = "SELECT COUNT(*) AS total_turmas FROM turma";
$resultTurmas = $mysqli->query($queryTurmas);
$turmas = $resultTurmas->fetch_assoc();
$totalTurmas = $turmas['total_turmas'];

    
    
    ?>
    <style>

        .caixona{
    
            margin-top: 40px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 40px;
        }
        .caixa{
        box-shadow: 0 0 10px #19234E;
        border-radius: 20px;
        margin-bottom: 40px;
        padding: 20px;
        width: 30%;
        height: 180px;
        margin: auto;
        

        }

           .titulo{
            text-align: center;
            font-size: 2.0em;
            color: #19234E;
            margin-top: 40px;
           }

           .info{
            font-size: 2.3em;
            text-align: center;
            margin-top: -12px;
           }
      
    </style>
    
    <div class="caixona">
        <div class="caixa azulF">
            <h2 class="titulo" style="font-size: 1.8em">Tutores cadastrados</h2>
            <p class="info"><?php echo $totalTutores; ?></p> <!-- Exibe o número de tutores -->
        </div>
        <div class="caixa azulM">
            <h2 class="titulo" style="font-size: 1.8em">Turmas da Unidade</h2>
            <p class="info"><?php echo $totalTurmas; ?></p> <!-- Exibe o número de turmas -->
        </div>
    </div>

    <div class="box">
        <h2>Rendimento</h2>
        <div class="status">
            <!-- Gráfico de Pizza com tamanho maior -->
            <div id="grafico-pizza-container">
                <canvas id="graficoPizza" width="320" height="320" style="margin-top:20px ;"></canvas>
                <!-- Aumentado para 400x400 -->
            </div>

            <div class="hr-alu" style="height: 400px;"></div>

            <!-- Gráfico de Barras com tamanho proporcional ao gráfico de pizza -->
            <div id="grafico-container">
                <canvas id="graficoSemanal" width="400" height="300"></canvas> <!-- Aumentado para 300x300 -->
            </div>
        </div>

        <div class="p" style="margin-left:700px;">
            <strong>
                <p>Total de horas esta semana: 49 horas</p>
            </strong>
        </div>

    </div>

    <script>
        // Dados para o gráfico de barras (rendimento semanal)
        var dadosGraficoSemanal = {
            labels: ["Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado", "Domingo"], // Dias da semana
            datasets: [{
                label: 'Horas de Estudo',
                data: [6, 7, 8, 6, 5, 4, 3], // Horas de estudo por dia
                backgroundColor: 'rgba(38, 132, 255, 0.5)',
                borderColor: 'rgba(38, 132, 255, 1)',
                borderWidth: 1
            }]
        };

        var configGraficoSemanal = {
            type: 'bar',
            data: dadosGraficoSemanal,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Criação do gráfico de barras
        var ctxSemanal = document.getElementById('graficoSemanal').getContext('2d');
        new Chart(ctxSemanal, configGraficoSemanal);

        // Dados para o gráfico de pizza (distribuição de tarefas ou algo similar)
        var dadosGraficoPizza = {
            labels: ["Concluídas", "Pendentes", "Em progresso"], // Tarefas ou status
            datasets: [{
                label: 'Distribuição de Tarefas',
                data: [50, 30, 20], // Percentuais (substitua com dados reais)
                backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384'],
                hoverOffset: 4
            }]
        };

        var configGraficoPizza = {
            type: 'pie',
            data: dadosGraficoPizza,
            options: {
                responsive: true
            }
        };

        // Criação do gráfico de pizza
        var ctxPizza = document.getElementById('graficoPizza').getContext('2d');
        new Chart(ctxPizza, configGraficoPizza);
    </script>

<?php } ?>

<!-- 5C65C0 - azul médio -->
 <!-- #2F4DBE - azul forte -->