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
            <form role="form" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" id="idDirectorioEdit" name="idDirectorioEdit">
                <div class="form-row align-items-center pb-1">
                    <div class="col-sm-12 my-1">
                        <label for="example-text-input" class="col-form-label">Extension</label>
                        <input class="form-control" type="text" name="nuevoExtension" id="nuevoExtension" placeholder="Extension"
                            required autocomplete="off">
                    </div>
                </div>
                <div class="form-row align-items-center pb-1">
                    <div class="col-sm-12 my-1">
                        <label for="example-text-input" class="col-form-label">Departamento</label>
                        <input class="form-control" type="text" name="nuevoDepartamento" id="nuevoDepartamento" placeholder="Departamento"
                            required autocomplete="off">
                    </div>
                </div>
                <div class="form-row align-items-center pb-1">
                    <div class="col-sm-12 my-1">
                        <label for="example-text-input" class="col-form-label">Responsable</label>
                        <input class="form-control" type="text" name="nuevoResponsable" id="nuevoResponsable" placeholder="Responsable"
                            required autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="summit" class="btn btn-primary">Guardar</button>
            </div>
                <?php
                $editarDirectorio = new ControladorDirectorio();
                $editarDirectorio->ctrEditarDirectorio();
                ?>
            </form>
        </div>
    </div>
</div>