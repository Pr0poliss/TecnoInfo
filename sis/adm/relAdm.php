<?php

use Mpdf\Mpdf;

require_once __DIR__ . '/../../vendor/autoload.php'; // Corrigido para o caminho correto do autoloader

$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$mpdf = new \Mpdf\Mpdf(); // CRIA UMA INSTÂNCIA DO MPDF

$result = $mysqli->query("SELECT * FROM administrador");

date_default_timezone_set('America/Sao_Paulo');

$html .= '
        <style>
    .header{width: 100%; border-bottom: 1px solid gray; margin-bottom: 20px; }
    .header-table{width: 100%; border-collapse: collapse; outline: none;}
    .logo{width: 60px;padding-bottom: 20px}
    .title{font-family: "Rubik", sans-serif; margin: 0 0 0 -500px; font-size: 1.6em}
    small{color: gray; margin-top: -20px;padding-bottom: 20px}
    span{color: #0D579C;}
    h1{color: #3f3f3f;font-family: "Rubik", sans-serif;margin-top: 0px; font-size: 1.5em}
    h2{color: #0D579C;font-family: "Rubik", sans-serif;margin-top: 0px; font-size: 1.3em}
    p{font-family: "Rubik", sans-serif;}
    table{width: 100%;border-collapse: collapse;margin-top: 20px;background-color: #fff;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);}

    thead {background-color: #19234E;color: #fff;}
    th,td{padding: 12px 15px;text-align: left;border-bottom: 1px solid #ddd;}
    th{background-color: #19234E;color: white;}
    </style>

    <div class="header">
    <table class="header-table">
    <tr>
        <td class="title"><h2><span>TecnoInfo</span> - Rede de Ensino Tecnológico</h2></td>
    </tr>
    </table>
    </div>
    <h1>Administradores cadastrados na plataforma</h1>
';

if ($result->num_rows > 0) {
    $html .= '
        <table><thead><tr>
        <th>ID</th>
        <th>Nome</th>
        <th>E-mail</th>
        </tr></thead>
        <tbody>';

    while ($row =  $result->fetch_assoc()) {
        $html .= '
            <tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['nome'] . '</td>
            <td>' . $row['email'] . '</td>';
    }

    $html .= '</tr> </tbody></table>';
}
$mpdf->SetFooter('
<table style="width: 100%; border: none">
<tr style="border-top: none; padding-top: 10px;">
<td style="border-bottom: none; border-top: none; font-size: 0.8em">' .date("d/m/Y H:i:s") . '</td>
<td style="text-align: right; border: none; font-size: 0.8em">Página {PAGENO} de {nbpg}.</td>
</tr>
</table>');
$mpdf->WriteHTML($html); // ADICIONA O CONTEÚDO AO PDF
$mpdf->Output(__DIR__ . '/litarAdm.php', \Mpdf\Output\Destination::INLINE); // GERA E ENVIA O PDF PARA O NAVEGADOR

exit; // ENCERRO O SCRIPT PARA EVITAR RENDERIZAR MAIS CONTEÚDO NA PÁGINA
