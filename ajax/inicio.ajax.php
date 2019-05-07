<?php
require_once "../controladores/inicio.controlador.php";
require_once "../modelos/inicio.modelo.php";
class AjaxInicio
{
    /*<!--=====================================
    GRAFICAR RESIDENTES
    ======================================-->*/
    public $GraficaInicio;
    public function ajaxverGrafo()
    {
        $item = "tipo_registro";
        $valor = $this->GraficaInicio;
        $tabla = "residentes";
        // $respuesta = ControladorInicio::ctrMostrarResidentesGrafo($valor);
        $respuesta = ControladorInicio::ctrMostrarResidentesInicio($valor, $tabla, $item);
        echo json_encode($respuesta);
    }
}
    /*<!--=====================================
    GRAFICAR RESIDENTES
    ======================================-->*/
if (isset($_POST["GraficaR"])) {
    $editar = new AjaxInicio();
    $editar->GraficaInicio = $_POST["GraficaR"];
    $editar->ajaxverGrafo();
}