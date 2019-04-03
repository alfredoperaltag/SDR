<?php
class ControladorJerarquia
{

    /*=============================================
    MOSTRAR DOCENTE EN TABLA
    =============================================*/
    public static function ctrMostrarDocentesJerarquia()
    {
        $item = null;
        $valor = null;
        $tabla = "jerarquia";
        $respuesta = ModeloDocentesJerarquia::MdlMostrarDocentesJerarquia($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    MOSTRAR DOCENTE EN DICTAMEN
    =============================================*/
    public static function ctrMostrarDocentesDictamen($tabla, $item)
    {
        $respuesta = ModeloDocentesJerarquia::MdlMostrarDocentesDictamen($tabla, $item);
        return $respuesta;
    }

}