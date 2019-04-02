<div class="col-12 mt-3">
    <div class="card">
        <h2 class="ml-4">Directorio</h2>
        <div class="card-body">
            <div class="data-tables datatable-primary">
                <table class="text-center tablaES">
                    <thead class="text-capitalize">
                        <tr>
                            <th>#</th>
                            <th>Extension</th>
                            <th>Departamento</th>
                            <th>Responsable</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- TODO: Hacer la alineacion del texto y el boton de editar -->

                        <?php
                        $VerResidentes = new ControladorDirectorio();
                        $VerResidentes->ctrMostrarDirectorio();
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!--=====================================
MODAL EDITAR DIRECCION
======================================-->
<!-- basic modal start -->
<div class="modal fade" id="modalEditDirectory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar directorio</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-row align-items-center pb-1">
                    <div class="col-sm-12 my-1">
                        <label for="example-text-input" class="col-form-label">Extension</label>
                        <input class="form-control" type="text" name="nuevoExtension" placeholder="Extension"
                            required autocomplete="off">
                    </div>
                </div>
                <div class="form-row align-items-center pb-1">
                    <div class="col-sm-12 my-1">
                        <label for="example-text-input" class="col-form-label">Departamento</label>
                        <input class="form-control" type="text" name="nuevoDepartamento" placeholder="Departamento"
                            required autocomplete="off">
                    </div>
                </div>
                <div class="form-row align-items-center pb-1">
                    <div class="col-sm-12 my-1">
                        <label for="example-text-input" class="col-form-label">Responsable</label>
                        <input class="form-control" type="text" name="nuevoResponsable" placeholder="Responsable"
                            required autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>