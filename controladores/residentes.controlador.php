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

        $respuesta = ModeloResidentes::MdlMostrarDocentes($tabla, $item, $valor);

        foreach ($respuesta as $key => $value) {
            echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
        }

    }


    /*=============================================
    MOSTRAR TODOS LOS RESIDENTES
    =============================================*/
    public static function ctrMostrarResidentes()
    {
        $tabla = "residentes";
        $item = null;
        $valor = "";

        $respuesta = ModeloResidentes::MdlMostrarDocentes($tabla, $item, $valor);

        foreach ($respuesta as $key => $value) {
            // echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       echo ' <tr>
                            <td>'.$value["id"].'</td>
                            <td>'.$value["nombre"].' '.$value["apellidoP"].' '.$value["apellidoM"].'</td>
                            <td>'.$value["noControl"].'</td>
                            <td>'.$value["carrera"].'</td>
                            <td>'.$value["sexo"].'</td>
                            <td>'.$value["telefono"].'</td>
                            <td>'.$value["proyecto_id"].'</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-primary"><i class="fa fa-info"></i></button>
                                </div>
                            </td>
                        </tr>';
        }

    }



}
