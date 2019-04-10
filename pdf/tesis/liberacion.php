<?php
session_start();

require '../FPDF/fpdf.php';
require '../../controladores/residentes.controlador.php';
require '../../modelos/residentes.modelo.php';
require '../../controladores/jerarquia.controlador.php';
require '../../modelos/jerarquia.modelo.php';
class PDF extends FPDF
{
    // public $docente;
    public function Header()
    {
        $this->SetFont('Arial', 'B', '10');
        $this->Image('../img/sepNew_R.png', 15, 12, 67, 25, 'PNG');
        $this->Image('../img/TecNacMex.PNG', 137, 12, 66, 24, 'PNG');
        // $this->Cell(0, 46, '', 0, 1, 'C');
        $this->Cell(0, 28, '', 0, 1, 'C');
    }
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $x = $this->GetX();
        $y = $this->GetY();
        $this->Image('../img/iti.jpg', 15, 253, 12);
        $this->SetFont('Helvetica', '', '7');
        $this->SetXY($x, $y - 12);
        $this->Cell(0, 4, utf8_decode('Carretera Nacional Iguala-Taxco esquina Periférico Norte, Col. Adolfo López  Mateos  Infonavit, C.P. 40030, '), 0, 1, 'C');
        $this->Cell(0, 4, utf8_decode('Iguala de la Independencia, Gro. Tels. (733) 3321425'), 0, 1, 'C');
        $this->Cell(0, 4, utf8_decode('Ext. 225, e-mail: comunicacion@itiguala.edu.mx,'), 0, 1, 'C');
        $this->SetFont('Helvetica', 'B', '7');
        $this->Cell(0, 4, utf8_decode('sistemas@itiguala.edu.mx'), 0, 0, 'C');
        $this->Image('../img/iso14001.jpg', 155 + 12, 253, 17);
        $x = $this->GetX();
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
        $pdf->Image('../img/fondo_membrete_R.jpg', '0', '38', '220', '243', 'JPG');
        $pdf->SetFont('Helvetica', '', '7');
        $pdf->Cell(0, 5, utf8_decode('"2019, Año del Caudillo del Sur, Emiliano Zapata"'), 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('Arial', '', '9');
        $pdf->Cell(17);
        $pdf->Cell(0, 4, utf8_decode('DEPTO. DE SISTEMAS Y COMPUTACION'), 0, 1, 'L');
        $pdf->Cell(17);
        $pdf->Cell(0, 4, utf8_decode('OF. No. DSC-ITI/1236/2018'), 0, 1, 'L');
        $pdf->Cell(17);
        $pdf->SetFont('Arial', 'B', '9');
        $pdf->Cell(16, 4, utf8_decode('ASUNTO:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', '9');
        // $pdf->Cell(16);
        $pdf->Cell(80, 4, utf8_decode('Liberación de Proyecto para Titulación Integral.'), 0, 1, 'L');
        $pdf->Cell(17);
        $pdf->Cell(20, 4, utf8_decode('Iguala, Gro.,'),0, 0, 'L');
        $pdf->SetTextColor(255,255,255);
        $anchoTexto = $pdf->GetStringWidth('06/ABRIL/2018');
        $pdf->Cell($anchoTexto, 4, utf8_decode('06/ABRIL/2018'), 1, 1, 'C', true);
        $pdf->SetTextColor(0,0,0);
        $pdf->Ln(10); //CELDA DE ESPACIO
        
        
        $pdf->SetFont('Arial', 'B', '9');
        $pdf->Cell(17);
        $pdf->Cell(100, 4, utf8_decode('M.A. JUANA MIRNA VALLE MORALES'), 0, 1, 'L');
        $pdf->Cell(17);
        $pdf->Cell(100, 4, utf8_decode('JEFA DE LA DIVISION DE ESTUDIOS PROFESIONALES'), 0, 1, 'L');
        $pdf->Cell(17);
        $pdf->Cell(100, 4, utf8_decode('PRESENTE'), 0, 1, 'L');
        $pdf->Ln(10); //CELDA DE ESPACIO
        
        
        $pdf->SetFont('Arial', '', '9');
        // $pdf->Cell(17);
        $pdf->Cell(0, 5, utf8_decode('Por este medio le informo que ha sido liberado el siguiente proyecto para la Titulación integral Tesis Profesional'), 0, 1, 'C');
        $pdf->Cell(19);
        $pdf->Cell(40, 4, utf8_decode('a)	Nombre del Egresado:'), 1, 0, 'L');
        $pdf->Cell(118, 4, utf8_decode('FARIT MALDONADO SEGURA'), 1, 1, 'L');
        $pdf->Cell(19);
        $pdf->Cell(40, 4, utf8_decode('a)	Numero de Control:'), 1, 0, 'L');
        $pdf->Cell(118, 4, utf8_decode('11670329'), 1, 1, 'L');
        $pdf->Cell(19);
        $pdf->Cell(40, 4, utf8_decode('c)	Carrera:'), 1, 0, 'L');
        $pdf->Cell(118, 4, utf8_decode('Ingenieria en Sistemas Computacionales'), 1, 1, 'L');

        // NOTE: CHECAR LAS MULTICELL
        $pdf->Cell(19);
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->SetXY($x + 40, $y);
        $pdf->MultiCell(118, 4, utf8_decode(strtoupper('DETERMINACION DE LOS DISPOSITIVOS DE RED QUE PERMITAN PROPORCIONAR SERVICIO DE INTERNET EN EL INSTITUTO TECNOLOGICO DE IGUALA')), 1, 'L');
        $y1 = $pdf->GetY();
        $pdf->MultiCell(40, $y1, utf8_decode('d)	Nombre del proyecto:                     '), 1, 'L');
        
        $pdf->Output('I', 'Jurado_Seleccionado.pdf');


} else {
    echo '<h1>Aqui no puedes hacer eso :)<h1>';
}
