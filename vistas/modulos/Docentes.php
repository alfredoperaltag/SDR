<div class="col-12 mt-5">
    <div class="card">
        <h2 class="ml-4">Docentes</h2>
        <div class="card-body">
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalAgregarDocente">Agregar Docente</button>
            <div class="data-tables datatable-primary">
                <table class="text-center tablaES">
                    <thead class="text-capitalize">
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nombre</td>
                            <td>Estado</td>
                        </tr>
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
            <div class="modal-header">
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
                            <input class="form-control" type="text" name="nuevoNombre" placeholder="Ingresar nombre completo"
                                required>
                        </div>
                    </div>
                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar usuario</button>
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