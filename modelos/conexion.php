<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=sdr","root","");
		// $link = new PDO("mysql:host=localhost;dbname=sdr","root","patas");
		$link->exec("set names utf8");
		return $link;
	}

}
