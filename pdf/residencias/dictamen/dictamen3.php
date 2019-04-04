<page>
    <div style="height:16%; background:red;">
        <img src="../imagenes/LogoCaptura.PNG">
    </div>
    <div style="height:10%; background:blue;">
        <h5>INSTITUTO TECNOLÓGICO DE IGUALA <br>
            DEPARTAMENTO DE SISTEMAS Y COMPUTACIÓN <br>
            DICTAMEN DE ANTEPROYECTOS DE RESIDENCIAS PROFESIONALES
        </h5>
    </div>
    <div style="height:7%; background:green;">
        <Table cellspacing=0 border=0.5>
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
    <div style="height:5%; background:white;">
        <h5>ING. EN SISTEMAS COMPUTACIONALES</h5>
    </div>
    <div style="height:36%; background:yellow;">
        <table cellspacing=0 border=0.5 style="width:100%;">
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
    <div style="height:5%; background:orange;">
        En caso que uno o mas Anteproyectos sean rechazados se elaborara otro registro unicamente con los anteproyectos redictaminados
    </div>
    <div style="height:15%; background:brown;">
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
                    NOMBRE Y FIRMA DEL JEFE DEL DEPTO. ACADÉMICO <br> Valida
                </td>
                <td>
                    NOMBRE Y FIRMA DEL SUBDIRECTOR ACADÉMICO <br> Vo. Bo.
                </td>
            </tr>
        </table>
    </div>
    <div style="height:5%; background:pink;">
        <table>
            <tr>
                <td><img src="../imagenes/logoPequeño.PNG"></td>
                <td><img src="../imagenes/noControlado.PNG"></td>
                <td>Rev.1</td>
            </tr>
        </table>
    </div>
</page> 