<!-- main header area start -->
<div class="mainheader-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="logo">
                        <a href="inicio"><img src="images/icon/logo2.png" alt="logo"></a>
                    </div>
                </div>
                <!-- profile info & task notification -->
                <div class="col-md-9 clearfix text-right">
                    <!-- <div class="d-md-inline-block d-block mr-md-4">
                        <ul class="notification-area">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        </ul>
                    </div> -->
                    <div class="clearfix d-md-inline-block d-block">
                        <div class="user-profile m-0">
                            <img class="avatar user-thumb" src="vistas/assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['nombre']; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Opciones</a>
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
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- nav and search button -->
                <div class="col-lg-3 clearfix">
                    <div class="search-box">
                        <form action="#">
                            <input type="text" name="search" placeholder="Buscar..." required>
                            <i class="ti-search"></i>
                        </form>
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