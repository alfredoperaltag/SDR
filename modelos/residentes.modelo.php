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

}