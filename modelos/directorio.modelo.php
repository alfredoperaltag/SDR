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

    /*=============================================
	LLENAR EL MODAL EDITAR DIRECTORIO
	=============================================*/

    static public function MdlMostrarEditDirectorio($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM directorio WHERE id = :id");
        $stmt->bindParam(":id", $valor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }

    /*=============================================
	EDITAR PROYECTO DE RESIDENTE
	=============================================*/

    static public function mdlEditDirectorio($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla
        SET noExt = :noExt, depto = :depto, responsable = :responsable
        WHERE id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":noExt", $datos["extension"], PDO::PARAM_STR);
        $stmt->bindParam(":depto", $datos["departamento"], PDO::PARAM_STR);
        $stmt->bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r($stmt->errorInfo());
            // return "error";
            return "ERROR: " . $stmt->errorInfo();
        }

        $stmt->close();
        $stmt = null;
    }


}