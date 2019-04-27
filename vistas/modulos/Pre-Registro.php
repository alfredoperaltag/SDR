<div class="col-12 mt-3">
    <div class="card">
        <h2 class="ml-4">Pre-Registro</h2>
        <div class="card-body">
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalAgregarPreRegistro">Agregar Pre-Registro</button>
            <div class="data-tables datatable-primary">
                <table class="text-center tablaES">
                    <thead class="text-capitalize">
                        <tr>
                            <th>#</th>
                            <th>No. Control</th>
                            <th>Carrera</th>
                            <th>Nombre</th>
                            <th>Asesor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $item = null;
                        $valor = null;
                        $docentes = ControladorPreRegistro::ctrMostrarResidentesPre($item, $valor);
                        foreach ($docentes as $key => $value) {
                                echo '<tr>
                                        <td>' . $value["id"] . '</td>';
                                echo '<td>' . $value["noControl"] . '</td>';
                                echo '<td>' . $value["carrera"] . '</td>';
                                echo '<td>' . $value["nombre"] .' '. $value["apellidoP"] .' '.$value["apellidoM"] .'</td>';
                                        echo '<td>' . $value["asesorR"] . '</td>';
                                echo '<td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning btnEditarPreRegistro" idPreRegistro="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarPreRegistro"><i class="fa fa-edit"></i></button>';
                                            if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == "Administrador") {
                                            echo '<button class="btn btn-danger btnEliminarPreRegistro" idPreRegistro="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
                                            }
                                        echo '</div>
                                    </td>
                                </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR DOCENTE
======================================-->
<div class="modal fade" id="modalAgregarPreRegistro">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-tittle">Pre-Registro</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA EL NUMERO DE CONTROL -->
                        <div class="col-sm-6 my-1">
                                <label for="example-text-input" class="col-form-label">No. Control</label>
                                <input class="form-control" type="number" name="nuevoNoControlPR" placeholder="Ingresar nomuero de control" autocomplete="off" required>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR SU CARRERA -->
                            <div class="col-sm-6 my-1">
                                <label class="col-form-label">Carrera</label>
                                <select class="custom-select" name="nuevoCarreraPR" required>
                                    <option value="">Selecionar carrera</option>
                                    <option value="Ingenieria en Sistemas Computacionales">Ingenieria en Sistemas
                                        Computacionales</option>
                                    <option value="Ingenieria Informatica">Ingenieria Informatica</option>
                                </select>
                            </div>
                            </div>
                            <div class="form-row align-items-center">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" name="nuevoNombrePR" placeholder="Ingresar nombre" autocomplete="off" required>
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO PATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Paterno</label>
                            <input class="form-control" type="text" name="nuevoApellidoPPR" placeholder="Ingresar apellido paterno" autocomplete="off" required>
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO MATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Materno</label>
                            <input class="form-control" type="text" name="nuevoApellidoMPR" placeholder="Ingresar apellido materno" autocomplete="off" required>
                        </div>
                        </div>
                        <!-- ENTRADA PARA ASESOR INTERNO -->
                        <div class="form-group">
                            <label class="col-form-label">Asesor Interno</label>
                            <select class="custom-select" name="nuevoAsesorPRE" required>
                                <option value="">Selecionar Asesor</option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes();
                                ?>
                            </select>
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
                    $crearDocente = new ControladorPreRegistro();
                    $crearDocente->ctrPreRegistrar();
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>