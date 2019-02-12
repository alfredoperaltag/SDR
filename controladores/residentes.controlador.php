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
        if(isset($_POST["nuevoUsuario"])){

            $tabla1 = "proyecto";
            $tabla2 = "residentes";
				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$datosResidente = array("noControl" => $_POST["nuevoNoControl"],
					           "carrera" => $_POST["nuevoCarrera"],
					           "periodo" => $_POST["nuevoPeriodo"],
					           "anio" => $_POST["nuevoPeriodoAnio"],
					           "nombre" => $_POST["nuevoNombre"],
					           "apellidoP" => $_POST["nuevoApellidoP"],
					           "apellidoM" => $_POST["nuevoApellidoM"],
					           "sexo" => $_POST["nuevoSexo"],
					           "telefono" => $_POST["nuevoTelefono"],
                               "telefono" => $_POST["nuevoTelefono"]);
                               
                $datosProyecto = array("nombreProyecto" => $_POST["nuevoNombreProyecto"],
					           "nombreEmpresa" => $_POST["nuevoNombreEmpresa"],
					           "asesorExt" => $_POST["nuevoAsesorExt"],
					           "asesorInt" => $_POST["nuevoAsesorInt"],
					           "revisor1" => $_POST["nuevoRevisor1"],
					           "revisor2" => $_POST["nuevoRevisor2"],
					           "revisor3" => $_POST["nuevoSuplente"]);

                $respuesta = ModeloResidentes::mdlRegistroResidenteProyecto($tabla, $datos);
                

				if($respuesta == "ok"){
					echo '<script>
					Swal.fire({
						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
							window.location = "usuarios";
						}
					});
					</script>';
				}else{
                    echo '<script>
                    Swal.fire({
                            type: "error",
                            title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                window.location = "usuarios";
                            }
                        });
                    </script>';
                }


        }
    }



}
