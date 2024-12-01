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
  }

  /* ====================== HEADER =========================== */

  header {
    width: 100%;
    height: 15%;
    padding: 10px 100px;

    display: flex;
    justify-content: space-between;
    align-items: center;

    background-color: var(--c02);
  }

  .fig_logo {
    height: 100%;
    display: flex;
    align-items: center;
  }

  nav.header {
    width: 50%;
    height: 100%;
  }

  nav.header>ul {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 100%;
  }

  nav.header>ul>a {
    width: 150px;
    height: 40px;

    text-decoration: none;
    border-radius: 10px;
    text-align: center;
    transition: 0.5s;
  }

  nav.header>ul>a>li {
    list-style: none;
    color: var(--c04);
    margin: 5px;
    transition: 0.5s;
    font-family: var(--f02);
    font-size: 1.3em;
  }

  nav.header>ul>a>li:hover {
    text-decoration: underline;
  }

  /* ====================== FIM DO HEADER =========================== */

  /* Configuração de imagem */

  img {
    width: 100%;
  }

  /* =================================================== */
  /* Configuração de textos */

  h1 {
    font-size: 3em;
    color: var(--c04);
    font-family: var(--f02);
  }

  h1.invertido {
    color: var(--c02);
  }

  p {
    font-size: 1.5em;
    color: var(--c01);
    font-family: var(--f02);
    /* text-align: justify; */
  }

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
  /* Carrossel */

  .carousel {
    position: relative;
    max-width: 100%;
    margin: auto;
    overflow: hidden;
  }

  .carousel-inner {
    display: flex;
    transition: transform 0.5s ease-in-out;
  }

  .carousel-item {
    min-width: 100%;
    transition: opacity 1s ease-in-out;
  }

  .carousel-item img {
    width: 100%;
    vertical-align: middle;
  }

  button.prev,
  button.next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
  }

  button.prev {
    left: 10px;
  }

  button.next {
    right: 10px;
  }

  button.prev:hover,
  button.next:hover {
    background-color: rgba(0, 0, 0, 0.8);
  }

  /* =================================================== */
  /* Box */

  .box {
    width: 100%;
  }

  #destaque {
    background-color: var(--c04);
  }

  .fluid {
    display: flex;
    align-items: center;
  }

  .fig_informativo {
    width: 500px;
    height: 250px;
    border-radius: 20px 20px 20px 20px;
    background-image: url(../assets/home/Box01.png);
    background-repeat: no-repeat;
    background-size: cover;
    background-position: -20px 0;
  }

  .txt {
    width: 70%;
  }

  /* =================================================== */
  /* Cards */

  .wave-container {
            position: relative;
            background-color: #0A74DA; /* Cor de fundo da div */
            height: 300px; /* Altura da área */
            clip-path: polygon(0 10%, 100% 0, 100% 90%, 0% 100%);
        }

  .cards {
    background-color: var(--c04);
    justify-content: space-around;
  }

  .cartao {
    width: 300px;
    height: 400px;
    display: flex;
    flex-direction: column;
    align-items: center;

    border-radius: 10px;
    background-color: var(--c02);
  }

  .txt-card {
    max-width: 70%;
    max-height: 50%;
    text-align: center;
  }

  .cartao>.txt-card>p {
    margin: 20px auto;
    /* text-align: center; */
  }

  .cartao>.txt-card>.cta {
    margin: 0 auto 20px;
  }

  /* ================================================================ */

  /* Estilo para placeholders de input */
  input::placeholder {
    font-family: var(--f02);
    font-size: 1.3em;
    color: var(--c02);
  }

  /* Estilo dos botões invertidos */
  .invertido {
    background-color: var(--c02);
    color: var(--c04);
    width: 150px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    transition: 0.5s;
    font-family: var(--f02);
    font-weight: bold;
    font-size: 1.3em;
  }

  /* Estilo de hover dos botões invertidos */
  .invertido:hover {
    background-color: var(--c04);
    color: var(--c02);
    border: 3px solid var(--c02);
  }

  /* Estilo base para os botões de CTA */
  .cta {
    width: 150px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 10px;
    transition: 0.5s;
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
    font-size: 1.3em;
    background-color: var(--c04);
  }

  /* Estilo de hover para os botões de CTA */
  .cta:hover {
    background-color: var(--c02);
    color: var(--c01);
    border: 3px solid var(--c04);
  }

  /* ====================================== */

  .container-fluid {
    width: 100%;
    margin: 0 auto;
    padding: 20px;
  }

  h1 {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 20px;
    color: #007bff;
    /* Azul da TecnoInfo */
  }

  .comentarios {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .comentario {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    display: none;
  }

  .comentario.ativo {
    display: block;
  }

  figure {
    text-align: center;
  }

  .mt-4 {
    margin-top: 20px;
  }

  .col-md-8 {
    width: 60%;
  }

  .col-md-1 {
    width: 20%;
  }

  .hr {
    border: 1px solid #ddd;
    margin-top: 20px;
    margin-bottom: 20px;
  }

  .informacoes-individuo {
    text-align: center;
  }

  .stars {
    justify-content: center;
    align-items: center;
    gap: 5px;
  }

  .stars img {
    width: 18px;
    height: 18px;
  }

  .aluno {
    text-align: center;
    margin-top: 20px;
  }

  .aluno img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }

  .paginacao {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
  }

  .btn-prev,
  .btn-next {
    background-color: #007bff;
    /* Azul da TecnoInfo */
    color: #fff;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
  }

  .pagina-atual {
    margin: 0 10px;
    font-weight: bold;
  }

  .btn-prev:hover,
  .btn-next:hover {
    background-color: #0056b3;
    /* Azul mais escuro da TecnoInfo */
  }

  /* ====================================== */

  footer {
    background-color: var(--c01);
    width: 100%;
    display: flex;
    color: var(--c02);
  }
</style>

<!-- Inclui os estilos principais e do Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- Carrossel de imagens -->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/home/carroussel01.gif" class="d-block w-100" alt="Imagem 1">
    </div>
    <div class="carousel-item">
      <img src="img/home/carroussel02.png" class="d-block w-100" alt="Imagem 2">
    </div>
    <div class="carousel-item">
      <img src="img/home/carroussel03.png" class="d-block w-100" alt="Imagem 3">
    </div>
  </div>
  <!-- Botões de controle do carrossel -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>

<!-- Seção de introdução à TecnoInfo -->
<div class="container mb-50">
  <h1 class="mt-5" style="float: left">Conheça mais sobre a TecnoInfo</h1>

  <div class="container row mt-4">
    <figure class="col-md-6 col mr-4" style="width:400px">
      <img src="img/home/Box01.png" alt="Imagem de introdução" class="img-box">
    </figure>
    <div class="col-md-6 col ml-3">
      <p>A TecnoInfo é uma empresa inovadora e dinâmica, dedicada a transformar a maneira como as pessoas aprendem e se
        especializam em tecnologia. Com uma vasta gama de cursos voltados para diversas áreas da tecnologia, a TecnoInfo
        se destaca pela qualidade de seu conteúdo, metodologia de ensino moderna e suporte contínuo aos alunos.</p>
      <button class="cta classico">Saiba mais</button>
    </div>
  </div>
</div>

<!-- Seção de destaque de cursos -->
<div class="container-fluid mt-5" style="background-color:var(--c04);">
  <div class="row" style="justify-content:space-around; padding: 50px 0">
    <!-- Cartão do curso de programação -->
    <div class="col cartao" style="max-width:300px; margin:0 50px">
      <figure style="width:300px;">
        <img src="img/home/BoxCard01.png" alt="Curso de Programação" style="border-radius:9px 9px 0 0">
      </figure>
      <p style="text-align: center; height: 135px">Domine as principais linguagem utilizadas atualmente no nosso curso
        de programação!</p>
      <button class="cta classico">Conheça já</button>
    </div>
    <!-- Cartão do curso de Pacote Office -->
    <div class="col cartao" style="max-width:300px">
      <figure style="width:302px;">
        <img src="img/home/BoxCard02.png" alt="Curso de Pacote Office" style="border-radius:10px 10px 0 0">
      </figure>
      <p style="text-align: center; height: 135px">Domine o Pacote Office e impulsione sua produtividade!</p>
      <button class="cta classico">Saiba mais</button>
    </div>
    <!-- Cartão do curso de robótica -->
    <div class="col cartao" style="max-width:300px; margin:0 50px">
      <figure style="width:303px;">
        <img src="img/home/BoxCard03.png" alt="Curso de Robótica" style="border-radius:10px 10px 0 0">
      </figure>
      <p style="text-align: center; height: 135px">Junte-se ao nosso curso de robótica e transforme suas ideias em
        realidade!</p>
      <button class="cta classico">Junte-se já</button>
    </div>
  </div>
</div>

<!-- Seção sobre a metodologia -->
<div class="container">
  <h1 class="mt-5">Conheça mais sobre a nossa metodologia</h1>
  <div class="container-fluid row mt-5">
    <div class="col-md-5 col">
      <img src="img/home/Box03.png" alt="Imagem da metodologia" class="img-box">
    </div>
    <div class="col-md-5 col ml-4">
      <p>Tutoriais</p>
      <p>Vídeo-aulas</p>
      <p>Exercícios práticos</p>
      <p>Informações sobre materiais de apoio</p>
      <button class="cta classico">Saiba mais</button>
    </div>
  </div>
</div>

<!-- Seção de Perguntas Frequentes (FAQ) -->
<div class="FAQ p-3 mt-5" style="background-color:var(--c04)">
  <div class="container">
    <h1 class="mt-5" style="color:var(--c02)">Perguntas frequentes</h1>
    <div class="accordion accordion-flush mt-3" id="accordionFlushExample">
      <!-- Primeira pergunta do FAQ -->
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne"
            style="background-color:var(--c04); color:var(--c02);font-size:0.7em;">
            Quais tipos de cursos de tecnologia vocês oferecem?
          </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body" style="background-color: #98c6f1c0;">Oferecemos cursos de programação, robótica e pacote Office. Todos estes contam com
            níveis do mais básico ao avançado.</div>
        </div>
      </div>
      <!-- Segunda pergunta do FAQ -->
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo"
            style="background-color:var(--c04); color:var(--c02);font-size:0.7em;">
            Os cursos são online ou presenciais?
          </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body" style="background-color: #98c6f1c0;">Os cursos são oferecidos totalmente online. Não temos nenhuma unidade física para
            ensino.</div>
        </div>
      </div>
      <!-- Terceira pergunta do FAQ -->
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree"
            style="background-color:var(--c04); color:var(--c02);font-size:0.7em;">
            Posso experimentar uma amostra do curso antes de me inscrever?
          </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body" style="background-color: #98c6f1c0;">Claro! Nossos cursos contam com duas etapas que são divididas geralmente em cinco
            módulos cada, a primeira é totalmente gratuita e a segunda é feita mediante a pagamento.</div>
        </div>
      </div>
      <!-- Quarta pergunta do FAQ -->
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour"
            style="background-color:var(--c04); color:var(--c02);font-size:0.7em;">
            Os cursos têm pré-requisitos específicos de conhecimento prévio?
          </button>
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body" style="background-color: #98c6f1c0;">De forma alguma. Disponibilizamos conteúdos de nível iniciante que facilitará o
            entendimento de qualquer indivíduo.</div>
        </div>
      </div>
    </div>

    <!-- Input para perguntas adicionais -->
    <h1 class="mt-4" style="color:var(--c02)">Faça sua pergunta</h1>
    <input type="text" name="inputFAQ" id="inputFAQ" class="inputFAQ col-md-12"
      placeholder="Digite sua pergunta aqui..."
      style="height:50px; border-radius:10px; background-color: var(--c05); border: 2px solid var(--c02); padding-left: 20px;">
    <button class="invertido mt-3 mb-5">Enviar</button>
  </div>
</div>

<!-- Seção de depoimentos de alunos -->

<div style="width: 100%; padding:50px 100px">
  <div class="container">
    <h1>Conheça relatos de quem já estudou com a TecnoInfo</h1>
    <div class="comentarios">
      <div class="comentario" id="comentario-1" style="display: flex;">
        <figure class="mt-4" style="width:50px; margin-right: 10px">
          <img src="img/home/BoxComentarios_aspas.png" alt="" style="width:'100%'">
        </figure>
        <p class="col-md-8 mt-4">A plataforma é incrível! Comecei sem entender nada de programação, mas com as aulas bem
          explicadas e a interface fácil de usar, já crio meus próprios projetos. Vale muito a pena para quem quer
          aprender rápido e com qualidade!</p>
        <div class="hr"></div>
        <div class="informacoes-individuo col-md-1 mt-4"
          style="display: flex; flex-direction: column; justify-content: center; width: 300px">
          <div class="stars" style="width:50px; margin: 0 auto; display:flex">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
          </div>
          <p style="margin-top: 5px">Rafael Nascimento</p>
          <p style="margin-top: -10px">FAETEC - Oscar Tenório</p>
          <p style="margin-top: -10px">22 de Março de 2007</p>
          <figure class="aluno" style="width:50px; margin: 0 auto">
            <img src="img/home/user1.jpg" alt="" style="border-radius:50%">
          </figure>
        </div>
      </div>
      <div class="comentario" id="comentario-2" style="display: flex;">
        <figure class="mt-4" style="width:50px; margin-right: 10px">
          <img src="img/home/BoxComentarios_aspas.png" alt="" style="width:'100%'">
        </figure>
        <p class="col-md-8 mt-4">Sempre gostei de robótica, e essa plataforma me ajudou a aprender o básico de forma
          prática e divertida. As aulas são didáticas, e o conteúdo é excelente. Agora, estou pronto para levar o
          conhecimento para o próximo nível. Super recomendo!</p>
        <div class="hr"></div>
        <div class="informacoes-individuo col-md-1 mt-4"
          style="display: flex; flex-direction: column; justify-content: center; width: 300px">
          <div class="stars" style="width:50px; margin: 0 auto; display:flex">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
          </div>
          <p style="margin-top: 5px">João Silva</p>
          <p style="margin-top: -10px">SENAI - Rio de Janeiro</p>
          <p style="margin-top: -10px">15 de Junho de 2023</p>
          <figure class="aluno" style="width:50px; margin: 0 auto">
            <img src="img/home/user2.jpg" alt="" style="width:'100%'">
          </figure>
        </div>
      </div>
      <div class="comentario" id="comentario-3" style="display: flex;">
        <figure class="mt-4" style="width:50px; margin-right: 10px">
          <img src="img/home/BoxComentarios_aspas.png" alt="" style="width:'100%'">
        </figure>
        <p class="col-md-8 mt-4">As aulas de pacote Office me ajudaram muito. Sou do ensino fundamental e já consigo
          fazer apresentações e planilhas com facilidade. O conteúdo é claro e direto, perfeito para quem quer aprender
          de maneira prática e sem complicação.</p>
        <div class="hr"></div>
        <div class="informacoes-individuo col-md-1 mt-4"
          style="display: flex; flex-direction: column; justify-content: center; width: 300px">
          <div class="stars" style="width:50px; margin: 0 auto; display:flex">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
            <img src="img/home/Boxcomentarios_star.png" alt="" class="col">
          </div>
          <p style="margin-top: 5px">Maria Oliveira</p>
          <p style="margin-top: -10px">IFRJ - Duque de Caxias</p>
          <p style="margin-top: -10px">05 de Novembro de 2022</p>
          <figure class="aluno" style="width:50px; margin: 0 auto">
            <img src="img/home/user3.jpg" alt="" style="width:'100%'">
          </figure>
        </div>
      </div>
    </div>
    <div class="paginacao">
      <button class="btn-prev" onclick="prevComentario()">&lt;</button>
      <span class="pagina-atual" style="font-weight: regular">1</span> / 3
      <button class="btn-next" onclick="nextComentario()" style="margin-left:10px;">&gt;</button>
    </div>
  </div>
</div>

<script>
  // Definindo as variáveis
  let comentarios = document.querySelectorAll('.comentario');
  let comentarioAtual = 0; // índice do comentário atual
  let totalComentarios = comentarios.length; // número total de comentários

  // Função para mostrar o comentário atual
  function mostrarComentario(index) {
    // Escondendo todos os comentários
    comentarios.forEach((comentario, i) => {
      comentario.style.display = 'none';
    });

    // Mostrando apenas o comentário atual
    comentarios[index].style.display = 'flex';

    // Atualizando a página atual no carrossel
    document.querySelector('.pagina-atual').textContent = index + 1;
  }

  // Função para ir para o próximo comentário
  function nextComentario() {
    comentarioAtual = (comentarioAtual + 1) % totalComentarios; // Ciclo de 0 a total-1
    mostrarComentario(comentarioAtual);
  }

  // Função para ir para o comentário anterior
  function prevComentario() {
    comentarioAtual = (comentarioAtual - 1 + totalComentarios) % totalComentarios; // Retrocede e volta ao final se necessário
    mostrarComentario(comentarioAtual);
  }

  // Iniciando com o primeiro comentário visível
  mostrarComentario(comentarioAtual);
</script>

<?php
// Inclui o rodapé do site
include "base/footer.php";
?>