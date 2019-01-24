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

}