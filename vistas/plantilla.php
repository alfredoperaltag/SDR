<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SISTEMA DE RESIDENCIAS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" type="image/png" href="vistas/assets/images/icon/favicon.ico"> -->
    <link rel="stylesheet" href="vistas/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="vistas/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="vistas/assets/css/themify-icons.css">
    <link rel="stylesheet" href="vistas/assets/css/metisMenu.css">
    <link rel="stylesheet" href="vistas/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="vistas/assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="vistas/assets/css/typography.css">
    <link rel="stylesheet" href="vistas/assets/css/default-css.css">
    <link rel="stylesheet" href="vistas/assets/css/styles.css">
    <link rel="stylesheet" href="vistas/assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="vistas/assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="body-bg">
 
  
<?php
    if (isset($_SESSION['inicioSecion']) && $_SESSION['inicioSecion'] == "ok") {
        
        echo '<div class="horizontal-main-wrapper">';
        
        include "modulos/cabecera.php";
        if (isset($_GET["ruta"])) {
            
            if ($_GET["ruta"] == "Inicio" ||
            $_GET["ruta"] == "Usuarios" ||
            $_GET["ruta"] == "CerrarSesion") {

                include "modulos/" . $_GET["ruta"] . ".php";
        } else {
            include "modulos/404.php";
        }

    } else {
        include "modulos/inicio.php";
    }

    include "modulos/pie.php";
    
    echo '</div>';

    }else{
        include "modulos/login.php";
    }

    ?>


    <!-- jquery latest version -->
    <script src="vistas/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="vistas/assets/js/popper.min.js"></script>
    <script src="vistas/assets/js/bootstrap.min.js"></script>
    <script src="vistas/assets/js/owl.carousel.min.js"></script>
    <script src="vistas/assets/js/metisMenu.min.js"></script>
    <script src="vistas/assets/js/jquery.slimscroll.min.js"></script>
    <script src="vistas/assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <!-- start amcharts -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <!-- all line chart activation -->
    <script src="vistas/assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="vistas/assets/js/pie-chart.js"></script>
    <!-- all bar chart -->
    <script src="vistas/assets/js/bar-chart.js"></script>
    <!-- all map chart -->
    <script src="vistas/assets/js/maps.js"></script>
    <!-- others plugins -->
    <script src="vistas/assets/js/plugins.js"></script>
    <script src="vistas/assets/js/scripts.js"></script>
</body>

</html>
