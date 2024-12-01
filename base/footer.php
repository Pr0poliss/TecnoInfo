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

  body {
    user-select: none;
  }

  /* ====================================== */

  footer {
    background-color: var(--c01);
    width: 100%;
    display: flex;
    flex-direction: column;
    color: var(--c02);
    padding: 100px 100px;
    font-family: var(--f02);
  }

  .f1,
  .f2 {
    display: flex;
    justify-content: space-between;
  }

  h6 {
    font-size: 1.2em;
  }

  ul {
    line-height: 35px;
  }

  .lista-footer>ul>figure {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }

  .lista-footer>ul>a>figure {
    display: flex;
    align-items: center;
  }

  hr {
    border: 1px solid #ddd;
    margin-top: 20px;
    margin-bottom: 20px;
  }

  .f2>p {
    color: var(--c02);
    font-family: var(--f02);
    font-size: 1.2em;
    width: 60%;
    margin: 5px 200px 0 0;
    line-height: 25px;
  }
</style>

<footer>
  <div class="f1">
    <figure>
      <img src="img/logo/logo-figure-txt_branca.png" alt="" style="width: 150px">
    </figure>

    <div class="lista-footer">
      <ul>
        <li>
          <h6>Cadastre-se agora!</h6>
        </li>
        <li>Aluno</li>
        <li>Unidade de Ensino</li>
        <li>Oportunidade de estágio</li>
      </ul>
    </div>
    <div class="lista-footer">
      <ul>
        <li>
          <h6>Sobre nós</h6>
        </li>
        <li>Quem Somos</li>
        <li>Ideia Inicial</li>
        <li>Equipe</li>
      </ul>
    </div>
    <div class="lista-footer">
      <ul>
        <li>
          <h6>Contate-nos</h6>
        </li>
        <li>(21)9 99999-9999</li>
        <a href="mailto:tecnoinfo.tcc@gmail.com" style="color:var(--c02); text-decoration:none; font-size:1em;">
          <li>TecnoInfo@gmail.com</li>
        </a>
        <li>Acesse nosso canal no whatsapp!</li>
      </ul>
    </div>

    <div class="lista-footer">
      <ul>
        <li>
          <h6>Siga-nos</h6>
        </li>
        <figure>
          <img src="img/home/facebook.png" alt="" name="face" style="width: 35px; margin-right: 10px"><label for="face">Facebook</label>
        </figure>

        <a href="https://www.instagram.com/us.tecnoinfo/?utm_source=ig_web_button_share_sheet"
          style="color:var(--c02); text-decoration:none; font-size:1em;">
          <figure>
            <img src="img/home/instagram.png" alt="" name="insta" style="width: 35px; margin-right: 10px"><label for="insta">Instagram</label>
          </figure>
        </a>

      </ul>
    </div>
  </div>
  <hr>
  <div class="f2">

    <p>© Todos os direitos reservados. 2024 - TECNOINFO ESTUDO À DISTÂNCIA LTDA.- CPNJ: 00.000. 000/0000-00 Rua Xavier Curado, S/N - Marechal Hermes, Rio de Janeiro - RJ, 21610-330</p>
    <div class="pgto">
      <h6>Formas de pagamento</h6>
      <div class="fpgto" style="display:flex; justify-content: space-between">
        <figure>
          <img src="img/home/fpgto1.png" alt="" style="width:40px">
        </figure>
        <figure>
          <img src="img/home/fpgto2.png" alt="" style="width:40px">
        </figure>
        <figure>
          <img src="img/home/fpgto3.png" alt="" style="width:40px">
        </figure>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>