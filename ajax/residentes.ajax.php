<?php
require_once "../controladores/residentes.controlador.php";
require_once "../modelos/residentes.modelo.php";
class AjaxResidentes{
    
    /*<!--=====================================
    INFO RESIDENTE
    ======================================-->*/
    public $idResidente;
    public function ajaxInfoResidente()
    {
        $item = "id";
        $valor = $this->idResidente;
        $respuesta = ControladorResidentes::ctrMostrarInfoResidentes($valor);
        echo json_encode($respuesta);
    }

}
    /*<!--=====================================
    INFO RESIDENTE
    ======================================-->*/
    if (isset($_POST["idResidente"])) {
        $editar = new AjaxResidentes();
        $editar->idResidente = $_POST["idResidente"];
        $_SERVER["infoResidenteSelect"] = $_POST["idResidente"];
        $editar->ajaxInfoResidente();
    }