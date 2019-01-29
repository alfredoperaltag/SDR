<?php

class ControladorResidentes
{

    /*=============================================
    MOSTRAR TODOS LOS ASESORES/REVISORES/SUPLENTES
    =============================================*/
    public static function ctrMostrarTodosLosDocesentes()
    {
        $tabla = "asesor";
        $item = null;
        $valor = "";

        $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

        foreach ($respuesta as $key => $value) {
            echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
        }

    }
}
