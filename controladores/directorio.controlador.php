<?php

class ControladorDirectorio
{

    /*=============================================
    MOSTRAR EL DIRECTORIO
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
                    echo '<button class="btn btn-warning btnEditdireccion" idDireccionEdit="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditDirectory"><i class="fa fa-edit"></i></button>';
            }else{
                echo '<button class="btn btn-warning btnEditdireccion" disabled idDireccionEdit="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditDirectory"><i class="fa fa-edit"></i></button>';
            
            }
            echo ' </tr>';
        }
    }

    /*=============================================
    EDITAR DIRECTORIO
    =============================================*/
    public static function ctrEditarDirectorio()
    {
        if (isset($_POST["nuevoExtension"])) {
            $datosDirectorio = array(
                "id" => $_POST["idDirectorioEdit"],
                "extension" => $_POST["nuevoExtension"],
                "departamento" => $_POST["nuevoDepartamento"],
                "responsable" => $_POST["nuevoResponsable"]
            );
            
            $respuesta = ModeloDirectorio::mdlEditDirectorio("directorio", $datosDirectorio);

            if ($respuesta == "ok") {
                echo '<script>
            Swal.fire({
                 type: "success",
                 title: "¡Exito!",
                 text: "¡Se modifico correctamente!",						   
                showConfirmButton: true,
                confirmButtonText: "Cerrar"				   
            }).then((result)=>{
                if(result.value){
                    window.location = "Directorio";
                }
                });
          </script>';
            } else {
                echo '<script>
                Swal.fire({
                     type: "error",
                    title: "Error!",
                    text: "¡No se pudo actualizar!",						   
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"				   
                }).then((result)=>{
                    if(result.value){
                        window.location = "Directorio";
                    }
                    });
              </script>';
            }
        }else{
            // echo '<script>
            //     Swal.fire({
            //          type: "error",
            //         title: "Error!",
            //         text: "¡NEL!",						   
            //         showConfirmButton: true,
            //         confirmButtonText: "Cerrar"				   
            //     }).then((result)=>{
            //         if(result.value){
            //             window.location = "Directorio";
            //         }
            //         });
            //   </script>';
        }
    }

    /*=============================================
    EDITAR DEL RESIDENTE PARA MOSTRAR INFO EN MODAL
    =============================================*/
    public static function ctrMostrarEditarDirectorio($item, $valor)
    {
        $tabla = "directorio";
        $respuesta = ModeloDirectorio::MdlMostrarEditDirectorio($tabla, $item, $valor);
        return $respuesta;
    }
}