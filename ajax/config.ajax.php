<?php
require_once "../controladores/config.controlador.php";
require_once "../modelos/config.modelo.php";
class AjaxConfig
{
    /*<!--=====================================
    ACTUALIZAR VALOR CONFIG PRE-REGISTRO
    ======================================-->*/
    public $idConfig;
    public function ajaxEditarDocente()
    {
        $item = "id";
        $valor = $this->idConfig;
        // $respuesta = ControladorConfig::ctrSaveConfig($item, $valor);
        $respuesta = ControladorConfig::ctrSaveConfig();
        echo json_encode($respuesta);
    }
}
/*<!--=====================================
    ACTUALIZAR VALOR CONFIG PRE-REGISTRO
======================================-->*/
    if (isset($_POST["idConfig"])) {
        $editar = new AjaxConfig();
        $editar->idConfig = $_POST["idConfig"];
        $editar->ajaxEditarDocente();
    }