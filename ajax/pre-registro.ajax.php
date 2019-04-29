<?php
require_once "../controladores/pre-registro.controlador.php";
require_once "../modelos/pre-registro.modelo.php";

class AjaxPreRegistro
{
    public $idPreRegistroEdit;
    public function ajaxEditarPreRegistroAjax()
    {
        $item = "id";
        $valor = $this->idPreRegistroEdit;
        $respuesta = ControladorPreRegistro::ctrMostrarInfoPreRegistro($item, $valor);
        echo json_encode($respuesta);
    }

    public $idRegistroView;
    public function ajaxEditarPreRegistroAjax2()
    {
        $item = "id";
        $valor = $this->idRegistroView;
        $respuesta = ControladorPreRegistro::ctrMostrarInfoPreRegistro($item, $valor);
        echo json_encode($respuesta);
    }

}
/*<!--=====================================
    EDITAR PRE-REGISTRO
======================================-->*/
    if (isset($_POST["idPreRegistroEdit"])) {
        $editar = new AjaxPreRegistro();
        $editar->idPreRegistroEdit = $_POST["idPreRegistroEdit"];
        $editar->ajaxEditarPreRegistroAjax();
    }

/*<!--=====================================
    EDITAR PRE-REGISTRO
======================================-->*/
if (isset($_POST["idRegistroView"])) {
    $editar = new AjaxPreRegistro();
    $editar->idRegistroView = $_POST["idRegistroView"];
    $editar->ajaxEditarPreRegistroAjax2();
}