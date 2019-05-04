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
        $this->Cell(71);
        $this->Cell(20, 4, utf8_decode('Ext. 225, e-mail:'), 0, 0, 'L');
        $this->SetFont('Helvetica', 'B', '7');
        // $this->Cell(20);
        $this->Cell(35, 4, utf8_decode('sistemas@itiguala.edu.mx'), 0, 0, 'L');
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
    $puesto2 = "JEFE DE LA DIVISION DE ESTUDIOS PROFESIONALES";
    $res = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);
    $res2 = ControladorJerarquia::ctrMostrarDocentesDictamen($tabla, $puesto);
    $res3 = ControladorJerarquia::ctrMostrarDocentesDictamen($tabla, $puesto2);
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
    $pdf->Cell(0, 4, utf8_decode('OF. No. DSC-ITI/'.$_GET['numero'].'/'.Date("Y")), 0, 1, 'L');
    $pdf->Cell(17);
    $pdf->SetFont('Arial', 'B', '9');
    $pdf->Cell(16, 4, utf8_decode('ASUNTO:'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', '9');
    // $pdf->Cell(16);
    $pdf->Cell(80, 4, utf8_decode('Liberación de Proyecto para Titulación Integral.'), 0, 1, 'L');
    $pdf->Cell(17);
    $pdf->Cell(20, 4, utf8_decode('Iguala, Gro.,'), 0, 0, 'L');
    $pdf->SetTextColor(255, 255, 255);
    $anchoTexto = $pdf->GetStringWidth(' '.$_GET['fecha'].' ');
    $pdf->Cell($anchoTexto, 4, utf8_decode($_GET['fecha']), 1, 1, 'C', true);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln(10); //CELDA DE ESPACIO

    $pdf->SetFont('Arial', 'B', '9');
    $pdf->Cell(17);
    if ($res3['nombre'] == null) {
        $pdf->Cell(100, 4, utf8_decode('==== LA JERARQUIA EN LA BASE DE DATOS ESTA MAL ===='), 0, 1, 'L');
    }else{
        $pdf->Cell(100, 4, utf8_decode(mb_strtoupper($res3['nombre'])), 0, 1, 'L');
    }
    // OPCION DEPENDE DEL GENERO
    if ($res3['sexo'] == 'F') {
        $pdf->Cell(17);
        $pdf->Cell(100, 4, utf8_decode('JEFA DE LA DIVISION DE ESTUDIOS PROFESIONALES'), 0, 1, 'L');
    }else{
        $pdf->Cell(17);
        $pdf->Cell(100, 4, utf8_decode('JEFE DE LA DIVISION DE ESTUDIOS PROFESIONALES'), 0, 1, 'L');
    }
    $pdf->Cell(17);
    $pdf->Cell(100, 4, utf8_decode('PRESENTE'), 0, 1, 'L');
    $pdf->Ln(10); //CELDA DE ESPACIO

    $pdf->SetFont('Arial', '', '9');
    // $pdf->Cell(17);
    $pdf->Cell(0, 5, utf8_decode('Por este medio le informo que ha sido liberado el siguiente proyecto para la Titulación integral Tesis Profesional'), 0, 1, 'C');
    $pdf->Ln(2);
    $pdf->Cell(19);
    $pdf->Cell(40, 4, utf8_decode('a)	Nombre del Egresado:'), 1, 0, 'L');
    $pdf->SetFont('Arial', 'B', '9');
    $pdf->Cell(118, 4, utf8_decode(mb_strtoupper($res['nombre'])), 1, 1, 'L');
    $pdf->Cell(19);
    $pdf->SetFont('Arial', '', '9');
    $pdf->Cell(40, 4, utf8_decode('a)	Numero de Control:'), 1, 0, 'L');
    $pdf->SetFont('Arial', 'B', '9');
    $pdf->Cell(118, 4, utf8_decode($res['noControl']), 1, 1, 'L');
    $pdf->Cell(19);
    $pdf->SetFont('Arial', '', '9');
    $pdf->Cell(40, 4, utf8_decode('c)	Carrera:'), 1, 0, 'L');
    $pdf->SetFont('Arial', 'B', '9');
    $pdf->Cell(118, 4, utf8_decode(mb_strtoupper($res['carrera'])), 1, 1, 'L');
    
    
    $pdf->Cell(59);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(118, 4, utf8_decode(mb_strtoupper($res['nombreProyecto'])), 1, 'L');
    $pdf->SetFont('Arial', '', '9');
    $H = $pdf->GetY();
    $pdf->Cell(19);
    $height= $H-$y;
    $pdf->SetXY($x -40 , $y);
    $pdf->MultiCell(40, $height, utf8_decode('d) Nombre del proyecto: '), 1, 'L');
    
    $pdf->Cell(59);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->SetFont('Arial', 'B', '9');
    $pdf->MultiCell(118, 4, utf8_decode('TRABAJO DE TITULACIÓN INTEGRAL "INFORME TÉCNICO DE RESIDENCIA PROFESIONAL"'), 1, 'L');
    $pdf->SetFont('Arial', '', '9');
    $H = $pdf->GetY();
    $pdf->Cell(19);
    $height= $H-$y;
    $pdf->SetXY($x -40 , $y);
    $pdf->MultiCell(40, $height, utf8_decode('e) Producto: '), 1, 'L');
    
    $pdf->Ln(5);
    
    $pdf->SetFont('Arial', '', '9');
    $pdf->Cell(19);
    $pdf->MultiCell(160, 4, utf8_decode('Agradezco de antemano su valioso apoyo en esta importante actividad para la formación profesional de nuestros egresados. '), 0, 'L');
    // $pdf->Cell(250, 4, utf8_decode(), 1, 1, 'L');
    
    $pdf->Ln(10);
    $pdf->Cell(19);
    $pdf->SetFont('Arial', 'B', '9');
    $pdf->Cell(158, 4, utf8_decode('ATENTAMENTE'), 0, 1, 'L');
    $pdf->Cell(19);
    $pdf->Cell(158, 4, utf8_decode('"Tecnología como Sinónimo de Independencia"'), 0, 1, 'L');
    $pdf->Ln(15);
    $pdf->Cell(19);
    $pdf->Cell(158, 4, utf8_decode(mb_strtoupper($res2['nombre'])), 0, 1, 'L');
    if ($res2['sexo'] == 'F') {
        $pdf->Cell(19);
        $pdf->Cell(158, 4, utf8_decode('JEFA DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'L');
    }else{
        $pdf->Cell(19);
        $pdf->Cell(158, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'L');
    }
    
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', '9');
    $pdf->Cell(19);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    // MultiCellRow(3, 53, 10, ["M.C. ENRIQUE MENA SALGADO","M.D.I.S. SILVIA VALLE BAHENA", "M.A. ANGELITA  ABRAJAN"], $pdf);
    // $pdf->Cell(158, 4, utf8_decode(''), 0, 1, 'L');
    // $pdf->SetY($pdf->GetY()+4);

    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(53, 4, utf8_decode(mb_strtoupper($res['revisor1'])), 'LTR', 'C');
    $pdf->SetXY($x + 53, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(53, 4, utf8_decode(mb_strtoupper($res['revisor2'])), 'LTR', 'C');
    $pdf->SetXY($x + 53, $y);
    $pdf->MultiCell(53, 4, utf8_decode(mb_strtoupper($res['revisor3'])), 'LTR', 'C');
    //ESPACIO BAA
    $pdf->Cell(19);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(53, 4, utf8_decode(''), 'LBR', 'C');
    $pdf->SetXY($x + 53, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(53, 4, utf8_decode(''), 'LBR', 'C');
    $pdf->SetXY($x + 53, $y);
    $pdf->MultiCell(53, 4, utf8_decode(''), 'LBR', 'C');
    // BAAA



    $pdf->Cell(19);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(53, 7, utf8_decode('Nombre y Firma Asesor'), 1, 'C');
    $pdf->SetXY($x + 53, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(53, 7, utf8_decode('Nombre y Firma Asesor'), 1, 'C');
    $pdf->SetXY($x + 53, $y);
    $pdf->MultiCell(53, 7, utf8_decode('Nombre y Firma Asesor'), 1, 'C');

    $pdf->Ln(8);
    $pdf->Cell(19);
    $pdf->SetFont('Arial', '', '8');
    $pdf->Cell(158, 4, utf8_decode('c.c.p.- Expediente'), 0, 1, 'L');

    
    $pdf->Output('I', 'Liberación_'.$res['nombre'].'.pdf', 'D');

} else {
    echo '<h1>Aqui no puedes hacer eso :)<h1>';
}
