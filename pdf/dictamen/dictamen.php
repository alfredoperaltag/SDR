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

        .prueba {
            text-align: right;
            /* display: block;
            float: right; */
            /*  width: 200px;
            height: 50px; */
            /* border-color: black;
            background: red; */
        }

        table {
            border: 0.5px solid #000;
        }

        td {
            border: 0.5px solid #000;
        }

        #sinBottomBorde {
            border-bottom: 0.5px solid white;
        }

        #sinTopBorde {
            border-top: 0.5px solid white;
        }
    </style>
</head>

<body>
    <img src="../imagenes/LogoCaptura.PNG">
    <h5>INSTITUTO TECNOLÓGICO DE IGUALA <br>
        DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN <br>
        DICTAMEN DE ANTEPROYECTOS DE RESIDENCIAS PROFESIONALES
    </h5>
    <div class="prueba">
        <Table cellspacing="0">
            <tr>
                <td id="sinBottomBorde">SEMESTRE</td>
                <td>ENE - JUN</td>
                <td><?php
                    if ($semestre == 'EJ') {
                        echo $anio;
                    }
                    ?></td>
            </tr>
            <tr>
                <td id="sinTopBorde"></td>
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

</body>

</html> 