<?php 
session_destroy();
$_SESSION = array();

echo '<script> window.location = "Inicio"; </script>';
