<?php
require('../FPDF/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../img/logoCaptura.png', 44, 12, 0);
        $this->Ln(40);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-27);
        $this->Image('../img/iti.jpg', 53, 183, 9);
        $this->SetFont('Arial', 'B', 7);
        $this->SetXY(6, -27);
        $this->Cell(0, 0, utf8_decode('Copia en PAPEL es "Documento no controlado" a excepción del original'), 0, 0, 'C');
        $this->SetFont('Arial', '', 9);
        $this->SetXY(188, -24);
        $this->Cell(0, 0, utf8_decode('Rev.1'), 0, 0, 'C');
    }
}

$pdf = new PDF('L', 'mm', 'Letter');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 0, utf8_decode('INSTITUTO TECNOLÓGICO DE IGUALA'), 0, 0, 'C');
$pdf->Ln(4);
$pdf->Cell(0, 0, utf8_decode('DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
$pdf->Ln(4);
$pdf->Cell(0, 0, utf8_decode('DICTAMEN DE ANTEPROYECTOS DE RESIDENCIAS PROFESIONALES'), 0, 0, 'C');
$pdf->Output();
