<?php
require_once "../../controladores/residentes.controlador.php";
require_once "../../modelos/residentes.modelo.php";
use Spipu\Html2Pdf\Html2Pdf;

class imprimirDictamen
{
    public $idResidente;
    public function traerImpresionDictamen()
    {
        $item = "id";
        $valor = $this->idResidente;
        $respuesta = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);
        $nombre = $respuesta["nombre"];
        $periodo = $respuesta["periodo"];
        $anio = $respuesta["anio"];
        $semestre = $respuesta["semestre"];

        require '../vendor/autoload.php';

        /* require_once 'dictamen.php'; */
        require_once 'dictamen.php';
        $html = ob_get_clean();

        $html2pdf = new Html2Pdf('L', 'LETTER', 'es', 'true', 'UTF-8');
        $html2pdf->writeHTML($html);
        $html2pdf->output('dictamen-'.$nombre.'.pdf');
    }
}

$Dictamen = new imprimirDictamen();
$Dictamen->idResidente = $_GET['id'];
$Dictamen->traerImpresionDictamen();
