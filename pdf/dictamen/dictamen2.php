<page backleft="12mm" backright="10mm">

    <img src="../imagenes/LogoCaptura.PNG">
    <h5>INSTITUTO TECNOLÓGICO DE IGUALA <br>
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
                <td></td>
                <td>AGO - DIC</td>
                <td><?php
                    if ($semestre == 'AD') {
                        echo $anio;
                    }
                    ?>
                </td>
            </tr>
        </Table>
    </div>
    <h5>ING. EN SISTEMAS COMPUTACIONALES</h5>
    <div>
        <table cellspacing="0" border=0.5 style="width:100%; text-align: center; font-size:12" align="center">
            <tr>
                <td></td>
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
                <th>NUM.</th>
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
                <td style="width:10%">Aceptado</td>
                <td style="width:10%">16/ENERO/19</td>
            </tr>
        </table>
    </div>
    <p>En caso que uno o mas Anteproyectos sean rechazados se elaborara otro registro unicamente con los anteproyectos redictaminados</p>
    <h5>INSTITUTO TECNOLÓGICO DE IGUALA <br>
        DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN <br>
        DICTAMEN DE ANTEPROYECTOS DE RESIDENCIAS PROFESIONALES
    </h5>
</page> 