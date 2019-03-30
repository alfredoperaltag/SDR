<?php
 //Diferntes formas de retornar la direccion del servidor
//$ruta = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME'])) . "/";
//$ruta = "http://localhost/sdr/";
//$ruta = "C:laragon/www/SDR/";
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/residentes.controlador.php";
require_once "controladores/docentes.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/residentes.modelo.php";
require_once "modelos/docentes.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();

//https://drive.google.com/open?id=1J-UnEVuGjgffOjs306Z-k31dpj9YxrPE
