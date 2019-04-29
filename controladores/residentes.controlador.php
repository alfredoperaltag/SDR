<?php

class ControladorResidentes
{

    /*=============================================
    MOSTRAR TODOS LOS ASESORES
    =============================================*/
    public static function ctrMostrarTodosLosDocesentes()
    {
        $tabla = "asesor";
        $item = "noResidentes";
        echo $tabla . ' ' . $item . ' ' . $valor;
        $respuesta = ModeloResidentes::MdlMostrarDocentes($tabla, $item);

        if ($respuesta != null) {
            foreach ($respuesta as $key => $value) {
                if ($value["id"] != 0) {
                    if ($value["estado"] != 0) {
                        // echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                        $asesores = $asesores .  '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                    }
                }
            }
            if ($asesores == null) {
                echo '<option value="NA">SIN ASESORES POR EL MOMENTO</option>';
            }else{
                echo $asesores;
            }
        }else{
            echo '<option value="NA">SIN ASESORES POR EL MOMENTO</option>';
        }
        
    }

        /*=============================================
    MOSTRAR TODOS LOS ASESORES/REVISORES/SUPLENTES
    =============================================*/
    public static function ctrMostrarTodosLosDocesentes2()
    {
        $tabla = "asesor";
        $item = null;
        echo $tabla . ' ' . $item . ' ' . $valor;
        $respuesta = ModeloResidentes::MdlMostrarDocentes($tabla, $item);

            foreach ($respuesta as $key => $value) {
                if ($value["id"] != 0) {
                    if ($value["estado"] != 0) {
                        echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                    }
                }
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
            if ($value["tipo"] == "Residencias") {//RESIDENCIAS
                echo ' <tr class="table-success">
                            <td>' . $value["id"] . '</td>
                            <td>' . $value["nombre"] . '</td>
                            <td>' . $value["noControl"] . '</td>
                            <td>' . $value["carrera"] . '</td>
                            <td>' . $value["sexo"] . '</td>
                            <td>' . $value["telefono"] . '</td>
                            <td>' . $value["nombreProyecto"] . '</td>
                            <td>' . $value["tipo"] . '</td>
                            <td>
                                <div class="btn-group">';

                if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == "Administrador") {
                    echo '<button class="btn btn-warning btnEditResidente" idResidenteEdit="' . $value["id"] . '" data-toggle="modal" data-target="#modalER"><i class="fa fa-edit"></i></button>';
                }
                echo '
                                    <button class="btn btn-primary btnInfoResidente" idResidente="' . $value["id"] . '" data-toggle="modal" data-target="#modalInfo"><i class="fa fa-info"></i></button>
                                    <button class="btn btn-success btnImprimirDoc" idResidenteImp="' . $value["id"] . '"data-toggle="modal" data-target="#modalFormatosRP"><i class="fa fa-print"></i></button>
                                </div>
                            </td>
                        </tr>';
            } elseif ($value["tipo"] == "Tesis") {//TESIS
                echo ' <tr class="table-danger">
                            <td>' . $value["id"] . '</td>
                            <td>' . $value["nombre"] . '</td>
                            <td>' . $value["noControl"] . '</td>
                            <td>' . $value["carrera"] . '</td>
                            <td>' . $value["sexo"] . '</td>
                            <td>' . $value["telefono"] . '</td>
                            <td>' . $value["nombreProyecto"] . '</td>
                            <td>' . $value["tipo"] . '</td>
                            <td>
                                <div class="btn-group">';

                if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == "Administrador") {
                    echo '<button class="btn btn-warning btnEditResidente" idResidenteEdit="' . $value["id"] . '" data-toggle="modal" data-target="#modalER"><i class="fa fa-edit"></i></button>';
                }
                echo '
                                    <button class="btn btn-primary btnInfoResidente" idResidente="' . $value["id"] . '" data-toggle="modal" data-target="#modalInfo"><i class="fa fa-info"></i></button>
                                    <button class="btn btn-success btnImprimirDoc" idResidenteImp="' . $value["id"] . ' "data-toggle="modal" data-target="#modalFormatosT"><i class="fa fa-print"></i></button>
                                </div>
                            </td>
                        </tr>';
            }
        }
    }

    /*=============================================
    MOSTRAR INFO DEL RESIDENTE
    =============================================*/
    public static function ctrMostrarInfoResidentes($item, $valor)
    {
        $tabla = "residentes";
        $respuesta = ModeloResidentes::MdlMostrarInfoResidentes($tabla, $item, $valor);
        return $respuesta;
    }


    /*=============================================
    EDITAR DEL RESIDENTE PARA MOSTRAR INFO EN MODAL
    =============================================*/
    public static function ctrMostrarEditarResidentes($item, $valor)
    {
        $tabla = "residentes";
        $respuesta = ModeloResidentes::MdlMostrarEditResidentes($tabla, $item, $valor);
        return $respuesta;
    }


    /*=============================================
    REGISTRAR RESIDENTES INFORME TECNICO
    =============================================*/

    public static function ctrRegistrarResidentesRP()
    {
        if (isset($_POST["nuevoNoControlRP"])) {

            $tabla1 = "proyecto";
            $tabla2 = "residentes";
            $tipo = 1;

            // Quitarles los residentes a los docentes
            $restarResidente1 = $_POST["nuevoAsesorInt"]; 

            $na = 0;
            $datosProyecto = array(
                "nombreProyecto" => $_POST["nuevoNombreProyecto"],
                "nombreEmpresa" => $_POST["nuevoNombreEmpresa"],
                "asesorExt" => $_POST["nuevoAsesorExt"],
                "asesorInt" => $_POST["nuevoAsesorInt"],
                "revisor1" => $_POST["nuevoRevisor1"],
                "revisor2" => $_POST["nuevoRevisor2"],
                "revisor3" => $na,
                "suplente" => $_POST["nuevoSuplente"]
            );

            $respuestaProyecto = ModeloResidentes::mdlRegistroResidenteProyecto($tabla1, $datosProyecto);

            print_r('ERROR: '.$respuestaProyecto);
            if ($respuestaProyecto == "ok") {

                $revisarProyecto = ModeloResidentes::mdlRevisarPro($tabla1, $datosProyecto);

                $datosResidente = array(
                    "noControl" => $_POST["nuevoNoControlRP"],
                    "carrera" => $_POST["nuevoCarrera"],
                    "periodo" => $_POST["nuevoPeriodo"],
                    "anio" => $_POST["nuevoPeriodoAnio"],
                    "nombre" => $_POST["nuevoNombre"],
                    "apellidoP" => $_POST["nuevoApellidoP"],
                    "apellidoM" => $_POST["nuevoApellidoM"],
                    "sexo" => $_POST["nuevoSexo"],
                    "telefono" => $_POST["nuevoTelefono"],
                    "tipo_registro" => $tipo,
                    "proyecto_id" => $revisarProyecto["id"]
                );

                $resResidente = ModeloResidentes::mdlRegistroResidenteDatos($tabla2, $datosResidente);

                if ($resResidente == "ok") {
                        echo '<script>
                    Swal.fire({
                        type: "success",
                        title: "¡Exito!",
                        text: "¡Se registro correctamente!",					   
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"				   
                    }).then((result)=>{
                        if(result.value){
                            window.location = "Residentes";
                        }
                        });
                    </script>';
                    //TODO: RESTAR SOLO AL ASESOR
                    $tablaDocente = "asesor";
                    $res1 = ModeloResidentes::mdlRestarResidente($tablaDocente, $restarResidente1);

              
                } else {
                    echo '<script>
                    Swal.fire({
                         type: "error",
                        title: "¡Error!",
                        text: "¡No se pudo registrar!",				   
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"				   
                    }).then((result)=>{
                        if(result.value){
                            window.location = "Residentes";
                        }
                        });
                  </script>';
                }
            } else {
                //BORRAR PROYECTO SINO SE PUEDE REGISTRAR
                $revisarProyecto = ModeloResidentes::mdlRevisarPro($tabla1, $datosProyecto);
                $tablaE = "proyecto";
                $revisarProyecto = ModeloResidentes::mdlEliminarPro($tablaE, $revisarProyecto["id"]);
                //TERMINA
                echo '<script>
				Swal.fire({
					 type: "error",
                    title: "¡Error",
                    text: "Revisa los datos del Proyecto.",					   
					showConfirmButton: true,
					confirmButtonText: "Cerrar"				   
				}).then((result)=>{
					if(result.value){
						//window.location = "Residentes";
					}
					});
			  </script>';
            }
        }
    }

    /*=============================================
    REGISTRAR RESIDENTES TESIS
    =============================================*/

    public static function ctrRegistrarResidentesT()
    {
        if (isset($_POST["nuevoNoControlT"])) {

            $tabla1 = "proyecto";
            $tabla2 = "residentes";
            $tipo = 2;
            //$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

            $restarResidente1 = $_POST["nuevoAsesorInt"]; 
            $na = 0;
            $datosProyecto = array(
                "nombreProyecto" => $_POST["nuevoNombreProyecto"],
                "nombreEmpresa" => $_POST["nuevoNombreEmpresa"],
                "asesorExt" => $na,
                "asesorInt" => $_POST["nuevoAsesorInt"],
                "revisor1" => $_POST["nuevoRevisor1"],
                "revisor2" => $_POST["nuevoRevisor2"],
                "revisor3" => $_POST["nuevoRevisor3"],
                "suplente" => $_POST["nuevoSuplente"]
            );

            $respuestaProyecto = ModeloResidentes::mdlRegistroResidenteProyecto($tabla1, $datosProyecto);


            if ($respuestaProyecto == "ok") {

                $revisarProyecto = ModeloResidentes::mdlRevisarPro($tabla1, $datosProyecto);

                $datosResidente = array(
                    "noControl" => $_POST["nuevoNoControlT"],
                    "carrera" => $_POST["nuevoCarrera"],
                    "periodo" => $_POST["nuevoPeriodo"],
                    "anio" => $_POST["nuevoPeriodoAnio"],
                    "nombre" => $_POST["nuevoNombre"],
                    "apellidoP" => $_POST["nuevoApellidoP"],
                    "apellidoM" => $_POST["nuevoApellidoM"],
                    "sexo" => $_POST["nuevoSexo"],
                    "telefono" => $_POST["nuevoTelefono"],
                    "tipo_registro" => $tipo,
                    "proyecto_id" => $revisarProyecto["id"]
                );

                $resResidente = ModeloResidentes::mdlRegistroResidenteDatos($tabla2, $datosResidente);
                if ($resResidente == "ok") {
                    echo '<script>
				Swal.fire({
					 type: "success",
                     title: "¡Exito!",
                     text: "¡Se registro correctamente!",					   
					showConfirmButton: true,
					confirmButtonText: "Cerrar"				   
				}).then((result)=>{
					if(result.value){
						window.location = "Residentes";
					}
					});
              </script>';
              $tablaDocente = "asesor";
              $res1 = ModeloResidentes::mdlRestarResidente($tablaDocente, $restarResidente1);
                } else {
                    echo '<script>
                    Swal.fire({
                         type: "error",
                         title: "¡Error!",
                         text: "¡No se pudo registrar!",					   
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"				   
                    }).then((result)=>{
                        if(result.value){
                            window.location = "Residentes";
                        }
                        });
                  </script>';
                }
            } else {
                //BORRAR PROYECTO SINO SE PUEDE REGISTRAR
                $revisarProyecto = ModeloResidentes::mdlRevisarPro($tabla1, $datosProyecto);
                $tablaE = "proyecto";
                $revisarProyecto = ModeloResidentes::mdlEliminarPro($tablaE, $revisarProyecto["id"]);
                //TERMINA
                echo '<script>
				Swal.fire({
					 type: "error",
                    title: "¡Error!",
                    text: "Revisa los datos del Proyecto.",					   
					showConfirmButton: true,
					confirmButtonText: "Cerrar"				   
				}).then((result)=>{
					 if(result.value){
					 	window.location = "Residentes";
					 }
					});
			  </script>';
            }
        }
    }

    /*===================================================================
    EDITAR RESIDENTES INFORME TECNICO && RESIDENCIAS PROFESIONALES
    ===================================================================*/

    public static function ctrEditarResidente()
    {
        if (isset($_POST["editTipo"]) && $_POST["editTipo"] == "Residencias Profesionales") {

            $tabla1 = "proyecto";
            $tabla2 = "residentes";
            $tipo = 1;
            $NoRevicion = 0;

            // Revicioness
            if($_POST["customCheck1"]){
                $NoRevicion = 1;
            }
            if ($_POST["customCheck2"]) {
                $NoRevicion = 2;
            }
            if ($_POST["customCheck3"]) {
                $NoRevicion = 3;
            }



            $na = 0;
            $datosProyecto = array(
                "idP" => $_POST["idProyectoEdit"],
                "nombreProyecto" => $_POST["editNombreProyecto"],
                "nombreEmpresa" => $_POST["editNombreEmpresa"],
                "asesorExt" => $_POST["editAsesorExt"],
                "asesorInt" => $_POST["editAsesorInt"],
                "revisor1" => $_POST["editRevisor1"],
                "revisor2" => $_POST["editRevisor2"],
                "revisor3" => $na,
                "suplente" => $_POST["editSuplente"]
            );

            $respuestaProyecto = ModeloResidentes::mdlEditResidenteProyecto($tabla1, $datosProyecto);


            if ($respuestaProyecto == "ok") {

                $revisarProyecto = ModeloResidentes::mdlRevisarPro($tabla1, $datosProyecto);

                if ($_POST["editCarrera"] == "ISC") {
                    $var1 = "Ingenieria en Sistemas Computacionales";
                } elseif ($_POST["editCarrera"] == "II") {
                    $var1 = "Ingenieria Informatica";
                }

                $datosResidente = array(
                    "idRe" => $_POST["idResidenteEdit"],
                    "noControl" => $_POST["editNoControlEdit"],
                    "carrera" => $var1,
                    "periodo" => $_POST["editPeriodo"],
                    "anio" => $_POST["editPeriodoAnio"],
                    "nombre" => $_POST["editNombre"],
                    "apellidoP" => $_POST["editApellidoP"],
                    "apellidoM" => $_POST["editApellidoM"],
                    "sexo" => $_POST["editSexo"],
                    "telefono" => $_POST["editTelefono"],
                    "revisionOK" => $NoRevicion,
                    "tipo_registro" => $tipo,
                    "proyecto_id" => $revisarProyecto["id"]
                );

                $resResidente = ModeloResidentes::mdlEditResidenteDatos($tabla2, $datosResidente);

                if ($resResidente == "ok") {
                    echo '<script>
				Swal.fire({
					 type: "success",
                     title: "¡Exito!",
                     text: "¡Se actualizo correctamente!",						   
					showConfirmButton: true,
					confirmButtonText: "Cerrar"				   
				}).then((result)=>{
					if(result.value){
						window.location = "Residentes";
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
                            window.location = "Residentes";
                        }
                        });
                  </script>';
                }
            } else {
                //BORRAR PROYECTO SINO SE PUEDE REGISTRAR
                $revisarProyecto = ModeloResidentes::mdlRevisarPro($tabla1, $datosProyecto);
                $tablaE = "proyecto";
                $revisarProyecto = ModeloResidentes::mdlEliminarPro($tablaE, $revisarProyecto["id"]);
                //TERMINA
                var_dump($respuestaProyecto);
                echo '<script>
				Swal.fire({
					 type: "error",
                    title: "¡Error!",
                    text: "Revisa los datos del Proyecto.",					   
					showConfirmButton: true,
					confirmButtonText: "Cerrar"				   
				}).then((result)=>{
					if(result.value){
						//window.location = "Residentes";
					}
					});
			  </script>';
            }
        } else {
            if (isset($_POST["editTipo"]) && $_POST["editTipo"] == "Tesis Profesional") {
            $tabla1 = "proyecto";
            $tabla2 = "residentes";
            $tipo = 2;
            $NoRevicion = 0;

            // Revicioness
            // if($_POST["customCheck1"]){
            //     $NoRevicion = 1;
            // }
            // if ($_POST["customCheck2"]) {
            //     $NoRevicion = 2;
            // }
            // if ($_POST["customCheck3"]) {
            //     $NoRevicion = 3;
            // }
            if ($_POST["CheckTesis"]) {
                $NoRevicion = 3;
            }else{
                $NoRevicion = 0;
            }


            $na = "";
            $datosProyecto = array(
                "idP" => $_POST["idProyectoEdit"],
                "nombreProyecto" => $_POST["editNombreProyecto"],
                "nombreEmpresa" => $_POST["editNombreEmpresa"],
                "asesorExt" => $na,
                "asesorInt" => $_POST["editAsesorInt"],
                "revisor1" => $_POST["editRevisor1"],
                "revisor2" => $_POST["editRevisor2"],
                "revisor3" => $_POST["editRevisor3"],
                "suplente" => $_POST["editSuplente"]
            );

            $respuestaProyecto = ModeloResidentes::mdlEditResidenteProyecto($tabla1, $datosProyecto);


            if ($respuestaProyecto == "ok") {

                $revisarProyecto = ModeloResidentes::mdlRevisarPro($tabla1, $datosProyecto);

                if ($_POST["editCarrera"] == "ISC") {
                    $var1 = "Ingenieria en Sistemas Computacionales";
                } elseif ($_POST["editCarrera"] == "II") {
                    $var1 = "Ingenieria Informatica";
                }

                $datosResidente = array(
                    "idRe" => $_POST["idResidenteEdit"],
                    "noControl" => $_POST["editNoControlEdit"],
                    "carrera" => $var1,
                    "periodo" => $_POST["editPeriodo"],
                    "anio" => $_POST["editPeriodoAnio"],
                    "nombre" => $_POST["editNombre"],
                    "apellidoP" => $_POST["editApellidoP"],
                    "apellidoM" => $_POST["editApellidoM"],
                    "sexo" => $_POST["editSexo"],
                    "telefono" => $_POST["editTelefono"],
                    "revisionOK" => $NoRevicion,
                    "tipo_registro" => $tipo,
                    "proyecto_id" => $revisarProyecto["id"]
                );

                $resResidente = ModeloResidentes::mdlEditResidenteDatos($tabla2, $datosResidente);

                if ($resResidente == "ok") {
                    echo '<script>
				Swal.fire({
					 type: "success",
                     title: "¡Exito!",
                     text: "¡Se actualizo correctamente!",						   
					showConfirmButton: true,
					confirmButtonText: "Cerrar"				   
				}).then((result)=>{
					if(result.value){
						window.location = "Residentes";
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
                            window.location = "Residentes";
                        }
                        });
                  </script>';
                }
            } else {
                //BORRAR PROYECTO SINO SE PUEDE REGISTRAR
                $revisarProyecto = ModeloResidentes::mdlRevisarPro($tabla1, $datosProyecto);
                $tablaE = "proyecto";
                $revisarProyecto = ModeloResidentes::mdlEliminarPro($tablaE, $revisarProyecto["id"]);
                //TERMINA
                var_dump($respuestaProyecto);
                echo '<script>
				Swal.fire({
					 type: "error",
                    title: "¡Error!",
                    text: "Revisa los datos del Proyecto.",					   
					showConfirmButton: true,
					confirmButtonText: "Cerrar"				   
				}).then((result)=>{
					if(result.value){
						//window.location = "Residentes";
					}
					});
			  </script>';
            }
            }
        }
    }
}
