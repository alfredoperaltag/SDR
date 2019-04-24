<?php
require_once "../../controladores/residentes.controlador.php";
require_once "../../modelos/residentes.modelo.php";
require_once "../../controladores/jerarquia.controlador.php";
require_once "../../modelos/jerarquia.modelo.php";
require('../FPDF/fpdf.php');

class PDF extends FPDF
{
    public function Header()
    {
        $this->Image('../img/sepNew_R.png', 20.6, 17.5, 61.5);
        $this->Image('../img/TecNacMex.PNG', 130, 21, 66);
        $this->Cell(0, 46, '', 0, 1, 'C'); //NOTE no borrar
    }
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $x = $this->GetX();
        $y = $this->GetY();
        $this->Image('../img/iti.jpg', 24, 256, 14);
        $this->SetFont('Helvetica', '', '7');
        $this->SetXY($x, $y - 12);
        $this->Cell(0, 4, utf8_decode('Carretera Nacional Iguala-Taxco esquina Periférico Norte, Col. Adolfo López  Mateos  Infonavit, C.P. 40030, '), 0, 1, 'C');
        // $this->Cell(20);
        $this->Cell(0, 4, utf8_decode('Iguala de la Independencia, Gro. Tels. (733) 3321425'), 0, 1, 'C');
        // $this->Cell(44);
        $this->Cell(0, 4, utf8_decode('Ext. 225, e-mail: comunicacion@itiguala.edu.mx,'), 0, 1, 'C');
        $this->SetFont('Helvetica', 'B', '7');
        // $this->Cell(20);
        $this->Cell(0, 4, utf8_decode('sistemas@itiguala.edu.mx'), 0, 0, 'C');
        // $x = $this->GetX();
        $this->Image('../img/iso14001.jpg', 155 + 12, 253, 17);
        $x = $this->GetX();
        // $this->Image('../img/iso9001.jpg', $x + 31, 253, 12);
        $this->Image('../img/norma.jpg', 155 + 31, 253, 15);
    }
}

$item = "id";
$valor = $_GET['id'];
$respuesta = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);
$nombre = $respuesta["nombre"];

$numero = $_GET['numero'];
$fechaActual = $_GET['fecha'];
$fechaTitulacion = $_GET['fechaTitulacion'];

$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AddPage();
$pdf->Image('../img/fondo_membrete_R.jpg', '0', '46', '215');
$pdf->SetFont('Helvetica', '', '7.3');
$pdf->Cell(0, -3, utf8_decode('"2019, Año del Caudillo del Sur, Emiliano Zapata"'), 0, 1, 'C');
$pdf->Ln(12);
$pdf->SetFont('Helvetica', 'B', '8');
$pdf->Cell(0, 0, utf8_decode('DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'R');
$pdf->Ln(4);
$pdf->SetFont('Helvetica', 'B', '9');
$pdf->Cell(125.5);
$pdf->Cell(0, 0, utf8_decode('OF. No. DSC-ITI/' . $numero . '/*' . date("Y") . ''), 0, 0, 'L');

$pdf->Ln(4);
$pdf->SetFont('Helvetica', 'B', '8');
$pdf->Cell(267, 0, utf8_decode('ASUNTO: '), 0, 0, 'C');
$pdf->SetXY(132, 73);

$pdf->SetFont('Helvetica', 'BU', '8');
$pdf->Cell(0, 0, utf8_decode('JURADO SELECCIONADO.'), 0, 0, 'C');
$pdf->Ln(8);
$pdf->SetFont('Helvetica', '', '8.5');
$pdf->SetX(91);
$pdf->Cell(0, 4, utf8_decode('Iguala, Guerrero, '), 0, 0, 'C');
$pdf->SetX(160);
$pdf->SetTextColor(255, 255, 255);
$anchoFecha = $pdf->GetStringWidth($fechaActual);
$pdf->Cell($anchoFecha + 2, 4, utf8_decode($fechaActual), 0, 0, 'C', true);
$pdf->Ln(8);
$pdf->Ln(4);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Helvetica', 'B', '8');
// $pdf->Cell(0, 0, utf8_decode('C. ' . strtoupper($asesorInterno)), 0, 0, 'L');
$pdf->Cell(0, 0, utf8_decode('JEFA DE LA DIVISIÓN DE ESTUDIOS PROFESIONALES'), 0, 0, 'L');
$pdf->Ln(4);
$pdf->Cell(0, 0, utf8_decode('P R E S E N T E .'), 0, 0, 'L');
$pdf->Ln(8);
$pdf->Cell(0, 0, utf8_decode('AT´N: COORDINADORA DE TITULACIÓN.'), 0, 0, 'L');
$pdf->Ln(12);
$pdf->SetFont('Helvetica', '', '8');
$pdf->Cell(0, 0, utf8_decode('Por medio del presente, me permito enviar a usted el '), 0, 1, 'L');
$pdf->SetFont('Helvetica', 'BI', '8');
$pdf->Cell(149, 0, utf8_decode('JURADO '), 0, 1, 'C');
$pdf->SetFont('Helvetica', '', '8');
$pdf->Cell(133, 0, utf8_decode('que fungirá en el Acto de Titulación, del '), 0, 0, 'R');
$pdf->Ln(4);
$pdf->SetFont('Helvetica', 'B', '8');
$pdf->Cell(0, 0, utf8_decode(utf8_decode('C. ' .  strtoupper($nombre) . ',')), 0, 1, 'L');
$pdf->SetFont('Helvetica', '', '8');
$pdf->Cell(149, 0, utf8_decode(' que presenta su protocolo para su '), 0, 1, 'C');
$pdf->SetFont('Helvetica', 'B', '8');
$pdf->Cell(227, 0, utf8_decode('TITULACIÓN INTEGRAL,'), 0, 1, 'C');
$pdf->SetFont('Helvetica', '', '8');
$pdf->Ln(4);
$pdf->Cell(0, 0, utf8_decode('el día'), 0, 1, 'L');
$pdf->SetFont('Helvetica', 'B', '8');
$pdf->Cell(8);
$pdf->Cell(0, 0, utf8_decode(strtoupper($fechaTitulacion)), 0, 1, 'L');



$pdf->SetFont('Helvetica', '', '8');
// $pdf->Cell(8);
$anchoFechaTitulacion = $pdf->GetStringWidth($fechaTitulacion);
// $pdf->Cell($anchoFechaTitulacion);
// $pdf->Cell(5);
// $pdf->SetX($anchoFechaTitulacion + 20);
// $pdf->Cell();
$pdf->SetX(18 + $anchoFechaTitulacion + 4.5);
$x2 = $pdf->GetX();
$pdf->Cell(0, 0, utf8_decode('del año en curso, a las'), 0, 1, 'L');
// $pdf->Cell(0, 0, utf8_decode($anchoFechaTitulacion), 0, 1, 'C');
$pdf->Cell(0, 0, utf8_decode($x2), 0, 1, 'C');

$pdf->Output('I', 'Asignación de Sinodales.pdf', 'D');
