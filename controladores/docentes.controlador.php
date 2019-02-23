<?php
class ControladorDocentes
{
    public static function ctrCrearDocente()
    {
        if (isset($_POST["nuevoNombre"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["nuevoNombre"])) {
                $tabla = "asesor";
                $datos = array(
                    "nombre" => $_POST["nuevoNombre"]
                );
                $respuesta = modeloDocentes::mdlIngresarDocente($tabla, $datos);
                echo $respuesta;
                if ($respuesta == "ok") {
                    echo '<script>
                    Swal.fire({
                    type: "success",
                    title: "!Registrado Correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then((result)=>{
                    if(result.value){
                       window.location = "Docentes";
                    }
                    });
                    </script>';
                }
            } else {
                echo '<script>
				   Swal.fire({
						type: "error",
					   title: "!El campo nombre no puede estar vacio o llevar caracteres especiales",
					   showConfirmButton: true,
					   confirmButtonText: "Cerrar",
					   closeOnConfirm: false
				   }).then((result)=>{
					   if(result.value){
						   window.location = "Docentes";
					   }
					   });
				 </script>';
            }
        }
    }
    /*=============================================
    MOSTRAR DOCENTE
    =============================================*/
    public static function ctrMostrarDocentes($item, $valor)
    {
        $tabla = "asesor";
        $respuesta = ModeloDocentes::MdlMostrarDocentes($tabla, $item, $valor);
        return $respuesta;
    }
    /*=============================================
    EDITAR USUARIO
    =============================================*/
    public static function ctrEditarDocente()
    {
        if (isset($_POST["editarUsuario"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarUsuario"])) {
                $tabla = "usuarios";
                if ($_POST["editarPassword"] != "" || $_POST["confirmarPassword"] != "") {
                    if ($_POST["editarPassword"] != $_POST["confirmarPassword"]) {
                        echo '<script>
				   Swal.fire({
						type: "error",
					   title: "!La contraseña NO Coincide!",
					   showConfirmButton: true,
					   confirmButtonText: "Cerrar",
					   closeOnConfirm: false
				   }).then((result)=>{
					   if(result.value){
						   window.location = "Usuarios";
					   }
					   });
				 </script>';
                    } else if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {
                        $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                    } else {
                        echo '<script>
				   Swal.fire({
						type: "error",
					   title: "!La contraseña no puede estar vacio o llevar caracteres especiales",
					   showConfirmButton: true,
					   confirmButtonText: "Cerrar",
					   closeOnConfirm: false
				   }).then((result)=>{
					   if(result.value){
						   window.location = "Usuarios";
					   }
					   });
				 </script>';
                    }
                } else {
                    $encriptar = $_POST["passwordActual"];
                }
                $datos = array(
                    "nombre" => $_POST["editarNombre"],
                    "usuario" => $_POST["editarUsuario"],
                    "password" => $encriptar,
                    "perfil" => $_POST["editarPerfil"],
                );
                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);
                if ($respuesta == "ok") {
                    echo '<script>
			   Swal.fire({
					type: "success",
				   title: "!Modificado Correctamente",
				   showConfirmButton: true,
				   confirmButtonText: "Cerrar",
				   closeOnConfirm: false
			   		}).then((result)=>{
				   if(result.value){
					   window.location = "Usuarios";
				   }
				   });
			 </script>';
                }
            } else {
                echo '<script>
				Swal.fire({
					 type: "error",
					title: "!El usuario no puede estar vacio o llevar caracteres especiales",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result)=>{
					if(result.value){
						window.location = "Usuarios";
					}
					});
			  </script>';
            }
        }
    }
}
?>