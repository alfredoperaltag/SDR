<?php
require_once "conexion.php";

class ModeloDocentesJerarquia
{

    /*=============================================
    MOSTRAR DOCENTES
    =============================================*/
    public static function MdlMostrarDocentesJerarquia($tabla, $item, $valor)
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
    MOSTRAR DOCENTES EN DICTAMEN
    =============================================*/
    public static function MdlMostrarDocentesDictamen($tabla, $item)
    {
        $stmt = Conexion::conectar()->prepare("SELECT nombre, sexo FROM $tabla WHERE cargo = :item");
        $stmt->execute(['item' => $item]);
        return $stmt->fetch();

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
	REGISTRO DE JERARQUIA
    =============================================*/
    static public function mdlRegistroJerarquia($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, cargo, sexo) VALUES (:nombre, :cargo, :sexo)");

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);
        $stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
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
	EDITAR Jerarquia
    =============================================*/
    static public function mdlEditarJerarquia($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, cargo = :cargo, sexo = :sexo WHERE id = :id");
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);
        $stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            // print_r($stmt->errorInfo());
            return "ok";
        } else {
            // print_r($stmt->errorInfo());
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
    /*=============================================
	BORRAR Jerarquia
    =============================================*/
    static public function mdlBorrarJerarquia($tabla, $datos)
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
