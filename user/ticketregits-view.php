<?php if(!isset($_SESSION['nombre'])=="" && !isset($_SESSION['tipo'])==""){
    $email_sesion = $_SESSION['email']
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-1">
                <img src="./img/msj.png" alt="Image" class="img-responsive animated tada">
            </div>
            <div class="col-sm-10">
                <p class="lead">Bienvenido en esta pestaña podras ver todos los ticket que has levantado recientemente.</p>
            </div>
        </div>
    </div>
    <?php

    /* Todos los tickets*/
    $num_ticket_all = Mysql::consulta("SELECT * FROM ticket WHERE email_cliente='$email_sesion'");
    $num_total_all = mysqli_num_rows($num_ticket_all);

    /* Tickets pendientes*/
    $num_ticket_pend = Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Pendiente' AND email_cliente='$email_sesion'");
    $num_total_pend = mysqli_num_rows($num_ticket_pend);

    /* Tickets en proceso*/
    $num_ticket_proceso = Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='En proceso' AND email_cliente='$email_sesion'");
    $num_total_proceso = mysqli_num_rows($num_ticket_proceso);

    /* Tickets resueltos*/
    $num_ticket_res = Mysql::consulta("SELECT * FROM ticket WHERE estado_ticket='Resuelto' AND email_cliente='$email_sesion'");
    $num_total_res = mysqli_num_rows($num_ticket_res);
    ?>

    <a href="./index.php?view=soporte" class="btn btn-danger btn-sm fa-pull-right"><span
                class="fa fa-reply"></span>&nbsp;&nbsp;Volver a soporte</a>
    <br/>
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills nav-justified">
                    <li> <a href="./index.php?view=ticket" class="btn btn-success btn-sm"><span
                                    class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Levanta Ticket</a></li>
                    <li><a href="./index.php?view=ticketregits&ticket=all" class="text-danger"><i
                                    class="fa fa-list"></i>&nbsp;&nbsp;Todos los tickets&nbsp;&nbsp;<span
                                    class="badge progress-bar-danger"><?php echo $num_total_all; ?></span></a></li>
                    <li><a href="./index.php?view=ticketregits&ticket=pending" class="text-warning"><i
                                    class="fa fa-envelope"></i>&nbsp;&nbsp;Tickets pendientes&nbsp;&nbsp;<span
                                    class="badge progress-bar-warning"><?php echo $num_total_pend; ?></span></a></li>
                    <li><a href="./index.php?view=ticketregits&ticket=process" class="text-primary"><i
                                    class="fa fa-folder-open"></i>&nbsp;&nbsp;Tickets en proceso&nbsp;&nbsp;<span
                                    class="badge progress-bar-info"><?php echo $num_total_proceso; ?></span></a></li>
                    <li><a href="./index.php?view=ticketregits&ticket=resolved" class="text-success"><i
                                    class="fa fa-thumbs-o-up"></i>&nbsp;&nbsp;Tickets resueltos&nbsp;<span
                                    class="badge progress-bar-success"><?php echo $num_total_res; ?></span></a></li>
                </ul>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <?php
                    $mysqli = mysqli_connect(SERVER, USER, PASS, BD);
                    mysqli_set_charset($mysqli, "utf8");

                    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                    $regpagina = 15;
                    $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;


                    if (isset($_GET['ticket'])) {
                        if ($_GET['ticket'] == "all") {
                            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE email_cliente='$email_sesion' LIMIT $inicio, $regpagina";
                        } elseif ($_GET['ticket'] == "pending") {
                            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Pendiente' AND email_cliente='$email_sesion' LIMIT $inicio, $regpagina";
                        } elseif ($_GET['ticket'] == "process") {
                            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='En proceso' AND email_cliente='$email_sesion' LIMIT $inicio, $regpagina";
                        } elseif ($_GET['ticket'] == "resolved") {
                            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE estado_ticket='Resuelto' AND email_cliente='$email_sesion' LIMIT $inicio, $regpagina";
                        } else {
                            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE email_cliente='$email_sesion' LIMIT $inicio, $regpagina";
                        }
                    } else {
                        $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM ticket WHERE email_cliente='$email_sesion' LIMIT $inicio, $regpagina";
                    }


                    $selticket = mysqli_query($mysqli, $consulta);

                    $totalregistros = mysqli_query($mysqli, "SELECT FOUND_ROWS()");
                    $totalregistros = mysqli_fetch_array($totalregistros, MYSQLI_ASSOC);

                    $numeropaginas = ceil($totalregistros["FOUND_ROWS()"] / $regpagina);

                    if (mysqli_num_rows($selticket) > 0):
                        ?>
                        <table class="table table-hover table-striped table-bordered" id="tablaDatos">
                            <thead style="color: white; background-color: #2b542c;">
                            <tr>
                                <th class="text-center col">#</th>
                                <th class="text-center col">Fecha</th>
                                <th class="text-center col">Serie</th>
                                <th class="text-center col">Servicio</th>
                                <th class="text-center col">detalles del servicio</th>
                                <th class="text-center col">Estado</th>
                                <th class="text-center col">Usuario solicitante</th>
                                <th class="text-center col">Email</th>
                                <th class="text-center col">Tecnico asignado</th>
                                <th class="text-center col">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $ct = $inicio + 1;
                            while ($row = mysqli_fetch_array($selticket, MYSQLI_ASSOC)):
                                ?>
                                <tr>
                                    <td class="text-center"><strong><?php echo $ct; ?></strong></td>
                                    <td class="text-center"><?php echo $row['fecha']; ?></td>
                                    <td class="text-center"><?php echo $row['serie']; ?></td>
                                    <td class="text-center"><?php echo $row['asunto']; ?></td>
                                    <td class="text-center"><?php echo $row['mensaje']; ?></td>
                                    <td class="text-center"><?php
                                        switch($row['estado_ticket']){
                                            case "Pendiente":
                                                echo '<span class="label label-warning">Pendiente</span>';
                                                break;
                                            case "En proceso":
                                                echo '<span class="label label-primary">En Proceso</span>';
                                                break;
                                            case "Resuelto":
                                                echo '<span class="label label-success">Resuelto</span>';
                                                break;
                                        }
                                        ?></td>
                                    <td class="text-center"><?php echo $row['nombre_usuario']; ?></td>
                                    <td class="text-center"><?php echo $row['email_cliente']; ?></td>
                                    <td class="text-center"><?php echo $row['departamento']; ?></td>
                                    <td class="text-center" style="width: 10%">

                                        <form class="form-horizontal" role="form" method="GET" action="./index.php" >
                                            <input type="hidden" name="view" value="ticketcon">
                                            <input type="hidden" name="id_consul" value="<?php echo $row['serie']; ?>">
                                            <input type="hidden" name="email_consul" value="<?php echo $_SESSION['email'] ?>" readonly>
                                            <button class="btn btn-sm btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Ver</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                $ct++;
                            endwhile;
                            ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <h2 class="text-center text-danger">No hay tickets registrados en el sistema</h2>
                    <?php endif; ?>
                </div>
                <?php
                if ($numeropaginas >= 1):
                    if (isset($_GET['ticket'])) {
                        $ticketselected = $_GET['ticket'];
                    } else {
                        $ticketselected = "all";
                    }
                    ?>
                    <nav aria-label="Page navigation" class="text-center">
                        <ul class="pagination">
                            <?php if ($pagina == 1): ?>
                                <li class="disabled">
                                    <a aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="./index.php?view=ticketregits&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina - 1; ?>"
                                       aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>


                            <?php
                            for ($i = 1; $i <= $numeropaginas; $i++) {
                                if ($pagina == $i) {
                                    echo '<li class="active"><a href="./index.php?view=ticketregits&ticket=' . $ticketselected . '&pagina=' . $i . '">' . $i . '</a></li>';
                                } else {
                                    echo '<li><a href="./index.php?view=ticketregits&ticket=' . $ticketselected . '&pagina=' . $i . '">' . $i . '</a></li>';
                                }
                            }
                            ?>


                            <?php if ($pagina == $numeropaginas): ?>
                                <li class="disabled">
                                    <a aria-label="Previous">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="./index.php?view=ticketregits&ticket=<?php echo $ticketselected; ?>&pagina=<?php echo $pagina + 1; ?>"
                                       aria-label="Previous">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    </div><!--container principal-->
<?php
}else{
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
        $("#input_user").keyup(function(){
            $.ajax({
                url:"./process/val.php?id="+$(this).val(),
                success:function(data){
                    $("#com_form").html(data);
                }
            });
        });
    });
</script>
<script>
        $(document).ready( function () {
        $('#tablaDatos').DataTable({
            language:{
                sLengthMenu: "Mostrar _MENU_ Registros",
                sZeroRecords:  "No se encontraron registros",
                info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                sInfoFiltered: "(Filtrado de un total de _MAX_ registros)",
                sSearch: "Buscar:",
                sProcessing: "Procesando",
                responsive: true,
            },
            paging: false,
            scrollCollapse: true,
            scrollY: '50vh'
        });
    });
</script>