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

    // Docentes disponibles ajax
    public $varDocDisponible;
    public function ajaxDocentesDisponibles()
    {
        $item = $this->varDocDisponible;
        $respuesta = ControladorPreRegistro::ctrMostrarDocentesPreRegistro($item);
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

/*<!--=====================================
VER DOCENTES DISPONIBLES SIN ACTUALIZAR
======================================-->*/
if (isset($_POST["varDocDisponible"])) {
    $editar = new AjaxPreRegistro();
    $editar->varDocDisponible = $_POST["varDocDisponible"];
    $editar->ajaxDocentesDisponibles();
}