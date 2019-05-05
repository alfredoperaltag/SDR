<?php
require_once "conexion.php";

class ModeloInicio
{
    /*=============================================
    TOTAL DE RESIDENTES EN NUMERO
    =============================================*/
    public static function MdlMostrarRInicio($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) AS total FROM $tabla WHERE $item = :$item;");
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    GRAFICAR RESIDENTES
    =============================================*/
    public static function MdlMostrarRGrafo($tabla, $item, $valor)
    {
        // $stmt = Conexion::conectar()->prepare("SELECT COUNT(id) AS total FROM $tabla WHERE $item = :$item;");
        $stmt = Conexion::conectar()->prepare("SELECT residentes.".$item." AS tipo, COUNT(*) AS total FROM ".$tabla." GROUP BY residentes.".$item.";");
        // $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
        $stmt = null;
    }
}
