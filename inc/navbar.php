<?php
if (isset($_POST['correo_login']) && isset($_POST['contrasena_login'])) {
    include "./process/login.php";
}
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #026034;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="color: white"><img src="logo_utj.jpg" alt="logo" width="30" height="24" class="d-inline-block align-text-top" />&nbsp;&nbsp;<strong>Universidad
                    Tecnologica Jalisco</strong></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php if (isset($_SESSION['tipo']) && isset($_SESSION['nombre'])): ?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user"></span> &nbsp; <?php echo $_SESSION['nombre']; ?><b
                                    class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- usuarios -->
                            <?php if ($_SESSION['tipo'] == "user"): ?>
                                <li>
                                    <a href="./index.php?view=soporte"><span class="glyphicon glyphicon-flag"></span>&nbsp;&nbsp;Levanta Ticket</a>
                                </li>
                                <li>
                                    <a href="#!"><span
                                                class="glyphicon glyphicon-comment"></span>&nbsp;&nbsp;Mensajes</a>
                                </li>
                                <li>
                                    <a href="./index.php?view=configuracion"><i class="fa fa-cogs"></i>&nbsp;&nbsp;Configuracion</a>
                                </li>
                            <?php endif; ?>

                            <!-- admins -->
                            <?php if ($_SESSION['tipo'] == "admin"): ?>
                                <li>
                                    <a href="admin.php?view=ticketadmin"><span
                                                class="glyphicon glyphicon-envelope"></span> &nbsp; Administrar Tickets</a>
                                </li>
                                <li>
                                    <a href="admin.php?view=users"><span class="glyphicon glyphicon-user"></span> &nbsp;Administrar
                                        Usuarios</a>
                                </li>
                                <li>
                                    <a href="admin.php?view=admin"><span class="glyphicon glyphicon-user"></span> &nbsp;Administrar
                                        Administradores</a>
                                </li>
                                <li>
                                    <a href="admin.php?view=config"><i class="fa fa-cogs"></i> &nbsp; Configuracion</a>
                                </li>
                            <?php endif; ?>
                            <li class="divider"></li>
                            <li><a href="./process/logout.php" style="color: #d2322d"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Cerrar sesión</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            <?php endif; ?>
            <ul class=" nav navbar-nav navbar-right">
                <li>
                    <a href="./index.php"><span class="glyphicon glyphicon-home"></span> &nbsp; Inicio</a>
                </li>

                <?php if (!isset($_SESSION['tipo']) && !isset($_SESSION['nombre'])): ?>
                    <li>
                        <a href="./index.php?view=registro"><i class="fa fa-users"></i>&nbsp;&nbsp;Registrate</a>
                    </li>
                    <li>
                        <a href="#!" data-toggle="modal" data-target="#modalLog"><span
                                    class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Login</a>
                    </li>
                <?php endif; ?>

            </ul>

        </div>
    </div>
</nav>

<div class="modal fade" tabindex="-1" role="dialog" id="modalLog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center" style="color: black" id="myModalLabel">Bienvenido a Soporte Tecnico UTJ</h4>
            </div>
            <form action="" method="POST" style="margin: 20px;">
                <div class="form-group">
                    <label><span class="glyphicon glyphicon-user"></span>&nbsp;Correo Institucional</label>
                    <input type="email" class="form-control" name="correo_login" placeholder="Escriba su correo"
                           required=""/>
                </div>
                <div class="form-group">
                    <label><span class="glyphicon glyphicon-lock"></span>&nbsp;Contraseña</label>
                    <input type="password" class="form-control" name="contrasena_login"
                           placeholder="Escribe tu contraseña" required=""/>
                </div>

                <p>¿Cómo iniciaras sesión?</p>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="user" checked>
                        Usuario
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="admin">
                        Administrador
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm">Iniciar sesión</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>