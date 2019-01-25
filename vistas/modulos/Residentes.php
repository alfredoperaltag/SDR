<div class="col-12 mt-5">
    <div class="card">
        <h2 class="ml-4">Residentes</h2>
        <div class="card-body">
            <!-- <h1 class="header-title">Usuarios</h1> -->
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar Usuario</button>
            <div class="data-tables datatable-primary">
                <table class="text-center tablaES">
                    <thead class="text-capitalize">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>No. Control</th>
                            <th>Carrera</th>
                            <th>Sexo</th>
                            <th>Telefono</th>
                            <th>Proyecto</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Yonathan Román Salgado</td>
                            <td>15670051</td>
                            <td>Ingenieria en Sistemas Computacionales</td>
                            <td>M</td>
                            <td>7331089089</td>
                            <td>Sistema de Residencias</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-primary"><i class="fa fa-info"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Alfredo Peralta Garcia</td>
                            <td>15670123</td>
                            <td>Ingenieria en Sistemas Computacionales</td>
                            <td>M</td>
                            <td>7331234578</td>
                            <td>Sistema de Residencias</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-primary"><i class="fa fa-info"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div class="modal fade" id="modalAgregarUsuario">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header">
                <h5 class="modal-title">Agregar usuario</h5>
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
                                <input class="form-control" type="text" name="nuevoNombre" placeholder="Numero de control"
                                    required>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR SU CARRERA -->
                            <div class="col-sm-6 my-1">
                                <label class="col-form-label">Carrera</label>
                                <select class="custom-select" required>
                                    <option value="">Selecionar carrera</option>
                                    <option value="ISC">Ingenieria en Sistemas Computacionales</option>
                                    <option value="II">Ingenieria Informatica</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row align-items-center">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" name="nuevoNombre" placeholder="Ingresar nombre completo"
                                required>
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO PATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Paterno</label>
                            <input class="form-control" type="text" name="nuevoApellidoP" placeholder="Ingresar apellido paterno completo"
                                required>
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO MATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Materno</label>
                            <input class="form-control" type="text" name="nuevoApellidoM" placeholder="Ingresar apellido materno completo"
                                required>
                        </div>
                    </div>
                    <div class="form-row align-items-center">
                        <!-- ENTRADA PARA SELECCIONAR SU SEXO -->
                        <div class="col-sm-6 my-1">
                            <label class="col-form-label">Sexo</label>
                            <select class="custom-select" required>
                                <option value="">Selecionar sexo</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                        <!-- ENTRADA PARA EL TELEFONO -->
                        <div class="col-sm-6 my-1">
                            <label for="example-text-input" class="col-form-label">Telefono</label>
                            <input class="form-control" type="text" name="nuevoNombre" placeholder="Ingresar telefono"
                                required>
                        </div>
                    </div>
                </div>
                    <!--=====================================
              PIE DEL MODAL
              ======================================-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar usuario</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>