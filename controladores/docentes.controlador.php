<?php
class ControladorDocentes
{
    public static function ctrCrearDocente()
    {
        if (isset($_POST["nuevoNombre"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"])) {
                echo '<script>
				   Swal.fire({
						type: "error",
					   title: "!BIEN",
					   showConfirmButton: true,
					   confirmButtonText: "Cerrar",
					   closeOnConfirm: false
				   }).then((result)=>{
					   if(result.value){
						   window.location = "Docentes";
					   }
					   });
				 </script>';
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
}
?>