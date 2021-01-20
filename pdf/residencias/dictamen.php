<?php
session_start();
require_once "../../controladores/residentes.controlador.php";
require_once "../../modelos/residentes.modelo.php";
require_once "../../controladores/jerarquia.controlador.php";
require_once "../../modelos/jerarquia.modelo.php";
require('../FPDF/fpdf.php');
// require('mc_table.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../img/membreteDictamen.PNG', 44, 12, 0);
        $this->Ln(40);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-27);
        $this->Image('../img/iti.jpg', 53, 183, 9);
        $this->SetFont('Arial', 'B', 7);
        $this->SetXY(6, -27);
        $this->Cell(0, 0, utf8_decode('Toda copia en PAPEL es "Documento no controlado" a excepción del original'), 0, 0, 'C');
        $this->SetFont('Arial', '', 9);
        $this->SetXY(188, -24);
        $this->Cell(0, 0, utf8_decode('Rev.1'), 0, 0, 'C');
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
if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {
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
    $id = $valor;
    $numeroControl = $respuesta["noControl"];
    $carrera = $respuesta["carrera"];
    $proyecto = $respuesta["nombreProyecto"];
    $nombre = $respuesta["nombre"];
    $sexo = $respuesta["sexo"];
    $empresa = $respuesta["nombreEmpresa"];
    $asesorInterno = $respuesta["asesorInt"];
    $asesorExterno = $respuesta["asesorExt"];
    $periodo = $respuesta["periodo"];
    $anio = $respuesta["anio"];
    $semestre = $respuesta["semestre"];
    $fechaActual = $_GET['fecha'];
    $estado = $_GET['estado'];
    // JERARQUIA
    $presidente = $resP['nombre'];
    $jefe = $resJe['nombre'];
    $subdirector = $resSub['nombre'];

    $pdf = new PDF('L', 'mm', 'Letter');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(0, 0, utf8_decode('INSTITUTO TECNOLÓGICO DE IGUALA'), 0, 0, 'C');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN'), 0, 0, 'C');
    $pdf->Ln(4);
    $pdf->Cell(0, 0, utf8_decode('DICTAMEN DE ANTEPROYECTOS DE RESIDENCIAS PROFESIONALES'), 0, 0, 'C');
    $pdf->Ln(4);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(191, 64);
    $pdf->Cell(29, 9, utf8_decode('SEMESTRE'), 1, 0, 'C');
    $pdf->Cell(22, 4.5, utf8_decode('ENE - JUN'), 1, 2, 'C');
    $pdf->Cell(22, 4.5, utf8_decode('AGO - DIC'), 1, 0, 'C');
    $pdf->SetXY(242, 64);
    if ($semestre == 'EJ') {
        $pdf->Cell(18, 4.5, utf8_decode($anio), 1, 2, 'C');
        $pdf->Cell(18, 4.5, utf8_decode(''), 1, 0, 'C');
    } else {
        $pdf->Cell(18, 4.5, utf8_decode(''), 1, 2, 'C');
        $pdf->Cell(18, 4.5, utf8_decode($anio), 1, 0, 'C');
    }
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetXY(10, 80);
    $pdf->Cell(0, 0, utf8_decode(mb_strtoupper($carrera)), 0, 0, 'C');
    $pdf->SetXY(17, 85);
    // $pdf->Cell(15, 12, utf8_decode('NUM.'), 1, 0, 'C');
    // $pdf->Cell(23, 12, utf8_decode('CONTROL'), 1, 0, 'C');
    // $pdf->MultiCell(38, 6, utf8_decode('NOMBRE DEL ESTUDIANTE'), 1, 'C');
    // $pdf->SetXY(93, 85);
    // $pdf->Cell(6, 12, utf8_decode('S'), 1, 0, 'C');
    // $pdf->Cell(36, 12, utf8_decode('ANTEPROYECTO'), 1, 0, 'C');
    // $pdf->Cell(34, 12, utf8_decode('EMPRESA'), 1, 0, 'C');
    // $pdf->Cell(45, 5, utf8_decode('ASESORES'), 1, 0, 'C');
    // $pdf->Cell(25, 12, utf8_decode('DICTAMEN'), 1, 0, 'C');
    // $pdf->MultiCell(25, 6, utf8_decode('FECHA DE DICTAMEN'), 1, 'C');
    // $pdf->SetXY(169, 90);
    // $pdf->Cell(23, 7, utf8_decode('INTERNO'), 1, 0, 'C');
    // $pdf->Cell(22, 7, utf8_decode('EXTERNO'), 1, 0, 'C');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(11, 12, utf8_decode('NUM.'), 1, 0, 'C');
    $pdf->Cell(19, 12, utf8_decode('CONTROL'), 1, 0, 'C');
    $pdf->MultiCell(34, 6, utf8_decode('NOMBRE DEL ESTUDIANTE'), 1, 'C');
    $pdf->SetXY(81, 85);
    $pdf->Cell(6, 12, utf8_decode('S'), 1, 0, 'C');
    $pdf->Cell(43, 12, utf8_decode('ANTEPROYECTO'), 1, 0, 'C');
    $pdf->Cell(43, 12, utf8_decode('EMPRESA'), 1, 0, 'C');
    $pdf->Cell(45, 5, utf8_decode('ASESORES'), 1, 0, 'C');
    $pdf->Cell(25, 12, utf8_decode('DICTAMEN'), 1, 0, 'C');
    $pdf->MultiCell(21, 6, utf8_decode('FECHA DE DICTAMEN'), 1, 'C');
    $pdf->SetXY(173, 90);
    $pdf->Cell(23, 7, utf8_decode('INTERNO'), 1, 0, 'C');
    $pdf->Cell(22, 7, utf8_decode('EXTERNO'), 1, 0, 'C');

    // $pdf->SetXY(17, 103);
    $pdf->SetXY(17, 97);
    $pdf->SetFont('Arial', '', 10);
    if ($sexo == 'Masculino') {
        $sexo = 'M';
    } else {
        $sexo = 'F';
    }
    //$pdf->SetWidths(array(15, 23, 38, 6, 36, 34, 23, 22, 25, 25));
    //247
    $pdf->SetWidths(array(11, 19, 34, 6, 43, 43, 23, 22, 25, 21));
    for ($i = 0; $i < 1; $i++)
        $pdf->Row(array('1', $numeroControl, utf8_decode(mb_strtoupper($nombre)), $sexo, utf8_decode($proyecto), utf8_decode($empresa), utf8_decode(mb_strtoupper($asesorInterno)), utf8_decode(mb_strtoupper($asesorExterno)), utf8_decode(mb_strtoupper($estado)), utf8_decode(mb_strtoupper($fechaActual))));


    // $pdf->SetY(148);
    $pdf->Ln(7);
    $pdf->Cell(0, 0, utf8_decode('En caso que uno o mas Anteproyectos sean rechazados se elaborara otro registro unicamente con los anteproyectos redictaminados'), 0, 0, 'C');

    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(44, 171);
    $pdf->Cell(0, 0, utf8_decode(mb_strtoupper($presidente)), 0, 0, 'L');
    $pdf->SetX(30);
    $pdf->Cell(0, 0, utf8_decode(mb_strtoupper($jefe)), 0, 0, 'C');
    $pdf->SetX(185);
    $pdf->Cell(0, 0, utf8_decode(mb_strtoupper($subdirector)), 0, 0, 'C');
    $pdf->Ln(4);
    $pdf->SetX(36);
    $pdf->Cell(0, 0, utf8_decode('NOMBRE Y FIRMA DEL PRESIDENTE DE'), 0, 0, 'L');
    $pdf->SetX(30);
    $pdf->Cell(0, 0, utf8_decode('NOMBRE Y FIRMA DEL JEFE DEL'), 0, 0, 'C');
    $pdf->SetX(185);
    $pdf->Cell(0, 0, utf8_decode('NOMBRE Y FIRMA DEL SUBDIRECTOR'), 0, 0, 'C');
    $pdf->Ln(4);
    $pdf->SetX(60);
    $pdf->Cell(0, 0, utf8_decode('ACADEMIA'), 0, 0, 'L');
    $pdf->SetX(30);
    $pdf->Cell(0, 0, utf8_decode('DEPTO. ACADÉMICO'), 0, 0, 'C');
    $pdf->SetX(185);
    $pdf->Cell(0, 0, utf8_decode('ACADÉMICO'), 0, 0, 'C');
    $pdf->Ln(4);
    $pdf->SetX(63);
    $pdf->Cell(0, 0, utf8_decode('Propone'), 0, 0, 'L');
    $pdf->SetX(30);
    $pdf->Cell(0, 0, utf8_decode('Valida'), 0, 0, 'C');
    $pdf->SetX(185);
    $pdf->Cell(0, 0, utf8_decode('Vo. Bo.'), 0, 0, 'C');

    $pdf->Output('I', 'Dictamen ' . $nombre . '.pdf', 'D');
} else {
    echo "<script>window.location = '../../Inicio';</script>";
}
