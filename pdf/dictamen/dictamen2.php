<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    <style>
        img {
            margin: 3.5% 14.5% 0% 14.5%;
        }

        h5 {
            margin-top: -.3%;
            text-align: center;
        }

        .sinBordeInferior {
            border-bottom: 0.5px solid white;
            /* border-bottom: 0.0px; */
        }

        .sinBordeSuperior {
            border-top: 0.0px;

        }

        .bordeNormal {
            border: 0.5px solid #000;
        }

        td,
        th {
            border: 0.5px solid #000;
        }

        #contenedor1 {
            font-size: 11px;
            padding: 7px 0px 23px 700px;
            /* height: 11px; */
            /* width: 82px; */
            text-align: center;
        }

        #contenedor2 {
            padding: -1px 45px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <img src="../imagenes/LogoCaptura.PNG">
    <h5>INSTITUTO TECNOLÓGICO DE IGUALA <br>
        DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN <br>
        DICTAMEN DE ANTEPROYECTOS DE RESIDENCIAS PROFESIONALES
    </h5>
    <div id="contenedor1">
        <Table cellspacing="0" id="tabla1" class="bordeNormal">
            <tr>
                <td class="sinBordeInferior">SEMESTRE</td>
                <td class="bordeNormal">ENE - JUN</td>
                <td class="bordeNormal"><?php
                                        if ($semestre == 'EJ') {
                                            echo $anio;
                                        }
                                        ?></td>
            </tr>
            <tr>
                <td class="sinBordeSuperior"></td>
                <td class="bordeNormal">AGO - DIC</td>
                <td class="bordeNormal"><?php
                                        if ($semestre == 'AD') {
                                            echo $anio;
                                        }
                                        ?>
                </td>
            </tr>
        </Table>
    </div>
    <h5>ING. EN SISTEMAS COMPUTACIONALES</h5>
    <div id="contenedor2">
        <table cellspacing="0" class="bordeNormal" style="text-align: center;">
            <tr>
                <td class="sinBordeInferior"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th style="text-align: right">ASES</th>
                <th style="text-align: left">ORES</th>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th class="sinBordeSuperior">NUM.</th>
                <th>CONTROL</th>
                <th>NOMBRE DEL<br>ESTUDIANTE</th>
                <th>S</th>
                <th>ANTEPROYECTO</th>
                <th>EMPRESA</th>
                <th>INTERNO</th>
                <th>EXTERNO</th>
                <th>DICTAMEN</th>
                <th>FECHA DE<br>DICTAMEN</th>
            </tr>
            <tr>
                <td style=" width: 29px;"><?php echo $id; ?></td>
                <td style="width: 84px;"><?php echo $numeroControl; ?></td>

                <td style="width: 143px;"><?php echo $nombre; ?></td>
                <td style="width: 18px;"><?php if ($sexo == "Masculino") {
                                                echo "M";
                                            } else {
                                                echo "F";
                                            } ?></td>
                <td style="width: 133px;"><?php echo $proyecto; ?></td>
                <td style="width: 125px;"><?php echo $empresa; ?></td>
                <td style="width: 85px;"><?php echo $asesorInterno; ?></td>
                <td style="width: 86px;"><?php echo $asesorExterno; ?></td>
                <td style="width: 87px;">Aceptado</td>
                <td style="width: 94px;">16/ENERO/19</td>
            </tr>
        </table>
    </div>
    <p>En caso que uno o mas Anteproyectos sean rechazados se elaborara otro registro unicamente con los anteproyectos redictaminados</p>
</body>

</html> 