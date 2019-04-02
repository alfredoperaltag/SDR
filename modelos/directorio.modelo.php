<?php



require_once "conexion.php";

class ModeloDirectorio
{

/*=============================================
	MOSTRAR ASESORES/REVISORES/SUPLENTES
	=============================================*/

    static public function MdlMostrarDirectorio($tabla, $item, $valor)
    {

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item < $valor");
            $stmt->execute();
            // return $stmt -> fetch();
            return $stmt->fetchAll(); //Para ver todos los docentes pero solo los que tienen menos de 7 residentes
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }
}