<?php
session_start();
require('../FPDF/fpdf.php');
require_once "../../controladores/jerarquia.controlador.php";
require_once "../../modelos/jerarquia.modelo.php";
require_once "../../controladores/residentes.controlador.php";
require_once "../../modelos/residentes.modelo.php";

class PDF extends FPDF
{
    public function Header()
    {
        $this->SetFont('Arial', 'B', '10');
        $this->Image('../img/cabecera.png', 23, 14, 180, 34, 'PNG');
        $this->Ln(40);//NOTE no borrar
    }
    public function Footer()
    {
        $this->Image('../img/pie.png', 23, 238, 174, 34, 'PNG');
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
    //var $alineacion;

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

    function Row($data, $margen, $alineacion)
    {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $margen * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : $alineacion;
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, $margen, $data[$i], 0, $a);
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
    $fechaActual = $_GET['fecha'];
    $tablaJ = "jerarquia";
    $itemJefeDivision = "JEFE DE LA DIVISION DE ESTUDIOS PROFESIONALES";
    $respuestajefeDivision = ControladorJerarquia::ctrMostrarDocentesDictamen($tablaJ, $itemJefeDivision);
    $jefeDivision = $respuestajefeDivision["nombre"];
    $jefeSexo = $respuestajefeDivision["sexo"];

    $item = "id";
    $valor = $_GET['id'];
    $respuesta = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);
    $nombre = $respuesta["nombre"];
    $carrera = $respuesta["carrera"];
    $numeroControl = $respuesta["noControl"];
    $proyecto = $respuesta["nombreProyecto"];
    $asesorInterno = $respuesta["asesorInt"];
    $revisor1 = $respuesta["revisor1"];
    $revisor2 = $respuesta["revisor2"];
    $periodo = $respuesta["periodo"];

    $itemJefeDepartamento = "JEFE DEL DEPTO. ACADEMICO";
    $respuestajefeDepartamento = ControladorJerarquia::ctrMostrarDocentesDictamen($tablaJ, $itemJefeDepartamento);
    $jefeDepartamento = $respuestajefeDepartamento["nombre"];
    $jefeDepartamentoSexo = $respuestajefeDepartamento["sexo"];

    // $leyenda = '"2020, Año de Leona Vicario, Benemérita Madre de la Patria"';

    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AddPage();
    $pdf->SetLeftMargin(24);
    $pdf->SetRightMargin(19.15);
    // $pdf->Image('../img/fondo_membrete_R.jpg', '2.5', '46', '215');
    $pdf->SetFont('Helvetica', '', '7.3');
    // $pdf->Cell(0, -3, utf8_decode($leyenda), 0, 1, 'C');
    $pdf->Ln(9);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(88);
    $pdf->Cell(0, 4, utf8_decode('Iguala, Gro.,'), 0, 0, 'L');
    $pdf->SetTextColor(255, 255, 255);
    // $pdf->SetX(43);
    $pdf->Cell(-66);
    $anchoFecha = $pdf->GetStringWidth($fechaActual);
    $pdf->Cell($anchoFecha + 2, 4, utf8_decode($fechaActual), 0, 0, 'L', true);
    $pdf->Ln(7.3);

    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(88);
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
    $pdf->Ln(7.3);

    $pdf->SetWidths(array(43.8, 113));
    $pdf->Row(array('a) Nombre del Egresado:', utf8_decode(mb_strtoupper($nombre))), 3.8, 'J');
    $pdf->Row(array('b) Carrera:', utf8_decode(mb_strtoupper($carrera))), 3.8, 'J');
    $pdf->Row(array('c) No. de Control:', utf8_decode(mb_strtoupper($numeroControl))), 3.8, 'J');
    $pdf->Row(array(utf8_decode('d) Nombre del proyecto:'), utf8_decode($proyecto)), 3.8, 'J');
    $pdf->Row(array('e) Producto:', utf8_decode(mb_strtoupper('TITULACIÓN INTEGRAL "INFORME TÉCNICO DE RESIDENCIA PROFESIONAL"
    '))), 3.8, 'J');
    $pdf->Row(array(utf8_decode('f) Periodo:'), utf8_decode($periodo)), 3.8, 'J');
    $pdf->Ln(3.8);

    $pdf->MultiCell(0, 3.7, utf8_decode('Agradezco de antemano su valioso apoyo en esta importante actividad para la formación profesional de nuestros egresados.'), 0, 'J');
    $pdf->Ln(12);

    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 4, utf8_decode('A T E N T A M E N T E'), 0, 0, 'C');
    $pdf->Ln(3.3);
    $pdf->Cell(0, 4, utf8_decode('"Tecnología como Sinónimo de Independencia"'), 0, 0, 'C');
    $pdf->Ln(18.4);

    $pdf->Cell(0, 4, utf8_decode($jefeDepartamento), 0, 0, 'C');
    $pdf->Ln(3.7);
    if ($jefeDepartamentoSexo == 'M') {
        $pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
    } else {
        $pdf->Cell(0, 4, utf8_decode('JEFA DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
    }
    $pdf->Ln(15);

    $pdf->SetFont('Helvetica', '', '9');
    $pdf->SetWidths(array(57, 58.5, 56.5));
    $pdf->Row(array(utf8_decode(mb_strtoupper($asesorInterno . '

')), utf8_decode(mb_strtoupper($revisor1)), utf8_decode(mb_strtoupper($revisor2))), 7, 'C');
    $pdf->Row(array('Nombre y Firma
Asesor', 'Nombre y Firma
Revisor', 'Nombre y Firma
Revisor'), 3.7, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Helvetica', '', '8');
    $pdf->Cell(0, 4, utf8_decode('c.c.p.- Expediente'), 0, 0, 'L');

    $pdf->Output('I', 'Liberación de Residencias Profesionales ' . $nombre . '.pdf', 'D');
} else {
    echo "<script>window.location = '../../Inicio';</script>";
}
