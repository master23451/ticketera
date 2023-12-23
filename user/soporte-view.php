<?php if (isset($_SESSION['nombre']) && isset($_SESSION['tipo'])) {
    ?>
    <div class="container">
        <div class="row well">
            <div class="col-sm-3">
                <img src="img/tux_repair.png" class="img-responsive" alt="Image">
            </div>
            <div class="col-sm-9 lead">
                <h2 class="text-success"><strong>Bienvenido al centro de soporte de U T J</strong></h2>
                <p>Es muy facil de usar, si usted tiene problemas con alguno de sus equipos nos puede enviar un nuevo ticket, nosotros lo respondemos y solucionaremos su problema.<br>Si ya nos ha enviado un ticket puede consultar el estado de este mediante su <strong>Ticket ID</strong>.</p>
            </div>
        </div><!--fin row 1-->

        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-success">
                    <div class="panel-heading text-center"><i class="fa fa-file-text"></i>&nbsp;<strong>Nuevo Ticket</strong></div>
                    <div class="panel-body text-center">
                        <img src="./img/new_ticket.png" alt="">
                        <h4>Abrir un nuevo ticket</h4>
                        <p class="text-justify">Si tienes un problema con cualquiera de tus equipos reportalo creando un nuevo ticket y te ayudaremos a solucionarlo.Si desea actualizar una peticion ya realizada utiliza el formulario de la derecha <em>Comprobar estado de Ticket</em>, solamente los <strong>usuarios registrados</strong> pueden abrir un nuevo ticket.</p>
                        <p>Para abrir un nuevo <strong>ticket</strong> has click en el siguiente boton</p>
                        <a type="button" class="btn btn-success" href="./index.php?view=ticket">Nuevo Ticket</a>
                    </div>
                </div>
            </div><!--fin col-md-6-->
            <div class="col-sm-6">
                <div class="panel panel-warning">
                    <div class="panel-heading text-center"><i class="fa fa-link"></i>&nbsp;<strong>Tus tickets</strong></div>
                    <div class="panel-body text-center">
                        <img src="./img/old_ticket.png" alt="">
                        <h4>Colsultar estado de ticket</h4>
                        <h6>Aqui podras revisar todos los ticket que se han levantado</h6>
                        <form class="form-horizontal" role="form" method="GET" action="./index.php">
                            <input type="hidden" name="view" value="ticketregits">
                            <center class="form-group">
                                <center>
                                    <button type="submit" class="btn btn-warning">Colsultar tus ticket</button>
                                </center>
                            </center >
                        </form>
                    </div>
                </div>
           <!-- <div class="col-sm-6">
                <div class="panel panel-warning">
                    <div class="panel-heading text-center"><i class="fa fa-link"></i>&nbsp;<strong>Comprobar estado de Ticket</strong></div>
                    <div class="panel-body text-center">
                        <img src="./img/old_ticket.png" alt="">
                        <h4>Colsultar estado de ticket</h4>
                        <form class="form-horizontal" role="form" method="GET" action="./index.php">
                            <input type="hidden" name="view" value="ticketcon">
                            <div class="form-group" hidden="">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email_consul" placeholder="Email" required="" value="<?php echo $_SESSION['email'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label">ID Ticket</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="id_consul" placeholder="ID Ticket" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-warning">Colsultar tus ticket</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
            </div><!--fin col-md-6-->
        </div><!--fin row 2-->
    </div><!--fin container-->
    <?php
} else {
    ?>
    <div class="container">
        <div class="row animated fade-out-up">
            <div class="col-sm-4">
                <img src="img/Stop.png" alt="Image" class="img-responsive"/><br>
            </div>
            <div class="col-sm-7">
                <h1 class="text-danger">Lo sentimos esta página es solamente para usuarios registrados en Soporte UTJ</h1>
                <h3 class="text-success text-center">Inicia sesión para poder acceder</h3>
            </div>
            <div class="col-sm-12">
                <img src="img/SadTux.png" alt="Image" class="img-responsive"/><br>
            </div>
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