<div class="col-12 mt-3">
    <div class="card">
        <h2 class="ml-4">Pre-Registro</h2>
        <div class="card-body">
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalAgregarPreRegistro">Agregar Pre-Registro</button>
            <div class="data-tables datatable-primary">
                <table class="text-center tablaES">
                    <thead class="text-capitalize">
                        <tr>
                            <th>#</th>
                            <th>No. Control</th>
                            <th>Carrera</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Asesor</th>
                            <?php
                            if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == "Administrador") {
                            echo '<th>Acciones</th>';
                            }else{
								echo '<th>Acciones</th>';
							}
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $item = null;
                        $valor = null;
                        $docentes = ControladorPreRegistro::ctrMostrarResidentesPre($item, $valor);
                        $c = 0;
                        foreach ($docentes as $key => $value) {
                            $c++;
                                echo '<tr>
                                        <td>' . $c . '</td>';
                                echo '<td>' . $value["noControl"] . '</td>';
                                echo '<td>' . $value["carrera"] . '</td>';
                                echo '<td>' . $value["nombre"] .' '. $value["apellidoP"] .' '.$value["apellidoM"] .'</td>';
                                        echo '<td>' . $value["telefono"] . '</td>';
                                        echo '<td>' . $value["asesorR"] . '</td>';
                                echo '<td>
                                        <div class="btn-group">';
                                        if (isset($_SESSION['perfil']) && $_SESSION['perfil'] == "Administrador") {
                                        echo '<button class="btn btn-warning btnEditarPreRegistro" idPreRegistroEdit="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarPreRegistro"><i class="fa fa-edit"></i></button>';
                                            echo '<button class="btn btn-danger btnEliminarPreRegistro" idPreRegistroDel="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
                                            }else{
												//echo '<button class="btn btn-warning" disabled><i class="fa fa-edit"></i></button>';
												echo '<p>Sin acciones</p>';
											}
                                        echo '</div>
                                    </td>
                                </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--=====================================
    AGREGAR PRE-REGISTRO
======================================-->
<div class="modal fade" id="modalAgregarPreRegistro">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header  bg-primary text-white">
                <h5 class="modal-tittle">Pre-Registro</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                    <div id="AlertAsesorPreRegistroEditView" style="display:block;" class="alert alert-dismissible alert-danger text-center">
                                <h6>¡Cuidado! Revisa que tus datos esten escritos correctamente antes de guardar.</h6>
                            </div>
                    <div class="form-row align-items-center">
                            
                    <input type="hidden" id="idResidentePreRe" name="idResidentePreRe">
                        <!-- ENTRADA PARA EL NUMERO DE CONTROL -->
                        <div class="col-sm-4 my-1">
                                <label for="example-text-input" class="col-form-label">No. Control</label>
                                <input class="form-control" type="number" name="nuevoNoControlPR" placeholder="Ingresar numero de control" autocomplete="off" required>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR SU CARRERA -->
                            <div class="col-sm-5 my-1">
                                <label class="col-form-label">Carrera</label>
                                <select class="custom-select" name="nuevoCarreraPR" required>
                                    <option value="">Selecionar carrera</option>
                                    <option value="Ingeniería en Sistemas Computacionales">Ingenieria en Sistemas
                                        Computacionales</option>
                                    <option value="Ingeniería Informática">Ingenieria Informatica</option>
                                </select>
                            </div>
                            <!-- ENTRADA PARA TELEFONO -->
                        <div class="col-sm-3 my-1">
                                <label for="example-text-input" class="col-form-label">Telefono</label>
                                <input class="form-control" type="number" name="nuevoTelefonoPR" placeholder="Telefono" autocomplete="off" required>
                            </div>
                            </div>
                            <div class="form-row align-items-center">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" name="nuevoNombrePR" placeholder="Ingresar nombre" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();" required>
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO PATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Paterno</label>
                            <input class="form-control" type="text" name="nuevoApellidoPPR" placeholder="Ingresar apellido paterno" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();" required>
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO MATERNO -->
                            <div class="col-sm-4 my-1">
                                <label for="example-text-input" class="col-form-label">Apellido Materno</label>
                                <input class="form-control" type="text" name="nuevoApellidoMPR" placeholder="Ingresar apellido materno" autocomplete="off" onkeyup="this.value = this.value.toUpperCase();" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA ASESOR INTERNO -->
                        <!-- <div class="form-group">
                            <label class="col-form-label">Asesor Interno</label>
                            <select class="custom-select" name="nuevoAsesorPRE" required>
                                <option value="">Selecionar Asesor</option>
                                <?php
                                // $verDocente = new ControladorResidentes();
                                // $verDocente->ctrMostrarTodosLosDocesentes();
                                ?>
                            </select>
                        </div> -->
                        <div class="form-row align-items-center">
                        <div class="col-sm-11 my-1">
                            <label class="col-form-label">Asesor Interno</label>
                            <select class="custom-select DocentesDisponibles" name="nuevoAsesorPRE" id="DocentesDisponibles" required>
                            <option value="NA" selected>Recarga por favor -></option>
                            </select>
                        </div>
                            <div class="col-sm-1 my-1">
                                <!-- <input class="form-control" type="text" placeholder="Ingresar apellido materno" required> -->
                                <label class="col-form-label">Recargar</label>
                                <button type="button" class="btn btn-primary btnActuDocDisp"><span class="fa fa-redo-alt"></span></button>
                            </div>
                        </div>
                    </div>
                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button> -->
                        <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    <?php
                        $crearDocente = new ControladorPreRegistro();
                        $crearDocente->ctrPreRegistrar();
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR PRE-REGISTRO
======================================-->
<div class="modal fade" id="modalEditarPreRegistro">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!--=====================================
              CABEZA DEL MODAL
              ======================================-->
            <div class="modal-header  bg-warning text-white">
                <h5 class="modal-tittle">Editar Pre-Registro</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form role="form" method="post" enctype="multipart/form-data">
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                    <div class="form-row align-items-center">
                        <!-- ID PRE-REGISTRO -->
                    <input type="hidden" id="idPreRegistroEdit" name="idPreRegistroEdit">
                        <!-- ENTRADA PARA EL NUMERO DE CONTROL -->
                        <div class="col-sm-4 my-1">
                                <label for="example-text-input" class="col-form-label">No. Control</label>
                                <input class="form-control" type="number" name="editarNoControlPR" id="editarNoControlPR" placeholder="Ingresar nomuero de control" autocomplete="off" required>
                            </div>
                            <!-- ENTRADA PARA SELECCIONAR SU CARRERA -->
                            <div class="col-sm-5 my-1">
                                <label class="col-form-label">Carrera</label>
                                <select class="custom-select" name="editarCarreraPR" id="editarCarreraPR" required>
                                    <option value="">Selecionar carrera</option>
                                    <option value="Ingeniería en Sistemas Computacionales">Ingenieria en Sistemas
                                        Computacionales</option>
                                    <option value="Ingeniería Informática">Ingenieria Informatica</option>
                                </select>
                            </div>
                            <!-- ENTRADA PARA TELEFONO -->
                            <div class="col-sm-3 my-1">
                                <label for="example-text-input" class="col-form-label">Telefono</label>
                                <input class="form-control" type="number" name="editarTelefonoPR" id="editarTelefonoPR" placeholder="Telefono" autocomplete="off" required>
                            </div>
                            </div>
                            <div class="form-row align-items-center">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Nombre</label>
                            <input class="form-control" type="text" name="editarNombrePR" id="editarNombrePR" placeholder="Ingresar nombre" autocomplete="off" required>
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO PATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Paterno</label>
                            <input class="form-control" type="text" name="editarApellidoPPR" id="editarApellidoPPR" placeholder="Ingresar apellido paterno" autocomplete="off" required>
                        </div>
                        <!-- ENTRADA PARA EL APELLIDO MATERNO -->
                        <div class="col-sm-4 my-1">
                            <label for="example-text-input" class="col-form-label">Apellido Materno</label>
                            <input class="form-control" type="text" name="editarApellidoMPR" id="editarApellidoMPR" placeholder="Ingresar apellido materno" autocomplete="off" required>
                        </div>
                        </div>
                        <!-- AVISO -->
                        <div  class="form-row justify-content-center">
                        <div class="col-sm-5">
                            <!-- <label class="col-form-label mr-4">Editar, sin cambiar Asesor:</label> -->
                            <div class="custom-control custom-checkbox custom-control-inline mt-2">
                                <input type="checkbox" name="CheckPreRegistroEdit" class="custom-control-input CheckPreRegistroEdit" id="CheckPreRegistroEdit">
                                <label class="custom-control-label" for="CheckPreRegistroEdit"><h6>Editar sin afectar el asesor</h6></label>
                            </div>
                        </div>
                    </div>
                    <br>
                                <div id="AlertAsesorPreRegistroEditView" style="display:block;" class="alert alert-dismissible alert-danger text-center">
                                <!-- <button type="button" class="text-center" data-dismiss="alert"></button> -->
                                En el caso de no existir un docente por el momento o uno diferente, mejor espera que un Administrador edite el registro.
                                </div>
                        <!-- ENTRADA PARA ASESOR INTERNO -->
                        <div id="AsesorPreRegistroEditView" style="display:block;" class="form-group">
                            <label class="col-form-label">Asesor Interno</label>
                            <select class="custom-select" name="editarAsesorPRE" id="editarAsesorPRE" required>
                                <option value="">Selecionar Asesor</option>
                                <?php
                                $verDocente = new ControladorResidentes();
                                $verDocente->ctrMostrarTodosLosDocesentes();
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    <?php
                    $crearDocente = new ControladorPreRegistro();
                    $crearDocente->ctrEditarPreRegistro();
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_GET['idPreRegistro'])) {
    $item = 'id';
    $valor = $_GET['idPreRegistro'];
    $DocenteAnterior = ControladorPreRegistro::ctrMostrarInfoPreRegistro($item, $valor);
    $tablaDocente = "asesor";
    $res1 = ModeloResidentes::mdlRestarResidente($tablaDocente, $DocenteAnterior['asesorPre']);
}
$borrarPreRegistro = new ControladorPreRegistro();
$borrarPreRegistro->ctrBorrarPreRegistro();
?> 