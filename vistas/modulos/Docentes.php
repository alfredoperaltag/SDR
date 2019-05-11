<div class="col-12 mt-3">
    <div class="card">
        <h2 class="ml-4">Docentes</h2>
        <div class="card-body">
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalAgregarDocente">Agregar Docente</button>
            <button class="btn btn-danger mb-3 ml-5 btnCeroDocente">Poner en ceros a docentes</button>
            <div class="data-tables datatable-primary">
                <table class="text-center tablaES">
                    <thead class="text-capitalize">
                        <tr>
                            <th>Nombre</th>
                            <th>Residentes<br>Maximos</th>
                            <th>Residentes<br>Actuales</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $docentes = ControladorDocentes::ctrMostrarDocentes($item, $valor);
                        foreach ($docentes as $key => $value) {
                            if ($value["nombre"] != "NA") {
                                echo '<tr>
                                        <td>' . $value["nombre"] . '</td>';
                                        echo '<td>' . $value["setResidentes"] . '</td>';
                                        echo '<td>' . $value["noResidentes"] . '</td>';
                                if ($value["estado"] != 0) {
                                    echo '<td><button class="btn btn-success btn-xs btnActivarDocente" idDocente="' . $value["id"] . '" estadoDocente="0">Activado</button></td>';
                                } else {
                                    echo '<td><button class="btn btn-danger btn-xs btnActivarDocente" idDocente="' . $value["id"] . '" estadoDocente="1">Desactivado</button></td>';
                                }
                                echo '<td>
                                            <div class="btn-group">
                                                <button class="btn btn-warning btnEditarDocente" idDocente="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarDocente"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-primary btnInfoDocente" idDocente="' . $value["id"] . '" data-toggle="modal" data-target="#modalInfoDocente"><i class="fa fa-info"></i></button>
                                                <button class="btn btn-danger btnEliminarDocente" idDocente="' . $value["id"] . '"><i class="fa fa-times"></i></button>
                                            </div>
                                        </td>
                                    </tr>';
                            }
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
<div class="modal fade" id="modalAgregarDocente">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-tittle">Agregar docente</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" name="nuevoNombre" placeholder="Ingresar nombre completo" autocomplete="off" required>
                        </div>
                        <!-- ENTRADA PARA RESIDENTES -->
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Establecer numero maximo de residentes</label>
                            <input class="form-control" type="number" name="nuevoSetResidentes" placeholder="Ingresar numero maximo de residentes" autocomplete="off" required>
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
                    $crearDocente = new ControladorDocentes();
                    $crearDocente->ctrCrearDocente();
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
<!--=====================================
MODAL EDITAR DOCENTE
======================================-->
<div class="modal fade" id="modalEditarDocente">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-tittle">Editar docente</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" id="editarNombre" name="editarNombre" value="" autocomplete="off" required>
                            <input type="hidden" id="idDocente" name="idDocente">
                            <!-- <input type="hidden" id="idDocente" name="idDocente" value=<?php echo $value["id"] ?>> -->
                            <label for="example-text-input" class="col-form-label">Residentes Maximos</label>
                            <input class="form-control" type="text" id="editarResidentesM" name="editarResidentesM" value="" autocomplete="off" required>
                            <!-- <input type="hidden" id="idDocente" name="idDocente"> -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    <?php
                    $editarDocente = new ControladorDocentes();
                    $editarDocente->ctrEditarDocente();
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL INFO DOCENTE
======================================-->
<div class="modal fade" id="modalInfoDocente">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-tittle">Información docente</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <div class="text-center">
                        <label class="font-weight-bold text-uppercase" id="InfoNombreAsesor"></label>
                        </div>
                        <!-- <input type="hidden" id="idDocenteInfo"> -->
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label for="InfoAsesor" class="col-form-label">Asesor</label>
                                <input class="form-control" disabled type="text" id="InfoAsesor">
                            </div>
                            <div class="col-sm-6 my-1">
                                <label for="InfoRevisor1" class="col-form-label">Revisor #1</label>
                                <input class="form-control" disabled type="text" id="InfoRevisor1">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label for="InfoRevisor2" class="col-form-label">Revisor #2</label>
                                <input class="form-control" disabled type="text" id="InfoRevisor2">
                            </div>
                            <div class="col-sm-6 my-1">
                                <label for="InfoRevisor3" class="col-form-label">Revisor #3</label>
                                <input class="form-control" disabled type="text" id="InfoRevisor3">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label for="InfoSuplente" class="col-form-label">Suplente</label>
                                <input class="form-control" disabled type="text" id="InfoSuplente">
                            </div>
                        </div>

                    </div>
                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <!-- <button type="submit" class="btn btn-primary">Guardar</button> -->
                    </div>
                    <?php
                    $crearDocente = new ControladorDocentes();
                    $crearDocente->ctrCrearDocente();
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
$borrarDocente = new ControladorDocentes();
$borrarDocente->ctrborrarDocente();
?> 