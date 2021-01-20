<?php
session_start();
require('../FPDF/fpdf.php');
require_once "../../controladores/residentes.controlador.php";
require_once "../../modelos/residentes.modelo.php";
require_once "../../controladores/jerarquia.controlador.php";
require_once "../../modelos/jerarquia.modelo.php";

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
        $h = 4 * $nb;
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
            $this->MultiCell($w, 4, $data[$i], 0, $a);
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
    $carrera = $respuesta["carrera"];
    $proyecto = $respuesta["nombreProyecto"];

    $tablaJ = "jerarquia";
    $itemJefeDepartamento = "JEFE DEL DEPTO. ACADEMICO";
    $respuestajefeDepartamento = ControladorJerarquia::ctrMostrarDocentesDictamen($tablaJ, $itemJefeDepartamento);
    $jefeDepartamento = $respuestajefeDepartamento["nombre"];
    $jefeDepartamentoSexo = $respuestajefeDepartamento["sexo"];

    // $leyenda = '"2020, Año de Leona Vicario, Benemérita Madre de la Patria"';

    $numero1 = $_GET['folio1'];
    $numero2 = $_GET['folio2'];
    $fechaActual = $_GET['fecha'];

    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AddPage();
    $pdf->SetLeftMargin(24);
    $pdf->SetRightMargin(19);
    // $pdf->Image('../img/fondo_membrete_R.jpg', '0', '46', '215');
    $pdf->SetFont('Helvetica', '', '7.3');
    // $pdf->Cell(0, -3, utf8_decode($leyenda), 0, 1, 'C');
    $pdf->Ln(12);

    
    $pdf->SetFont('Helvetica', '', '8.5');
    $pdf->SetX(51);
    $pdf->Cell(0, 4, utf8_decode('Iguala, Guerrero, '), 0, 0, 'C');
    $pdf->SetX(136);
    $pdf->SetTextColor(255, 255, 255);
    $anchoFecha = $pdf->GetStringWidth($fechaActual);
    $pdf->Cell($anchoFecha + 2, 4, utf8_decode($fechaActual), 0, 0, 'C', true);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln(8);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(238, 0, utf8_decode('DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
    $pdf->Ln(4);
    $pdf->Cell(87);
    $pdf->Cell(0, 0, utf8_decode('OF. No. DSC-IT-' . $numero1 . '/' . date("Y") . ''), 0, 0, 'L');
    $pdf->Ln(4);
    $pdf->Cell(191, 0, utf8_decode('ASUNTO: '), 0, 0, 'C');
    $pdf->SetX(113);
    $pdf->SetFont('Helvetica', 'BU', '8');
    $pdf->Cell(0, 0, utf8_decode('REVISIÓN DE TRABAJO DE TITULACIÓN'), 0, 0, 'C');
    $pdf->Ln(8);

    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 0, utf8_decode($revisor1), 0, 0, 'L');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('DOCENTE DE ESTA INSTITUCIÓN'), 0, 0, 'L');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('P R E S E N T E .'), 0, 0, 'L');
    $pdf->Ln(10);

    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(13);
    $pdf->Cell(0, 0, utf8_decode('Por medio del presente, me permito hacer de su conocimiento que ha sido comisionado (a) para llevar a cabo la'), 0, 0, 'L');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('Revisión del Trabajo de Titulación.'), 0, 0, 'L');
    $pdf->Ln(6);

    if ($carrera == 'Ingeniería en Sistemas Computacionales') {
        $carrera = 'ING. EN SISTEMAS COMPUTACIONALES';
    } else if ($carrera == 'Ingeniería Informática') {
        $carrera = 'ING. INFORMATICA';
    }
    $pdf->SetWidths(array(30, 80, 50));
    $pdf->Row(array(utf8_decode('Alumno (s) :'), utf8_decode(mb_strtoupper($nombre)), utf8_decode('Área: ' . mb_strtoupper($carrera))));
    $pdf->SetWidths(array(30, 130));
    $pdf->Row(array(utf8_decode('Opción'), utf8_decode(mb_strtoupper('TITULACIÓN INTEGRAL "INFORME TÉCNICO DE RESIDENCIA PROFESIONAL"'))));
    $pdf->Row(array(utf8_decode('Proyecto:'), utf8_decode($proyecto)));
    $pdf->Row(array(utf8_decode('Asesor:'), utf8_decode(mb_strtoupper($asesorInterno))));
    $pdf->Row(array(utf8_decode('Revisor 1:'), utf8_decode(mb_strtoupper($revisor1))));
    $pdf->Row(array(utf8_decode('Revisor 2:'), utf8_decode(mb_strtoupper($revisor2))));
    $pdf->SetWidths(array(45, 115));
    $pdf->Row(array(utf8_decode('Documentos entregados:'), utf8_decode(mb_strtoupper('1 EJEMPLAR PARA CADA REVISOR'))));
    $pdf->Ln(8);

    $pdf->SetFont('Helvetica', 'BUI', '9');
    $pdf->Cell(0, 0, utf8_decode('Los revisores deberán ponerse en contacto para unificar criterios, y emitir un solo dictamen.'), 0, 0, 'C');

    $pdf->Ln(8);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(13);
    $text = "Asimismo, hago de su conocimiento que deberá entregar a este departamento el resultado de dicha revisión a
más tardar en <10 (DIEZ) días hábiles a partir de la fecha de entrega,> en el entendido que, de no cumplir dentro de este
plazo, se estará imposibilitado a que se continúe con los trámites sucesivos.";
    $pdf->WriteText(utf8_decode($text));
    $pdf->Ln(10);

    $pdf->Cell(13);
    $pdf->Cell(0, 0, utf8_decode('Con la seguridad de su oportuna entrega, quedo de usted.'), 0, 0, 'J');
    $pdf->Ln(12);

    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 4, utf8_decode('A T E N T A M E N T E'), 0, 0, 'C');
    $pdf->Ln(3.3);
    $pdf->Cell(0, 4, utf8_decode('"TECNOLOGÍA COMO SINÓNIMO DE INDEPENDENCIA"'), 0, 0, 'C');
    $pdf->Ln(14);

    $pdf->Cell(0, 4, utf8_decode($jefeDepartamento), 0, 0, 'C');
    $pdf->Ln(3.7);
    if ($jefeDepartamentoSexo == 'M') {
        $pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
    } else {
        $pdf->Cell(0, 4, utf8_decode('JEFA DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
    }
    $pdf->Ln(14);

    $pdf->SetFont('Helvetica', '', '8');
    $pdf->Cell(0, 4, utf8_decode('C.c.p. archivo.'), 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->SetFont('Helvetica', '', '6');
    $pdf->Cell(8);
    $pdf->Cell(0, 4, utf8_decode('*JEOL*ere'), 0, 0, 'L');


    $pdf->AddPage();
    $pdf->SetLeftMargin(24);
    $pdf->SetRightMargin(19);
    // $pdf->Image('../img/fondo_membrete_R.jpg', '0', '46', '215');
    $pdf->SetFont('Helvetica', '', '7.3');
    // $pdf->Cell(0, -3, utf8_decode($leyenda), 0, 1, 'C');
    $pdf->Ln(12);

    $pdf->SetFont('Helvetica', '', '8.5');
    $pdf->SetX(51);
    $pdf->Cell(0, 4, utf8_decode('Iguala, Guerrero, '), 0, 0, 'C');
    $pdf->SetX(136);
    $pdf->SetTextColor(255, 255, 255);
    $anchoFecha = $pdf->GetStringWidth($fechaActual);
    $pdf->Cell($anchoFecha + 2, 4, utf8_decode($fechaActual), 0, 0, 'C', true);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Ln(8);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(238, 0, utf8_decode('DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
    $pdf->Ln(4);
    $pdf->Cell(87);
    $pdf->Cell(0, 0, utf8_decode('OF. No. DSC-IT-' . $numero2 . '/' . date("Y") . ''), 0, 0, 'L');
    $pdf->Ln(4);
    $pdf->Cell(191, 0, utf8_decode('ASUNTO: '), 0, 0, 'C');
    $pdf->SetX(113);
    $pdf->SetFont('Helvetica', 'BU', '8');
    $pdf->Cell(0, 0, utf8_decode('REVISIÓN DE TRABAJO DE TITULACIÓN'), 0, 0, 'C');
    $pdf->Ln(8);
    
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 0, utf8_decode($revisor2), 0, 0, 'L');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('DOCENTE DE ESTA INSTITUCIÓN'), 0, 0, 'L');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('P R E S E N T E .'), 0, 0, 'L');
    $pdf->Ln(10);

    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(13);
    $pdf->Cell(0, 0, utf8_decode('Por medio del presente, me permito hacer de su conocimiento que ha sido comisionado (a) para llevar a cabo la'), 0, 0, 'L');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('Revisión del Trabajo de Titulación.'), 0, 0, 'L');
    $pdf->Ln(6);

    if ($carrera == 'Ingeniería en Sistemas Computacionales') {
        $carrera = 'ING. EN SISTEMAS COMPUTACIONALES';
    } else if ($carrera == 'Ingeniería Informática') {
        $carrera = 'ING. INFORMATICA';
    }
    $pdf->SetWidths(array(30, 80, 50));
    $pdf->Row(array(utf8_decode('Alumno (s) :'), utf8_decode(mb_strtoupper($nombre)), utf8_decode('Área: ' . mb_strtoupper($carrera))));
    $pdf->SetWidths(array(30, 130));
    $pdf->Row(array(utf8_decode('Opción'), utf8_decode(mb_strtoupper('TITULACIÓN INTEGRAL "INFORME TÉCNICO DE RESIDENCIA PROFESIONAL"'))));
    $pdf->Row(array(utf8_decode('Proyecto:'), utf8_decode($proyecto)));
    $pdf->Row(array(utf8_decode('Asesor:'), utf8_decode(mb_strtoupper($asesorInterno))));
    $pdf->Row(array(utf8_decode('Revisor 1:'), utf8_decode(mb_strtoupper($revisor1))));
    $pdf->Row(array(utf8_decode('Revisor 2:'), utf8_decode(mb_strtoupper($revisor2))));
    $pdf->SetWidths(array(45, 115));
    $pdf->Row(array(utf8_decode('Documentos entregados:'), utf8_decode(mb_strtoupper('1 EJEMPLAR PARA CADA REVISOR'))));
    $pdf->Ln(8);

    $pdf->SetFont('Helvetica', 'BUI', '9');
    $pdf->Cell(0, 0, utf8_decode('Los revisores deberán ponerse en contacto para unificar criterios, y emitir un solo dictamen.'), 0, 0, 'C');

    $pdf->Ln(8);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(13);
    $text = "Asimismo, hago de su conocimiento que deberá entregar a este departamento el resultado de dicha revisión a
más tardar en <10 (DIEZ) días hábiles a partir de la fecha de entrega,> en el entendido que, de no cumplir dentro de este
plazo, se estará imposibilitado a que se continúe con los trámites sucesivos.";
    $pdf->WriteText(utf8_decode($text));
    $pdf->Ln(10);

    $pdf->Cell(13);
    $pdf->Cell(0, 0, utf8_decode('Con la seguridad de su oportuna entrega, quedo de usted.'), 0, 0, 'J');
    $pdf->Ln(12);

    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 4, utf8_decode('A T E N T A M E N T E'), 0, 0, 'C');
    $pdf->Ln(3.3);
    $pdf->Cell(0, 4, utf8_decode('"TECNOLOGÍA COMO SINÓNIMO DE INDEPENDENCIA"'), 0, 0, 'C');
    $pdf->Ln(14);

    $pdf->Cell(0, 4, utf8_decode($jefeDepartamento), 0, 0, 'C');
    $pdf->Ln(3.7);
    if ($jefeDepartamentoSexo == 'M') {
        $pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
    } else {
        $pdf->Cell(0, 4, utf8_decode('JEFA DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
    }
    $pdf->Ln(14);

    $pdf->SetFont('Helvetica', '', '8');
    $pdf->Cell(0, 4, utf8_decode('C.c.p. archivo.'), 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->SetFont('Helvetica', '', '6');
    $pdf->Cell(8);
    $pdf->Cell(0, 4, utf8_decode('*JEOL*ere'), 0, 0, 'L');

    $pdf->Output('I', 'Revisión de trabajo de titulación ' . $nombre . '.pdf', 'D');
} else {
    echo "<script>window.location = '../../Inicio';</script>";
}
