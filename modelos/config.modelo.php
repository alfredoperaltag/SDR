<?php
require_once "conexion.php";

class ModeloConfig
{

    /*=============================================
	    CARGAR CONFIG
	=============================================*/
    static public function MdlCargarConfig($tabla, $item, $valor)
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

    /*<!--=====================================
    ACTUALIZAR VALOR CONFIG PRE-REGISTRO
    ======================================-->*/
    static public function mdlActualizarValorConfig($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET valor = :valor WHERE id = :id");
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":valor", $datos["valor"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            print_r($stmt->errorInfo());
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
}