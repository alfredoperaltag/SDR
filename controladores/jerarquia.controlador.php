<?php
class ControladorJerarquia
{

    /*=============================================
    MOSTRAR DOCENTE EN TABLA
    =============================================*/
    public static function ctrMostrarDocentesJerarquia($item, $valor)
    {

        $tabla = "jerarquia";
        $respuesta = ModeloDocentesJerarquia::MdlMostrarDocentesJerarquia($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    MOSTRAR DOCENTE EN DICTAMEN
    =============================================*/
    public static function ctrMostrarDocentesDictamen($tabla, $item)
    {
        $respuesta = ModeloDocentesJerarquia::MdlMostrarDocentesDictamen($tabla, $item);
        return $respuesta;
    }
    /*=============================================
    EDITAR Jerarquia
    =============================================*/
    public static function ctrEditarJerarquia()
    {

        if (isset($_POST["editarNombre"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["editarNombre"])) {
                $tabla = "jerarquia";
                $datos = array(
                    "id" => $_POST["idJerarquia"],
                    "nombre" => $_POST["editarNombre"],
                    "jerarquia" => $_POST["editarJerarquia"]
                );
                $respuesta = ModeloDocentesJerarquia::mdlEditarJerarquia($tabla, $datos);
                /* echo $datos["id"];
                    echo $respuesta; */
                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                        type: "success",
                        title: "¡Actualizado Correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then((result)=>{
                        if(result.value){
                           window.location = "Jerarquia";
                        }
                        });
                        </script>';
                }
            } else {
                echo '<script>
                       Swal.fire({
                            type: "error",
                           title: "¡El campo nombre no puede estar vacio o llevar caracteres especiales!",
                           showConfirmButton: true,
                           confirmButtonText: "Cerrar",
                           closeOnConfirm: false
                       }).then((result)=>{
                           if(result.value){
                               window.location = "Jerarquia";
                           }
                           });
                     </script>';
            }
        }
    }
    /*=============================================
    BORRAR Jerarquia
    =============================================*/
    public static function ctrborrarJerarquia()
    {
        if (isset($_GET["idJerarquia"])) {
            $tabla = "jerarquia";
            $datos = $_GET["idJerarquia"];

            $respuesta = ModeloDocentesJerarquia::MdlBorrarJerarquia($tabla, $datos);
            if ($respuesta == "ok") {
                echo '<script>
			   Swal.fire({
					type: "success",
				   title: "¡Eliminado Correctamente!",
				   showConfirmButton: true,
				   confirmButtonText: "Cerrar",
				   closeOnConfirm: false
			   }).then((result)=>{
				   if(result.value){
					   window.location = "Jerarquia";
				   }
				   });
			 </script>';
            }
        }
    }
}
