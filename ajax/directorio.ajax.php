<?php
require_once "../controladores/directorio.controlador.php";
require_once "../modelos/directorio.modelo.php";
class AjaxDirectorio
{
    public $idDireccionEdit;
    //Editar directorio
    public function ajaxEditDirectorio()
    {
        $item = "id";
        $valor = $this->idDireccionEdit;
        $respuesta = ControladorDirectorio::ctrMostrarEditarDirectorio($item, $valor);
        echo json_encode($respuesta);
    }
}

/*<!--=====================================
EDITAR DIRECTORIO
======================================-->*/
if (isset($_POST["idDireccionEdit"])) {
    $editar = new AjaxDirectorio();
    $editar->idDireccionEdit = $_POST["idDireccionEdit"];
    $editar->ajaxEditDirectorio();
}