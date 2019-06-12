<?php
session_start();
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
        $this->Image('../img/membreteAsesor.PNG', 21, 12, 0);
        $this->Ln(40);
    }

    // Pie de página
    function Footer()
    {
        $this->Image('../img/iti.jpg', 24, 257.5, 9);
        $this->SetFont('Arial', 'B', 6.3);
        $this->SetXY(52, -17);
        $this->Cell(0, 0, utf8_decode('Toda copia en PAPEL es "Documento no controlado" a excepción del original'), 0, 0, 'L');
        $this->SetFont('Arial', '', 8);
        $this->SetXY(176, -13);
        $this->Cell(0, 0, utf8_decode('Rev. 1'), 0, 0, 'C');
    }
    var $widths;
    var $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}
if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {
    $item = "id";
    $valor = $_GET['id'];
    $fechaActual = $_GET['fecha'];
    $numero = $_GET['numero'];
    $respuesta = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);
    $tablaJ = "jerarquia";
    $itemPresi = "PRESIDENTE DE ACADEMIA";
    $itemJefe = "JEFE DEL DEPTO. ACADEMICO";
    $itemSub = "SUBDIRECTOR ACADÉMICO";
    $resP = ControladorJerarquia::ctrMostrarDocentesDictamen($tablaJ, $itemPresi);
    $resJe = ControladorJerarquia::ctrMostrarDocentesDictamen($tablaJ, $itemJefe);
    $resSub = ControladorJerarquia::ctrMostrarDocentesDictamen($tablaJ, $itemSub);
    $jefe = $resJe['nombre'];
    $asesorInterno = $respuesta["asesorInt"];
    $nombre = $respuesta["nombre"];
    $carrera = $respuesta["carrera"];
    $proyecto = $respuesta["nombreProyecto"];
    $periodo = $respuesta["periodo"];
    $empresa = $respuesta["nombreEmpresa"];

    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->SetLeftMargin(20);
    $pdf->SetRightMargin(12);
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 9);

    $pdf->Cell(0, 0, utf8_decode('Departamento: Sistemas y Computación'), 0, 0, 'R');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('No. de Oficio: DSC-ITI/' . $numero . '/*' . date("Y") . ''), 0, 0, 'R');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('Iguala de la Independencia, Gro. ' . $fechaActual), 0, 0, 'R');
    $pdf->Ln(10);
    $pdf->Cell(290, 0, utf8_decode('ASUNTO: '), 0, 0, 'C');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 0, utf8_decode('Asesor interno de'), 0, 0, 'R');
    $pdf->Ln(5);
    $pdf->Cell(0, 0, utf8_decode('Residencias Profesionales.'), 0, 0, 'R');
    $pdf->Ln(16);
    $pdf->Cell(0, 0, utf8_decode('C. ' . mb_strtoupper($asesorInterno)), 0, 0, 'L');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('CATEDRÁTICO DEL I.T. DE IGUALA,'), 0, 0, 'L');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('P R E S E N T E.'), 0, 0, 'L');
    $pdf->Ln(11);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 0, utf8_decode('Por este conducto informo a usted que ha sido asignado para fungir como Asesor Interno del Proyecto de'), 0, 0, 'J');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('Residencias Profesionales que a continuación se describe:'), 0, 0, 'J');
    $pdf->Ln(6);

    // $pdf->SetFont('Arial', '', 10);
    $pdf->SetWidths(array(48.5, 134));
    $pdf->Row(array('a) Nombre del Residente:', utf8_decode(mb_strtoupper($nombre))));
    $pdf->Row(array('b) Carrera:', utf8_decode(mb_strtoupper($carrera))));
    $pdf->Row(array('c) Nombre del Proyecto:', utf8_decode($proyecto)));
    $pdf->Row(array(utf8_decode('d) Periodo de Realización'), utf8_decode(mb_strtoupper($periodo))));
    $pdf->Row(array('e) Empresa', utf8_decode(mb_strtoupper($empresa))));
    $pdf->Ln(14);

    // $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 0, utf8_decode('Así mismo, le solicito dar el seguimiento pertinente a la realización del proyecto aplicando los lineamientos'), 0, 0, 'J');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('establecidos para ello, en el procedimiento del SGI para Residencias Profesionales.'), 0, 0, 'J');
    $pdf->Ln(6.5);
    $pdf->Cell(0, 0, utf8_decode('Agradezco de antemano su valioso apoyo en esta importante actividad para la formación profesional de nuestro'), 0, 0, 'J');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('estudiantado.'), 0, 0, 'J');
    $pdf->Ln(18.5);

    $pdf->Cell(0, 0, utf8_decode('A t e n t a m e n t e.'), 0, 0, 'C');
    $pdf->Ln(8);
    $pdf->Cell(0, 0, utf8_decode(mb_strtoupper($jefe)), 0, 0, 'C');
    $pdf->Ln(4.2);
    $pdf->Cell(0, 0, utf8_decode('JEFE DEL DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
    $pdf->Ln(29);
    $pdf->Cell(0, 0, utf8_decode('c.c.p. Coordinación de Carrera'), 0, 0, 'J');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('c.c.p. Expediente'), 0, 0, 'J');

    $pdf->Output('I', 'Asignacion de Asesor ' . $nombre . '.pdf', 'D');
} else {
    echo "<script>window.location = '../../Inicio';</script>";
}
