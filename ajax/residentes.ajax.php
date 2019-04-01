<?php
require_once "../controladores/residentes.controlador.php";
require_once "../modelos/residentes.modelo.php";
class AjaxResidentes
{

    /*<!--=====================================
    INFO RESIDENTE
    ======================================-->*/
    public $idResidente;
    public $idResidenteEdit;
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
        $valor = $this->idResidenteEdit;
        $respuesta = ControladorResidentes::ctrMostrarEditarResidentes($item, $valor);
        echo json_encode($respuesta);
    }
    //Imorimir documentos residente
    public function ajaxImprimirResidente()
    {
        $item = "id";
        $valor = $this->idResidenteImp;
        $respuesta = ControladorResidentes::ctrMostrarInfoResidentes($item, $valor);
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
    $editar->idResidenteEdit = $_POST["idResidenteEdit"];
    $editar->ajaxEditResidente();
}

/*<!--=====================================
IMPRIMIR PDF RESIDENTE
======================================-->*/
if (isset($_POST["idResidenteImp"])) {
    $editar = new AjaxResidentes();
    $editar->idResidenteImp = $_POST["idResidenteImp"];
    $editar->ajaxImprimirResidente();
}
