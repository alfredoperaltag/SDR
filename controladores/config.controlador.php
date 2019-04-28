<?php
class ControladorConfig
{

    /*=============================================
	    CARGAR CONFIG
	=============================================*/
    public static function ctrCargarConfig($nameConfig)
    {
        if (isset($_SESSION['iniciarSesion'])) {
            $tabla = "config";
            $item = "nombre";
            $valor = $nameConfig;
            $respuesta = ModeloConfig::MdlCargarConfig($tabla, $item, $valor);
            return $respuesta;
        }
    }

    /*<!--=====================================
    ACTUALIZAR VALOR CONFIG PRE-REGISTRO
    ======================================-->*/
    public static function ctrSaveConfig()
    {
        if (isset($_POST["idConfig"])) {
            $tabla = "config";
            $datos = array(
                "id" => $_POST["idConfig"],
                "valor" => $_POST["valorConfig"],
            );
            $respuesta = ModeloConfig::mdlActualizarValorConfig($tabla, $datos);

            if ($respuesta == "ok") {
                return $respuesta;
            }
        }
    }
}
