<?php
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/residentes.controlador.php";
require_once "controladores/docentes.controlador.php";


require_once "modelos/usuarios.modelo.php";
require_once "modelos/residentes.modelo.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();