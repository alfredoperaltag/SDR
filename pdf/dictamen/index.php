<?php
require_once "../../controladores/residentes.controlador.php";
require_once "../../modelos/residentes.modelo.php";
require_once "../../controladores/jerarquia.controlador.php";
require_once "../../modelos/jerarquia.modelo.php";

use Spipu\Html2Pdf\Html2Pdf;

class imprimirDictamen
{
    public $idResidente;
    public function traerImpresionDictamen()
    {
        $item = "id";
        $valor = $this->idResidente;
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

        require '../vendor/autoload.php';

        /* require_once 'dictamen.php'; */
        require_once 'dictamen2.php';
        $html = ob_get_clean();

        $html2pdf = new Html2Pdf('L', 'LETTER', 'es', 'true', 'UTF-8');
        $html2pdf->writeHTML($html);
        $html2pdf->output(' d ictamen - ' . $nombre . '.pdf');
    }
}

$Dictamen = new imprimirDictamen();
$Dictamen->idResidente = $_GET['id'];
$Dictamen->traerImpresionDictamen();
