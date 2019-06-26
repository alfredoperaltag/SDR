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
        $this->Image('../img/membrete1.png', 25, 17, 84, 17, 'PNG');
        $this->Image('../img/membrete2.png', 145, 12, 50, 24, 'PNG');
        $this->Ln(46);//NOTE no borrar
    }
    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $x = $this->GetX();
        $y = $this->GetY();
        $this->Image('../img/iti.jpg', 24, 256, 14);
        $this->SetFont('Helvetica', '', '7');
        $this->SetXY($x - 10, $y - 12);
        $this->Cell(0, 4, utf8_decode('Carretera Nacional Iguala-Taxco esquina Periférico Norte, Col. Adolfo López  Mateos  Infonavit, C.P. 40030,'), 0, 1, 'C');
        // $this->Cell(20);
        $this->Cell(0, 4, utf8_decode('Iguala de la Independencia, Gro. Tels. (733) 3321425'), 0, 1, 'C');
        // $this->Cell(44);
        $this->Cell(0, 4, utf8_decode('Ext. 225, e-mail: sistemas@itiguala.edu.mx,'), 0, 1, 'C');
        $this->SetFont('Helvetica', 'B', '7');
        // $this->Cell(20);
        $this->Cell(0, 4, utf8_decode('www.itiguala.edu.mx'), 0, 0, 'C');
        // $x = $this->GetX();
        $this->Image('../img/iso14001.jpg', 155 + 12, 253, 17);
        $x = $this->GetX();
        // $this->Image('../img/iso9001.jpg', $x + 31, 253, 12);
        $this->Image('../img/norma.jpg', 155 + 31, 253, 15);
    }
    public function WriteText($text)
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

    $numero = $_GET['num1'];
    $fechaActual = $_GET['fecha'];
    $fechaTitulacion = $_GET['fechaT'];
    $hora = $_GET['horaT'];
    // $item = "id";
    // $valor = $_GET['id'];
    $tabla = "jerarquia";
    $puesto = "JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN";
    $res = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);
    $res2 = ControladorJerarquia::ctrMostrarDocentesDictamen($tabla, $puesto);

    $pdf = new PDF('P', 'mm', 'Letter');
    $pdf->AddPage();
    $h = $pdf->GetPageHeight();
    $w = $pdf->GetPageWidth();
    $pdf->Image('../img/fondo_membrete_R.jpg', '0', '38', '220', '243', 'JPG');

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
    $pdf->Cell(87.4);
    $pdf->Cell(0, 0, utf8_decode('OF. No. DSC-ITI/' . $numero . '/*' . date("Y") . ''), 0, 0, 'L');

    $pdf->Ln(4);
    $pdf->SetFont('Helvetica', 'B', '8');
    $pdf->Cell(191, 0, utf8_decode('ASUNTO: '), 0, 1, 'C');
    $pdf->SetXY(113, 73);

    $pdf->SetFont('Helvetica', 'BU', '8');
    $pdf->Cell(0, 0, utf8_decode('JURADO SELECCIONADO.'), 0, 0, 'C');
    $pdf->Ln(8);
    $pdf->SetFont('Helvetica', '', '8.5');
    $pdf->SetX(73);
    $pdf->Cell(0, 4, utf8_decode('Iguala, Guerrero, '), 0, 0, 'C');
    $pdf->SetX(142);
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

    $pdf->Cell(0, 0, utf8_decode('P R E S E N T E '), 0, 0, 'L');
    $pdf->Ln(8);

    if ($jefeSexo == 'M') {
        $pdf->Cell(0, 0, utf8_decode('AT´N: COORDINADOR DE TITULACIÓN.'), 0, 0, 'L');
    } else {
        $pdf->Cell(0, 0, utf8_decode('AT´N: COORDINADORA DE TITULACIÓN.'), 0, 0, 'L');
    }
    $pdf->Ln(8);

    $pdf->SetFont('Helvetica', '', '9');
    //TODO TITULACIÓN INTEGRAL CAMBIAR???
    // $text1 = "Por medio del presente, me permito enviar a usted el <JURADO> que fungirá en el Acto de Titulación, del <C. " . mb_strtoupper($nombre) . ",> que presenta su protocolo para su <TITULACIÓN INTEGRAL \"TESIS PROFESIONAL\">, defendiendo su proyecto (promedio " . $_GET['pro'] . "), el día <" . mb_strtoupper($fechaTitulacion) . "> del año en curso, a las <" . $hora . " hrs.>, en la <SALA DE TITULACIÓN YOHUALCEHUATL.>";
    $text2 = "Por medio del presente, me permito enviar a usted el <JURADO> que fungirá en el Acto de Titulación, del <C. " . mb_strtoupper($nombre) . ",> que presenta su <TITULACIÓN INTEGRAL \"TESIS PROFESIONAL\">, el día <" . mb_strtoupper($fechaTitulacion) . "> del año en curso, a las <" . $hora . " hrs.>, en la <SALA DE TITULACIÓN YOHUALCEHUATL.>";
    // if ($_GET['defiende'] == 'si') {
    //     $pdf->WriteText(utf8_decode($text1));
    // } else {
        $pdf->WriteText(utf8_decode($text2));
    // }

    // $pdf->WriteText(utf8_decode($text));
    $pdf->Ln(12);

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
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->SetWidths(array(40, 40, 40, 40));
    $pdf->Row(array(utf8_decode(mb_strtoupper($asesorInterno)), utf8_decode(mb_strtoupper($revisor1)), utf8_decode(mb_strtoupper($revisor2)), utf8_decode(mb_strtoupper($res['revisor3']))));
    $pdf->Ln(8);
    $pdf->SetFont('Helvetica', '', '9');
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
    $pdf->Cell(0, 4, utf8_decode('C.c.p. archivo.'), 0, 0, 'L');
    $pdf->Ln(3);
    $pdf->Cell(3);
    $pdf->Cell(0, 4, utf8_decode('JEOL*ere'), 0, 0, 'L');

    $pdf->SetLeftMargin(10);
    $pdf->SetRightMargin(10);
    //OTRO
    $pdf->AddPage();
    $h = $pdf->GetPageHeight();
    $w = $pdf->GetPageWidth();
    $pdf->Image('../img/fondo_membrete_R.jpg', '0', '38', '220', '243', 'JPG');
    $pdf->SetFont('Helvetica', '', '7');
    $pdf->Cell(0, 4, utf8_decode('"2019, Año del Caudillo del Sur, Emiliano Zapata"'), 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(107);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(20, 4, utf8_decode('DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'L');
    $pdf->Cell(107);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(80, 4, 'OF. No. DSC-ITI/' . $_GET['num2'] . '/' . date("Y"), 0, 1, 'L');
    $pdf->Cell(107);
    $pdf->Cell(15, 4, 'ASUNTO: ', 0, 0, 'L');
    $pdf->SetFont('Helvetica', 'BUI', '9');
    $pdf->Cell(15, 4, utf8_decode('JURADO DE TITULACIÓN.'), 0, 1, 'L');
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(107);
    $pdf->Cell(25, 4, 'IGUALA, GRO., ', 0, 0, 'L');
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(50, 4, $_GET['fecha'], 0, 1, 'L');
    $pdf->Ln(5); //CELDA DE ESPACIO
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(11);
    $pdf->Cell(80, 4, utf8_decode($res['asesorInt']), 0, 1, 'L');
    $pdf->Cell(11);
    $pdf->Cell(80, 4, utf8_decode('DOCENTE DE ESTA INSTITUCIÓN'), 0, 1, 'L');
    $pdf->Cell(11);
    $pdf->Cell(80, 4, 'P R E S E N T E', 0, 1, 'L');
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->SetLeftMargin(20);
    $pdf->SetRightMargin(20);
    // $pdf->Cell(19);
    // $text1 = "Por medio del presente, me permito hacer de su conocimiento que ha sido comisionado (a) para fungir como <PRESIDENTE>, en el Acto de Recepción Profesional de él (la) <C. " . $res['nombre'] . ">, que realiza su protocolo para su <TITULACIÓN INTEGRAL \"TESIS PROFESIONAL\">, defendiendo su proyecto (promedio " . $_GET['pro'] . "), el día <" . utf8_decode(mb_strtoupper($_GET['fechaT'])) . " del año en curso>,  a  las <" . $_GET['horaT'] . " HRS.>, en la <SALA DE TITULACIÓN YOHUALCEHUATL.>";
    $text2 = "Por medio del presente, me permito hacer de su conocimiento que ha sido comisionado (a) para fungir como <PRESIDENTE>, en el Acto de Recepción Profesional de él (la) <C." . $res['nombre'] . ">, que realiza su <TITULACIÓN INTEGRAL \"TESIS PROFESIONAL\">, el día <" . utf8_decode(mb_strtoupper($_GET['fechaT'])) . " del año en curso>,  a las <" . $_GET['horaT'] . " HRS.>, en la <SALA DE TITULACIÓN YOHUALCEHUATL.>";
    // if ($_GET['defiende'] == 'si') {
    //     $pdf->WriteText(utf8_decode($text1));
    // } else {
        $pdf->WriteText(utf8_decode($text2));
    // }
    $pdf->SetLeftMargin(10);
    $pdf->SetRightMargin(10);
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(19);
    $text = "Así mismo le comunico que dicho evento será celebrado puntualmente en la fecha, hora y aula especificadas, por lo
            que le pido a usted confirmar en un plazo no mayor a un día, < además deberá presentarse 10 minutos antes del evento>.";
    $pdf->WriteText(utf8_decode($text));
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(19);
    $pdf->Cell(150, 4, utf8_decode('También le notifico que por ser el acto de Recepción Profesional de Titulación una ceremonia especial, es requisito'), 0, 1, 'L');
    $pdf->Cell(11);
    $pdf->Cell(150, 4, utf8_decode('para los miembros del jurado, presentarse de manera apropiada para ello. '), 0, 1, 'L');
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(19);
    $pdf->MultiCell(163, 4, utf8_decode('Hombres: Saco y corbata.
Mujeres: Vestir de manera formal (traje sastre o de acuerdo al evento).'), 1, 'L');
    $pdf->Ln(10);
    $pdf->Cell(11);
    $pdf->SetFont('Arial', 'B', '9');
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('PRESIDENTE'), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('SECRETARIO(A)'), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('VOCAL'), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('VOCAL SUPLENTE'), 1, 'C');

    $pdf->SetFont('Arial', '', '9');
    $pdf->Cell(11);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['asesorInt'])), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['revisor1'])), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['revisor2'])), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['revisor3'])), 1, 'C');

    $pdf->Ln(4);
    $pdf->Cell(0, 4, utf8_decode('Sin más por el momento y agradeciendo de antemano la atención prestada al presente quedo de usted.'), 0, 1, 'C');
    $pdf->Ln(4);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 4, utf8_decode('A T E N T A M E N T E'), 0, 1, 'C');
    $pdf->Cell(0, 4, utf8_decode('"TECNOLOGÍA COMO SINÓNIMO DE INDEPENDENCIA"'), 0, 1, 'C');
    $pdf->Ln(15);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 4, utf8_decode($res2['nombre']), 0, 1, 'C');
    if ($res2['sexo'] == 'F') {
        $pdf->Cell(0, 4, utf8_decode('JEFA DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
    } else {
        $pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
    }
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', '', '7');
    $pdf->Cell(20);
    $pdf->Cell(0, 4, utf8_decode('C.c.p. archivo.'), 0, 1, 'L');
    $pdf->SetFont('Helvetica', '', '6');
    $pdf->Cell(17);
    $pdf->Cell(20, 4, utf8_decode('JEOL*ere'), 0, 1, 'R');

    //OTRO DOCUMENTO
    $pdf->AddPage();
    $h = $pdf->GetPageHeight();
    $w = $pdf->GetPageWidth();
    $pdf->Image('../img/fondo_membrete_R.jpg', '0', '38', '220', '243', 'JPG');
    $pdf->SetFont('Helvetica', '', '7');
    $pdf->Cell(0, 4, utf8_decode('"2019, Año del Caudillo del Sur, Emiliano Zapata"'), 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(107);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(20, 4, utf8_decode('DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'L');
    $pdf->Cell(107);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(80, 4, 'OF. No. DSC-ITI/' . $_GET['num3'] . '/' . date("Y"), 0, 1, 'L');
    $pdf->Cell(107);
    $pdf->Cell(15, 4, 'ASUNTO: ', 0, 0, 'L');
    $pdf->SetFont('Helvetica', 'BUI', '9');
    $pdf->Cell(15, 4, utf8_decode('JURADO DE TITULACIÓN.'), 0, 1, 'L');
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(107);
    $pdf->Cell(25, 4, 'IGUALA, GRO., ', 0, 0, 'L');
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(50, 4, $_GET['fecha'], 0, 1, 'L');
    $pdf->Ln(5); //CELDA DE ESPACIO
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(11);
    $pdf->Cell(80, 4, utf8_decode($res['revisor1']), 0, 1, 'L');
    $pdf->Cell(11);
    $pdf->Cell(80, 4, utf8_decode('DOCENTE DE ESTA INSTITUCIÓN'), 0, 1, 'L');
    $pdf->Cell(11);
    $pdf->Cell(80, 4, 'P R E S E N T E', 0, 1, 'L');
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->SetLeftMargin(25);
    $pdf->SetRightMargin(25);
    // $pdf->Cell(19);
    // $text1 = "Por medio del presente, me permito hacer de su conocimiento que ha sido comisionado (a) para fungir como <SECRETARIO (A)>, en el Acto de Recepción Profesional de él (la) <C. " . $res['nombre'] . ">, que realiza su protocolo para su <TITULACIÓN INTEGRAL \"TESIS PROFESIONAL\",>, defendiendo su proyecto (promedio " . $_GET['pro'] . "), el día <" . utf8_decode(mb_strtoupper($_GET['fechaT'])) . " del año en curso>,  a las <" . $_GET['horaT'] . " HRS.>, en la <SALA DE TITULACIÓN YOHUALCEHUATL.>";
    $text2 = "Por medio del presente, me permito hacer de su conocimiento que ha sido comisionado (a) para fungir como <PRESIDENTE>, en el Acto de Recepción Profesional de él (la) <C." . $res['nombre'] . ">, que realiza su <TITULACIÓN INTEGRAL \"TESIS PROFESIONAL\">, el día <" . utf8_decode(mb_strtoupper($_GET['fechaT'])) . " del año en curso>,  a las <" . $_GET['horaT'] . " HRS.>, en la <SALA DE TITULACIÓN YOHUALCEHUATL.>";
    // if ($_GET['defiende'] == 'si') {
    //     $pdf->WriteText(utf8_decode($text1));
    // } else {
        $pdf->WriteText(utf8_decode($text2));
    // }
    $pdf->SetLeftMargin(10);
    $pdf->SetRightMargin(10);
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(19);
    $text = "Así mismo le comunico que dicho evento será celebrado puntualmente en la fecha, hora y aula especificadas, por lo
        que le pido a usted confirmar en un plazo no mayor a un día, < además deberá presentarse 10 minutos antes del evento>.";
    $pdf->WriteText(utf8_decode($text));
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(19);
    $pdf->Cell(150, 4, utf8_decode('También le notifico que por ser el acto de Recepción Profesional de Titulación una ceremonia especial, es requisito'), 0, 1, 'L');
    $pdf->Cell(11);
    $pdf->Cell(150, 4, utf8_decode('para los miembros del jurado, presentarse de manera apropiada para ello. '), 0, 1, 'L');
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(19);
    $pdf->MultiCell(163, 4, utf8_decode('Hombres: Saco y corbata.
Mujeres: Vestir de manera formal (traje sastre o de acuerdo al evento).'), 1, 'L');
    $pdf->Ln(10);
    $pdf->Cell(11);
    $pdf->SetFont('Arial', 'B', '9');
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('PRESIDENTE'), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('SECRETARIO(A)'), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('VOCAL'), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('VOCAL SUPLENTE'), 1, 'C');

    $pdf->SetFont('Arial', '', '9');
    $pdf->Cell(11);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['asesorInt'])), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['revisor1'])), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['revisor2'])), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['revisor3'])), 1, 'C');

    $pdf->Ln(4);
    $pdf->Cell(0, 4, utf8_decode('Sin más por el momento y agradeciendo de antemano la atención prestada al presente quedo de usted.'), 0, 1, 'C');
    $pdf->Ln(4);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 4, utf8_decode('A T E N T A M E N T E'), 0, 1, 'C');
    $pdf->Cell(0, 4, utf8_decode('"TECNOLOGÍA COMO SINÓNIMO DE INDEPENDENCIA"'), 0, 1, 'C');
    $pdf->Ln(15);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 4, utf8_decode($res2['nombre']), 0, 1, 'C');
    if ($res2['sexo'] == 'F') {
        $pdf->Cell(0, 4, utf8_decode('JEFA DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
    } else {
        $pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
    }
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', '', '7');
    $pdf->Cell(20);
    $pdf->Cell(0, 4, utf8_decode('C.c.p. archivo.'), 0, 1, 'L');
    $pdf->SetFont('Helvetica', '', '6');
    $pdf->Cell(17);
    $pdf->Cell(20, 4, utf8_decode('JEOL*ere'), 0, 1, 'R');

    //OTRO DOCUMENTO
    $pdf->AddPage();
    $h = $pdf->GetPageHeight();
    $w = $pdf->GetPageWidth();
    $pdf->Image('../img/fondo_membrete_R.jpg', '0', '38', '220', '243', 'JPG');
    $pdf->SetFont('Helvetica', '', '7');
    $pdf->Cell(0, 4, utf8_decode('"2019, Año del Caudillo del Sur, Emiliano Zapata"'), 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(107);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(20, 4, utf8_decode('DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'L');
    $pdf->Cell(107);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(80, 4, 'OF. No. DSC-ITI/' . $_GET['num4'] . '/' . date("Y"), 0, 1, 'L');
    $pdf->Cell(107);
    $pdf->Cell(15, 4, 'ASUNTO: ', 0, 0, 'L');
    $pdf->SetFont('Helvetica', 'BUI', '9');
    $pdf->Cell(15, 4, utf8_decode('JURADO DE TITULACIÓN.'), 0, 1, 'L');
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(107);
    $pdf->Cell(25, 4, 'IGUALA, GRO., ', 0, 0, 'L');
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(50, 4, $_GET['fecha'], 0, 1, 'L');
    $pdf->Ln(5); //CELDA DE ESPACIO
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(11);
    $pdf->Cell(80, 4, utf8_decode($res['revisor2']), 0, 1, 'L');
    $pdf->Cell(11);
    $pdf->Cell(80, 4, utf8_decode('DOCENTE DE ESTA INSTITUCIÓN'), 0, 1, 'L');
    $pdf->Cell(11);
    $pdf->Cell(80, 4, 'P R E S E N T E', 0, 1, 'L');
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->SetLeftMargin(25);
    $pdf->SetRightMargin(25);
    // $pdf->Cell(19);
    // $text1 = "Por medio del presente, me permito hacer de su conocimiento que ha sido comisionado (a) para fungir como <VOCAL>, en el Acto de Recepción Profesional de él (la) <C. " . $res['nombre'] . ">, que realiza su protocolo para su <TITULACIÓN INTEGRAL \"TESIS PROFESIONAL\",>, defendiendo su proyecto (promedio " . $_GET['pro'] . "), el día <" . utf8_decode(mb_strtoupper($_GET['fechaT'])) . " del año en curso>,  a las <" . $_GET['horaT'] . " HRS.>, en la <SALA DE TITULACIÓN YOHUALCEHUATL.>";
    $text2 = "Por medio del presente, me permito hacer de su conocimiento que ha sido comisionado (a) para fungir como <PRESIDENTE>, en el Acto de Recepción Profesional de él (la) <C." . $res['nombre'] . ">, que realiza su <TITULACIÓN INTEGRAL \"TESIS PROFESIONAL\">, el día <" . utf8_decode(mb_strtoupper($_GET['fechaT'])) . " del año en curso>,  a las <" . $_GET['horaT'] . " HRS.>, en la <SALA DE TITULACIÓN YOHUALCEHUATL.>";
    // if ($_GET['defiende'] == 'si') {
    //     $pdf->WriteText(utf8_decode($text1));
    // } else {
        $pdf->WriteText(utf8_decode($text2));
    // }
    $pdf->SetLeftMargin(10);
    $pdf->SetRightMargin(10);
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(19);
    $text = "Así mismo le comunico que dicho evento será celebrado puntualmente en la fecha, hora y aula especificadas, por lo
            que le pido a usted confirmar en un plazo no mayor a un día, < además deberá presentarse 10 minutos antes del evento>.";
    $pdf->WriteText(utf8_decode($text));
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(19);
    $pdf->Cell(150, 4, utf8_decode('También le notifico que por ser el acto de Recepción Profesional de Titulación una ceremonia especial, es requisito'), 0, 1, 'L');
    $pdf->Cell(11);
    $pdf->Cell(150, 4, utf8_decode('para los miembros del jurado, presentarse de manera apropiada para ello. '), 0, 1, 'L');
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(19);
    $pdf->MultiCell(163, 4, utf8_decode('Hombres: Saco y corbata.
Mujeres: Vestir de manera formal (traje sastre o de acuerdo al evento).'), 1, 'L');
    $pdf->Ln(10);
    $pdf->Cell(11);
    $pdf->SetFont('Arial', 'B', '9');
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('PRESIDENTE'), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('SECRETARIO(A)'), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('VOCAL'), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('VOCAL SUPLENTE'), 1, 'C');

    $pdf->SetFont('Arial', '', '9');
    $pdf->Cell(11);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['asesorInt'])), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['revisor1'])), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['revisor2'])), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['revisor3'])), 1, 'C');

    $pdf->Ln(4);
    $pdf->Cell(0, 4, utf8_decode('Sin más por el momento y agradeciendo de antemano la atención prestada al presente quedo de usted.'), 0, 1, 'C');
    $pdf->Ln(4);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 4, utf8_decode('A T E N T A M E N T E'), 0, 1, 'C');
    $pdf->Cell(0, 4, utf8_decode('"TECNOLOGÍA COMO SINÓNIMO DE INDEPENDENCIA"'), 0, 1, 'C');
    $pdf->Ln(15);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 4, utf8_decode($res2['nombre']), 0, 1, 'C');
    if ($res2['sexo'] == 'F') {
        $pdf->Cell(0, 4, utf8_decode('JEFA DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
    } else {
        $pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
    }
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', '', '7');
    $pdf->Cell(20);
    $pdf->Cell(0, 4, utf8_decode('C.c.p. archivo.'), 0, 1, 'L');
    $pdf->SetFont('Helvetica', '', '6');
    $pdf->Cell(17);
    $pdf->Cell(20, 4, utf8_decode('JEOL*ere'), 0, 1, 'R');


    //OTRO DOCUMENTO
    $pdf->AddPage();
    $h = $pdf->GetPageHeight();
    $w = $pdf->GetPageWidth();
    $pdf->Image('../img/fondo_membrete_R.jpg', '0', '38', '220', '243', 'JPG');
    $pdf->SetFont('Helvetica', '', '7');
    $pdf->Cell(0, 4, utf8_decode('"2019, Año del Caudillo del Sur, Emiliano Zapata"'), 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(107);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(20, 4, utf8_decode('DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'L');
    $pdf->Cell(107);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(80, 4, 'OF. No. DSC-ITI/' . $_GET['num5'] . '/' . date("Y"), 0, 1, 'L');
    $pdf->Cell(107);
    $pdf->Cell(15, 4, 'ASUNTO: ', 0, 0, 'L');
    $pdf->SetFont('Helvetica', 'BUI', '9');
    $pdf->Cell(15, 4, utf8_decode('JURADO DE TITULACIÓN.'), 0, 1, 'L');
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(107);
    $pdf->Cell(25, 4, 'IGUALA, GRO., ', 0, 0, 'L');
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(50, 4, $_GET['fecha'], 0, 1, 'L');
    $pdf->Ln(5); //CELDA DE ESPACIO
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(11);
    $pdf->Cell(80, 4, utf8_decode($res['revisor3']), 0, 1, 'L');
    $pdf->Cell(11);
    $pdf->Cell(80, 4, utf8_decode('DOCENTE DE ESTA INSTITUCIÓN'), 0, 1, 'L');
    $pdf->Cell(11);
    $pdf->Cell(80, 4, 'P R E S E N T E', 0, 1, 'L');
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->SetLeftMargin(25);
    $pdf->SetRightMargin(25);
    // $pdf->Cell(19);
    // $text1 = "Por medio del presente, me permito hacer de su conocimiento que ha sido comisionado (a) para fungir como <VOCAL SUPLENTE>, en el Acto de Recepción Profesional de él (la) <C. " . $res['nombre'] . ">, que realiza su protocolo para su <TITULACIÓN INTEGRAL \"TESIS PROFESIONAL\",>, defendiendo su proyecto (promedio " . $_GET['pro'] . "), el día <" . utf8_decode(mb_strtoupper($_GET['fechaT'])) . " del año en curso>,  a las <" . $_GET['horaT'] . " HRS.>, en la <SALA DE TITULACIÓN YOHUALCEHUATL.>";
    $text2 = "Por medio del presente, me permito hacer de su conocimiento que ha sido comisionado (a) para fungir como <PRESIDENTE>, en el Acto de Recepción Profesional de él (la) <C." . $res['nombre'] . ">, que realiza su <TITULACIÓN INTEGRAL \"TESIS PROFESIONAL\">, el día <" . utf8_decode(mb_strtoupper($_GET['fechaT'])) . " del año en curso>,  a las <" . $_GET['horaT'] . " HRS.>, en la <SALA DE TITULACIÓN YOHUALCEHUATL.>";
    // if ($_GET['defiende'] == 'si') {
    //     $pdf->WriteText(utf8_decode($text1));
    // } else {
        $pdf->WriteText(utf8_decode($text2));
    // }
    $pdf->SetLeftMargin(10);
    $pdf->SetRightMargin(10);
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(19);
    $text = "Así mismo le comunico que dicho evento será celebrado puntualmente en la fecha, hora y aula especificadas, por lo
            que le pido a usted confirmar en un plazo no mayor a un día, < además deberá presentarse 10 minutos antes del evento>.";
    $pdf->WriteText(utf8_decode($text));
    $pdf->Ln(10);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(19);
    $pdf->Cell(150, 4, utf8_decode('También le notifico que por ser el acto de Recepción Profesional de Titulación una ceremonia especial, es requisito'), 0, 1, 'L');
    $pdf->Cell(11);
    $pdf->Cell(150, 4, utf8_decode('para los miembros del jurado, presentarse de manera apropiada para ello. '), 0, 1, 'L');
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', '', '9');
    $pdf->Cell(19);
    $pdf->MultiCell(163, 4, utf8_decode('Hombres: Saco y corbata.
Mujeres: Vestir de manera formal (traje sastre o de acuerdo al evento).'), 1, 'L');
    $pdf->Ln(10);
    $pdf->Cell(11);
    $pdf->SetFont('Arial', 'B', '9');
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('PRESIDENTE'), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('SECRETARIO(A)'), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('VOCAL'), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 7, utf8_decode('VOCAL SUPLENTE'), 1, 'C');

    $pdf->SetFont('Arial', '', '9');
    $pdf->Cell(11);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['asesorInt'])), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['revisor1'])), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['revisor2'])), 1, 'C');
    $pdf->SetXY($x + 43, $y);
    $x = $pdf->GetX();
    $y = $pdf->GetY();
    $pdf->MultiCell(43, 5, utf8_decode(mb_strtoupper($res['revisor3'])), 1, 'C');

    $pdf->Ln(4);
    $pdf->Cell(0, 4, utf8_decode('Sin más por el momento y agradeciendo de antemano la atención prestada al presente quedo de usted.'), 0, 1, 'C');
    $pdf->Ln(4);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 4, utf8_decode('A T E N T A M E N T E'), 0, 1, 'C');
    $pdf->Cell(0, 4, utf8_decode('"TECNOLOGÍA COMO SINÓNIMO DE INDEPENDENCIA"'), 0, 1, 'C');
    $pdf->Ln(15);
    $pdf->SetFont('Helvetica', 'B', '9');
    $pdf->Cell(0, 4, utf8_decode($res2['nombre']), 0, 1, 'C');
    if ($res2['sexo'] == 'F') {
        $pdf->Cell(0, 4, utf8_decode('JEFA DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
    } else {
        $pdf->Cell(0, 4, utf8_decode('JEFE DEL DEPTO. DE SISTEMAS Y COMPUTACIÓN'), 0, 1, 'C');
    }
    $pdf->Ln(5);
    $pdf->SetFont('Helvetica', '', '7');
    $pdf->Cell(20);
    $pdf->Cell(0, 4, utf8_decode('C.c.p. archivo.'), 0, 1, 'L');
    $pdf->SetFont('Helvetica', '', '6');
    $pdf->Cell(17);
    $pdf->Cell(20, 4, utf8_decode('JEOL*ere'), 0, 1, 'R');

    $pdf->Output('I', 'Comisión para titulacion ' . $res['nombre'] . '.pdf', 'D');
} else {
    echo "<script>window.location = '../../Inicio';</script>";
}
