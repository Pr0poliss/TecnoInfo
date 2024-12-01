<?php
// Inclui o cabeçalho do site
include "base/header.php";

// session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['nome'])) {
  // header("Location: login.php");
  // exit();
}
?>
<title>TecnoInfo</title>

<style>
  @charset "UTF-8";

  /* Importação de fontes */
  @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap');
  /* Importação da font Sparta */
  @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap');
  /* Importação da font Nunito */
  @import url('https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap');
  /* Importação da font Charkra Petch */


  /* Cadastro de cores e fontes */
  :root {
    --c01: #1C2321;
    /*  Preto               */
    --c02: #fff;
    /*  Branco              */
    --c03: #0060B8;
    /*  Azul-logo           */
    --c04: #0D579C;
    /*  Quebra-azul-logo    */
    --c05: #ffffff7e;
    /*  Branco 50%          */

    --f01: "Nunito", sans-serif;
    --f02: "League Spartan", sans-serif;
    --f03: "Chakra Petch", sans-serif;
  }

  /* Configuração geral */
  * {
    margin: 0;
    padding: 0;
    outline: 0;
    border: 0;
    box-sizing: border-box;
  }

  html,
  body {
    width: 100%;
    height: 100%;
    font-family: var(--f02);
  }

  /* =================================================== */
  /* Configuração de textos */

  a {
    text-decoration: none;
    font-size: 1.3em;
  }

  li {
    list-style: none;
    font-size: 1.3em;
    font-family: var(--f02);
  }

  /* =================================================== */

  /* Estilo base para os botões de CTA */
  .cta {
    width: 150px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    transition: 0.5s;
    font-size: 1.5em;
  }

  .cta-invertido {
    font-size: 1.5em;
    width: 150px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    transition: 0.5s;
    background-image: linear-gradient(to right, #0060B8, #00315F);
    color: var(--c02);
    text-decoration: none;
    transition: backgroundimage 2s;
    font-size: 1.1em;
  }

  .cta-invertido:hover {
    background-image: linear-gradient(to right, #00315F, #0060B8);
  
  }

  /* Estilo específico para botões clássicos */
  .classico {
    color: var(--c02);
    font-family: var(--f02);
    font-weight: bold;
    font-size: 1.5em;
    background-color: var(--c04);
  }

  /* Estilo de hover para os botões de CTA */
  .cta:hover {
    background-color: var(--c02);
    color: var(--c01);
    border: 3px solid var(--c04);
  }

  /* ====================================== */
  /* banner */

  header {
    background-color: #BAE2E8;
    align-items: center;
  }

  .s-logo {
    font-family: var(--f03);
    font-size: 3em;
  }

  h2 {
    font-size: 1.7em;
  }

  h3{
    font-size: 1.3em;
  }

  h4 {
    color: var(--c03);
    font-size: 1.8em;
    margin: 5px 0;
  }

  .banner>p {
    width: 85%;
    font-size: 1.3em;
    text-align: justify;
  }

  .container {
    width: 100%;
    height: 350px;
    padding: 50px 0;
    margin-bottom: 20px;
  }

  .banner {
    background-image: url(img/home/image.png);
    background-repeat: no-repeat;
    background-size: cover;
    /* object-fit: cover; */

    margin-top: -50px;
    padding: 125px 100px 0 700px;
    height: 500px;
    width: 100%;
  }

  main {
    padding: 0 100px;
    margin-bottom: 100px;
  }

 
  .cat {
    /* width: 75%; */
    /* float: right; */
    padding: 50px 0 0 0;
  }

  .categorias {
    display: flex;
    flex-wrap: wrap;
    margin-top: 10px;
  }

  .cat-esp>img {
    width: 300px;
    margin-bottom: 20px;
  }

  .pe {
    float: right;
    margin-left: 20px;
  }

  .pe>img {
    height: 450px;
  }

  .fieldset {
    border: 2px solid gray;
    border-radius: 10px;
    padding: 25px 50px;
    margin: 20px 0;
  }

  .eventos {
    margin-top: 10px;
    display: flex;
    justify-content: space-between;
  }

  .evento>img {
    max-width: 300px;
  }



  .a-cta {
    color: var(--c03);
  }

  .funcoes {
    display: flex;
    justify-content: space-between;
  }

  .c {
    margin-bottom: 30px;
  }

  .cursos{
    display: flex;
    justify-content: space-around;
    margin-top: 10px;
  }

  .curso{
    width: 25%;
    height: 300px;
    margin: 0 15px;
    box-shadow: 0 0 10px black;
    border-radius: 20px;
    text-align: center;
  }

  .curso>img{
    width: 100%;
    height: 150px;
    border-radius: 10px 10px 0 0;
  }

  .curso>h3{
    margin: 25px auto;
  }
  .curso>.cta-invertido{
    margin: 20px auto 10px auto;
    width: 200px;
  }

 /* Estilo principal do container */
.sessao {
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 350px;
    margin: 50px 0;
    margin-top: 88px;
    font-family: var(--f02);
}

/* Estilo da lista e itens */
.sessao > ul {
    list-style: none;
    padding: 0;
}

.sessao > ul > li {
    font-size: 1.5em;
    padding: 10px 15px;
    cursor: pointer;
    position: relative;
    transition: background-color 0.3s;

}

/* Efeito hover nos itens */
.sessao > ul > li:hover {
    background-color: #f1f1f1;
}

/* Estilo do "V" */
.v {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: #007BFF;
    font-weight: bold;
    cursor: pointer;
}

/* Estilo do dropdown */
.dropdown-content {
    display: none;
    list-style: none;
    padding: 0;
    margin-top: 10px;
    position: absolute;
    top: 35px;  /* Distância do item */
    left: 0;
    width: 100%;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    z-index: 999;
}

.dropdown-content li {
    padding: 12px 15px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s;
}

/* Efeito de hover no dropdown */
.dropdown-content li:hover {
    background-color: #007BFF;
    color: white;
}

.flex{
  display: flex;
  justify-content: space-around;

}

</style>

<div class="container banner">
  <span class="s-logo">TecnoInfo</span>
  <h4>Seu lugar de aprendizado, foro e progresso!</h4>
  <p>Conosco, você não só aprende, mas desenvolve habilidades para o mercado de trabalho e projetos pessoais. Prepare-se para os desafios reais com nossos cursos. Conquiste o futuro e faça parte da revolução tecnológica!</p>
</div>

<main>
<div class="flex">
  <div class="sessao">
      <ul>
          <li class="item dropdown">
              Categorias <span class="v" onclick="toggleDropdown(event)">V</span>
              <ul class="dropdown-content">
                  <li><a href="#">Programação</a></li>
                  <li><a href="#">Robótica</a></li>
                  <li><a href="#">Pacote Office</a></li>
  
              </ul>
          </li>
      </ul>
  </div>
  
  
  
    <div class="cat">
      <h2>Nossas Categorias</h2>
      <div class="categorias">
        <div class="ladin">
          <div class="cat-esp lado"><img src="img/home/cat1.png"></div>
          <div class="cat-esp lado"><img src="img/home/cat2.png"></div>
        </div>
        <div class="pe"><img src="img/home/cat3.png"></div>
      </div>
    </div>
</div>

  <div class="fieldset">
    <h2>Eventos</h2>
    <div class="eventos">
      <div class="evento"><img src="img/home/MAOSnaMAQUINA.png"></div>
      <div class="evento"><img src="img/home/VIAGEMnoTEMPO.png"></div>
      <div class="evento"><img src="img/home/DIAdoPROGRAMADOR.png"></div>
    </div>
  </div>

  <div class="container c">
    <div class="funcoes">
      <h2>Programação</h2>
      <a class="a-cta">Ver mais  ></a>
    </div>
    <div class="cursos">
      <div class="curso">
        <img src="img/curso/capa/prog.jpg">
        <h3>História da informática II</h3>
        <button class="cta-invertido">Acessar curso</button>
      </div>
      <div class="curso">
        <img src="img/curso/capa/python.jpg">
        <h3>Python Avançado</h3>
        <button class="cta-invertido">Acessar curso</button>
      </div>
      <div class="curso">
        <img src="img/curso/capa/java.png">
        <h3>Java Script Avançado</h3>
        <button class="cta-invertido">Acessar curso</button>
      </div>
      <div class="curso">
        <img src="img/curso/capa/sql.png">
        <h3>Banco de dados</h3>
        <button class="cta-invertido">Acessar curso</button>
      </div>
    </div>
  </div>


  <div class="container c">
    <div class="funcoes">
      <h2>Robótica</h2>
      <a class="a-cta">Ver mais  ></a>
    </div>
    <div class="cursos">
      <div class="curso">
        <img src="img/curso/capa/conceitos_basicos_hardware.png">
        <h3>Hardware Básico</h3>
        <button class="cta-invertido">Acessar curso</button>
      </div>
      <div class="curso">
        <img src="img/curso/capa/perifericos.png">
        <h3>Periféricos e Acessórios</h3>
        <button class="cta-invertido">Acessar curso</button>
      </div>
      <div class="curso">
        <img src="img/curso/capa/intro_robotica.png">
        <h3>Introdução à Robótica</h3>
        <button class="cta-invertido">Acessar curso</button>
      </div>
      <div class="curso">
        <img src="img/curso/capa/fundamento_basico.png">
        <h3>Funcionamento Básico</h3>
        <button class="cta-invertido">Acessar curso</button>
      </div>
    </div>
  </div>


  <div class="container">
    <div class="funcoes">
      <h2>Pacote Office</h2>
      <a class="a-cta">Ver mais  ></a>
    </div>
    <div class="cursos">
      <div class="curso">
        <img src="img/curso/capa/intro_pctOffice.png">
        <h3>Introdução ao Pacote Office</h3>
        <button class="cta-invertido">Acessar curso</button>
      </div>
      <div class="curso">
        <img src="img/curso/capa/primeiros_passos_word.png">
        <h3>Primeiros Passos com Word</h3>
        <button class="cta-invertido">Acessar curso</button>
      </div>
      <div class="curso">
        <img src="img/curso/capa/table_excel.png">
        <h3>Tabelas no Excel</h3>
        <button class="cta-invertido">Acessar curso</button>
      </div>
      <div class="curso">
        <img src="img/curso/capa/powerpoint.png">
        <h3>PowerPoint Avançado</h3>
        <button class="cta-invertido">Acessar curso</button>
      </div>
    </div>
  </div>
</main>


<script>
  // Função para alternar a visibilidade do dropdown
function toggleDropdown(event) {
    const dropdown = event.target.closest('.item').querySelector('.dropdown-content');
    // Alterna a visibilidade do dropdown
    if (dropdown.style.display === 'block') {
        dropdown.style.display = 'none';
    } else {
        dropdown.style.display = 'block';
    }
}
</script>

<?php
// Inclui o rodapé do site
include "base/footer.php";
?>