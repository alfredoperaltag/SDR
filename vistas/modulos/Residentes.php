<div class="col-12 mt-3">
    <div class="card">
        <h2 class="ml-4">Residentes</h2>
        <div class="card-body">
            <!-- <h1 class="header-title">Usuarios</h1> -->
            <?php
            if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == "Administrador") {
                echo '<button class="btn btn-success btn-xs mb-3" data-toggle="modal" data-target="#modalITDRP">Informe Tecnico
                de<br> Residencias Profesionales</button>
            <button class="btn btn-danger btn-xs mb-3" data-toggle="modal" data-target="#modalTP">Tesis <br>
                Profesional</button>';
            }
            $cargarConfig = ControladorConfig::ctrCargarConfig("configPreRegistro");

            if ($cargarConfig["valor"] == "on" && $_SESSION['perfil'] == "Administrador") {
                echo '<button class="btn btn-primary btn-xs mb-3 ml-5" data-toggle="modal" data-target="#modalPreRegistroOK">Pre-Registro<br> Residencias Profesionales</button>';
            }
            ?>
            <div class="data-tables datatable-primary">
                <table class="text-center tablaES">
                    <thead class="text-capitalize">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>No. Control</th>
                            <th>Carrera</th>
                            <!-- <th>Sexo</th>
                            <th>Telefono</th> -->
                            <th>Asesor Interno</th>
                            <th>Proyecto</th>
                            <th>Tipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $VerResidentes = new ControladorResidentes();
                        $VerResidentes->ctrMostrarResidentes();
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!--=====================================
INFORME TECNICO DE RESIDENCIAS PROFESIONALES
======================================-->

<div class="modal fade" id="modalITDRP">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header" style="background:#28A745; color:white">
                <h5 class="modal-title">Alta Residente - Informe Tecnico de Residencias Profesionales</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" method="post" enctype="multipart/form-data">
                <!-- <form method="post"> -->

                <!--=====================================
              CUERPO DEL MODAL
              ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <h6>Datos de Alumnos</h6>
                        <div class="form-row align-items-center">
                            <!-- ENTRADA PARA EL NUMERO DE CONTROL -->
                            <div class="col-sm-2 my-1">
                                <label for="example-text-input" class="col-form-label">No. Control</label>
                                <input class="form-control" type="number" name="nuevoNoControlRP" placeholder="No. Control" required autocomplete="off">
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR SU CARRERA -->
                            <div class="col-sm-5 my-1">
                                <label class="col-form-label">Carrera</label>
                                <select class="custom-select" name="nuevoCarrera" required>
                                    <option value="">Selecionar carrera</option>
                                    <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                                    <option value="Ingeniería Informática">Ingeniería Informática</option>
                                </select>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR PERIODO -->
                            <div class="col-sm-3 my-1">
                                <label class="col-form-label">Periodo</label>
                                <select class="custom-select" name="nuevoPeriodo" required>
                                    <option value="">Selecionar periodo</option>
                                    <option value="EJ">Enero/Junio</option>
                                    <option value="AD">Agosto/Diciembre</option>
                                </select>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR AÑO -->
                            <div class="col-sm-2 my-1">
                                <label class="col-form-label">Año</label>
                                <?php
                                $cont = date('Y');
                                ?>
                                <select class="custom-select" name="nuevoPeriodoAnio" required>
                                    <?php while ($cont >= 2018) { ?>
                                        <option name="anio" value="<?php echo ($cont); ?>">
                                            <?php echo ($cont); ?>
                                        </option>
                                        <?php $cont = ($cont - 1);
                                    } ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" name="nuevoNombre" placeholder="Nombre" required autocomplete="off">
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO PATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Paterno</label>
                            <input class="form-control" type="text" name="nuevoApellidoP" placeholder="Apellido Paterno" required autocomplete="off">
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO MATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Materno</label>
                            <input class="form-control" type="text" name="nuevoApellidoM" placeholder="Apellido Materno" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA SELECCIONAR SU SEXO -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Sexo</label>
                            <select class="custom-select" name="nuevoSexo" required>
                                <option value="">Selecionar sexo</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                        <!-- ENTRADA PARA EL TELEFONO -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Telefono</label>
                            <input class="form-control" type="tel" name="nuevoTelefono" placeholder="Telefono" autocomplete="off">
                        </div>
                    </div>
                    <hr>
                    <h6>Datos de Proyecto</h6>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA EL NOMBRE DEL PROYECTO -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre del Proyecto</label>
                            <textarea rows="2" maxlength="200" class="form-control" type="text" name="nuevoNombreProyecto" placeholder="Nombre del Proyecto" required autocomplete="off"></textarea>
                        </div>
                        <!-- ENTRADA PARA EL NOMBRE DE LA EMPRESA -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre de la Empresa</label>
                            <textarea rows="2" maxlength="200" class="form-control" type="text" name="nuevoNombreEmpresa" placeholder="Nombre de la Empresa" required autocomplete="off"></textarea>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA ASESOR EXTERNO -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Asesor Externo</label>
                            <input class="form-control" type="text" name="nuevoAsesorExt" placeholder="Asesor Externo" required autocomplete="off">
                        </div>
                        <!-- ENTRADA PARA ASESOR INTERNO -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Asesor Interno</label>
                            <select class="custom-select" name="nuevoAsesorInt" required>
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA REVISOR #1 -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Revisor #1</label>
                            <select class="custom-select" name="nuevoRevisor1">
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                        <!-- ENTRADA PARA REVISOR #2 -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Revisor #2</label>
                            <select class="custom-select" name="nuevoRevisor2">
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA SUPLENTE -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Suplente</label>
                            <select class="custom-select" name="nuevoSuplente">
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!--=====================================
              PIE DEL MODAL
              ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php

                $RegistrarResidente = new ControladorResidentes();
                $RegistrarResidente->ctrRegistrarResidentesRP();

                ?>

            </form>
        </div>
    </div>
</div>
</div>

<!--=====================================
TESIS PROFESIONAL
======================================-->

<div class="modal fade" id="modalTP">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header" style="background:#DC3545; color:white">
                <h5 class="modal-title">Alta Residente - Tesis Profesional</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" method="post" enctype="multipart/form-data">
                <!-- <form method="post"> -->

                <!--=====================================
              CUERPO DEL MODAL
              ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <h6>Datos de Alumnos</h6>
                        <div class="form-row align-items-center">
                            <!-- ENTRADA PARA EL NUMERO DE CONTROL -->
                            <div class="col-sm-2 my-1">
                                <label for="example-text-input" class="col-form-label">No. Control</label>
                                <input class="form-control" type="number" name="nuevoNoControlT" placeholder="No. Control" required autocomplete="off">
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR SU CARRERA -->
                            <div class="col-sm-5 my-1">
                                <label class="col-form-label">Carrera</label>
                                <select class="custom-select" name="nuevoCarrera" required>
                                    <option value="">Selecionar carrera</option>
                                    <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                                    <option value="Ingeniería Informática">Ingeniería Informática</option>
                                </select>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR PERIODO -->
                            <div class="col-sm-3 my-1">
                                <label class="col-form-label">Periodo</label>
                                <select class="custom-select" name="nuevoPeriodo" required>
                                    <option value="">Selecionar periodo</option>
                                    <option value="EJ">Enero/Junio</option>
                                    <option value="AD">Agosto/Diciembre</option>
                                </select>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR AÑO -->
                            <div class="col-sm-2 my-1">
                                <label class="col-form-label">Año</label>
                                <?php
                                $cont = date('Y');
                                ?>
                                <select class="custom-select" name="nuevoPeriodoAnio" required>
                                    <?php while ($cont >= 2018) { ?>
                                        <option name="anio" value="<?php echo ($cont); ?>">
                                            <?php echo ($cont); ?>
                                        </option>
                                        <?php $cont = ($cont - 1);
                                    } ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" name="nuevoNombre" placeholder="Nombre" required autocomplete="off">
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO PATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Paterno</label>
                            <input class="form-control" type="text" name="nuevoApellidoP" placeholder="Apellido Paterno" required autocomplete="off">
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO MATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Materno</label>
                            <input class="form-control" type="text" name="nuevoApellidoM" placeholder="Apellido Materno" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA SELECCIONAR SU SEXO -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Sexo</label>
                            <select class="custom-select" name="nuevoSexo" required>
                                <option value="">Selecionar sexo</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                        <!-- ENTRADA PARA EL TELEFONO -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Telefono</label>
                            <input class="form-control" type="tel" name="nuevoTelefono" placeholder="Telefono" autocomplete="off">
                        </div>
                    </div>
                    <hr>
                    <h6>Datos de Proyecto</h6>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA EL NOMBRE DEL PROYECTO -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre del Proyecto</label>
                            <textarea rows="2" maxlength="200" class="form-control" type="text" name="nuevoNombreProyecto" placeholder="Nombre del Proyecto" required autocomplete="off"></textarea>
                        </div>
                        <!-- ENTRADA PARA EL NOMBRE DE LA EMPRESA -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre de la Empresa</label>
                            <textarea rows="2" maxlength="200" class="form-control" type="text" name="nuevoNombreEmpresa" placeholder="Nombre de la Empresa" required autocomplete="off"></textarea>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA ASESOR INTERNO -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Asesor Interno</label>
                            <select class="custom-select" name="nuevoAsesorInt" required>
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                        <!-- ENTRADA PARA REVISOR #1 -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Revisor #1</label>
                            <select class="custom-select" name="nuevoRevisor1">
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA REVISOR #1 -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Revisor #2</label>
                            <select class="custom-select" name="nuevoRevisor2">
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                        <!-- ENTRADA PARA REVISOR #2 -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Revisor #3</label>
                            <select class="custom-select" name="nuevoRevisor3">
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA SUPLENTE -->
                        <!-- <div class="col-sm-6 my-1">
                            <label class="col-form-label">Suplente</label>
                            <select class="custom-select" name="nuevoSuplente">
                                <option value="">Selecionar suplente</option>
                                <?php
                                // $verDocente = new ControladorResidentes();
                                // $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div> -->
                    </div>
                </div>
                <!--=====================================
              PIE DEL MODAL
              ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php

                $RegistrarResidente = new ControladorResidentes();
                $RegistrarResidente->ctrRegistrarResidentesT();

                ?>

        </div>
        </form>

    </div>
</div>
</div>

<!--=====================================
EDITAR RESIDENTE
======================================-->

<div class="modal fade" id="modalER">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header" style="background:#FFC107; color:white">
                <h5 class="modal-title">Editar Residente</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" method="post" enctype="multipart/form-data">
                <!-- <form method="post"> -->

                <!--=====================================
              CUERPO DEL MODAL
              ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <h6>Datos de Alumnos</h6>
                        <div class="form-row align-items-center">
                            <input type="hidden" id="idResidenteEdit" name="idResidenteEdit">
                            <!-- ENTRADA PARA EL NUMERO DE CONTROL -->
                            <div class="col-sm-2 my-1">
                                <label for="example-text-input" class="col-form-label">No. Control</label>
                                <input class="form-control" type="number" name="editNoControlEdit" id="editNoControlEdit" placeholder="No. Control" required autocomplete="off">
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR SU CARRERA -->
                            <div class="col-sm-5 my-1">
                                <label class="col-form-label">Carrera</label>
                                <select class="custom-select" name="editCarrera" id="editCarrera" required>
                                    <option value="">Selecionar carrera</option>
                                    <option value="ISC">Ingeniería en Sistemas Computacionales</option>
                                    <option value="II">Ingeniería Informática</option>
                                </select>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR PERIODO -->
                            <div class="col-sm-3 my-1">
                                <label class="col-form-label">Periodo</label>
                                <select class="custom-select" name="editPeriodo" id="editPeriodo" required>
                                    <option value="">Selecionar periodo</option>
                                    <option value="EJ">Enero/Junio</option>
                                    <option value="AD">Agosto/Diciembre</option>
                                </select>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR AÑO -->
                            <div class="col-sm-2 my-1">
                                <label class="col-form-label">Año</label>
                                <?php
                                $cont = date('Y');
                                ?>
                                <select class="custom-select" name="editPeriodoAnio" id="editPeriodoAnio" required>
                                    <?php while ($cont >= 2018) { ?>
                                        <option name="anio" value="<?php echo ($cont); ?>">
                                            <?php echo ($cont); ?>
                                        </option>
                                        <?php $cont = ($cont - 1);
                                    } ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" name="editNombre" id="editNombre" placeholder="Nombre" required autocomplete="off">
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO PATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Paterno</label>
                            <input class="form-control" type="text" name="editApellidoP" id="editApellidoP" placeholder="Apellido Paterno" required autocomplete="off">
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO MATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Materno</label>
                            <input class="form-control" type="text" name="editApellidoM" id="editApellidoM" placeholder="Apellido Materno" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA SELECCIONAR SU SEXO -->
                        <div class="col-sm-3 my-1">
                            <label class="col-form-label">Sexo</label>
                            <select class="custom-select" name="editSexo" id="editSexo" required>
                                <option value="">Selecionar sexo</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                        <!-- ENTRADA PARA EL TELEFONO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Telefono</label>
                            <input class="form-control" type="tel" name="editTelefono" id="editTelefono" placeholder="Telefono" autocomplete="off">
                        </div>
                        <!-- ENTRADA PARA EL TIPO DE REGISTRO -->
                        <div class="col-sm-5 my-1">
                            <label for="example-text-input" class="col-form-label">Tipo de registro</label>
                            <input class="form-control" type="tel" name="editTipo" id="editTipo" placeholder="Tipo" autocomplete="off">
                        </div>
                    </div>
                    <!-- liberacion residencias -->
                    <div class="form-row justify-content-center">
                        <div id="CheckResidenciasView" style="display:none;" class="col-sm-8">
                            <label class="col-form-label mr-4">Revisiones:</label>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="customCheck1" id="customCheck1" class="custom-control-input customCheck1" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Revision #1</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="customCheck2" id="customCheck2" class="custom-control-input customCheck2" id="customCheck2">
                                <label class="custom-control-label" for="customCheck2">Revision #2</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="customCheck3" id="customCheck3" class="custom-control-input customCheck3" id="customCheck3">
                                <label class="custom-control-label" for="customCheck3">Revision #3</label>
                            </div>
                        </div>
                    </div>
                    <!-- liberacion tesis -->
                    <div class="form-row justify-content-center">
                        <div id="CheckTesisView" style="display:none;" class="col-sm-6">
                            <label class="col-form-label mr-4">Estado de la liberación:</label>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" name="CheckTesis" class="custom-control-input CheckTesis" id="CheckTesis">
                                <label id="StatusTesis" class="custom-control-label" for="CheckTesis"></label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h6>Datos de Proyecto</h6>
                    <div class="form-row align-items-center">
                        <input type="hidden" id="idProyectoEdit" name="idProyectoEdit">
                        <!-- ENTRADA PARA EL NOMBRE DEL PROYECTO -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre del Proyecto</label>
                            <textarea rows="2" maxlength="200" class="form-control" type="text" name="editNombreProyecto" id="editNombreProyecto" placeholder="Nombre del Proyecto" required autocomplete="off"></textarea>
                        </div>
                        <!-- ENTRADA PARA EL NOMBRE DE LA EMPRESA -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre de la Empresa</label>
                            <textarea rows="2" maxlength="200" class="form-control" type="text" name="editNombreEmpresa" id="editNombreEmpresa" placeholder="Nombre del asesor" required autocomplete="off"></textarea>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA ASESOR INTERNO -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Asesor Interno</label>
                            <select class="custom-select" name="editAsesorInt" id="editAsesorInt" >
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                        <!-- ENTRADA PARA ASESOR EXTERNO -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Asesor Externo</label>
                            <input class="form-control" type="text" name="editAsesorExt" id="editAsesorExt" placeholder="No llena asesor externo" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA REVISOR #1 -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Revisor #1</label>
                            <select class="custom-select" name="editRevisor1" id="editRevisor1" >
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                        <!-- ENTRADA PARA REVISOR #2 -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Revisor #2</label>
                            <select class="custom-select" name="editRevisor2" id="editRevisor2" >
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA REVISOR #3 -->
                        <div class="col-sm-6 my-1" id="ViewRevisor3" style="display:block;">
                            <label class="col-form-label">Revisor #3</label>
                            <select class="custom-select" name="editRevisor3" id="editRevisor3" >
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                        <!-- ENTRADA PARA SUPLENTE -->
                        <div class="col-sm-6 my-1" id="ViewSuplente" style="display:block;">
                            <label class="col-form-label">Suplente</label>
                            <select class="custom-select" name="editSuplente" id="editSuplente" >
                                <option value=""> -- POR ASIGNAR -- </option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!--=====================================
              PIE DEL MODAL
              ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php
                $editarResidente = new ControladorResidentes();
                $editarResidente->ctrEditarResidente();
                ?>

            </form>
        </div>
    </div>
</div>
</div>

<!--=====================================
INFORMACION RESIDENTE
======================================-->
<!-- basic modal start -->
<div class="modal fade" id="modalInfo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Informacion del Residente</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-row align-items-center">
                    <div class="col-sm-2 my-1">
                        <label for="example-text-input" class="col-form-label">No. Control</label>
                        <input class="form-control" type="text" id="InfoControl" readonly>
                    </div>
                    <div class="col-sm-5 my-1">
                        <label for="example-text-input" class="col-form-label">Nombre</label>
                        <input class="form-control" type="text" id="InfoNombre" readonly>
                    </div>
                    <div class="col-sm-5 my-1">
                        <label for="example-text-input" class="col-form-label">Carrera</label>
                        <input class="form-control" type="text" id="InfoCarrera" readonly>
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-sm-3 my-1">
                        <label for="example-text-input" class="col-form-label">Periodo</label>
                        <input class="form-control" type="text" id="InfoPeriodo" readonly>
                    </div>
                    <div class="col-sm-2 my-1">
                        <label for="example-text-input" class="col-form-label">Sexo</label>
                        <input class="form-control" type="text" id="InfoSexo" readonly>
                    </div>
                    <div class="col-sm-3 my-1">
                        <label for="example-text-input" class="col-form-label">Telefono</label>
                        <input class="form-control" type="tel" id="InfoTelefono" readonly>
                    </div>
                    <div class="col-sm-4 my-1">
                        <label for="example-text-input" class="col-form-label">Tipo de registro</label>
                        <input class="form-control" type="text" id="InfoTipo" readonly>
                    </div>
                </div>
                <br>
                <div class="form-row justify-content-center">
                    <div id="CheckResidenciasView1" style="display:none;" class="col-sm-8">
                        <label class="col-form-label mr-4">Revisiones:</label>
                        <!-- </div>
                    <div class="col-sm-10  "> -->
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" disabled class="custom-control-input" id="customCheck4">
                            <label class="custom-control-label" for="customCheck4">Revision #1</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" disabled class="custom-control-input" id="customCheck5">
                            <label class="custom-control-label" for="customCheck5">Revision #2</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" disabled class="custom-control-input" id="customCheck6">
                            <label class="custom-control-label" for="customCheck6">Revision #3</label>
                        </div>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div id="CheckTesisView1" style="display:none;" class="col-sm-6">
                        <label class="col-form-label mr-4">Estado de la liberación:</label>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" disabled name="CheckTesis1" class="custom-control-input" id="CheckTesis1">
                            <label id="StatusTesis1" class="custom-control-label" for="CheckTesis1">Liberado</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-row align-items-center">
                    <div class="col-sm-6 my-1">
                        <label for="example-text-input" class="col-form-label">Nombre del proyecto</label>
                        <textarea rows="2" maxlength="200" class="form-control" type="text" id="InfoProyecto" readonly></textarea>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label for="example-text-input" class="col-form-label">Empresa</label>
                        <textarea rows="2" maxlength="200" class="form-control" type="text" id="InfoEmpresa" readonly></textarea>
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-sm-6 my-1">
                        <label for="example-text-input" class="col-form-label">Asesor Externo</label>
                        <input class="form-control" type="text" id="InfoAsesorExt" readonly>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label for="example-text-input" class="col-form-label">Asesor Interno</label>
                        <input class="form-control" type="text" id="InfoAsesorInt" readonly>
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-sm-6 my-1">
                        <label for="example-text-input" class="col-form-label">Revisor #1</label>
                        <input class="form-control" type="text" id="InfoRevisor1" readonly>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label for="example-text-input" class="col-form-label">Revisor #2</label>
                        <input class="form-control" type="text" id="InfoRevisor2" readonly>
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-sm-6 my-1" id="ViewRevisor32" style="display:block;">
                        <label for="example-text-input" class="col-form-label">Revisor #3</label>
                        <input class="form-control" type="text" id="InfoRevisor3" readonly>
                    </div>
                    <div class="col-sm-6 my-1" id="ViewSuplente2" style="display:block;">
                        <label for="example-text-input" class="col-form-label">Suplente</label>
                        <input class="form-control" type="text" id="InfoSuplente" readonly>
                    </div>
                </div>
            </div><!--  Fin row -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--=====================================
IMPRIMIR DOCUMENTOS RESIDENCIAS PROFESIONALES
======================================-->
<!-- basic modal start -->
<div class="modal fade" id="modalFormatosRP">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#28A745; color:white">
                <h5 class="modal-title">Formatos de Impresion</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="form-row align-items-center">
                    <div class="col-sm-4 my-1">
                        <label for="impNoControl" class="col-form-label">No. Control</label>
                        <input class="form-control" type="text" id="impNoControl" readonly>
                    </div>
                    <div class="col-sm-8 my-1">
                        <label for="impNombre" class="col-form-label">Nombre</label>
                        <input class="form-control" type="text" id="impNombre" readonly>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-sm-12 my-1">
                            <label class="col-form-label">Revisiones: </label>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" disabled class="custom-control-input" id="customCheck7">
                                <label class="custom-control-label" for="customCheck7">Revision #1</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" disabled class="custom-control-input" id="customCheck8">
                                <label class="custom-control-label" for="customCheck8">Revision #2</label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" disabled class="custom-control-input" id="customCheck9">
                                <label class="custom-control-label" for="customCheck9">Revision #3</label>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-success btn-lg btn-block" id="btnImprimirDictamen">Dictamen
                    de anteproyecto de
                    Residencias
                    Profesionales</button>
                <button type="button" class="btn btn-success btn-lg btn-block" id="btnImprimirAsesores">Asignación de asesor</button>
                <button type="button" class="btn btn-success btn-lg btn-block" id="btnImprimirRevision">Revisión del trabajo de Titulación</button>
                <button type="button" class="btn btn-success btn-lg btn-block" id="btnImprimirLiberacion">Liberacion de Residencias Profesionales</button>
                <button type="button" class="btn btn-success btn-lg btn-block" id="btnImprimirJuradoSeleccionado">Jurado Seleccionado</button>
                <button type="button" class="btn btn-success btn-lg btn-block" id="btnImprimirJuradoTitulacion">Jurado de Titulación</button>
                <br>
                ¿Problemas con el PDF?  Conviértalo a WORD <a href="https://www.ilovepdf.com/pdf_to_word" target="_blank">Aquí</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--=====================================
IMPRIMIR DOCUMENTOS TESIS
======================================-->
<!-- basic modal start -->
<div class="modal fade" id="modalFormatosT">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#DC3545; color:white">
                <h5 class="modal-title">Formatos de Impresion Tesis</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">

                <div class="form-row align-items-center">
                    <div class="col-sm-4 my-1">
                        <label for="impNoControlT" class="col-form-label">No. Control</label>
                        <input class="form-control" type="text" id="impNoControlT" readonly>
                    </div>
                    <div class="col-sm-8 my-1">
                        <label for="impNombreT" class="col-form-label">Nombre</label>
                        <input class="form-control" type="text" id="impNombreT" readonly>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div id="CheckTesisView1" style="display:block;" class="col-sm-9">
                        <label class="col-form-label mr-4">Estado de la liberación:</label>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" disabled name="CheckTesis2" class="custom-control-input" id="CheckTesis2">
                            <label id="StatusTesis2" class="custom-control-label" for="CheckTesis2">Liberado</label>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-success btn-lg btn-block" id="btnImpAsesorT">Oficio asignación de asesor</button>
                <button type="submit" class="btn btn-success btn-lg btn-block" id="btnImpJurado">Revisión de Trabajo de Titulación</button>
                <button type="submit" class="btn btn-success btn-lg btn-block" id="btnImpComisionT">Jurado Titulación</button>
                <button type="button" class="btn btn-success btn-lg btn-block" id="btnImpLiberacionR">Liberación</button>
                <br>
                ¿Problemas con el PDF?  Conviértalo a WORD <a href="https://www.ilovepdf.com/pdf_to_word" target="_blank">Aquí</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--=====================================
SELECIONAR RESIDENTE PARE REGISTRO DE PRE-REGISTRO
======================================-->
<!-- basic modal start -->
<div class="modal fade" id="modalPreRegistroOK">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white" color:white">
                <h5 class="modal-title">Registrar desde Pre-Registro</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="data-tables datatable-primary">
                    <table class="text-center tablaES">
                        <thead class="text-capitalize">
                            <tr>
                                <th>#</th>
                                <th>No. Control</th>
                                <th>Nombre</th>
                                <th>Asesor</th>
                                <th>Registrar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $item = null;
                            $valor = null;
                            $docentes = ControladorPreRegistro::ctrMostrarResidentesPre($item, $valor);
                            $c = 0;
                            foreach ($docentes as $key => $value) {
                                $c++;
                                echo '<tr>
                                                <td>' . $c . '</td>';
                                echo '<td>' . $value["noControl"] . '</td>';
                                echo '<td>' . $value["nombre"] . ' ' . $value["apellidoP"] . ' ' . $value["apellidoM"] . '</td>';
                                echo '<td>' . $value["asesorR"] . '</td>';
                                echo '<td>
                                                <div class="btn-group">';
                                echo '<button class="btn btn-warning btnPreRegistroRegister" idPreRegistroRegister="' . $value["id"] . '" data-toggle="modal" data-target="#modalITDRPPRE"><i class="fa fa-pen"></i></button>';
                                echo '</div>
                                            </td>
                                        </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--=====================================
MODAL DE PRE-REGISTRO RESIDENCIAS PROFESIONALES
======================================-->

<div class="modal fade" id="modalITDRPPRE" role="dialog" style="overflow-y: auto;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-title">PRE-REGISTRO - Informe Tecnico de Residencias Profesionales</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" method="post" enctype="multipart/form-data">
                <!-- <form method="post"> -->

                <!--=====================================
              CUERPO DEL MODAL
              ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <h6>Datos de Alumnos</h6>
                        <div class="form-row align-items-center">
                            <input type="hidden" id="idResidentePreReR" name="idResidentePreReR">
                            <!-- ENTRADA PARA EL NUMERO DE CONTROL -->
                            <div class="col-sm-2 my-1">
                                <label for="example-text-input" class="col-form-label">No. Control</label>
                                <input class="form-control" style="background-color:#FDFFA1" type="number" name="nuevoNoControlRPR" id="nuevoNoControlRPR" placeholder="No. Control" required autocomplete="off">
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR SU CARRERA -->
                            <div class="col-sm-5 my-1">
                                <label class="col-form-label">Carrera</label>
                                <select class="custom-select" style="background-color:#FDFFA1" name="nuevoCarreraR" id="nuevoCarreraR" required>
                                    <option value="">Selecionar carrera</option>
                                    <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                                    <option value="Ingeniería Informática">Ingeniería Informática</option>
                                </select>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR PERIODO -->
                            <div class="col-sm-3 my-1">
                                <label class="col-form-label">Periodo</label>
                                <select class="custom-select" name="nuevoPeriodoR" required>
                                    <option value="">Selecionar periodo</option>
                                    <option value="EJ">Enero/Junio</option>
                                    <option value="AD">Agosto/Diciembre</option>
                                </select>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR AÑO -->
                            <div class="col-sm-2 my-1">
                                <label class="col-form-label">Año</label>
                                <?php
                                $cont = date('Y');
                                ?>
                                <select class="custom-select" name="nuevoPeriodoAnioR" required>
                                    <?php while ($cont >= 2018) { ?>
                                        <option name="anio" value="<?php echo ($cont); ?>">
                                            <?php echo ($cont); ?>
                                        </option>
                                        <?php $cont = ($cont - 1);
                                    } ?>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" style="background-color:#FDFFA1" type="text" name="nuevoNombreR" id="nuevoNombreR" placeholder="Nombre" required autocomplete="off">
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO PATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Paterno</label>
                            <input class="form-control" style="background-color:#FDFFA1" type="text" name="nuevoApellidoPR" id="nuevoApellidoPR" placeholder="Apellido Paterno" required autocomplete="off">
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO MATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Materno</label>
                            <input class="form-control" style="background-color:#FDFFA1" type="text" name="nuevoApellidoMR" id="nuevoApellidoMR" placeholder="Apellido Materno" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA SELECCIONAR SU SEXO -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Sexo</label>
                            <select class="custom-select" name="nuevoSexoR" required>
                                <option value="">Selecionar sexo</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                        <!-- ENTRADA PARA EL TELEFONO -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Telefono</label>
                            <input class="form-control" style="background-color:#FDFFA1" type="tel" name="nuevoTelefonoR" id="nuevoTelefonoRR" placeholder="Telefono" autocomplete="off">
                        </div>
                    </div>
                    <hr>
                    <h6>Datos de Proyecto</h6>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA EL NOMBRE DEL PROYECTO -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre del Proyecto</label>
                            <textarea rows="2" maxlength="200" class="form-control" type="text" name="nuevoNombreProyectoR" placeholder="Nombre del Proyecto" required autocomplete="off"></textarea>
                        </div>
                        <!-- ENTRADA PARA EL NOMBRE DE LA EMPRESA -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre de la Empresa</label>
                            <textarea rows="2" maxlength="200" class="form-control" type="text" name="nuevoNombreEmpresaR" placeholder="Nombre de la Empresa" required autocomplete="off"></textarea>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA ASESOR EXTERNO -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Asesor Externo</label>
                            <input class="form-control" type="text" name="nuevoAsesorExtR" placeholder="Asesor Externo" required autocomplete="off">
                        </div>
                        <!-- ENTRADA PARA ASESOR INTERNO -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Asesor Interno</label>
                            <select class="custom-select" style="background-color:#FDFFA1" name="nuevoAsesorIntR" id="nuevoAsesorIntR" required>
                                <option value="">Selecionar Asesor</option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA REVISOR #1 -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Revisor #1</label>
                            <select class="custom-select" name="nuevoRevisor1R">
                                <option value="">Selecionar revisor</option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                        <!-- ENTRADA PARA REVISOR #2 -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Revisor #2</label>
                            <select class="custom-select" name="nuevoRevisor2R">
                                <option value="">Selecionar revisor</option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA SUPLENTE -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Suplente</label>
                            <select class="custom-select" name="nuevoSuplenteR">
                                <option value="">Selecionar suplente</option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes2();
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <!--=====================================
              PIE DEL MODAL
              ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <?php

                if (isset($_POST["nuevoNoControlRPR"])) {
                    $RegistrarResidente2 = new ControladorResidentes();
                    $RegistrarResidente2->ctrRegistrarResidentesRPPreRegistro();
                }
                ?>

            </form>
        </div>
    </div>
</div>
</div>