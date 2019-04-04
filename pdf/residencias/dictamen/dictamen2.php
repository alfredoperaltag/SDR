<page align="center" style="width=100%;  height:100%">
    <div>
        <img src="../imagenes/LogoCaptura.PNG">
    </div>
    <div>
        <h5>INSTITUTO TECNOLÓGICO DE IGUALA <br>
            DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN <br>
            DICTAMEN DE ANTEPROYECTOS DE RESIDENCIAS PROFESIONALES
        </h5>
    </div>
    <div>
        <Table>
            <tr>
                <td style="border-bottom: 0px; font-size:12; width: 13%">SEMESTRE</td>
                <td style="width: 8%; font-size:10">ENE - JUN</td>
                <td style="width: 8%; font-size:12"><?php
                                                    if ($semestre == 'EJ') {
                                                        echo $anio;
                                                    }
                                                    ?></td>
            </tr>
            <tr>
                <td style="border-top: 0px;"></td>
                <td style="font-size:10">AGO - DIC</td>
                <td style="font-size:12"><?php
                                            if ($semestre == 'AD') {
                                                echo $anio;
                                            }
                                            ?>
                </td>
            </tr>
        </Table>
    </div>
    <div>
        <h5>ING. EN SISTEMAS COMPUTACIONALES</h5>
    </div>
    <div style="heigth:30%">
        <table style="width:100%;">
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
                <td style="width:10%"><?php echo $fechaActual; ?></td>
            </tr>
        </table>
    </div>
    <div>
        <p align="center">En caso que uno o mas Anteproyectos sean rechazados se elaborara otro registro unicamente con los anteproyectos redictaminados</p>
    </div>
    <div>
        <table>
            <tr>
                <td><?php echo $presidente ?></td>
                <td><?php echo $jefe ?></td>
                <td><?php echo $subdirector ?></td>
            </tr>
            <tr>
                <td>
                    NOMBRE Y FIRMA DEL PRESIDENTE DE ACADEMIA <br> propone
                </td>
                <td>
                    NOMBRE Y FIRMA DEL JEFE DEL DEPTO. <br> ACADÉMICO
                </td>
                <td>
                    NOMBRE Y FIRMA DEL SUBDIRECTOR ACADÉMICO <br> Vo. Bo.
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Valida</td>
                <td></td>
            </tr>
        </table>
    </div>
    <div>
        <h5>INSTITUTO TECNOLÓGICO DE IGUALA <br>
            DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN <br>
            DICTAMEN DE ANTEPROYECTOS DE RESIDENCIAS PROFESIONALES
        </h5>
    </div>
    <div>
        <table style="width:100%">
            <tr>
                <td style="width:30%"><img src="../imagenes/logoPequeño.PNG"></td>
                <td style="width:30%"><img src="../imagenes/noControlado.PNG"></td>
                <td style="width:30%">Rev.1</td>
            </tr>
        </table>
    </div>
</page> 