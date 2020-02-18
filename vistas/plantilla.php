<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SISTEMA DE RESIDENCIAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="vistas/assets/images/icon/favicon.ico">
    <!-- <link rel="stylesheet" href="vistas/assets/css/switch-bootstrap4-toggle.min.css"> -->
    <link rel="stylesheet" href="vistas/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="vistas/assets/css/swichtCSS.css">
    <!-- <link rel="stylesheet" href="vistas/assets/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="vistas/assets/css/Font-Awesome.css">
    <link rel="stylesheet" href="vistas/assets/css/themify-icons.css">
    <link rel="stylesheet" href="vistas/assets/css/metisMenu.css">
    <link rel="stylesheet" href="vistas/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="vistas/assets/css/slicknav.min.css">
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="vistas/assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="vistas/assets/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="vistas/assets/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" type="text/css" href="vistas/assets/css/jquery.dataTables.css">
    <!-- others css -->
    <link rel="stylesheet" href="vistas/assets/css/typography.css">
    <link rel="stylesheet" href="vistas/assets/css/default-css.css">
    <link rel="stylesheet" href="vistas/assets/css/styles.css">
    <link rel="stylesheet" href="vistas/assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="vistas/assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- sweetalert2 -->
    <script src="vistas/assets/js/sweetalert2.all.min.js"></script>
</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="body-bg">

    <div id="preloader">
        <div class="loader"></div>
    </div>

    <?php
    if (isset($_SESSION['iniciarSesion']) && $_SESSION['iniciarSesion'] == "ok") {

        echo '<div class="horizontal-main-wrapper">';

        if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == "Administrador") {
            include "modulos/cabezote.php";
            // echo $rutaM."modulos/cabezote.php";
        } else {
            include "modulos/cabezoteUser.php";
        }

        //MOSTRAR / OCULTAR EL SEGMENTO DE PRE-REGISTRO
        $cargarConfig = ControladorConfig::ctrCargarConfig("configPreRegistro");
        if ($cargarConfig["valor"] == "on") {
            $cargarPreRegistro = "Pre-Registro";
        } else {
            $cargarPreRegistro = "404";
        }

        // Usuario administrativo
        if (isset($_GET["ruta"]) && $_SESSION['perfil'] == "Administrador") {
            if (
                $_GET["ruta"] == "Inicio" ||
                $_GET["ruta"] == "Usuarios" ||
                $_GET["ruta"] == "Residentes" ||
                $_GET["ruta"] == "Docentes" ||
                $_GET["ruta"] == "Directorio" ||
                $_GET["ruta"] == "Jerarquia" ||
                $_GET["ruta"] == $cargarPreRegistro ||
                $_GET["ruta"] == "CerrarSesion"
            ) {

                include "modulos/" . $_GET["ruta"] . ".php";
            } else {
                include "modulos/404.php";
            }
        }
        // Usuario normal
        if (isset($_GET["ruta"]) && $_SESSION['perfil'] != "Administrador") {
            if (
                $_GET["ruta"] == "Inicio" ||
                $_GET["ruta"] == "Residentes" ||
                $_GET["ruta"] == "Directorio" ||
                $_GET["ruta"] == $cargarPreRegistro ||
                $_GET["ruta"] == "CerrarSesion"
            ) {

                include "modulos/" . $_GET["ruta"] . ".php";
            } else {
                include "modulos/404.php";
            }
        }
        if (!isset($_GET["ruta"])) {
            include "modulos/Inicio.php";
        }

        include "modulos/footer.php";

        echo '</div>';
    } else {
        include "modulos/login.php";
    }

    ?>


    <!-- jquery latest version -->
    <!-- <script src="vistas/assets/js/vendor/jquery-2.2.4.min.js"></script> -->
    <script src="vistas/assets/js/vendor/jquery-3.4.0.min.js"></script>
    <!-- switch bootstrap -->
    <!-- <script src="vistas/assets/js/switch-bootstrap4-toggle.min.js"></script> -->
    <!-- bootstrap 4 js -->
    <script src="vistas/assets/js/popper.min.js"></script>
    <script src="vistas/assets/js/bootstrap.min.js"></script>
    <script src="vistas/assets/js/owl.carousel.min.js"></script>
    <script src="vistas/assets/js/metisMenu.min.js"></script>
    <script src="vistas/assets/js/jquery.slimscroll.min.js"></script>
    <script src="vistas/assets/js/jquery.slicknav.min.js"></script>
    <script src="vistas/assets/js/Chart.min.js"></script>
    <script src="vistas/assets/js/chartInicio.js"></script>

    <!-- Start datatable js -->
    <script src="vistas/assets/js/jquery.dataTables.js"></script>
    <script src="vistas/assets/js/jquery.dataTables.min.js"></script>
    <script src="vistas/assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="vistas/assets/js/dataTables.responsive.min.js"></script>
    <script src="vistas/assets/js/responsive.bootstrap.min.js"></script>

    <!-- others plugins -->
    <script src="vistas/assets/js/jerarquia.js"></script>
    <script src="vistas/assets/js/configSDR.js"></script>
    <script src="vistas/assets/js/pre-registro.js"></script>
    <script src="vistas/assets/js/directorio.js"></script>
    <script src="vistas/assets/js/docentes.js"></script>
    <script src="vistas/assets/js/residentes.js"></script>
    <script src="vistas/assets/js/usuarios.js"></script>
    <script src="vistas/assets/js/plugins.js"></script>
    <script src="vistas/assets/js/scripts.js"></script>
    <script src="vistas/assets/js/table.js"></script>
</body>

</html>