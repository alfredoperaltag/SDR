<?php

class ControladorUsuarios{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/
	static public function ctrIngresoUsuario(){

        

		if(isset($_POST["username"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["username"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])){

			   	$encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			   	// $encriptar = $_POST["password"];
				$tabla = "usuarios";
				$item = "usuario";
                $valor = $_POST["username"];
                
				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				if($respuesta["usuario"] == $_POST["username"] && $respuesta["password"] == $encriptar){

					if($respuesta["estado"] == 1){

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["perfil"] = $respuesta["perfil"];
						$_SESSION["estado"] = $respuesta["estado"];

							echo '<script>

								window.location = "Inicio";

							</script>';			
						
					}else{

						// echo '¡Usuario no activado!';
						echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>¡Usuario no activado!</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span class="fa fa-times"></span>
						</button>
					</div>';
					}		

				}else{

					// echo '¡Usuario o contraseña incorrecta!';
					echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>¡Usuario o contraseña incorrecta!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span class="fa fa-times"></span>
					</button>
				</div>';
					
                    
				}

			}	

		}

	}


/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario(){
		if (isset($_POST["nuevoUsuario"])) {
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){
				   /* $tabla = "usuarios";
				   $datos = array("nombre" => $_POST["nuevoNombre"],
								  "usuario" => $_POST["nuevoUsuario"],
								  "password" => $_POST["nuevoPassword"],
								  "perfil" => $_POST["nuevoPerfil"]								  
								);

					$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);
					if ($respuesta == "ok") {					
						echo '<script>
				   swal({
					   type: "success",
					   title; "¡El usuario ha sido guardado correctamente!",
					   showConfirmButton: true,
					   confirmButtonText: "Cerrar",
					   closeOnConfirm: false
				   }).then((result))=>{
					   if(result.value){
						   window.location = "usuarios";
					   }
					   });
				 </script>';
					} */
			   }else {						 
				   echo '<script>
				   swal({
					   type: "error",
					   title: "!El usuario no puede estar vacio o llevar caracteres especiales",
					   showConfirmButton: true,
					   confirmButtonText: "Cerrar",
					   closeOnConfirm: false
				   }).then((result)=>{
					   if(result.value){
						   window.location = "usuarios";
					   }
					   });
				 </script>';
			   }
		}
	}
}