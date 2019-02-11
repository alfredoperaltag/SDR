<?php

class ControladorResidentes
{

    /*=============================================
    MOSTRAR TODOS LOS ASESORES/REVISORES/SUPLENTES
    =============================================*/
    public static function ctrMostrarTodosLosDocesentes()
    {
        $tabla = "asesor";
        $item = "noResidentes";
        $valor = "7";
        echo $tabla.' '.$item.' '.$valor;
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

        $respuesta = ModeloResidentes::MdlMostrarResidentesEnTabla($tabla, $item, $valor);

        foreach ($respuesta as $key => $value) {
                       echo ' <tr>
                            <td>'.$value["id"].'</td>
                            <td>'.$value["nombre"].'</td>
                            <td>'.$value["noControl"].'</td>
                            <td>'.$value["carrera"].'</td>
                            <td>'.$value["sexo"].'</td>
                            <td>'.$value["telefono"].'</td>
                            <td>'.$value["nombreProyecto"].'</td>
                            <td>'.$value["tipo"].'</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning"  idResidente="' . $value["id"] . '" data-toggle="modal" data-target="#modalER"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalInfo"><i class="fa fa-info"></i></button>
                                    <button class="btn btn-success" data-toggle="modal" data-target="#modalFormatos"><i class="fa fa-print"></i></button>
                                </div>
                            </td>
                        </tr>';
        }

    }



    /*=============================================
    REGISTRAR RESIDENTES
    =============================================*/

    public static function ctrRegistrarResidentes(){
        
    }



}
