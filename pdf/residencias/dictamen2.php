<?php
require('../FPDF/fpdf.php');
require('mc_table.php');

$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 14);
//Table with 2 rows and 10 columns
$pdf->SetWidths(array(30, 50, 30, 40, 30, 50, 30, 40, 30, 50));
// srand(microtime()*1000000);
for ($i = 0; $i < 2; $i++)
    $pdf->Row(array('pruebaasdfasfdasdfasdsssssssssssssssssssssssssssssssssssssffffffffffff', 'prueba 2', 'prueba 1', 'prueba 2', 'prueba 1', 'prueba 2', 'prueba 1', 'prueba 2', 'prueba 1', 'prueba 2'));
$pdf->Output();
