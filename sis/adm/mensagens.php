<?php
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];

    switch($msg){
        case 1:
            echo "Sua primeira mensagem de erro. <br>
            Deu certo!";
            break;
        case 2:
            echo "Sua segunda mensagem de erro. <br>
            Deu não";
            break;
        case 3:
            echo "Sua terceira mensagem de erro. <br>
            Chorei";
            break;
    }
    $msg = 0;
}