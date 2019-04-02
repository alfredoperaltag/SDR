<?php

class ControladorDirectorio
{

    /*=============================================
    MOSTRAR TODO EL DIRECTORIO
    =============================================*/
    public static function ctrMostrarDirectorio()
    {
        $tabla = "directorio";
        $item = null;
        $valor = "";

        $respuesta = ModeloDirectorio::MdlMostrarDirectorio($tabla, $item, $valor);

        foreach ($respuesta as $key => $value) {
                echo ' <tr class="table">
                            <td>' . $value["id"] . '</td>
                            <td><strong style="font-size: 25px;">' . $value["noExt"] . '</strong></td>
                            <td>' . $value["depto"] . '</td>
                            <td>' . $value["responsable"] . '</td>
                            <td>
                            <div class="btn-group">';

                if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == "Administrador") {
                    echo '<button class="btn btn-warning btnEditdireccion" idDireccionEdit="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditDirectory"><i class="fa fa-pencil"></i></button>';
            }else{
                echo '<button class="btn btn-warning btnEditdireccion" disabled idDireccionEdit="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditDirectory"><i class="fa fa-pencil"></i></button>';
            
            }
            echo ' </tr>';
        }
    }
}