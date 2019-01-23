<div class="login-area login-bg">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="post" novalidate="">
                    <div class="login-form-head">
                        <h4>Inicia Sesion</h4>
                        <p>Inicia sesion para acceder a las opciones del sistema.</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="user">Usuario</label>
                            <input type="text" id="user" name="username">
                            <i class="fa fa-user fa-2x"></i>
                        </div>
                        <div class="form-gp">
                            <label for="pass">ContraseĂ±a</label>
                            <input type="password" id="pass" name="password">
                            <i class="fa fa-lock fa-2x"></i>
                        </div>

                        <?php if (!empty($errores)): ?>
                        <div class="alert alert-dismissible alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $errores; ?>
                            </div>
                        <?php endif;?>

                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Iniciar Sesion <i class="fa fa-sign-in fa-lg"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>