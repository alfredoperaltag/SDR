<?php
 //Diferntes formas de retornar la direccion del servidor
//$ruta = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME'])) . "/";
//$ruta = "http://localhost/sdr/";
$ruta = "C:laragon/www/SDR/";
require_once $ruta . "controladores/plantilla.controlador.php";
require_once $ruta . "controladores/usuarios.controlador.php";
require_once $ruta . "controladores/residentes.controlador.php";
require_once $ruta . "controladores/docentes.controlador.php";

// echo "HOLAAAA  - ".$ruta;

require_once $ruta . "modelos/usuarios.modelo.php";
require_once $ruta . "modelos/residentes.modelo.php";
require_once $ruta . "modelos/docentes.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
