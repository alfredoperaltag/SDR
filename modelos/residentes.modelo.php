<?php

require_once "conexion.php";

class ModeloResidentes{
	
    /*=============================================
	MOSTRAR ASESORES/REVISORES/SUPLENTES
	=============================================*/

	static public function MdlMostrarDocentes($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item < $valor");
			$stmt -> execute();
			// return $stmt -> fetch();
			return $stmt -> fetchAll();//Para ver todos los docentes pero solo los que tienen menos de 7 residentes
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}


	/*=============================================
	MOSTRAR RESIDENTES EN TABLA PRINCIPAL
	=============================================*/

	static public function MdlMostrarResidentesEnTabla($tabla, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT residentes.id, residentes.noControl, concat(residentes.nombre,' ',residentes.apellidoP,' ',residentes.apellidoM)
			AS 'nombre', residentes.carrera, residentes.sexo, residentes.telefono, IF(residentes.tipo_registro = '1', 'Residencias', 'Tesis') AS tipo, proyecto.nombreProyecto FROM residentes INNER JOIN proyecto ON residentes.proyecto_id=proyecto.id;");
			// $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla INNER JOIN proyecto ON residentes.proyecto_id=proyecto.id;");
			// $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}

	/*=============================================
	REGISTRO DE RESIDENTE
	=============================================*/

	static public function mdlRegistroResidenteProyecto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombreProyecto, nombreEmpresa, asesorExt, asesorInt, revisor1, revisor2, suplente, revisor3) 
														VALUES (:nombreProyecto, :nombreEmpresa, :asesorExt, :asesorInt, :revisor1, :revisor2, :suplente, :revisor3)");
		//aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
		$stmt->bindParam(":nombreProyecto", $datos["nombreProyecto"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreEmpresa", $datos["nombreEmpresa"], PDO::PARAM_STR);
		$stmt->bindParam(":asesorExt", $datos["asesorExt"], PDO::PARAM_STR);
		$stmt->bindParam(":asesorInt", $datos["asesorInt"], PDO::PARAM_INT);
		$stmt->bindParam(":revisor1", $datos["revisor1"], PDO::PARAM_INT);
		$stmt->bindParam(":revisor2", $datos["revisor2"], PDO::PARAM_INT);
		$stmt->bindParam(":suplente", $datos["suplente"], PDO::PARAM_INT);
		$stmt->bindParam(":revisor3", $datos["revisor3"], PDO::PARAM_INT);

		if($stmt->execute()){
			return "ok";	
		}else{
			return "error";
		}

		$stmt->close();
		$stmt = null;

	}



}