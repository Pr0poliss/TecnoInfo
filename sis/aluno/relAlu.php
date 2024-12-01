<?php
// Caminho correto para o autoloader do Composer

require_once '../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();  // Cria uma instância do mPDF

$html = '<h1>Relatório de Alunos</h1>';
$mpdf->WriteHTML($html);  // Escreve o HTML no PDF

$mpdf->SetFooter('
<table style="width: 100%; border: none">
<tr style="border-top: none; padding-top: 10px;">
<td style="border-bottom: none; border-top: none; font-size: 0.8em">' .date("d/m/Y H:i:s") . '</td>
<td style="text-align: right; border: none; font-size: 0.8em">Página {PAGENO} de {nbpg}.</td>
</tr>
</table>');

$mpdf->Output();  // Exibe o PDF gerado no navegador
