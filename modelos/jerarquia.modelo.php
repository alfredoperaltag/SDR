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
        $stmt = Conexion::conectar()->prepare("SELECT nombre FROM $tabla WHERE cargo = :item");
        $stmt->execute(['item' => $item]);
        return $stmt->fetch();

        $stmt->close();
        $stmt = null;
    }

}
