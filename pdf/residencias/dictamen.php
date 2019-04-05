<?php
require('../FPDF/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../img/logoCaptura.png', 44, 12, 0);

        // Arial bold 15
        // $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        // $this->Cell(80);
        // Título
        // $this->Cell(30, 10, 'Title', 1, 0, 'C');
        // Salto de línea
        // $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->Image('../img/iti.jpg', 44, 120, 10);
        $this->Cell(0, 10, 'Title', 0, 0, 'C');
        // $this->Image('../img/logoPequeño.png', 44, 12, 0);
        // Posición: a 1,5 cm del final

        // Arial italic 8
        //$this->SetFont('Arial', 'I', 8);
        // Número de página
        //$this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF('L', 'mm', 'Letter');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

$pdf->Output();
