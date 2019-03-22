<!-- main header area start -->
<div class="mainheader-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3">
                <div class="logo">
                    <a href="Inicio"><img src="vistas/assets/images/icon/logo-1.svg" alt="logo"></a>
                </div>
            </div>
            <div class="col-md-9 clearfix text-right">
                <div class="clearfix d-md-inline-block d-block">
                    <div class="user-profile m-0">
                        <img class="avatar user-thumb" src="vistas/assets/images/author/avatar.png" alt="avatar">
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['nombre']; ?> <i class="fa fa-angle-down"></i></h4>
                        <div class="dropdown-menu">
                            <a class="dropdown-item  btnEditarMiUsuario" idUsuario=" <?php echo $_SESSION["id"]; ?>" data-toggle="modal" data-target="#modalEditarMiUsuario" href="#">Editar mi cuenta</a>
                            <a class="dropdown-item" href="CerrarSesion">Cerrar Sesion</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- main header area end -->
<!-- header area start -->
<div class="header-area header-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9  d-none d-lg-block">
                <div class="horizontal-menu">
                    <nav>
                        <ul id="nav_menu">
                            <li>
                                <a href="Inicio"><i class="fa fa-home fa-2x" style="color: #845ef7;"></i><span><strong>Inicio</strong></span></a>
                            </li>
                            <li>
                                <a href="Usuarios"><i class="fa fa-user fa-2x" style="color: #845ef7;"></i><span><strong>Usuarios</strong></span></a>
                            </li>
                            <li>
                                <a href="Residentes"><i class="fa fa-users fa-2x" style="color: #845ef7;"></i><span><strong>Residentes</strong></span></a>
                            </li>
                            <li>
                                <a href="Docentes"><i class="fa fa-users fa-2x" style="color: #845ef7;"></i><span><strong>Docentes</strong></span></a>
                            </li>
                            <li>
                                <a href="Directorio"><i class="fa fa-phone fa-2x" style="color: #845ef7;"></i><span><strong> Directorio</strong></span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- mobile_menu -->
            <div class="col-12 d-block d-lg-none">
                <div id="mobile_menu"></div>
            </div>
        </div>
    </div>
</div>
<!-- header area end -->

<!--=====================================
MODAL EDITAR USUARIO
======================================-->
<div class="modal fade" id="modalEditarMiUsuario">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->
            <div class="modal-header">
                <h5 class="modal-title">Editar mi cuenta</h5>
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
                            <input class="form-control" type="text" id="editarMiNombre" name="editarMiNombre" value="" autocomplete="off" required>
                        </div>
                        <!-- ENTRADA PARA EL USUARIO -->
                        <div class="form-group">
                            <label for="example-text-input" class="col-form-label">Usuario</label>
                            <input class="form-control" type="text" id="editarMiUsuario" name="editarMiUsuario" value="" required readonly>
                        </div>
                        <!-- ENTRADA PARA LA CONTRASEÑA -->
                        <div class="form-group">
                            <label class="">Contraseña</label>
                            <input type="password" class="form-control editarComprobarMiPassword" name="editarMiPassword" id="editarMiPassword" placeholder="Escriba la nueva contraseña">
                            <input type="hidden" id="miPasswordActual" name="miPasswordActual">
                        </div>
                        <!-- ENTRADA PARA CONFIRMAR CONTRASEÑA -->
                        <div class="form-group">
                            <label class="">Confirmar La Contraseña</label>
                            <input type="password" class="form-control editarComprobarMiPassword" name="confirmarMiPassword" id="editarConfirmarMiPassword" placeholder="Confirme La contraseña">
                        </div>
                        <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
                        <div class="form-group">
                            <label class="col-form-label">Perfil</label>
                            <input class="form-control" type="text" id="editarMiPerfil" name="editarMiPerfil" readonly>
                            </select>
                        </div>
                    </div>
                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">modificar mi cuenta</button>
                    </div>
                    <?php
                    $editarUsuario = new ControladorUsuarios();
                    $editarUsuario->ctrEditarMiUsuario();
                    ?>
                </div>
            </form>
        </div>
    </div>
</div> 