<?php
require_once "../controladores/jerarquia.controlador.php";
require_once "../modelos/jerarquia.modelo.php";
class Ajaxjerarquia
{
    /*<!--=====================================
    EDITAR Jerarquia
    ======================================-->*/
    public $idJerarquia;
    public function ajaxEditarJerarquia()
    {
        $item = "id";
        $valor = $this->idJerarquia;
        $respuesta = ControladorJerarquia::ctrMostrarDocentesJerarquia($item, $valor);
        echo json_encode($respuesta);
    }
}

/*<!--=====================================
    EDITAR Jerarquia
    ======================================-->*/
if (isset($_POST["idJerarquia"])) {
    $editar = new AjaxJerarquia();
    $editar->idJerarquia = $_POST["idJerarquia"];
    $editar->ajaxEditarJerarquia();
}
