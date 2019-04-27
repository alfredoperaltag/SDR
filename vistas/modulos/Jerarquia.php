<div class="col-12 mt-3">
    <div class="card">
        <h2 class="ml-4">Jerarquia</h2>
        <div class="card-body">
            <div class="data-tables datatable-primary">
                <table class="text-center tablaES">
                    <thead class="text-capitalize">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Cargo</th>
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
                                echo '<td>' . $value["nombre"] . '</td>';
                                        echo '<td>' . $value["cargo"] . '</td>';
                                // if ($value["estado"] != 0) {
                                //     echo '<td><button class="btn btn-success btn-xs btnActivarJera" idDocenteJera="' . $value["id"] . '" estadoDocenteJera="0">Activado</button></td>';
                                // } else {
                                //     echo '<td><button class="btn btn-danger btn-xs btnActivarJera" idDocenteJera="' . $value["id"] . '" estadoDocenteJera="1">Desactivado</button></td>';
                                // }
                                echo '<td>
                                            <div class="btn-group">
                                                <button class="btn btn-warning btnEditarDocenteJera" idDocenteJera="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarDocenteJera"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btnEliminarDocenteJera" idDocenteJera="' . $value["id"] . '"><i class="fa fa-times"></i></button>
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