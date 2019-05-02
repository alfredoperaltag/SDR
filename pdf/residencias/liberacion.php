<?php
require('../FPDF/fpdf.php');
require_once "../../controladores/jerarquia.controlador.php";
require_once "../../modelos/jerarquia.modelo.php";
require_once "../../controladores/residentes.controlador.php";
require_once "../../modelos/residentes.modelo.php";

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
    function WriteText($text)
    {
        $intPosIni = 0;
        $intPosFim = 0;
        if (strpos($text, '<') !== false && strpos($text, '[') !== false) {
            if (strpos($text, '<') < strpos($text, '[')) {
                $this->Write(4, substr($text, 0, strpos($text, '<')));
                $intPosIni = strpos($text, '<');
                $intPosFim = strpos($text, '>');
                $this->SetFont('', 'B');
                $this->Write(4, substr($text, $intPosIni + 1, $intPosFim - $intPosIni - 1));
                $this->SetFont('', '');
                $this->WriteText(substr($text, $intPosFim + 1, strlen($text)));
            } else {
                $this->Write(4, substr($text, 0, strpos($text, '[')));
                $intPosIni = strpos($text, '[');
                $intPosFim = strpos($text, ']');
                $w = $this->GetStringWidth('a') * ($intPosFim - $intPosIni - 1);
                $this->Cell($w, $this->FontSize + 0.75, substr($text, $intPosIni + 1, $intPosFim - $intPosIni - 1), 1, 0, '');
                $this->WriteText(substr($text, $intPosFim + 1, strlen($text)));
            }
        } else {
            if (strpos($text, '<') !== false) {
                $this->Write(4, substr($text, 0, strpos($text, '<')));
                $intPosIni = strpos($text, '<');
                $intPosFim = strpos($text, '>');
                $this->SetFont('', 'B');
                $this->WriteText(substr($text, $intPosIni + 1, $intPosFim - $intPosIni - 1));
                $this->SetFont('', '');
                $this->WriteText(substr($text, $intPosFim + 1, strlen($text)));
            } elseif (strpos($text, '[') !== false) {
                $this->Write(4, substr($text, 0, strpos($text, '[')));
                $intPosIni = strpos($text, '[');
                $intPosFim = strpos($text, ']');
                $w = $this->GetStringWidth('a') * ($intPosFim - $intPosIni - 1);
                $this->Cell($w, $this->FontSize + 0.75, substr($text, $intPosIni + 1, $intPosFim - $intPosIni - 1), 1, 0, '');
                $this->WriteText(substr($text, $intPosFim + 1, strlen($text)));
            } else {
                $this->Write(4, $text);
            }
        }
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
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'J';
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

$fechaActual = $_GET['fecha'];
$tablaJ = "jerarquia";
$itemJefeDivision = "JEFE DE LA DIVISION DE ESTUDIOS PROFESIONALES";
$respuestaJ = ControladorJerarquia::ctrMostrarDocentesDictamen($tablaJ, $itemJefeDivision);
$jefeDivision = $respuestaJ["nombre"];
$jefeSexo = $respuestaJ["sexo"];

$item = "id";
$valor = $_GET['id'];
$respuesta = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);
$nombre = $respuesta["nombre"];
$carrera = $respuesta["carrera"];
$numeroControl = $respuesta["noControl"];
$proyecto = $respuesta["nombreProyecto"];

$pdf = new PDF('P', 'mm', 'Letter');
$pdf->AddPage();
$pdf->SetLeftMargin(24);
$pdf->Image('../img/fondo_membrete_R.jpg', '0', '46', '215');
$pdf->SetFont('Helvetica', '', '7.3');
$pdf->Cell(0, -3, utf8_decode('"2019, Año del Caudillo del Sur, Emiliano Zapata"'), 0, 1, 'C');
$pdf->Ln(9);
$pdf->SetFont('Helvetica', '', '9');
$pdf->Cell(0, 4, utf8_decode('Iguala, Gro.,'), 0, 0, 'L');
$pdf->SetTextColor(255, 255, 255);
$pdf->SetX(43);
$anchoFecha = $pdf->GetStringWidth($fechaActual);
$pdf->Cell($anchoFecha + 2, 4, utf8_decode($fechaActual), 0, 0, 'L', true);
$pdf->Ln(7.3);

$pdf->SetTextColor(0, 0, 0);
$text = "<ASUNTO:> Liberación de Proyecto para Titulación Integral.";
$pdf->WriteText(utf8_decode($text));
$pdf->Ln(14.5);

$pdf->SetFont('Helvetica', 'B', '9');
$pdf->Cell(0, 4, utf8_decode($jefeDivision), 0, 0, 'L');
$pdf->Ln(3.7);
if ($jefeSexo == 'M') {
    $pdf->Cell(0, 4, utf8_decode('JEFE DE DIVISIÓN DE ESTUDIOS PROFESIONALES'), 0, 0, 'L');
} else {
    $pdf->Cell(0, 4, utf8_decode('JEFA DE DIVISIÓN DE ESTUDIOS PROFESIONALES'), 0, 0, 'L');
}
$pdf->Ln(3.7);
$pdf->Cell(0, 4, utf8_decode('P R E S E N T E .'), 0, 0, 'L');
$pdf->Ln(14.5);

$pdf->SetFont('Helvetica', '', '9');
$pdf->Cell(0, 4, utf8_decode('Por este medio le informo que ha sido liberado el siguiente proyecto para la Titulación integral:'), 0, 0, 'J');
$pdf->Ln(8);

$pdf->SetWidths(array(48.5, 115));
$pdf->Row(array('a) Nombre del Egresado:', utf8_decode(strtoupper($nombre . 'TÉCNICÁ'))));
$pdf->Row(array('b) Carrera:', utf8_decode(strtoupper($carrera))));
$pdf->Row(array('c) No. de Control:', utf8_decode(strtoupper($numeroControl))));
$pdf->Row(array(utf8_decode('d) Nombre del proyecto:'), utf8_decode(strtoupper($proyecto))));
$pdf->Row(array('e) Producto:', utf8_decode(strtoupper('INFORME TÉCNICO DE RESIDENCIA PROFESIONAL'))));

$pdf->Output('I', 'Liberación de Residencias Profesionales.pdf', 'D');
