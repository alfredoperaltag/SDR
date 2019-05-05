<?php
class ControladorInicio
{
    /*=============================================
    TOTAL DE RESIDENTES EN NUMERO
    =============================================*/
    // public static function ctrMostrarResidentesInicio($item, $valor)
    public static function ctrMostrarResidentesInicio($valor)
    {
        $item = "tipo_registro";
        $tabla = "residentes";
        $respuesta = ModeloInicio::MdlMostrarRInicio($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    GRAFICAR RESIDENTES
    =============================================*/
    // public static function ctrMostrarResidentesInicio($item, $valor)
    public static function ctrMostrarResidentesGrafo($valor)
    {
        $item = "tipo_registro";
        $tabla = "residentes";
        $respuesta = ModeloInicio::MdlMostrarRGrafo($tabla, $item, $valor);
        return $respuesta;
    }
}
