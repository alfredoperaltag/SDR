<?php
 // $ruta = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME'])) . "/";
/* $ruta = "http://localhost/sdr/"; */
$ruta = "C:laragon/www/SDR/";
// echo $ruta;
require_once $ruta . "controladores/plantilla.controlador.php";
require_once $ruta . "controladores/usuarios.controlador.php";
require_once $ruta . "controladores/residentes.controlador.php";
require_once $ruta . "controladores/docentes.controlador.php";


require_once $ruta . "modelos/usuarios.modelo.php";
require_once $ruta . "modelos/residentes.modelo.php";
require_once $ruta . "modelos/docentes.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
