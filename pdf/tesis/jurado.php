<?php

require '../FPDF/fpdf.php';

class PDF extends FPDF
{
    //Cabecera
    public function Header()
    {
        $this->SetFont('Arial', 'B', '10');
        $this->Image('../img/sep-logo.jpg', 20, 2, 67, 52, 'JPG');
        $this->Image('../img/TecNacMex.PNG', 137, 12, 66, 24, 'PNG');
        $this->Cell(0, 46, '', 0, 1, 'C');
        // $this->Ln(20);
    }
}

$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AddPage();
$pdf->Image('../img/fondo1.png', '28', '99', '150', '150', 'PNG');

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

$pdf->Cell(0, 15, '', 0, 1, 'C'); //CELDA DE ESPACIO
$pdf->SetFont('Helvetica', 'B', '9');
$pdf->Cell(19);
$pdf->Cell(80, 4, 'M.D.I.S. SILVIA VALLE BAHENA', 0, 1, 'L');
$pdf->Cell(19);
$pdf->Cell(80, 4, utf8_decode('DOCENTE DE ESTA INSTITUCIÓN.'), 0, 1, 'L');
$pdf->Cell(19);
$pdf->Cell(80, 4, 'P R E S E N T E', 0, 1, 'L');

$pdf->Cell(0, 7, '', 0, 1, 'C'); //CELDA DE ESPACIO
$pdf->SetFont('Helvetica', '', '9');
$pdf->Cell(31);
$pdf->Cell(0, 4, 'Por medio del presente, me permito hacer de su conocimiento que ha sido comisionado (a) para ', 0, 1, 'L');
$pdf->Cell(18);
$pdf->Cell(0, 4, utf8_decode('llevar a cabo la Revisión del Trabajo de Titulación. '), 0, 1, 'L');

$pdf->Cell(0, 3, '', 0, 1, 'C'); //CELDA DE ESPACIO
$pdf->Cell(23);
$pdf->Cell(28, 4, utf8_decode(' Alumno (s):'), 1, 0, 'L');
$pdf->SetFont('Helvetica', 'B', '9');
// AQUI VA EL NOMBRE DEL ALUMNO
$pdf->Cell(70, 4, utf8_decode(' MARÍA VALENTINA HERNANDEZ RAMIREZ'), 1, 0, 'L');
// AQUI VA LA CARRERA
$pdf->SetFont('Helvetica', '', '9');
// NOTE Checar espacio de carrera
$pdf->Cell(70, 4, utf8_decode(' Área: INGENIERIA INFORMATICA'), 1, 1, 'L');
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
$pdf->MultiCell(140, 4, utf8_decode(' DETERMINACION DE LOS DISPOSITIVOS DE RED QUE PERMITAN PROPORCIONAR SERVICIO DE INTERNET EN EL INSTITUTO TECNOLOGICO DE IGUALA'), 1, 'L');
$pdf->Cell(23);
$pdf->Cell(28, 4, utf8_decode(' Asesor:'), 1, 0, 'L');
$pdf->Cell(140, 4, utf8_decode(' LIC. ENRIQUE MENA SALGADO'), 1, 1, 'L');
$pdf->Cell(23);
$pdf->Cell(28, 4, utf8_decode(' Revisor 1:'), 1, 0, 'L');
$pdf->Cell(140, 4, utf8_decode(' M.D.I.S. SILVIA VALLE BAHENA'), 1, 1, 'L');
$pdf->Cell(23);
$pdf->Cell(28, 4, utf8_decode(' Revisor 2:'), 1, 0, 'L');
$pdf->Cell(140, 4, utf8_decode(' M.A. ANGELITA DIONICIO ABRAJAN'), 1, 1, 'L');
$pdf->Cell(23);
$pdf->Cell(45, 4, utf8_decode(' Documentos entregados:'), 1, 0, 'L');
$pdf->Cell(123, 4, utf8_decode(' 1 EJEMPLAR PARA CADA REVISOR'), 1, 1, 'L');

$pdf->Cell(0, 6, '', 0, 1, 'C'); //CELDA DE ESPACIO
// $pdf->Cell(37);
$pdf->SetFont('Helvetica', 'BIU', '9');
$pdf->Cell(0, 4, utf8_decode('Los revisores deberán ponerse en contacto para unificar criterios, y emitir un solo dictamen.'), 0, 1, 'C');

$pdf->Cell(0, 8, '', 0, 1, 'C'); //CELDA DE ESPACIO
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
$pdf->Cell(0, 4, utf8_decode('cumplir dentro de este plazo, se estará imposibilitado a que se continúe con los trámites sucesivos.'), 0, 0, 'L');

$pdf->Cell(0, 8, '', 0, 1, 'C'); //CELDA DE ESPACIO







$pdf->Output();
