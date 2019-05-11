<?php
require_once "conexion.php";

class ModeloDocentes
{
    /*=============================================
	MOSTRAR DOCENTES
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
	REGISTRO DE DOCENTES
    =============================================*/
    static public function mdlIngresarDocente($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, setResidentes) VALUES (:nombre, :setResidentes)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":setResidentes", $datos["setResidentes"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    /*=============================================
	EDITAR DOCENTES
    =============================================*/
    static public function mdlEditarDocente($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, setResidentes = :setResidentes WHERE id = :id");
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":setResidentes", $datos["setResidentes"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    /*=============================================
	ACTUALIZAR DOCENTE
    =============================================*/
    static public function mdlActualizarDocente($tabla, $item1, $valor1, $item2, $valor2)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":" .$item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" .$item2, $valor2, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt = null;
    }
    /*=============================================
	BORRAR DOCENTE
    =============================================*/
    static public function mdlBorrarDocente($tabla, $datos)
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
    /*=============================================
	PONER EN CERO LOS DOCENTES
    =============================================*/
    static public function mdlEditarCeroDocente($tabla){
        $stmt = Conexion::conectar()->prepare("UPDATE ".$tabla." SET ".$tabla.".noResidentes = 0, ".$tabla.".setResidentes = 0;");
        if ($stmt->execute()) {
            return "ok";
        } else {
            return print_r($stmt->errorInfo()).$valor;
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    /*=============================================
	INFORMACION DOCENTES
	=============================================*/
    static public function MdlInfoDocentes($tabla, $valor)
    {

        
            // $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt = Conexion::conectar()->prepare("SELECT (select asesor.nombre FROM asesor WHERE asesor.id = :$valor) AS 'nombre', 
            (select COUNT(proyecto.asesorInt) FROM $tabla WHERE proyecto.asesorInt = :$valor) AS 'asesorA', 
            (select COUNT(proyecto.revisor1) FROM $tabla WHERE proyecto.revisor1 = :$valor) AS 'revisor1A', 
            (select COUNT(proyecto.revisor2) FROM $tabla WHERE proyecto.revisor2 = :$valor) AS 'revisor2A', 
            (select COUNT(proyecto.revisor3) FROM $tabla WHERE proyecto.revisor3 = :$valor) AS 'revisor3A', 
            (select COUNT(proyecto.suplente) FROM $tabla WHERE proyecto.suplente = :$valor) AS 'suplenteA' 
            FROM proyecto WHERE proyecto.id = 0;");
            $stmt->bindParam(":" . $valor, $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        
        $stmt->close();
        $stmt = null;
    }
}
 