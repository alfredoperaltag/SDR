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
        AGREGAR JERARQUIA
    =============================================*/
    public static function ctrCrearDocente()
    {
        if (isset($_POST["nuevoNombreJ"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["nuevoNombreJ"])) {
                $tabla = "jerarquia";
                $datos = array(
                    "nombre" => $_POST["nuevoNombreJ"],
                    "cargo" => $_POST["nuevoCargoJ"],
                    "sexo" => $_POST["nuevoSexoJ"]
                );
                $respuesta = ModeloDocentesJerarquia::mdlRegistroJerarquia($tabla, $datos);
                echo $respuesta;
                if ($respuesta == "ok") {
                    echo "<script>
                        Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: '¡Exito!',
                            text: '¡Se registro correctamente!',
                            showConfirmButton: false,
                            timer: 1200
                        }).then((result)=>{
                            window.location = 'Jerarquia';
                            });
                        </script>";
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
    MOSTRAR DOCENTE EN DICTAMEN
    =============================================*/
    public static function ctrMostrarDocentesDictamen($tabla, $item)
    {
        $respuesta = ModeloDocentesJerarquia::MdlMostrarDocentesDictamen($tabla, $item);
        return $respuesta;
    }
    /*=============================================
    EDITAR JERARQUIA
    =============================================*/
    public static function ctrEditarJerarquia()
    {

        if (isset($_POST["editarNombreJ"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ. ]+$/', $_POST["editarNombreJ"])) {
                $tabla = "jerarquia";
                $datos = array(
                    "id" => $_POST["idJerarquia"],
                    "nombre" => $_POST["editarNombreJ"],
                    "cargo" => $_POST["editarCargoJ"],
                    "sexo" => $_POST["editarSexoJ"]
                );
                $respuesta = ModeloDocentesJerarquia::mdlEditarJerarquia($tabla, $datos);
                if ($respuesta == "ok") {
                    echo "<script>
                        Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: '¡Exito!',
                            text: '¡Se actualizo correctamente!',
                            showConfirmButton: false,
                            timer: 1100
                        }).then((result)=>{
                            window.location = 'Jerarquia';
                            });
                        </script>";
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
    BORRAR JERARQUIA
    =============================================*/
    public static function ctrborrarJerarquia()
    {
        if (isset($_GET["idJerarquia"])) {
            $tabla = "jerarquia";
            $datos = $_GET["idJerarquia"];

            $respuesta = ModeloDocentesJerarquia::MdlBorrarJerarquia($tabla, $datos);
            if ($respuesta == "ok") {
                echo "<script>
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: '¡Exito!',
                    text: '¡Se elimino correctamente!',
                    showConfirmButton: false,
                    timer: 1500
                }).then((result)=>{
                    window.location = 'Jerarquia';
                    });
                </script>";
            }
        }
    }
}
