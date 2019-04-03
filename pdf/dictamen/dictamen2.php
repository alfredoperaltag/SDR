<page backleft="12mm" backright="10mm">

    <img src="../imagenes/LogoCaptura.PNG" style="margin: 3.5% 14.5% -2% 11%;">
    <h5 align="center">INSTITUTO TECNOLÓGICO DE IGUALA <br>
        DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN <br>
        DICTAMEN DE ANTEPROYECTOS DE RESIDENCIAS PROFESIONALES
    </h5>
    <div>
        <Table cellspacing="0" border=0.5 style="width:100%; text-align: center;" align="right">
            <tr>
                <td>SEMESTRE</td>
                <td>ENE - JUN</td>
                <td><?php
                    if ($semestre == 'EJ') {
                        echo $anio;
                    }
                    ?></td>
            </tr>
            
            <tr>
                <td style="width: 9%"></td>
                <td style="width: 10%">AGO - DIC</td>
                <td style="width: 10%"><?php
                    if ($semestre == 'AD') {
                        echo $anio;
                    }
                    ?>
                </td>
            </tr>
        </Table>
    </div>
    <h5 align="center">ING. EN SISTEMAS COMPUTACIONALES</h5>
    <div>
        <table cellspacing="0" border=0.5 style="width:100%; text-align: center; font-size:12" align="center">
            <tr>
                <td style="border-bottom: 0px"></td>
                <td style="border-bottom: 0px"></td>
                <td style="border-bottom: 0px"></td>
                <td style="border-bottom: 0px"></td>
                <td style="border-bottom: 0px"></td>
                <td style="border-bottom: 0px"></td>
                <th style="text-align: right; border-right:0px">ASES</th>
                <th style="text-align: left; border-left:0px">ORES</th>
                <td style="border-bottom: 0px"></td>
                <td style="border-bottom: 0px"></td>
            </tr>
            <tr>
                <th style="border-top: 0px">NUM.</th>
                <th style="border-top: 0px">CONTROL</th>
                <th style="border-top: 0px">NOMBRE DEL<br>ESTUDIANTE</th>
                <th style="border-top: 0px">S</th>
                <th style="border-top: 0px">ANTEPROYECTO</th>
                <th style="border-top: 0px">EMPRESA</th>
                <th>INTERNO</th>
                <th>EXTERNO</th>
                <th style="border-top: 0px">DICTAMEN</th>
                <th style="border-top: 0px">FECHA DE<br>DICTAMEN</th>
            </tr>
            <tr>
                <td style="width:6%"><?php echo $id; ?></td>
                <td style="width:9.5%"><?php echo $numeroControl; ?></td>

                <td style="width:15%"><?php echo $nombre; ?></td>
                <td style="width:2.5%"><?php if ($sexo == "Masculino") {
                                            echo "M";
                                        } else {
                                            echo "F";
                                        } ?></td>
                <td style="width:14%"><?php echo $proyecto; ?></td>
                <td style="width:14%"><?php echo $empresa; ?></td>
                <td style="width:10%"><?php echo $asesorInterno; ?></td>
                <td style="width:9%"><?php echo $asesorExterno; ?></td>
                <td style="width:10%"><?php echo $estado; ?></td>
                <td style="width:10%"><?php echo $presidente; ?></td>
            </tr>
        </table>
    </div>
    <p align="center">En caso que uno o mas Anteproyectos sean rechazados se elaborara otro registro unicamente con los anteproyectos redictaminados</p>
    <h5 align="center">INSTITUTO TECNOLÓGICO DE IGUALA <br>
        DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN <br>
        DICTAMEN DE ANTEPROYECTOS DE RESIDENCIAS PROFESIONALES
    </h5>
</page> 