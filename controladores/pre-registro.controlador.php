<?php
class ControladorPreRegistro
{

    /*=============================================
    MOSTRAR RESIDENTES EN TABLA
    =============================================*/
    public static function ctrMostrarResidentesPre()
    {
        $item = null;
        $valor = null;
        $tabla = "preregistros";
        $respuesta = ModeloPreRegistro::MdlMostrarDocentesJerarquia($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    PRE-REGISTRAR RESIDENTE
    =============================================*/
    public static function ctrPreRegistrar()
    {
        if (isset($_POST["nuevoNombrePR"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["nuevoNombrePR"])) {
                if ($_POST["nuevoAsesorPRE"] != "NA") {
                    $tabla = "preregistros";
                    $datos = array(
                    "noControl" => $_POST["nuevoNoControlPR"],
                    "carrera" => $_POST["nuevoCarreraPR"],
                    "nombre" => $_POST["nuevoNombrePR"],
                    "apellidoP" => $_POST["nuevoApellidoPPR"],
                    "apellidoM" => $_POST["nuevoApellidoMPR"],
                    "asesorPre" => $_POST["nuevoAsesorPRE"],
                    "telefono" => $_POST["nuevoTelefonoPR"]
                );
                $respuesta = ModeloPreRegistro::mdlHacerPreRegistro($tabla, $datos);
                echo $respuesta;
                if ($respuesta == "ok") {
                    $tablaDocente = "asesor";
                    $res1 = ModeloResidentes::mdlSumarResidente($tablaDocente, $_POST["nuevoAsesorPRE"]);
                echo "<script>
                Swal.fire({
                    position: 'top',
                    type: 'success',
                    title: '¡Pre-registrado Correctamente!',
                    showConfirmButton: false,
                    timer: 1800
                  }).then((result)=>{
                            window.location = 'Pre-Registro';
                     });
                  </script>";
                    
                }else{
                    echo '<script>
				   Swal.fire({
						type: "error",
                       title: "¡Error!",
                       text: "¡No se pudo registrar¡ Verifica bien la información",
					   showConfirmButton: true,
					   confirmButtonText: "Cerrar"
				   }).then((result)=>{
					   if(result.value){
						   window.location = "Pre-Registro";
					   }
					   });
				 </script>';
                    }
                }else{
                    if ($_SESSION['perfil'] == "Administrador") {
                        echo '<script>
				   Swal.fire({
						type: "error",
                       title: "¡Error!",
                       text: "¡No puedes registrar sin asesores! Necesita editar el maximo de residentes de los docentes.",
					   showConfirmButton: true,
					   confirmButtonText: "Cerrar"
				   }).then((result)=>{
					   if(result.value){
						   window.location = "Pre-Registro";
					   }
					   });
                 </script>';
                    }else{
                    echo '<script>
				   Swal.fire({
						type: "error",
                       title: "¡Error!",
                       text: "¡No puedes registrar sin asesores! Un administrador puede solucionarlo, contacta con uno.",
					   showConfirmButton: true,
					   confirmButtonText: "Cerrar"
				   }).then((result)=>{
					   if(result.value){
						   window.location = "Pre-Registro";
					   }
					   });
                 </script>';
                    }
                    }
            } else {
                echo '<script>
				   Swal.fire({
                        type: "error",
                        title: "¡Error!",
                        text: "¡El campo nombre no puede estar vacio o llevar caracteres especiales!",
					   showConfirmButton: true,
					   confirmButtonText: "Cerrar"
				   }).then((result)=>{
					   if(result.value){
						   window.location = "Pre-Registro";
					   }
					   });
				 </script>';
            }
        }
    }

    /*=============================================
    MOSTRAR INFO DE PRE-REGISTRO PARA EDITAR
    =============================================*/
    public static function ctrMostrarInfoPreRegistro($item, $valor)
    {
        $tabla = "preregistros";
        $respuesta = ModeloPreRegistro::MdlMostrarInfoParaEditarPreRegistro($tabla, $item, $valor);
        return $respuesta;
    }


    /*=============================================
        EDITAR PRE-REGISTRO
    =============================================*/
    public static function ctrEditarPreRegistro()
    {
        // {
            if (isset($_POST["editarNoControlPR"])) {
                if ($_POST["editarAsesorPRE"] != "NA" || $_POST["CheckPreRegistroEdit"] == "on") {
                // if ($_POST["editarAsesorPRE"] != "NA") {
                    $tabla = "preregistros";
                    $item = 'id';
                    $valor = $_POST['idPreRegistroEdit'];
                    $DocenteAnterior = ControladorPreRegistro::ctrMostrarInfoPreRegistro($item, $valor);
                    
                    
                    if ($_POST["CheckPreRegistroEdit"] == "on") {
                        $aux = 1;
                    }else{
                        $aux = 0;
                    }
                    $datos = array(
                        "id" => $_POST["idPreRegistroEdit"],
                        "noControl" => $_POST["editarNoControlPR"],
                        "carrera" => $_POST["editarCarreraPR"],
                        "telefono" => $_POST["editarTelefonoPR"],
                        "nombre" => $_POST["editarNombrePR"],
                        "apellidoP" => $_POST["editarApellidoPPR"],
                        "apellidoM" => $_POST["editarApellidoMPR"],
                        "asesorPre" => $_POST["editarAsesorPRE"],
                        "aux" => $aux
                    );
                    $respuesta = ModeloPreRegistro::mdlEditarPreRegistro($tabla, $datos);
                    if ($respuesta == "ok") {
                        $tablaDocente = "asesor";
                        // NOTE corregir resta a asesor
                        if ($_POST["CheckPreRegistroEdit"] != "on") {
                            $res1 = ModeloResidentes::mdlSumarResidente($tablaDocente, $_POST["editarAsesorPRE"]);
                            $res1 = ModeloResidentes::mdlRestarResidente($tablaDocente, $DocenteAnterior['asesorPre']);
                        }
                        echo "<script>
                        Swal.fire({
                            position: 'top',
                            type: 'success',
                            title: '¡Actualizado Correctamente!',
                            showConfirmButton: false,
                            timer: 1100
                        }).then((result)=>{
                                 window.location = 'Pre-Registro';
                            });
                        </script>";
                    }
                }else{
                    echo '<script>
				   Swal.fire({
						type: "error",
                       title: "¡Error!",
                       text: "¡No puedes registrar sin asesores! Si no quieres cambiar el asesor, primero marca el check.",
					   showConfirmButton: true,
					   confirmButtonText: "Cerrar"
				   }).then((result)=>{
					   if(result.value){
						   window.location = "Pre-Registro";
					   }
					   });
				 </script>';
                    }
            }
        // }
    }

    /*=============================================
    BORRAR PRE-REGISTRO
    =============================================*/
    public static function ctrBorrarPreRegistro(){
        if (isset($_GET["idPreRegistro"])) {
            $tabla = "preregistros";
            $datos = $_GET["idPreRegistro"];

            
            $respuesta = ModeloPreRegistro::mdlBorrarPreRegistro($tabla, $datos);
            if ($respuesta == "ok") {
             echo "<script>
                Swal.fire({
                    position: 'top',
                    type: 'success',
                    title: '¡Exito!',
                    text: '¡Eliminado Correctamente!',
                    showConfirmButton: false,
                    timer: 1800
                    }).then((result)=>{
                            window.location = 'Pre-Registro';
                    });
                </script>";
            }
        }
    }

    /*=============================================
    BORRAR PRE-REGISTRO DESPUES DEL REGISTRO
    =============================================*/
    public static function ctrBorrarPreRegistroOK(){
        if (isset($_POST["idResidentePreReR"])) {
            $tabla = "preregistros";
            $datos = $_POST["idResidentePreReR"];

            $respuesta = ModeloPreRegistro::mdlBorrarPreRegistro($tabla, $datos);
            if ($respuesta == "ok") {
             echo "<script>
                Swal.fire({
                    position: 'top',
                    type: 'success',
                    title: '¡Exito!',
                    text: '¡Eliminado Correctamente!',
                    showConfirmButton: false,
                    timer: 1800
                    }).then((result)=>{
                            window.location = 'Residentes';
                    });
                </script>";
            }
        }
    }

    /*=============================================
    VER DOCENTES DISPONIBLES SIN ACTUALIZAR
    =============================================*/
    public static function ctrMostrarDocentesPreRegistro($item)
    {
        $tabla = "asesor";
        $respuesta = ModeloPreRegistro::MdlMostrarDocentesPreRegistro($tabla, $item);
        return $respuesta;
    }

}