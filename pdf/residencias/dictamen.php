<?php
require_once "../../controladores/residentes.controlador.php";
require_once "../../modelos/residentes.modelo.php";
require_once "../../controladores/jerarquia.controlador.php";
require_once "../../modelos/jerarquia.modelo.php";
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

$item = "id";
$valor = $_GET['id'];
$respuesta = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);
$tablaJ = "jerarquia";
$itemPresi = "PRESIDENTE DE ACADEMIA";
$itemJefe = "JEFE DEL DEPTO. ACADEMICO";
$itemSub = "SUBDIRECTOR ACADÉMICO";
$resP = ControladorJerarquia::ctrMostrarDocentesDictamen($tablaJ, $itemPresi);
$resJe = ControladorJerarquia::ctrMostrarDocentesDictamen($tablaJ, $itemJefe);
$resSub = ControladorJerarquia::ctrMostrarDocentesDictamen($tablaJ, $itemSub);
$id = $valor;
$numeroControl = $respuesta["noControl"];
$proyecto = $respuesta["nombreProyecto"];
$nombre = $respuesta["nombre"];
$sexo = $respuesta["sexo"];
$empresa = $respuesta["nombreEmpresa"];
$asesorInterno = $respuesta["asesorInt"];
$asesorExterno = $respuesta["asesorExt"];
$periodo = $respuesta["periodo"];
$anio = $respuesta["anio"];
$semestre = $respuesta["semestre"];
$fechaActual = $_GET['fecha'];
$estado = $_GET['estado'];
// JERARQUIA
$presidente = $resP['nombre'];
$jefe = $resJe['nombre'];
$subdirector = $resSub['nombre'];

$pdf = new PDF('L', 'mm', 'Letter');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 0, utf8_decode('INSTITUTO TECNOLÓGICO DE IGUALA'), 0, 0, 'C');
$pdf->Ln(4);
$pdf->Cell(0, 0, utf8_decode('DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
$pdf->Ln(4);
$pdf->Cell(0, 0, utf8_decode('DICTAMEN DE ANTEPROYECTOS DE RESIDENCIAS PROFESIONALES'), 0, 0, 'C');
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 8);
$pdf->SetXY(191, 64);
$pdf->Cell(29, 9, utf8_decode('SEMESTRE'), 1, 0, 'C');
$pdf->Cell(22, 4.5, utf8_decode('ENE - JUN'), 1, 2, 'C');
$pdf->Cell(22, 4.5, utf8_decode('AGO - DIC'), 1, 0, 'C');
$pdf->SetXY(242, 64);
$pdf->SetFont('Arial', '', 9);
if ($semestre == 'EJ') {
    $pdf->Cell(18, 4.5, utf8_decode($anio), 1, 2, 'C');
    $pdf->Cell(18, 4.5, utf8_decode(''), 1, 0, 'C');
} else {
    $pdf->Cell(18, 4.5, utf8_decode(''), 1, 2, 'C');
    $pdf->Cell(18, 4.5, utf8_decode($anio), 1, 0, 'C');
}
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetXY(10, 80);
$pdf->Cell(0, 0, utf8_decode('ING. EN SISTEMAS COMPUTACIONALES'), 0, 0, 'C');
$pdf->SetXY(17, 85);
$pdf->Cell(15, 18, utf8_decode('NUM.'), 1, 0, 'C');
$pdf->Cell(23, 18, utf8_decode('CONTROL'), 1, 0, 'C');
$pdf->MultiCell(38, 9, utf8_decode('NOMBRE DEL ESTUDIANTE'), 1, 'C');
$pdf->SetXY(93, 85);
$pdf->Cell(6, 18, utf8_decode('S'), 1, 0, 'C');
$pdf->Cell(36, 18, utf8_decode('ANTEPROYECTO'), 1, 0, 'C');
$pdf->Cell(34, 18, utf8_decode('EMPRESA'), 1, 0, 'C');
$pdf->Cell(45, 5, utf8_decode('ASESORES'), 1, 0, 'C');
$pdf->Cell(25, 18, utf8_decode('DICTAMEN'), 1, 0, 'C');
$pdf->MultiCell(25, 9, utf8_decode('FECHA DE DICTAMEN'), 1, 'C');
$pdf->SetXY(169, 90);
$pdf->Cell(23, 13, utf8_decode('INTERNO'), 1, 0, 'C');
$pdf->Cell(22, 13, utf8_decode('EXTERNO'), 1, 0, 'C');


$pdf->Output();
