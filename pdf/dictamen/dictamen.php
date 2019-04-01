<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>dictamen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    <style>
        img {
            margin: 3.5% 14.5% 0% 14.5%;
            display: block;
            /* height: 107px;
            width: 750px; */
        }

        h5 {
            margin-top: -.3%;
            font-family: "arial";
            text-align: center;
        }


        table {
            border: 0.5px solid #000;
            text-align: center;
        }

        #contenedor1 {
            padding: 7px 0px 23px 700px;
        }

        #tabla1 td {
            font-size: 12px;
            height: 11px;
            width: 82px;
        }

        #contenedor2 {
            padding: 0px 45px;
        }

        #tabla2 td,
        th {
            padding: 6px;
        }

        td,
        th {
            border: 0.5px solid #000;
        }

        .sinBottomBorde {
            border-bottom: 0.0px;
        }

        .sinRightBorde {
            border-right: 0.0px;
        }

        .sinLeftBorde {
            border-left: 0.0px;
        }

        .sinTopBorde {
            border-top: 0.0px;
        }

        .textoFinal {
            text-align: right;
        }

        .textoInicio {
            text-align: left;
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
        <Table cellspacing="0" id="tabla1">
            <tr>
                <td class="sinBottomBorde">SEMESTRE</td>
                <td>ENE - JUN</td>
                <td><?php
                    if ($semestre == 'EJ') {
                        echo $anio;
                    }
                    ?></td>
            </tr>
            <tr>
                <td class="sinTopBorde"></td>
                <td>AGO - DIC</td>
                <td><?php
                    if ($semestre == 'AD') {
                        echo $anio;
                    }
                    ?></td>
            </tr>
        </Table>
    </div>
    <h5>ING. EN SISTEMAS COMPUTACIONALES</h5>
    <div id="contenedor2">
        <table cellspacing="0" id="tabla2">
            <tr>
                <td class="sinBottomBorde"></td>
                <td class="sinBottomBorde"></td>
                <td class="sinBottomBorde"></td>
                <td class="sinBottomBorde"></td>
                <td class="sinBottomBorde"></td>
                <td class="sinBottomBorde"></td>
                <th class="textoFinal sinRightBorde">ASES</th>
                <th class="textoInicio sinLeftBorde">ORES</th>
                <td class="sinBottomBorde"></td>
                <td class="sinBottomBorde"></td>
            </tr>
            <tr>
                <th class="sinTopBorde ">NUM. </th>
                <th class="sinTopBorde">CONTROL</th>
                <th class="sinTopBorde">NOMBRE DEL ESTUDIANTE</th>
                <th class="sinTopBorde">S</th>
                <th class="sinTopBorde">ANTEPROYECTO</th>
                <th class="sinTopBorde">EMPRESA</th>
                <th>INTERNO</th>
                <th>EXTERNO</th>
                <th class="sinTopBorde">DICTAMEN</th>
                <th class="sinTopBorde">FECHA DE DICTAMEN</th>
            </tr>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr>

        </table>
    </div>


</body>

</html> 