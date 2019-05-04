<div class="col-12 mt-3">
    <div class="card">
        <h2 class="ml-4">Jerarquia</h2>
        <div class="card-body">
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalAgregarJerarquia">Agregar Jerarquia</button>
            <div class="data-tables datatable-primary">
                <table class="text-center tablaES">
                    <thead class="text-capitalize">
                        <tr>
                            <th>#</th>
                            <th>Cargo</th>
                            <th>Nombre</th>
                            <th>Sexo</th>
                            <!-- <th>Estado</th> -->
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $docentes = ControladorJerarquia::ctrMostrarDocentesJerarquia($item, $valor);
                        $c=0;
                        foreach ($docentes as $key => $value) {
                            if ($value["nombre"] != "NA") {
                                $c++;
                                echo '<tr>
                                        <td>' . $c . '</td>';
                                echo '<td>' . $value["cargo"] . '</td>';
                                echo '<td>' . $value["nombre"] . '</td>';
                                echo '<td>' . $value["sexo"] . '</td>';
                                echo '<td>
                                            <div class="btn-group">
                                                <button class="btn btn-warning btnEditarJerarquia" idJerarquia="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarJerarquia"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btnEliminarJerarquia" idJerarquia="' . $value["id"] . '"><i class="fa fa-times"></i></button>
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
MODAL EDITAR JERARQUIA
======================================-->

<div class="modal fade" id="modalEditarJerarquia">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header">
                <h5 class="modal-title">Editar Jerarquia</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
              CUERPO DEL MODAL
              ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <!-- ENTRADA PARA EL Jerarquia -->
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Cargo</label>
                            <input class="form-control" type="text" id="editarCargoJ" name="editarCargoJ" required readonly>
                        </div>
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" id="editarNombreJ" name="editarNombreJ" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                        <!-- ENTRADA PARA EL GENERO -->
                        <label class="col-form-label">Sexo</label>
                            <select class="custom-select" name="editarSexoJ" id="editarSexoJ" required>
                                <option value="">Selecionar Sexo</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                        <!-- ENTRADA PARA EL ID -->
                            <input type="hidden" id="idJerarquia" name="idJerarquia">
                    </div>
                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                    <?php
                    $editarJerarquia = new ControladorJerarquia();
                    $editarJerarquia->ctrEditarJerarquia();
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL AGREGAR JERARQUIA
======================================-->
<div class="modal fade" id="modalAgregarJerarquia">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-tittle">Agregar Jerarquia</h5>
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
                            <label for="example-text-input" class="col-form-label">Cargo</label>
                            <input class="form-control" type="text" name="nuevoCargoJ" placeholder="Ingresar nombre completo" autocomplete="off" required>
                        </div>
                        <!-- ENTRADA PARA RESIDENTES -->
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" name="nuevoNombreJ" placeholder="Ingresar numero maximo de residentes" autocomplete="off" required>
                        </div>
                    </div>
                    <!-- ENTRADA PARA EL GENERO -->
                    <label class="col-form-label">Sexo</label>
                            <select class="custom-select" name="nuevoSexoJ" required>
                                <option value="">Selecionar Sexo</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    <?php
                    $crearDocente = new ControladorJerarquia();
                    $crearDocente->ctrCrearDocente();
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
$borrarJerarquia = new ControladorJerarquia();
$borrarJerarquia->ctrborrarJerarquia();
?>