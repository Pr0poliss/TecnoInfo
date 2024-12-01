<?php

$mysqli = new mysqli('localhost', 'root', '', 'tecnoinfo');

if ($mysqli->connect_error) {
    die('Erro de conexão (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

require_once __DIR__ . '/../../vendor/autoload.php'; // Inclui a biblioteca mPDF

// Configura o idioma para português (caso use strftime)
setlocale(LC_TIME, 'pt_BR.UTF-8');

// Fazendo a consulta no banco de dados
$result = $mysqli->query("SELECT * FROM usuarios");

// Criação do objeto mPDF com margens zero
$mpdf = new \Mpdf\Mpdf([
    'format' => 'A4',
    'orientation' => 'L', // Definir o formato horizontal (paisagem)
    'margin_left' => 0,    // Remover margem esquerda
    'margin_right' => 0,   // Remover margem direita
    'margin_top' => 0,     // Remover margem superior
    'margin_bottom' => -1,  // Remover margem inferior
]);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Obtém o primeiro usuário (ou você pode iterar sobre os resultados, caso queira mais de um)
    $row = $result->fetch_assoc(); // Pega a primeira linha

    // Corpo do documento
    $mpdf->SetFont('Arial, sans-serif');
    $mpdf->WriteHTML('
    <img src="../../img/certificado/template_certificado.jpg" width="297mm" height="210mm" style="display: block; margin: 0 auto;"/>
    ');
}

// Gera o PDF
$mpdf->Output();
?>
