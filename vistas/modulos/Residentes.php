<div class="col-12 mt-5">
    <div class="card">
        <h2 class="ml-4">Residentes</h2>
        <div class="card-body">
            <!-- <h1 class="header-title">Usuarios</h1> -->
            <button class="btn btn-primary btn-xs mb-3" data-toggle="modal" data-target="#modalAgregarUsuario">Alta Residente <br> Informe Tecnico de<br> Residencias Profecionales</button>
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
                <h5 class="modal-title">Agregar Residente</h5>
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
                            <div class="col-sm-2 my-1">
                                <label for="example-text-input" class="col-form-label">No. Control</label>
                                <input class="form-control" type="number" name="nuevoNoControl" placeholder="No. Control"
                                    required autocomplete="off">
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR SU CARRERA -->
                            <div class="col-sm-5 my-1">
                                <label class="col-form-label">Carrera</label>
                                <select class="custom-select" required>
                                    <option value="">Selecionar carrera</option>
                                    <option value="ISC">Ingenieria en Sistemas Computacionales</option>
                                    <option value="II">Ingenieria Informatica</option>
                                </select>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR PERIODO -->
                            <div class="col-sm-3 my-1">
                                <label class="col-form-label">Periodo</label>
                                <select class="custom-select" required>
                                    <option value="">Selecionar periodo</option>
                                    <option value="EJ">Enero/Junio</option>
                                    <option value="AD">Agosto/Diciembre</option>
                                </select>
                            </div>

                            <div class="col-sm-2 my-1">
                                    <label class="col-form-label">Periodo</label>
                                    <?php
                                    $cont = date('Y');
                                    ?>
                                    <select class="custom-select" id="sel1" required>
                                    <?php while ($cont >= 2018) { ?>
                                    <option name="anio" value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                                    <?php $cont = ($cont-1); } ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-row align-items-center">
                            <!-- ENTRADA PARA EL NOMBRE -->
                            <div class="col-sm-4 my-1">
                                <label for="example-text-input" class="col-form-label">Nombre</label>
                                <input class="form-control" type="text" name="nuevoNombre" placeholder="Nombre"
                                    required autocomplete="off">
                            </div>
                            <!-- ENTRADA PARA EL APELLIDO PATERNO -->
                            <div class="col-sm-4 my-1">
                                <label for="example-text-input" class="col-form-label">Apellido Paterno</label>
                                <input class="form-control" type="text" name="nuevoApellidoP" placeholder="Apellido Paterno"
                                    required autocomplete="off">
                            </div>
                            <!-- ENTRADA PARA EL APELLIDO MATERNO -->
                            <div class="col-sm-4 my-1">
                                <label for="example-text-input" class="col-form-label">Apellido Materno</label>
                                <input class="form-control" type="text" name="nuevoApellidoM" placeholder="Apellido Materno"
                                    required autocomplete="off">
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
                                <input class="form-control" type="tel" name="nuevoNombre" placeholder="Telefono"
                                    required autocomplete="off">
                            </div>
                        </div>
                        <hr>
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