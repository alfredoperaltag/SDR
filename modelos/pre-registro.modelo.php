<?php
require_once "conexion.php";

class ModeloPreRegistro
{

    /*=============================================
    MOSTRAR RESIDENTES EN TABLA
    =============================================*/
    public static function MdlMostrarDocentesJerarquia($tabla, $item, $valor)
    {

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            // $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt = Conexion::conectar()->prepare("SELECT preregistros.* , asesorOK.nombre AS 'asesorR'  FROM preregistros 
            INNER JOIN asesor AS asesorOK ON preregistros.asesorPre = asesorOK.id");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }

    /*=============================================
	PRE-REGISTRO DE RESIDENTES
    =============================================*/
    static public function mdlHacerPreRegistro($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(noControl, carrera, nombre, apellidoP, apellidoM, asesorPre) 
        VALUES (:noControl, :carrera, :nombre, :apellidoP, :apellidoM, :asesorPre)");

        $stmt->bindParam(":noControl", $datos["noControl"], PDO::PARAM_STR);
        $stmt->bindParam(":carrera", $datos["carrera"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidoP", $datos["apellidoP"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidoM", $datos["apellidoM"], PDO::PARAM_STR);
        $stmt->bindParam(":asesorPre", $datos["asesorPre"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r($stmt->errorInfo());
            return "error";

        }
        $stmt->close();
        $stmt = null;
    }

    /*=============================================
	MOSTRAR INFO PARA EDITAR
	=============================================*/
    static public function MdlMostrarDocentes($tabla, $item, $valor)
    {

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }

    /*=============================================
	    EDITAR PRE-REGISTRO
    =============================================*/
    static public function mdlEditarPreRegistro($tabla, $datos){
        if ($datos["aux"] == "1") {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET noControl = :noControl, carrera = :carrera,  nombre = :nombre, apellidoP = :apellidoP, apellidoM = :apellidoM WHERE id = :id");
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":noControl", $datos["noControl"], PDO::PARAM_STR);
        $stmt->bindParam(":carrera", $datos["carrera"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidoP", $datos["apellidoP"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidoM", $datos["apellidoM"], PDO::PARAM_STR);
        // $stmt->bindParam(":asesorPre", $datos["asesorPre"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        }else{
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET noControl = :noControl, carrera = :carrera,  nombre = :nombre, apellidoP = :apellidoP, apellidoM = :apellidoM, asesorPre = :asesorPre WHERE id = :id");
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":noControl", $datos["noControl"], PDO::PARAM_STR);
        $stmt->bindParam(":carrera", $datos["carrera"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidoP", $datos["apellidoP"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidoM", $datos["apellidoM"], PDO::PARAM_STR);
        $stmt->bindParam(":asesorPre", $datos["asesorPre"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        }
        
        $stmt->close();
        $stmt = null;
    }


    /*=============================================
	BORRAR PRE-REGISTRO
    =============================================*/
    static public function mdlBorrarPreRegistro($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt = null;
    }
}
