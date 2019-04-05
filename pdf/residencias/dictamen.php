<?php
require('../FPDF/fpdf.php');

$pdf = new FPDF('L', 'mm', 'Letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, '¡Hola, Mundo!');
$pdf->Cell(40, 10, '¡Hola, Mundo!', 1);
$pdf->Cell(60, 10, 'Hecho con FPDF.', 0, 1, 'C');
$pdf->Output();
