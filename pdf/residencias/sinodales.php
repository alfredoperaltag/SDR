<?php
session_start();
require_once "../../controladores/residentes.controlador.php";
require_once "../../modelos/residentes.modelo.php";
require_once "../../controladores/jerarquia.controlador.php";
require_once "../../modelos/jerarquia.modelo.php";
require('../FPDF/fpdf.php');

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
        $this->Cell(0, 4, utf8_decode('Ext. 225, e-mail: sistemas@itiguala.edu.mx,'), 0, 1, 'C');
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
        $h = 3.8 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 3.8, $data[$i], 0, $a);
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
    $respuesta = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);
    $nombre = $respuesta["nombre"];
    $asesorInterno = $respuesta["asesorInt"];
    $revisor1 = $respuesta["revisor1"];
    $revisor2 = $respuesta["revisor2"];
    $suplente = $respuesta["suplente"];

    $tablaJ = "jerarquia";
    $itemJefeDivision = "JEFE DE LA DIVISION DE ESTUDIOS PROFESIONALES";
    $respuestajefeDivision = ControladorJerarquia::ctrMostrarDocentesDictamen($tablaJ, $itemJefeDivision);
    $jefeDivision = $respuestajefeDivision["nombre"];
    $jefeSexo = $respuestajefeDivision["sexo"];

    $itemJefeDepartamento = "JEFE DEL DEPTO. ACADEMICO";
    $respuestajefeDepartamento = ControladorJerarquia::ctrMostrarDocentesDictamen($tablaJ, $itemJefeDepartamento);
    $jefeDepartamento = $respuestajefeDepartamento["nombre"];
    $jefeDepartamentoSexo = $respuestajefeDepartamento["sexo"];

    $numero = $_GET['numero'];
    $fechaActual = $_GET['fecha'];
    $fechaTitulacion = $_GET['fechaTitulacion'];
    $hora = $_GET['hora'];

    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AddPage();
    $pdf->SetLeftMargin(29);
    $pdf->SetRightMargin(29);
    $pdf->Image('../img/fondo_membrete_R.jpg', '0', '46', '215');
    $pdf->SetFont('Helvetica', '', '7.3');
    $pdf->Cell(0, -3, utf8_decode('"2019, Año del Caudillo del Sur, Emiliano Zapata"'), 0, 1, 'C');
    $pdf->Ln(12);

    $pdf->SetFont('Helvetica', 'B', '8');
    $pdf->Cell(0, 0, utf8_decode('DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'R');
    $pdf->Ln(4);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(106.6);
    $pdf->Cell(0, 0, utf8_decode('OF. No. DSC-ITI/' . $numero . '/*' . date("Y") . ''), 0, 0, 'L');

    $pdf->Ln(4);
    $pdf->SetFont('Helvetica', 'B', '8');
    $pdf->Cell(229, 0, utf8_decode('ASUNTO: '), 0, 0, 'C');
    $pdf->SetXY(132, 73);

    $pdf->SetFont('Helvetica', 'BU', '8');
    $pdf->Cell(0, 0, utf8_decode('JURADO SELECCIONADO.'), 0, 0, 'C');
    $pdf->Ln(8);
    $pdf->SetFont('Helvetica', '', '8.5');
    $pdf->SetX(91);
    $pdf->Cell(0, 4, utf8_decode('Iguala, Guerrero, '), 0, 0, 'C');
    $pdf->SetX(160);
    $pdf->SetTextColor(255, 255, 255);
    $anchoFecha = $pdf->GetStringWidth($fechaActual);
    $pdf->Cell($anchoFecha + 2, 4, utf8_decode($fechaActual), 0, 0, 'C', true);
    $pdf->Ln(8);
    $pdf->Ln(4);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Helvetica', 'B', '8');

    $pdf->Cell(0, 0, utf8_decode($jefeDivision), 0, 0, 'L');
    $pdf->Ln(4);
    if ($jefeSexo == 'M') {
        $pdf->Cell(0, 0, utf8_decode('JEFE DE DIVISIÓN DE ESTUDIOS PROFESIONALES'), 0, 0, 'L');
    } else {
        $pdf->Cell(0, 0, utf8_decode('JEFA DE DIVISIÓN DE ESTUDIOS PROFESIONALES'), 0, 0, 'L');
    }
    $pdf->Ln(4);

    $pdf->Cell(0, 0, utf8_decode('P R E S E N T E .'), 0, 0, 'L');
    $pdf->Ln(8);

    if ($jefeSexo == 'M') {
        $pdf->Cell(0, 0, utf8_decode('AT´N: COORDINADOR DE TITULACIÓN.'), 0, 0, 'L');
    } else {
        $pdf->Cell(0, 0, utf8_decode('AT´N: COORDINADORA DE TITULACIÓN.'), 0, 0, 'L');
    }
    $pdf->Ln(12);

    $pdf->SetFont('Helvetica', '', '8');
    $text = "Por medio del presente, me permito enviar a usted el <JURADO> que fungirá en el Acto de Titulación, del 
<C. " . mb_strtoupper($nombre) . ",> que presenta su protocolo para su <TITULACIÓN INTEGRAL,> 
el día <" . mb_strtoupper($fechaTitulacion) . "> del año en curso, a las <" . $hora . " hrs.>, en la <SALA DE TITULACIÓN YOHUALCEHUATL.>";
    $pdf->WriteText(utf8_decode($text));
    $pdf->Ln(8);

    $pdf->SetFont('Helvetica', 'B', '8');
    $pdf->MultiCell(40, 4, utf8_decode('PRESIDENTE

'), 1, 'C');
    $pdf->SetXY(69, 137);
    $pdf->MultiCell(40, 4, utf8_decode('SECRETARIO

'), 1, 'C');
    $pdf->SetXY(109, 137);
    $pdf->MultiCell(40, 4, utf8_decode('VOCAL

'), 1, 'C');
    $pdf->SetXY(149, 137);
    $pdf->MultiCell(40, 4, utf8_decode('VOCAL SUPLENTE

'), 1, 'C');
    $pdf->SetFont('Helvetica', '', '7');
    $pdf->SetWidths(array(40, 40, 40, 40));
    $pdf->Row(array(utf8_decode(mb_strtoupper($asesorInterno)), utf8_decode(mb_strtoupper($revisor1)), utf8_decode(mb_strtoupper($revisor2)), utf8_decode(mb_strtoupper($suplente))));
    $pdf->Ln(8);
    $pdf->SetFont('Helvetica', '', '8');
    $pdf->Cell(80, 0, utf8_decode('Sin otro particular, reciba un cordial saludo.'), 0, 0, 'C');
    $pdf->Ln(14.5);

    $pdf->SetFont('Helvetica', 'B', '8');
    $pdf->Cell(0, 4, utf8_decode('A T E N T A M E N T E'), 0, 0, 'C');
    $pdf->Ln(3.3);
    $pdf->Cell(0, 4, utf8_decode('"TECNOLOGÍA COMO SINÓNIMO DE INDEPENDENCIA"'), 0, 0, 'C');
    $pdf->Ln(18.4);

    $pdf->Cell(0, 4, utf8_decode($jefeDepartamento), 0, 0, 'C');
    $pdf->Ln(3.7);
    if ($jefeDepartamentoSexo == 'M') {
        $pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
    } else {
        $pdf->Cell(0, 4, utf8_decode('JEFA DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
    }
    $pdf->Ln(18.4);

    $pdf->SetFont('Helvetica', '', '5.5');
    $pdf->Cell(0, 4, utf8_decode('C.C.P. ARCHIVO'), 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->Cell(3);
    $pdf->Cell(0, 4, utf8_decode('*JEOL*Ere'), 0, 0, 'L');

    $pdf->Output('I', 'Asignación de Sinodales.pdf', 'D');
} else {
    echo "<script>window.location = '../../Inicio';</script>";
}
