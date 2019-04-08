<?php

require '../FPDF/fpdf.php';
require '../../controladores/residentes.controlador.php';
require '../../modelos/residentes.modelo.php';

class PDF extends FPDF
{
    //Cabecera
    public function Header()
    {
        $this->SetFont('Arial', 'B', '10');
        // $this->Image('../img/sep-logo.jpg', 20, 2, 67, 52, 'JPG');
        $this->Image('../img/sepNew_R.png', 15, 12, 67, 25, 'PNG');

        $this->Image('../img/TecNacMex.PNG', 137, 12, 66, 24, 'PNG');
        $this->Cell(0, 46, '', 0, 1, 'C');
        // $this->Ln(20);
    }
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        // $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
        // $this->Image('../img/iti.jpg', '28', '10', '3', '3', 'JPG');
        $x = $this->GetX();
        $y = $this->GetY();
        $this->Image('../img/iti.jpg', 15, 253, 12);
        $this->SetFont('Helvetica', '', '7.5');
        $this->SetXY($x + 20, $y - 12);
        $this->Cell(20, 4, utf8_decode('Carretera Nacional Iguala-Taxco esquina Periférico Norte, Col. Adolfo López Mateos Infonavit, C.P. 40030'), 0, 1, 'L');
        $this->Cell(20);
        $this->Cell(20, 4, utf8_decode('Iguala de la Independencia, Gro. Tels. (733) 3321425 Ext. 225,'), 0, 1, 'L');
        $this->Cell(44);
        $this->Cell(20, 4, utf8_decode('www.itiguala.edu.mx         e-mail:'), 0, 0, 'L');
        $this->SetFont('Helvetica', 'BU', '7.5');
        $this->Cell(20);
        $this->Cell(65, 4, utf8_decode('sistemas@itiguala.edu.mx'), 0, 0, 'L');
        $x = $this->GetX();
        $this->Image('../img/iso14001.jpg', $x + 12, 253, 12);
        $x = $this->GetX();
        $this->Image('../img/iso9001.jpg', $x + 31, 253, 12);

    }
}

$tabla = "residentes";
$item = "id";
$valor = $_GET['id'];
$res = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);




$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AddPage();
// $pdf->Image('../img/fondo1.png', '28', '99', '150', '150', 'PNG');
$h = $pdf->GetPageHeight();
$w = $pdf->GetPageWidth();
// $pdf->Image('../img/fondo_membrete.jpg', '0', '28', '210', '275', 'JPG');
$pdf->Image('../img/fondo_membrete_R.jpg', '0', '38', '220', '243', 'JPG');
// $pdf->Image('../img/fondo_membrete.jpg', 0, 28, 50);

$pdf->SetFont('Helvetica', '', '9');
$pdf->Cell(107);
$pdf->Cell(80, 4, 'OF. No. DSC-ITI/1031/2018', 0, 1, 'L');
$pdf->Cell(107);
$pdf->Cell(15, 4, 'ASUNTO: ', 0, 0, 'L');
$pdf->SetFont('Helvetica', 'B', '9');
$pdf->Cell(20, 4, utf8_decode('REVISIÓN DE TRABAJO DE TITULACIÓN.'), 0, 1, 'L');
$pdf->SetFont('Helvetica', '', '9');
$pdf->Cell(107);
$pdf->Cell(25, 4, 'IGUALA, GRO., ', 0, 0, 'L');
// AQUI VA LA FECHA 2019-Abril-05
$pdf->SetFont('Helvetica', 'B', '9');
$pdf->Cell(50, 4, ' 2018-septiembre-28', 0, 1, 'L');

$pdf->Ln(15); //CELDA DE ESPACIO
$pdf->SetFont('Helvetica', 'B', '9');
$pdf->Cell(19);
$pdf->Cell(80, 4, 'M.D.I.S. SILVIA VALLE BAHENA', 0, 1, 'L');
$pdf->Cell(19);
$pdf->Cell(80, 4, utf8_decode('DOCENTE DE ESTA INSTITUCIÓN.'), 0, 1, 'L');
$pdf->Cell(19);
$pdf->Cell(80, 4, 'P R E S E N T E', 0, 1, 'L');

$pdf->Ln(7); //CELDA DE ESPACIO
$pdf->SetFont('Helvetica', '', '9');
$pdf->Cell(31);
$pdf->Cell(0, 4, 'Por medio del presente, me permito hacer de su conocimiento que ha sido comisionado (a) para ', 0, 1, 'L');
$pdf->Cell(18);
$pdf->Cell(0, 4, utf8_decode('llevar a cabo la Revisión del Trabajo de Titulación. '), 0, 1, 'L');

$pdf->Ln(3); //CELDA DE ESPACIO
$pdf->Cell(23);
$x = $pdf->GetX();
$y = $pdf->GetY();
// $pdf->Cell(28, 4, utf8_decode(' Alumno (s):'), 1, 0, 'L');
$pdf->MultiCell(28, 4, utf8_decode(' Alumno (s):                            '), 1, 'L');
// AQUI VA EL NOMBRE DEL ALUMNO
$pdf->SetXY($x + 28, $y);
$x = $pdf->GetX();
$y = $pdf->GetY();
// $pdf->Cell(70, 4, utf8_decode(strtoupper ($res['nombre'])), 1, 0, 'L');
$pdf->SetFont('Helvetica', 'B', '9');
$pdf->MultiCell(70, 4, utf8_decode(' '.strtoupper ($res['nombre']).'                                        '), 1, 'L');
// AQUI VA LA CARRERA
$pdf->SetFont('Helvetica', '', '9');
// NOTE Checar espacio de carrera
$pdf->SetXY($x + 70, $y);
// $pdf->Cell(70, 4, utf8_decode(' Área: ' . strtoupper ($res['carrera'])), 1, 1, 'L');
$pdf->MultiCell(70, 4, utf8_decode(' '.strtoupper ($res['carrera'])), 1, 'L');
// $pdf->MultiCell(50, 4, utf8_decode('Área: INGENIERIA EN SISTEMAS COMPUTACIONALES'), 1, 'L');
$pdf->Cell(23);
$pdf->Cell(28, 4, utf8_decode(' Opción'), 1, 0, 'L');
$pdf->Cell(140, 4, utf8_decode(' TRABAJO DE TITULACIÓN INTEGRAL "TESIS PROFESIONAL"'), 1, 1, 'L');
$pdf->Cell(23);
// OBTENER CORDENADAS PARA PONER UNA MULTICELL AL LADO DE UNA CELL
$x = $pdf->GetX();
$y = $pdf->GetY();
// $pdf->Cell(28, 4, utf8_decode('Proyecto:'), 1, 0, 'L');
$pdf->MultiCell(28, 4, utf8_decode(' Proyecto:                    '), 1, 'L');
$pdf->SetXY($x + 28, $y);
// $pdf->Cell(53);
$pdf->MultiCell(140, 4, utf8_decode(' '.strtoupper ($res['nombreProyecto'])), 1, 'L');
$pdf->Cell(23);
$pdf->Cell(28, 4, utf8_decode(' Asesor:'), 1, 0, 'L');
$pdf->Cell(140, 4, utf8_decode(' '.strtoupper ($res['asesorInt'])), 1, 1, 'L');
$pdf->Cell(23);
$pdf->Cell(28, 4, utf8_decode(' Revisor 1:'), 1, 0, 'L');
$pdf->Cell(140, 4, utf8_decode(' '.strtoupper ($res['revisor1'])), 1, 1, 'L');
$pdf->Cell(23);
$pdf->Cell(28, 4, utf8_decode(' Revisor 2:'), 1, 0, 'L');
$pdf->Cell(140, 4, utf8_decode(' '.strtoupper ($res['revisor2'])), 1, 1, 'L');
$pdf->Cell(23);
$pdf->Cell(45, 4, utf8_decode(' Documentos entregados:'), 1, 0, 'L');
$pdf->Cell(123, 4, utf8_decode(' 1 EJEMPLAR PARA CADA REVISOR'), 1, 1, 'L');

$pdf->Ln(6); //CELDA DE ESPACIO
// $pdf->Cell(37);
$pdf->SetFont('Helvetica', 'BIU', '9');
$pdf->Cell(0, 4, utf8_decode('Los revisores deberán ponerse en contacto para unificar criterios, y emitir un solo dictamen.'), 0, 1, 'C');

$pdf->Ln(8); //CELDA DE ESPACIO
$pdf->SetFont('Helvetica', '', '9');
$pdf->Cell(31);
$pdf->Cell(0, 4, utf8_decode('Asimismo hago de su conocimiento que deberá entregar a este departamento el resultado de dicha'), 0, 1, 'L');
$pdf->Cell(21);
$pdf->Cell(36, 4, utf8_decode('revisión a más tardar en '), 0, 0, 'L');
$pdf->SetFont('Helvetica', 'B', '9');
$pdf->Cell(81, 4, utf8_decode('10 (DIEZ) días hábiles a partir de la fecha de entrega '), 0, 0, 'L');
$pdf->SetFont('Helvetica', '', '9');
$pdf->Cell(39, 4, utf8_decode('en el entendido que de no'), 0, 1, 'L');
$pdf->Cell(21);
$pdf->Cell(0, 4, utf8_decode('cumplir dentro de este plazo, se estará imposibilitado a que se continúe con los trámites sucesivos.'), 0, 1, 'L');

$pdf->Ln(2); //CELDA DE ESPACIO
$pdf->SetFont('Helvetica', '', '9');
$pdf->Cell(30);
$pdf->Cell(80, 4, utf8_decode('Con la seguridad de su oportuna entrega, quedo de usted. '), 0, 1, 'L');

$pdf->Ln(7); //CELDA DE ESPACIO
$pdf->SetFont('Helvetica', 'B', '9');
$pdf->Cell(0, 4, utf8_decode('A T E N T A M E N T E'), 0, 1, 'C');
$pdf->Cell(0, 4, utf8_decode('"TECNOLOGÍA COMO SINÓNIMO DE INDEPENDENCIA"'), 0, 1, 'C');

$pdf->Ln(10);
$pdf->SetFont('Helvetica', 'B', '9');
$pdf->Cell(0, 4, utf8_decode('ING. JORGE EDUARDO ORTEGA LOPEZ'), 0, 1, 'C');
$pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');

$pdf->Ln(16); //CELDA DE ESPACIO
$pdf->SetFont('Helvetica', '', '9');
$pdf->Cell(20);
$pdf->Cell(0, 4, utf8_decode('C.C.P. ARCHIVO.'), 0, 1, 'L');
$pdf->SetFont('Helvetica', '', '6');
$pdf->Cell(20);
$pdf->Cell(25, 4, utf8_decode('*SRZB*ere'), 0, 1, 'R');

$pdf->Output('I', 'Jurado_Seleccionado.pdf');
