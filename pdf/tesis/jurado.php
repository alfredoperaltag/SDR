<?php
session_start();

require '../FPDF/fpdf.php';
require '../../controladores/residentes.controlador.php';
require '../../modelos/residentes.modelo.php';
require '../../controladores/jerarquia.controlador.php';
require '../../modelos/jerarquia.modelo.php';
class PDF extends FPDF
{
    public $docente;
    //Cabecera
    public function Header()
    {
        $this->SetFont('Arial', 'B', '10');
        // $this->Image('../img/sep-logo.jpg', 20, 2, 67, 52, 'JPG');
        $this->Image('../img/sepNew_R.png', 15, 12, 67, 25, 'PNG');
        $this->Image('../img/TecNacMex.PNG', 137, 12, 66, 24, 'PNG');
        $this->Cell(0, 46, '', 0, 1, 'C'); //NOTE no borrar
        // $this->Cell(80, 25, 'gggggggggggggggg', 1, 1, 'C');
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
        $this->SetFont('Helvetica', '', '7');
        $this->SetXY($x, $y - 12);
        $this->Cell(0, 4, utf8_decode('Carretera Nacional Iguala-Taxco esquina Periférico Norte, Col. Adolfo López  Mateos  Infonavit, C.P. 40030, '), 0, 1, 'C');
        // $this->Cell(20);
        $this->Cell(0, 4, utf8_decode('Iguala de la Independencia, Gro. Tels. (733) 3321425'), 0, 1, 'C');
        // $this->Cell(44);
        $this->Cell(71);
        $this->Cell(20, 4, utf8_decode('Ext. 225, e-mail:'), 0, 0, 'L');
        $this->SetFont('Helvetica', 'B', '7');
        // $this->Cell(20);
        $this->Cell(35, 4, utf8_decode('sistemas@itiguala.edu.mx'), 0, 1, 'L');
        $this->Cell(0, 4, utf8_decode('www.itiguala.edu.mx'), 0, 0, 'C');
        // $x = $this->GetX();
        $this->Image('../img/iso14001.jpg', 155 + 12, 253, 17);
        $x = $this->GetX();
        // $this->Image('../img/iso9001.jpg', $x + 31, 253, 12);
        $this->Image('../img/norma.jpg', 155 + 31, 253, 15);
    }
}
if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {
    
        $item = "id";
        $valor = $_GET['id'];
        $tabla = "jerarquia";
        $puesto = "JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN";
        $res = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);
        $res2 = ControladorJerarquia::ctrMostrarDocentesDictamen($tabla, $puesto);


        $pdf = new PDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $h = $pdf->GetPageHeight();
        $w = $pdf->GetPageWidth();
        $pdf->Image('../img/fondo_membrete_R.jpg', '0', '38', '220', '243', 'JPG');
        //OTRO
        // $pdf->AddPage();
        // $h = $pdf->GetPageHeight();
        // $w = $pdf->GetPageWidth();
        $pdf->Image('../img/fondo_membrete_R.jpg', '0', '38', '220', '243', 'JPG');
        $pdf->SetFont('Helvetica', '', '7');
        $pdf->Cell(0, 4, utf8_decode('"2019, Año del Caudillo del Sur, Emiliano Zapata"'), 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Helvetica', '', '9');
        $pdf->Cell(107);
        $pdf->Cell(80, 4, 'OF. No. DSC-ITI/' . $_GET['numero'] . '/' . date("Y"), 0, 1, 'L');
        $pdf->Cell(107);
        $pdf->Cell(15, 4, 'ASUNTO: ', 0, 0, 'L');
        $pdf->SetFont('Helvetica', 'B', '9');
        $pdf->Cell(20, 4, utf8_decode('REVISIÓN DE TRABAJO DE TITULACIÓN.'), 0, 1, 'L');
        $pdf->SetFont('Helvetica', '', '9');
        $pdf->Cell(107);
        $pdf->Cell(25, 4, 'IGUALA, GRO., ', 0, 0, 'L');
// AQUI VA LA FECHA 2019-Abril-05
        $pdf->SetFont('Helvetica', 'B', '9');
        $pdf->Cell(50, 4, $_GET['fecha'], 0, 1, 'L');
        $pdf->Ln(12); //CELDA DE ESPACIO
        $pdf->SetFont('Helvetica', 'B', '9');
        $pdf->Cell(19);
        // $pdf->Cell(80, 4, utf8_decode($res['asesorInt'] . '.'), 0, 1, 'L');
        // NOTE AQUI
        $pdf->Cell(80, 4, utf8_decode($res['revisor1'] . '.'), 0, 1, 'L');
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
        $pdf->Cell(19);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(28, 4, utf8_decode(' Alumno (s):                            '), 1, 'L');
        $pdf->SetXY($x + 28, $y);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetFont('Helvetica', 'B', '9');
        // $pdf->MultiCell(70, 4, utf8_decode(' ' . strtoupper($res['nombre']) . '                                  '), 'LTB', 'L');
        $pdf->MultiCell(95, 4, utf8_decode(' ' . mb_strtoupper($res['nombre']) . '                                  '), 'LTB', 'L');
        $pdf->SetFont('Helvetica', '', '9');
        $pdf->SetXY($x + 95, $y);
        $pdf->MultiCell(45, 4, utf8_decode(' ' . mb_strtoupper($res['carrera'])), 1, 'L');
        $pdf->Cell(19);
        $pdf->Cell(28, 4, utf8_decode(' Opción'), 1, 0, 'L');
        $pdf->Cell(140, 4, utf8_decode(' TITULACIÓN INTEGRAL "TESIS PROFESIONAL"'), 1, 1, 'L');
        $pdf->Cell(19);
// OBTENER CORDENADAS PARA PONER UNA MULTICELL AL LADO DE UNA CELL
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(28, 4, utf8_decode(' Proyecto:                                                         '), 1, 'L');
        $pdf->SetXY($x + 28, $y);
        $pdf->MultiCell(140, 4, utf8_decode(' ' . mb_strtoupper($res['nombreProyecto'])), 1, 'L');
        $pdf->Cell(19);
        $pdf->Cell(28, 4, utf8_decode(' Asesor:'), 1, 0, 'L');
        $pdf->Cell(140, 4, utf8_decode(' ' . mb_strtoupper($res['asesorInt'])), 1, 1, 'L');
        $pdf->Cell(19);
        $pdf->Cell(28, 4, utf8_decode(' Revisor 1:'), 1, 0, 'L');
        $pdf->Cell(140, 4, utf8_decode(' ' . mb_strtoupper($res['revisor1'])), 1, 1, 'L');
        $pdf->Cell(19);
        $pdf->Cell(28, 4, utf8_decode(' Revisor 2:'), 1, 0, 'L');
        $pdf->Cell(140, 4, utf8_decode(' ' . mb_strtoupper($res['revisor2'])), 1, 1, 'L');
        $pdf->Cell(19);
        $pdf->Cell(45, 4, utf8_decode(' Documentos entregados:'), 1, 0, 'L');
        $pdf->Cell(123, 4, utf8_decode(' 1 EJEMPLAR PARA CADA REVISOR'), 1, 1, 'L');
        $pdf->Ln(6); //CELDA DE ESPACIO
        $pdf->SetFont('Helvetica', 'BIU', '9');
        $pdf->Cell(0, 4, utf8_decode('Los revisores deberán ponerse en contacto para unificar criterios, y emitir un solo dictamen.'), 0, 1, 'C');
        $pdf->Ln(8); //CELDA DE ESPACIO
        $pdf->SetFont('Helvetica', '', '9');
        $pdf->Cell(31);
        $pdf->Cell(0, 4, utf8_decode('Asi mismo hago de su conocimiento que deberá entregar a este departamento el resultado de dicha'), 0, 1, 'L');
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
        $pdf->Ln(15);
        $pdf->SetFont('Helvetica', 'B', '9');
        $pdf->Cell(0, 4, utf8_decode(mb_strtoupper($res2['nombre'])), 0, 1, 'C');
        // $pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
        if ($res2['sexo'] == 'F') {
            $pdf->Cell(0, 4, utf8_decode('JEFA DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
        }else{
            $pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
        }
        $pdf->Ln(14); //CELDA DE ESPACIO
        $pdf->SetFont('Helvetica', '', '9');
        $pdf->Cell(20);
        $pdf->Cell(0, 4, utf8_decode('C.C.P. ARCHIVO.'), 0, 1, 'L');
        $pdf->SetFont('Helvetica', '', '6');
        $pdf->Cell(20);
        $pdf->Cell(25, 4, utf8_decode('*SRZB*ere'), 0, 1, 'R');

        //OTRO
        $pdf->AddPage();
        $pdf->Image('../img/fondo_membrete_R.jpg', '0', '38', '220', '243', 'JPG');
        $pdf->SetFont('Helvetica', '', '7');
        $pdf->Cell(0, 4, utf8_decode('"2019, Año del Caudillo del Sur, Emiliano Zapata"'), 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Helvetica', '', '9');
        $pdf->Cell(107);
        $pdf->Cell(80, 4, 'OF. No. DSC-ITI/' . $_GET['numero'] . '/' . date("Y"), 0, 1, 'L');
        $pdf->Cell(107);
        $pdf->Cell(15, 4, 'ASUNTO: ', 0, 0, 'L');
        $pdf->SetFont('Helvetica', 'B', '9');
        $pdf->Cell(20, 4, utf8_decode('REVISIÓN DE TRABAJO DE TITULACIÓN.'), 0, 1, 'L');
        $pdf->SetFont('Helvetica', '', '9');
        $pdf->Cell(107);
        $pdf->Cell(25, 4, 'IGUALA, GRO., ', 0, 0, 'L');
// AQUI VA LA FECHA 2019-Abril-05
        $pdf->SetFont('Helvetica', 'B', '9');
        $pdf->Cell(50, 4, $_GET['fecha'], 0, 1, 'L');
        $pdf->Ln(12); //CELDA DE ESPACIO
        $pdf->SetFont('Helvetica', 'B', '9');
        $pdf->Cell(19);
        // $pdf->Cell(80, 4, utf8_decode($res['asesorInt'] . '.'), 0, 1, 'L');
        // NOTE AQUI
        $pdf->Cell(80, 4, utf8_decode($res['revisor1'] . '.'), 0, 1, 'L');
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
        $pdf->Cell(19);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(28, 4, utf8_decode(' Alumno (s):                            '), 1, 'L');
        $pdf->SetXY($x + 28, $y);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetFont('Helvetica', 'B', '9');
        // $pdf->MultiCell(70, 4, utf8_decode(' ' . strtoupper($res['nombre']) . '                                  '), 'LTB', 'L');
        $pdf->MultiCell(95, 4, utf8_decode(' ' . mb_strtoupper($res['nombre']) . '                                  '), 'LTB', 'L');
        $pdf->SetFont('Helvetica', '', '9');
        $pdf->SetXY($x + 95, $y);
        $pdf->MultiCell(45, 4, utf8_decode(' ' . mb_strtoupper($res['carrera'])), 1, 'L');
        $pdf->Cell(19);
        $pdf->Cell(28, 4, utf8_decode(' Opción'), 1, 0, 'L');
        $pdf->Cell(140, 4, utf8_decode(' TITULACIÓN INTEGRAL "TESIS PROFESIONAL"'), 1, 1, 'L');
        $pdf->Cell(19);
// OBTENER CORDENADAS PARA PONER UNA MULTICELL AL LADO DE UNA CELL
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->MultiCell(28, 4, utf8_decode(' Proyecto:                                                         '), 1, 'L');
        $pdf->SetXY($x + 28, $y);
        $pdf->MultiCell(140, 4, utf8_decode(' ' . mb_strtoupper($res['nombreProyecto'])), 1, 'L');
        $pdf->Cell(19);
        $pdf->Cell(28, 4, utf8_decode(' Asesor:'), 1, 0, 'L');
        $pdf->Cell(140, 4, utf8_decode(' ' . mb_strtoupper($res['asesorInt'])), 1, 1, 'L');
        $pdf->Cell(19);
        $pdf->Cell(28, 4, utf8_decode(' Revisor 1:'), 1, 0, 'L');
        $pdf->Cell(140, 4, utf8_decode(' ' . mb_strtoupper($res['revisor1'])), 1, 1, 'L');
        $pdf->Cell(19);
        $pdf->Cell(28, 4, utf8_decode(' Revisor 2:'), 1, 0, 'L');
        $pdf->Cell(140, 4, utf8_decode(' ' . mb_strtoupper($res['revisor2'])), 1, 1, 'L');
        $pdf->Cell(19);
        $pdf->Cell(45, 4, utf8_decode(' Documentos entregados:'), 1, 0, 'L');
        $pdf->Cell(123, 4, utf8_decode(' 1 EJEMPLAR PARA CADA REVISOR'), 1, 1, 'L');
        $pdf->Ln(6); //CELDA DE ESPACIO
        $pdf->SetFont('Helvetica', 'BIU', '9');
        $pdf->Cell(0, 4, utf8_decode('Los revisores deberán ponerse en contacto para unificar criterios, y emitir un solo dictamen.'), 0, 1, 'C');
        $pdf->Ln(8); //CELDA DE ESPACIO
        $pdf->SetFont('Helvetica', '', '9');
        $pdf->Cell(31);
        $pdf->Cell(0, 4, utf8_decode('Asi mismo hago de su conocimiento que deberá entregar a este departamento el resultado de dicha'), 0, 1, 'L');
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
        $pdf->Ln(15);
        $pdf->SetFont('Helvetica', 'B', '9');
        $pdf->Cell(0, 4, utf8_decode(mb_strtoupper($res2['nombre'])), 0, 1, 'C');
        // $pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
        if ($res2['sexo'] == 'F') {
            $pdf->Cell(0, 4, utf8_decode('JEFA DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
        }else{
            $pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
        }
        $pdf->Ln(14); //CELDA DE ESPACIO
        $pdf->SetFont('Helvetica', '', '9');
        $pdf->Cell(20);
        $pdf->Cell(0, 4, utf8_decode('C.C.P. ARCHIVO.'), 0, 1, 'L');
        $pdf->SetFont('Helvetica', '', '6');
        $pdf->Cell(20);
        $pdf->Cell(25, 4, utf8_decode('*SRZB*ere'), 0, 1, 'R');
        $pdf->Output('I', 'Jurado_Seleccionado_'.$res['nombre'].'.pdf', 'D');

} else {
    echo "<script>window.location = '../../Inicio';</script>";
}
