<?php
 //Diferntes formas de retornar la direccion del servidor
//$ruta = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME'])) . "/";
//$ruta = "http://localhost/sdr/";
//$ruta = "C:laragon/www/SDR/";
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/residentes.controlador.php";
require_once "controladores/docentes.controlador.php";
require_once "controladores/directorio.controlador.php";
require_once "controladores/jerarquia.controlador.php";
require_once "controladores/pre-registro.controlador.php";
require_once "controladores/config.controlador.php";
require_once "controladores/inicio.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/residentes.modelo.php";
require_once "modelos/docentes.modelo.php";
require_once "modelos/directorio.modelo.php";
require_once "modelos/jerarquia.modelo.php";
require_once "modelos/pre-registro.modelo.php";
require_once "modelos/config.modelo.php";
require_once "modelos/inicio.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();