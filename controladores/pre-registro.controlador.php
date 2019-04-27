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
                    "asesorPre" => $_POST["nuevoAsesorPRE"]
                );
                $respuesta = ModeloPreRegistro::mdlHacerPreRegistro($tabla, $datos);
                echo $respuesta;
                if ($respuesta == "ok") {
                    $tablaDocente = "asesor";
                    $res1 = ModeloResidentes::mdlRestarResidente($tablaDocente, $_POST["nuevoAsesorPRE"]);
                echo "<script>
                Swal.fire({
                    position: 'top-end',
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

}