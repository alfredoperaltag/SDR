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
        $pdf->Cell(16, 4, utf8_decode('ASUNTO:'), 1, 1, 'L');



        $pdf->Output('I', 'Jurado_Seleccionado.pdf');


} else {
    echo '<h1>Aqui no puedes hacer eso :)<h1>';
}
