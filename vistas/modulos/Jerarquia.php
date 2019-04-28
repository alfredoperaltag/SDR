<div class="col-12 mt-3">
    <div class="card">
        <h2 class="ml-4">Jerarquia</h2>
        <div class="card-body">
            <div class="data-tables datatable-primary">
                <table class="text-center tablaES">
                    <thead class="text-capitalize">
                        <tr>
                            <th>#</th>
                            <th>Cargo</th>
                            <th>Nombre</th>
                            <!-- <th>Estado</th> -->
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $docentes = ControladorJerarquia::ctrMostrarDocentesJerarquia($item, $valor);
                        foreach ($docentes as $key => $value) {
                            if ($value["nombre"] != "NA") {
                                echo '<tr>
                                        <td>' . $value["id"] . '</td>';
                                echo '<td>' . $value["cargo"] . '</td>';
                                echo '<td>' . $value["nombre"] . '</td>';
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
                            <label for="example-text-input" class="col-form-label">Jerarquia</label>
                            <input class="form-control" type="text" id="editarJerarquia" name="editarJerarquia" value="" required readonly>
                        </div>
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" id="editarNombre" name="editarNombre" value="" autocomplete="off" required>
                        </div>
                    </div>
                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">modificar Jerarquia</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


<?php
//$editarJerarquia = new ControladorJerarquias();
//$editarJerarquia->ctrEditarJerarquia("editarJerarquia", "editarNombre", "editarPassword", "confirmarPassword", "passwordActual", "editarPerfil");
?>