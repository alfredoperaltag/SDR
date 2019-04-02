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
                            <th>Carrera</th>
                            <th>Sexo</th>
                            <th>Telefono</th>
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