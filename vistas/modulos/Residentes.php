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
    <div class="modal-dialog modal-dialog-centered" role="document">
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
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" name="nuevoNombre" placeholder="Ingresar nombre completo"
                                required>
                        </div>
                        <!-- ENTRADA PARA EL USUARIO -->
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Usuario</label>
                            <input class="form-control" type="text" name="nuevoUsuario" placeholder="Ingresar usuario"
                                required>
                        </div>
                        <!-- ENTRADA PARA LA CONTRASEÑA -->
                        <div class="form-group">
                            <label class="">Contraseña</label>
                            <input type="password" class="form-control" name="nuevoPassword" placeholder="Ingresar contraseña"
                                required>
                        </div>
                        <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
                        <div class="form-group">
                            <label class="col-form-label">Perfil</label>
                            <select class="custom-select">
                                <option value="">Selecionar perfil</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Especial">Especial</option>
                                <option value="Vendedor">Vendedor</option>
                            </select>
                        </div>
                        <!-- ENTRADA PARA SUBIR FOTO -->
                        <div class="form-group">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Seleccionar archivo</label>
                                    </div>
                                </div>
                                <p class="help-block">Peso máximo de la foto 2MB</p>
                                <img src="images/author/avatar.png" class="img-thumbnail previsualizar" width="100px">
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