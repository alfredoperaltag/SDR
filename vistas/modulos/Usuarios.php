<div class="col-12 mt-3">
    <div class="card">
        <h2 class="ml-4">Usuarios</h2>
        <div class="card-body">
            <!-- <h1 class="header-title">Usuarios</h1> -->
            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalAgregarUsuario">Agregar Usuario</button>
            <div class="data-tables datatable-primary">
                <table class="text-center tablaES">
                    <thead class="text-capitalize">
                        <tr>
                            <th>Nombre</th>
                            <th>Nombre de Usuario</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;
                        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                        foreach ($usuarios as $key => $value) {
                            if ($_SESSION['usuario'] != $value["usuario"]) {
                                echo '<tr>
                                        <td>' . $value["nombre"] . '</td>
                                        <td>' . $value["usuario"] . '</td>
                                        <td>' . $value["perfil"] . '</td>';
                                if ($value["estado"] != 0) {
                                    echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="' . $value["id"] . '" estadoUsuario="0">Activado</button></td>';
                                } else {
                                    echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="' . $value["id"] . '" estadoUsuario="1">Desactivado</button></td>';
                                }
                                echo '<td>
                                            <div class="btn-group">
                                                <button class="btn btn-warning btnEditarUsuario" idUsuario="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-danger btnEliminarUsuario" idUsuario="' . $value["id"] . '"><i class="fa fa-times"></i></button>
                                            </div>
                                        </td>
                                    </tr>';
                            }
                        }
                        ?>
                        <!-- 
                        <th>Contraseña</th>
                        <td><div class="alert alert-info" role="alert"><strong>¡Puede modificar la contraseña desde el boton editar!</strong></div></td> 
                    -->
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
                            <input class="form-control" type="text" name="nuevoNombre" placeholder="Ingresar nombre completo" autocomplete="off" required>
                        </div>
                        <!-- ENTRADA PARA EL USUARIO -->
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Usuario</label>
                            <input class="form-control" type="text" name="nuevoUsuario" id="nuevoUsuario" placeholder="Ingresar usuario" autocomplete="off" required>
                        </div>
                        <!-- ENTRADA PARA LA CONTRASEÑA -->
                        <div class="form-group">
                            <label class="">Contraseña</label>
                            <input type="password" class="form-control" name="nuevoPassword" id="nuevoPassword" placeholder="Ingresar nueva contraseña" required>
                        </div><!-- ENTRADA PARA CONFIRMAR CONTRASEÑA -->
                        <div class="form-group">
                            <label class="">Confirmar La Contraseña</label>
                            <input type="password" class="form-control" name="confirmarPassword" id="confirmarPassword" placeholder="Confirme La contraseña" required>
                        </div>
                        <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
                        <div class="form-group">
                            <label class="col-form-label">Perfil</label>
                            <select class="custom-select" name="nuevoPerfil">
                                <option value="">Seleccionar Perfil</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Usuario">Usuario</option>
                            </select>
                        </div>
                        <!-- ENTRADA PARA SUBIR FOTO -->
                        <!-- <div class="form-group">
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
                        </div> -->
                    </div>
                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar usuario</button>
                    </div>
                    <?php
                    $crearUsuario = new ControladorUsuarios();
                    $crearUsuario->ctrCrearUsuario();
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div class="modal fade" id="modalEditarUsuario">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header">
                <h5 class="modal-title">Editar usuario</h5>
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
                        </div>
                        <!-- ENTRADA PARA EL USUARIO -->
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Usuario</label>
                            <input class="form-control" type="text" id="editarUsuario" name="editarUsuario" value="" required readonly>
                        </div>
                        <!-- ENTRADA PARA LA CONTRASEÑA -->
                        <div class="form-group">
                            <label class="">Contraseña</label>
                            <input type="password" class="form-control" name="editarPassword" placeholder="Escriba la nueva contraseña">
                            <input type="hidden" id="passwordActual" name="passwordActual">
                        </div>
                    </div><!-- ENTRADA PARA CONFIRMAR CONTRASEÑA -->
                    <div class="form-group">
                        <label class="">Confirmar La Contraseña</label>
                        <input type="password" class="form-control" name="confirmarPassword" placeholder="Confirme La contraseña">
                    </div>
                    <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
                    <div class="form-group">
                        <label class="col-form-label">Perfil</label>
                        <select class="custom-select" id="editarPerfil" name="editarPerfil">
                            <option value="">Seleccionar Perfil</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Usuario">Usuario</option>
                        </select>
                    </div>
                    <!-- ENTRADA PARA SUBIR FOTO -->
                    <!-- <div class="form-group">
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
                        </div> -->
                </div>
                <!--=====================================
                    PIE DEL MODAL
                    ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">modificar usuario</button>
                </div>
                <?php
                $editarUsuario = new ControladorUsuarios();
                $editarUsuario->ctrEditarUsuario();
                ?>
        </div>
        </form>
    </div>
</div>
</div>
<?php
$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();
?> 