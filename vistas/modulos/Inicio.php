<div class="col-12 mt-3">
    <div class="card">
        <!-- <h2 class="ml-4">Docentes</h2> -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card align-self-start  mt-3">
                        <h4 class="header-title mb-3">Total de registros</h4>
                        <div class="seo-fact sbg2 mt-4" id="divResidenciasInit">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="fa fa-user-friends"></i>Informe Tecnico de
                                    Residencias Profesionales</div>
                                <!-- <div class="seofct-icon"><img class="w-25" src="vistas/assets/images/author/residentes.svg"> Residentes</div> -->

                                <?php
                                $valor = 1;
                                $tabla = "residentes";
                                $item = "tipo_registro";
                                $totalR = ControladorInicio::ctrMostrarResidentesInicio($valor, $tabla, $item);
                                    echo "<h2>".$totalR["total"]."</h2>";
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="card align-self-center mt-2">
                        <div class="seo-fact sbg3">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon"><i class="fa fa-user-friends"></i> Tesis Profesional</div>
                                <!-- <div class="seofct-icon"><img class="w-25" src="vistas/assets/images/author/residentes.svg"> Residentes</div> -->
                                <?php
                                $valor = 2;
                                $tabla = "residentes";
                                $item = "tipo_registro";
                                $totalT = ControladorInicio::ctrMostrarResidentesInicio($valor, $tabla, $item);
                                    echo "<h2>".$totalT["total"]."</h2>";
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $cargarConfig = ControladorConfig::ctrCargarConfig("configPreRegistro");
            
                    // if ($cargarConfig["valor"] == "on" && $_SESSION['perfil'] == "Administrador") {
                        $valor = 'nombre';
                        $item = 'nombre';
                        $tabla = "preregistros";
                        $totalP = ControladorInicio::ctrMostrarResidentesInicio($valor, $tabla, $item);
                        echo '
                        <div class="card align-self-end mt-2">
                            <div class="seo-fact sbg1">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="fa fa-user-edit"></i> Pre-Registros</div>
                                        <h2>'.$totalP["total"].'</h2>
                                </div>
                            </div>
                        </div>
                        ';
                    // }
                    ?>
                </div>
                <!-- circular -->
                <div class="col-lg-6 align-self-start">
                    <div class="card mt-3">
                        <!-- <div class="card-body"> -->
                            <h4 class="header-title">Grafica de registros</h4>
                            <canvas id="GrafoRT" height="400"></canvas>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>