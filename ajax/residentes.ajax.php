<?php
require_once "../controladores/residentes.controlador.php";
require_once "../modelos/residentes.modelo.php";
class AjaxResidentes
{

    /*<!--=====================================
    INFO RESIDENTE
    ======================================-->*/
    public $idResidente;
    public function ajaxInfoResidente()
    {
        $item = "id";
        $valor = $this->idResidente;
        $respuesta = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);
        echo json_encode($respuesta);
    }
    //Editar residente
    public function ajaxEditResidente()
    {
        $item = "id";
        $valor = $this->idResidente;
        $respuesta = ControladorResidentes::ctrMostrarEditarResidentes($item, $valor);
        echo json_encode($respuesta);
    }
}
/*<!--=====================================
INFO RESIDENTE
======================================-->*/
if (isset($_POST["idResidente"])) {
    $ver = new AjaxResidentes();
    $ver->idResidente = $_POST["idResidente"];
    $ver->ajaxInfoResidente();
}

/*<!--=====================================
EDITAR RESIDENTE
======================================-->*/
if (isset($_POST["idResidenteEdit"])) {
    $editar = new AjaxResidentes();
    $editar->idResidente = $_POST["idResidenteEdit"];
    $editar->ajaxEditResidente();
}
