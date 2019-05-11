<?php
require_once "../controladores/docentes.controlador.php";
require_once "../modelos/docentes.modelo.php";
class AjaxDocentes
{
    /*<!--=====================================
    EDITAR DOCENTE
    ======================================-->*/
    public $idDocente;
    public function ajaxEditarDocente()
    {
        $item = "id";
        $valor = $this->idDocente;
        $respuesta = ControladorDocentes::ctrMostrarDocentes($item, $valor);
        echo json_encode($respuesta);
    }
    /*<!--=====================================
    ACTIVAR DOCENTE
    ======================================-->*/
    public $activarDocente;
    public $activarId;

    public function ajaxActivarDocente()
    {
        $tabla = "asesor";
        $item1 = "estado";
        $valor1 = $this->activarDocente;
        $item2 = "id";
        $valor2 = $this->activarId;
        $respuesta = ModeloDocentes::mdlActualizarDocente($tabla, $item1, $valor1, $item2, $valor2);
    }

    /*<!--=====================================
    PONER EN CERO LOS DOCENTES
    ======================================-->*/
    public $ceroD;
    public function ajaxCeroDocente()
    {
        
        $valor1 = $this->ceroD;
        $respuesta = ControladorDocentes::ctrCeroDocentes();
        echo json_encode($respuesta);
    }
    /*<!--=====================================
    INFORMACION DOCENTE
    ======================================-->*/
    public $idDocenteInfo;
    public function ajaxInfoDocente()
    {
        $valor = $this->idDocenteInfo;
        $respuesta = ControladorDocentes::ctrInfoDocentes($valor);
        echo json_encode($respuesta);
    }
}
/*<!--=====================================
    EDITAR DOCENTE
    ======================================-->*/
if (isset($_POST["idDocente"])) {
    $editar = new AjaxDocentes();
    $editar->idDocente = $_POST["idDocente"];
    $editar->ajaxEditarDocente();
}
/*<!--=====================================
ACTIVAR DOCENTE
======================================-->*/
if (isset($_POST["activarDocente"])) {
    $activarDocente = new AjaxDocentes();
    $activarDocente->activarDocente = $_POST["activarDocente"];
    $activarDocente->activarId = $_POST["activarId"];
    $activarDocente->ajaxActivarDocente();
}
/*<!--=====================================
    PONER EN CERO LOS DOCENTES
    ======================================-->*/
if (isset($_POST["ceroD"])) {
    $cero = new AjaxDocentes();
    $cero->ceroD = $_POST["ceroD"];
    $cero->ajaxCeroDocente();
}
/*<!--=====================================
    INFORMACION DOCENTE
======================================-->*/
if (isset($_POST["idDocenteInfo"])) {
    $info = new AjaxDocentes();
    $info->idDocenteInfo = $_POST["idDocenteInfo"];
    $info->ajaxInfoDocente();
}