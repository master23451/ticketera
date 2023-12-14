<?php if (isset($_SESSION['nombre']) && isset($_SESSION['tipo'])) {
    if (isset($_POST['fecha_ticket']) && isset($_POST['name_ticket']) && isset($_POST['email_ticket'])) {

        /*Este codigo nos servira para generar un numero diferente para cada ticket*/
        $codigo = "";
        $longitud = 2;
        for ($i = 1; $i <= $longitud; $i++) {
            $numero = rand(0, 9);
            $codigo .= $numero;
        }
        $num = Mysql::consulta("SELECT * FROM ticket");
        $numero_filas = mysqli_num_rows($num);

        $numero_filas_total = $numero_filas + 1;
        $id_ticket = "TK" . $codigo . "N" . $numero_filas_total;
        /*Fin codigo numero de ticket*/

        $fecha_ticket = MysqlQuery::RequestPost('fecha_ticket');
        $nombre_ticket = MysqlQuery::RequestPost('name_ticket');
        $email_ticket = MysqlQuery::RequestPost('email_ticket');
        $departamento_ticket = MysqlQuery::RequestPost('departamento_ticket');
        $asunto_ticket = MysqlQuery::RequestPost('asunto_ticket');
        $mensaje_ticket = MysqlQuery::RequestPost('mensaje_ticket');
        $estado_ticket = "Pendiente";
        $cabecera = "to: " . $_SESSION['email'] . "\r\n";
        $mensaje_mail = "Detalle del problema : " . $mensaje_ticket . "." ."\n";
        $mensaje_mail = wordwrap($mensaje_mail, 70, "\r\n");

        if (MysqlQuery::Guardar("ticket", "fecha, nombre_usuario, email_cliente, departamento, asunto, mensaje, estado_ticket, serie", "'$fecha_ticket', '$nombre_ticket', '$email_ticket', '$departamento_ticket', '$asunto_ticket', '$mensaje_ticket', '$estado_ticket','$id_ticket'")) {
            /*----------  Enviar correo con los datos del ticket*/
            //$correo = mail($email_ticket, $asunto_ticket, $mensaje_mail, $cabecera);
            $crear_correo = new Config_Correo();
            $crear_correo->crear_correo($email_ticket, $departamento_ticket, $id_ticket, $asunto_ticket, $mensaje_mail, $estado_ticket);

            echo '
                <div class="alert alert-success alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">TICKET CREADO</h4>
                    <p class="text-center">
                        Ticket creado con exito ' . $_SESSION['nombre'] . '<br>El TICKET ID es: <strong>' . $id_ticket . '</strong>
                        <br/>
                        <strong>Nota: </strong> se envio un correo al solicitante y al tecnico asigando para la tarea.
                    </p>
                </div>
            ';

        } else {
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        No hemos podido crear el ticket. Por favor intente nuevamente.
                    </p>
                </div>
            ';
        }
    }
    ?>
    <div class="container">
        <div class="row well">
            <div class="col-sm-3">
                <img src="img/ticket.png" class="img-responsive" alt="Image">
            </div>
            <div class="col-sm-9 lead">
                <h2 class="text-success">¿Cómo abrir un nuevo Ticket?</h2>
                <p>Para abrir un nuevo ticket deberá de llenar todos los campos de el siguiente formulario. Usted podra
                    verificar el estado de su ticket mediante el <strong>Ticket ID</strong> que se le proporcionara a
                    usted cuando llene y nos envie el siguiente formulario.</p>
            </div>
        </div><!--fin row 1-->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center"><strong><i class="fa fa-ticket"></i>&nbsp;&nbsp;&nbsp;Ticket</strong>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <br><br><br>
                                <img src="img/write_email.png" alt=""><br><br>
                                <p class="text-primary text-justify">Por favor llene todos los datos de este formulario
                                    para abrir su ticket. El <strong>Ticket ID</strong> será enviado a la dirección de
                                    correo electronico proporcionada en este formulario.</p>
                            </div>
                            <div class="col-sm-8">
                                <form class="form-horizontal" role="form" action="" method="POST">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Fecha</label>
                                            <div class='col-sm-10'>
                                                <div class="input-group">
                                                    <input class="form-control" type="text" id="fechainput"
                                                           placeholder="Fecha" name="fecha_ticket" required="" readonly value="<?php echo date("m/d/y"); ?>">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Solicitante</label>
                                            <div class="col-sm-10">
                                                <div class='input-group'>
                                                    <input type="text" class="form-control" placeholder="Nombre"
                                                           required="" pattern="[a-zA-Z ]{1,30}" name="name_ticket"
                                                           title="Nombre Apellido"
                                                           value='<?php echo $_SESSION['nombre'] ?>' readonly>
                                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <div class='input-group'>
                                                    <input type="email" class="form-control" id="inputEmail3"
                                                           placeholder="Email" name="email_ticket" required=""
                                                           title="Ejemplo@dominio.com"
                                                           value='<?php echo $_SESSION['email'] ?>'
                                                    readonly>
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-envelope-o"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Departamento</label>
                                            <div class="col-sm-10">
                                                <div class='input-group'>
                                                    <select class="form-control" name="departamento_ticket" id="select_departamento">
                                                        <option value="0" readonly="">Seleccionar...</option>
                                                        <?php
                                                        $consulta = Mysql::consulta('SELECT * FROM departamento');
                                                        foreach ($consulta as $key):
                                                            ?>
                                                            <option value="<?php echo $key["id_departamento"] ?>"><?php echo $key["departamento"] ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Tecnico</label>
                                            <div class="col-sm-10">
                                                <div class='input-group'>
                                                    <select class="form-control" name="departamento_ticket" id="select_tecnico">
                                                        <option value="0" readonly="">Seleccionar...</option>
                                                        <?php
                                                        $id_departamento = $_POST['departamento'];
                                                        echo $id_departamento;
                                                        $consulta = Mysql::consulta("SELECT * FROM administrador WHERE departamento= '$id_departamento';");
                                                        foreach ($consulta as $key):
                                                            ?>
                                                            <option value="<?php echo $key["email_admin"] ?>"><?php echo $key["nombre_admin"] ?></option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Asunto</label>
                                            <div class="col-sm-10">
                                                <div class='input-group'>
                                                    <input type="text" class="form-control" placeholder="Asunto"
                                                           name="asunto_ticket" required="">
                                                    <span class="input-group-addon"><i
                                                                class="fa fa-paperclip"></i></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Detalle del problema</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" rows="3"
                                                          placeholder="Escriba el problema que está presentando"
                                                          name="mensaje_ticket" required=""></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <center>
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success">Abrir ticket</button>
                                                </div>
                                            </center>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <img src="./img/Stop.png" alt="Image" class="img-responsive"/><br>
                <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>

            </div>
            <div class="col-sm-7 text-center">
                <h1 class="text-danger">Lo sentimos esta página es solamente para usuarios registrados en Soporte
                    UTJ</h1>
                <h3 class="text-info">Inicia sesión ó registrate para poder acceder</h3>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
    <?php
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#fechainput").datepicker();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        select_cargar();
        $('#select_departamento').change(function () {
            select_cargar();
        });
    });
</script>
<script type="text/javascript">
    function select_cargar() {
        $.ajax({
            type: "POST",
            data: "departamento=" + $('#select_departamento').val(),
            success: function (r) {
                $('#select_tecnico').html(r);
            }
        });
    }
</script>