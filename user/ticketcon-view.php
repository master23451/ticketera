<?php if (isset($_SESSION['nombre']) && isset($_SESSION['tipo'])) {
 $tipo = $_SESSION['tipo'];
if(isset($_POST['del_ticket'])){
    $id=MysqlQuery::RequestPost('del_ticket');

    if(MysqlQuery::Eliminar("ticket", "serie='$id'")){
        echo '
        <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="text-center">TICKET ELIMINADO</h4>
            <p class="text-center">
                El ticket fue eliminado con exito
            </p>
        </div>
    ';
    }else{
        echo '
        <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="text-center">OCURRIÓ UN ERROR</h4>
            <p class="text-center">
                Lo sentimos, no hemos podido eliminar el ticket
            </p>
        </div>
    ';
    }
}
$email_consul=  MysqlQuery::RequestGet('email_consul');
$id_colsul= MysqlQuery::RequestGet('id_consul');

$consulta_tablaTicket=Mysql::consulta("SELECT * FROM ticket WHERE serie= '$id_colsul' AND email_cliente='$email_consul'");
if(mysqli_num_rows($consulta_tablaTicket)>=1){
    $lsT=mysqli_fetch_array($consulta_tablaTicket, MYSQLI_ASSOC);
    ?>
    <div class="container">
        <div class="row well">
            <div class="col-sm-2">
                <img src="img/status.png" class="img-responsive" alt="Image">
            </div>
            <div class="col-sm-10 lead text-justify">
                <h2 class="text-success"><strong>Estado de ticket de soporte</strong></h2>
                <p>Si su <strong>ticket</strong> no ha sido solucionado aún, espere pacientemente, estamos trabajando para poder resolver su problema y darle una solución.</p>
            </div>
        </div><!--fin row well-->
        <div class="row">
            <div class="col">
                <a href="./index.php?view=ticketregits" class="btn btn-warning" style="margin-right: 50%"><i class="fa fa-reply"></i>&nbsp;&nbsp;Volver a la lista de ticket</a>
            </div>
            <br/>
            <div class="col">
                <div class="panel panel-success">
                    <div class="panel-heading text-center"><h4><i class="fa fa-ticket"></i> Ticket &nbsp;#<?php echo $lsT['serie']; ?></h4></div>
                    <div class="panel-body">
                        <div class="container">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img class="img-responsive" alt="Image" src="img/tux_repair.png">
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-6"><strong>Fecha:</strong> <?php echo $lsT['fecha']; ?></div>
                                            <div class="col-sm-6"><strong>Estado:</strong> <?php echo $lsT['estado_ticket']; ?></div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6"><strong>Nombre:</strong> <?php echo $lsT['nombre_usuario']; ?></div>
                                            <div class="col-sm-6"><strong>Email:</strong> <?php echo $lsT['email_cliente']; ?></div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-6"><strong>Departamento:</strong> <?php echo $lsT['departamento']; ?></div>
                                            <div class="col-sm-6"><strong>Asunto:</strong> <?php echo $lsT['asunto']; ?></div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-12"><strong>Problema:</strong> <?php echo $lsT['mensaje']; ?></div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-12"><strong>Solución:</strong> <?php echo $lsT['solucion']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <div class="row">
                            <h4>Opciones</h4>
                            <?php
                            if($tipo == "admin"):?>
                            <div class="col-sm-6">
                                <form action="" method="POST">
                                    <input type="hidden" value="<?php echo $lsT['serie']; ?>" name="del_ticket">
                                    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>&nbsp;  Eliminar ticket</button>
                                </form>
                            </div>
                            <?php endif; ?>
                            <br class="hidden-lg hidden-md hidden-sm">
                            <div class="col">
                                <button id="save" class="btn btn-success" data-id="<?php echo $lsT['serie']; ?>"><span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar ticket en PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }else{ ?>
    <div class="container">
        <div class="row  animated fadeInDownBig">
            <div class="col-sm-4">
                <img src="img/error.png" alt="Image" class="img-responsive"/><br>
                <img src="img/SadTux.png" alt="Image" class="img-responsive"/>

            </div>
            <div class="col-sm-7 text-center">
                <h1 class="text-danger">Lo sentimos ha ocurrido un error al hacer la consulta, esto se debe a lo siguiente:</h1>
                <h3 class="text-warning"><i class="fa fa-check"></i> El Ticket ha sido eliminado completamente.</h3>
                <h3 class="text-warning"><i class="fa fa-check"></i> Los datos ingresados no son correctos.</h3>
                <br>
                <h3> Por favor verifique que su <strong>id ticket</strong> y <strong>email</strong> sean correctos, e intente nuevamente.</h3>
                <h4><a href="./index.php?view=soporte" class="btn btn-danger"><i class="fa fa-reply"></i> Regresar a soporte</a></h4>
            </div>
            <div class="col-sm-1">&nbsp;</div>
        </div>
    </div>
<?php } ?>

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
<script>
  $(document).ready(function(){
    $("button#save").click(function (){
       window.open ("./lib/pdf_user.php?id="+$(this).attr("data-id"));
    });
  });
</script>