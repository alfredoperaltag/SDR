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
$nombre = $respuesta["nombre"];
$carrera = $respuesta["carrera"];
$proyecto = $respuesta["nombreProyecto"];
$periodo = $respuesta["periodo"];
$empresa = $respuesta["nombreEmpresa"];

$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 11);

$pdf->SetWidths(array(50, 140));
$pdf->Row(array('a) Nombre del Residente:', $nombre));
$pdf->Row(array('b) Carrera:', $carrera));
$pdf->Row(array('c) Nombre del Proyecto:', $proyecto));
$pdf->Row(array('d) Periodo de Realización', $periodo));
$pdf->Row(array('e) Empresa', $empresa));

$pdf->Output();
