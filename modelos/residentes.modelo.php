<?php

require_once "conexion.php";

class ModeloResidentes
{

    /*=============================================
	MOSTRAR ASESORES/REVISORES/SUPLENTES
	=============================================*/

    static public function MdlMostrarDocentes($tabla, $item)
    {

        if ($item != null) {
            // $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item < $valor");
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item < setResidentes");
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
	MOSTRAR RESIDENTES EN TABLA PRINCIPAL
	=============================================*/

    static public function MdlMostrarResidentesEnTabla($tabla, $item, $valor)
    {

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT residentes.id, residentes.noControl, concat(residentes.nombre,' ',residentes.apellidoP,' ',residentes.apellidoM)
			AS 'nombre', residentes.carrera, residentes.sexo, residentes.telefono, IF(residentes.tipo_registro = '1', 
			'Residencias', 'Tesis') AS tipo, proyecto.nombreProyecto, asesor.nombre AS asesorIn FROM residentes 
			INNER JOIN proyecto ON  residentes.proyecto_id=proyecto.id
			INNER JOIN asesor ON proyecto.asesorInt = asesor.id;");
            // $stmt = Conexion::conectar()->prepare("SELECT residentes.id, residentes.noControl, concat(residentes.nombre,' ',residentes.apellidoP,' ',residentes.apellidoM)
			// AS 'nombre', residentes.carrera, residentes.sexo, residentes.telefono, IF(residentes.tipo_registro = '1', 'Residencias', 'Tesis') AS tipo, proyecto.nombreProyecto FROM residentes INNER JOIN proyecto ON residentes.proyecto_id=proyecto.id;");
            // $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla INNER JOIN proyecto ON residentes.proyecto_id=proyecto.id;");
            // $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        $stmt->close();
        $stmt = null;
    }


    /*=============================================
	MOSTRAR INFORMACION DE RESIDENTES
	=============================================*/

    static public function MdlMostrarInfoResidentes($tabla, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT residentes.noControl, concat(residentes.nombre, ' ', residentes.apellidoP, ' ',residentes.apellidoM) AS 'nombre', 
        residentes.carrera, concat(IF(residentes.periodo = 'EJ', 'Enero - Junio', 'Agosto - Diciembre'), ' ',  residentes.anio) AS 'periodo',  
        IF(residentes.sexo = 'F', 'Femenino', 'Masculino') AS 'sexo',  residentes.telefono, residentes.revisionOK,  IF(residentes.tipo_registro = '1', 'Residencias Profesionales', 'Tesis Profecional') AS 'tipo_registro',  
        proyecto.nombreProyecto, proyecto.nombreEmpresa, IF(residentes.tipo_registro = '2', '---', proyecto.asesorExt) AS 'asesorExt', asesorIntA.nombre AS 'asesorInt', revisorA.nombre AS 'revisor1', revisorB.nombre AS 'revisor2', 
        IF(residentes.tipo_registro = '1','---',revisorC.nombre) AS 'revisor3', IF(residentes.tipo_registro = '2','---',suplenteA.nombre) AS 'suplente', residentes.anio AS anio, residentes.periodo AS semestre 
        FROM " . $tabla . "
        inner join proyecto on residentes.proyecto_id = proyecto.id  
        inner JOIN asesor AS asesorIntA ON proyecto.asesorInt = asesorIntA.id 
        inner join asesor AS revisorA ON proyecto.revisor1 = revisorA.id 
        inner join asesor AS revisorB ON proyecto.revisor2 = revisorB.id 
        inner join asesor AS revisorC ON proyecto.revisor3 = revisorC.id 
        inner join asesor AS suplenteA ON proyecto.suplente = suplenteA.id 
        WHERE residentes.id = :id");

        $stmt->bindParam(":$item", $valor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        /* return $stmt->fetchAll(); */
        $stmt->close();
        $stmt = null;
    }


    /*=============================================
	EDITAR RESIDENTES
	=============================================*/

    static public function MdlMostrarEditResidentes($tabla, $item, $valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT residentes.id AS 'idR', residentes.noControl, IF(residentes.carrera = 'Ingenieria en Sistemas Computacionales', 'ISC', 'II') AS 'carrera', residentes.periodo, residentes.anio,
        residentes.nombre, residentes.apellidoP, residentes.apellidoM, 
        residentes.sexo, residentes.telefono, residentes.revisionOk AS 'revision', IF(residentes.tipo_registro = 1, 'Residencias Profesionales','Tesis Profesional') AS 'tipo', proyecto.id AS 'idP', proyecto.nombreProyecto, 
        proyecto.nombreEmpresa, proyecto.asesorInt, proyecto.asesorExt, proyecto.revisor1, proyecto.revisor2, 
        proyecto.revisor3, proyecto.suplente
        FROM residentes 
        INNER JOIN proyecto ON residentes.proyecto_id = proyecto.id
        WHERE residentes.id = :id");

        $stmt->bindParam(":id", $valor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
        $stmt->close();
        $stmt = null;
    }


    /*=============================================
	REGISTRO DE RESIDENTE
	=============================================*/

    static public function mdlRegistroResidenteProyecto($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreProyecto, nombreEmpresa, asesorExt, asesorInt, revisor1, revisor2, revisor3, suplente) 
														VALUES (:nombreProyecto, :nombreEmpresa, :asesorExt, :asesorInt, :revisor1, :revisor2, :revisor3, :suplente)");
        //aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        $stmt->bindParam(":nombreProyecto", $datos["nombreProyecto"], PDO::PARAM_STR);
        $stmt->bindParam(":nombreEmpresa", $datos["nombreEmpresa"], PDO::PARAM_STR);
        $stmt->bindParam(":asesorExt", $datos["asesorExt"], PDO::PARAM_STR);
        $stmt->bindParam(":asesorInt", $datos["asesorInt"], PDO::PARAM_INT);
        $stmt->bindParam(":revisor1", $datos["revisor1"], PDO::PARAM_INT);
        $stmt->bindParam(":revisor2", $datos["revisor2"], PDO::PARAM_INT);
        $stmt->bindParam(":revisor3", $datos["revisor3"], PDO::PARAM_INT);
        $stmt->bindParam(":suplente", $datos["suplente"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "E: ".$stmt->errorInfo();
            // return 'error';
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
	REVISA PROYECTO
	=============================================*/

    static public function mdlRevisarPro($tabla, $dato)
    {
        // echo '<script>console.log("P1: '.$tabla.' - '. $dato .'");</script>';
        $stmt = Conexion::conectar()->prepare("SELECT id FROM $tabla WHERE nombreProyecto = :nombre");
        $stmt->bindParam(":nombre", $dato, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    /*=============================================
	ELIMINAR PROYECTO SI SALE MAL EL REGISTRO
	=============================================*/

    static public function mdlEliminarPro($tabla, $dato)
    {
        // echo '<script>console.log("P2: '.$tabla.' - '. $dato .'");</script>';
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :idPro");
        $stmt->bindParam(":idPro", $dato, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }


    /*=============================================
	REGISTRAR DATOS DEL RESIDENTE
	=============================================*/
    static public function mdlRegistroResidenteDatos($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(noControl, nombre, apellidoP, apellidoM, carrera, periodo, anio, sexo, telefono, tipo_registro, proyecto_id) 
														VALUES (:noControl, :nombre, :apellidoP, :apellidoM, :carrera, :periodo, :anio, :sexo, :telefono, :tipo_registro, :proyecto_id)");
        //aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        $stmt->bindParam(":noControl", $datos["noControl"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidoP", $datos["apellidoP"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidoM", $datos["apellidoM"], PDO::PARAM_STR);
        $stmt->bindParam(":carrera", $datos["carrera"], PDO::PARAM_STR);
        $stmt->bindParam(":periodo", $datos["periodo"], PDO::PARAM_STR);
        $stmt->bindParam(":anio", $datos["anio"], PDO::PARAM_STR);
        $stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_registro", $datos["tipo_registro"], PDO::PARAM_INT);
        $stmt->bindParam(":proyecto_id", $datos["proyecto_id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "E: ".$stmt->errorInfo();
            // return 'error';
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
	  RESTAR RESIDENTES A LOS ASESORES
	=============================================*/
    static public function mdlRestarResidente($tabla, $dato)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET noResidentes=noResidentes-1 WHERE id = :id");
        $stmt->execute(['id' => $dato]);
        return $stmt->fetch();
    }

    /*=============================================
	  SUMAR RESIDENTES A LOS ASESORES
	=============================================*/
    static public function mdlSumarResidente($tabla, $dato)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET noResidentes=noResidentes+1 WHERE id = :id");
        $stmt->execute(['id' => $dato]);
        return $stmt->fetch();
    }


    /*=============================================
	EDITAR PROYECTO DE RESIDENTE
	=============================================*/

    static public function mdlEditResidenteProyecto($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla
        SET nombreProyecto = :editNameProyecto, nombreEmpresa = :editEmpresa, asesorExt = :asesorExt, 
        asesorInt = :asesorInt, revisor1 = :revisor1, revisor2 = :revisor2, suplente = :suplente, 
        revisor3 = :revisor3
        WHERE id = :idP");

        $stmt->bindParam(":idP", $datos["idP"], PDO::PARAM_INT);
        $stmt->bindParam(":editNameProyecto", $datos["nombreProyecto"], PDO::PARAM_STR);
        $stmt->bindParam(":editEmpresa", $datos["nombreEmpresa"], PDO::PARAM_STR);
        $stmt->bindParam(":asesorExt", $datos["asesorExt"], PDO::PARAM_STR);
        $stmt->bindParam(":asesorInt", $datos["asesorInt"], PDO::PARAM_INT);
        $stmt->bindParam(":revisor1", $datos["revisor1"], PDO::PARAM_INT);
        $stmt->bindParam(":revisor2", $datos["revisor2"], PDO::PARAM_INT);
        $stmt->bindParam(":suplente", $datos["suplente"], PDO::PARAM_INT);
        $stmt->bindParam(":revisor3", $datos["revisor3"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            // print_r($stmt->errorInfo());
            // return "error";
            return "ERROR: " . $stmt->errorInfo();
        }

        $stmt->close();
        $stmt = null;
    }



    /*=============================================
	REGISTRAR DATOS DEL RESIDENTE
	=============================================*/
    static public function mdlEditResidenteDatos($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla
        SET noControl = :noControl, nombre = :nombre, apellidoP = :apellidoP, apellidoM = :apellidoM, 
        carrera = :carrera, periodo = :periodo, anio = :anio, sexo = :sexo,  telefono = :telefono, 
        revisionOK = :revision, tipo_registro = :tipo, proyecto_id = :proyecto_id
        WHERE id = :id;");
        //aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        $stmt->bindParam(":id", $datos["idRe"], PDO::PARAM_INT);
        $stmt->bindParam(":noControl", $datos["noControl"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidoP", $datos["apellidoP"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidoM", $datos["apellidoM"], PDO::PARAM_STR);
        $stmt->bindParam(":carrera", $datos["carrera"], PDO::PARAM_STR);
        $stmt->bindParam(":periodo", $datos["periodo"], PDO::PARAM_STR);
        $stmt->bindParam(":anio", $datos["anio"], PDO::PARAM_STR);
        $stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":revision", $datos["revisionOK"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo", $datos["tipo_registro"], PDO::PARAM_INT);
        $stmt->bindParam(":proyecto_id", $datos["proyecto_id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }
}
