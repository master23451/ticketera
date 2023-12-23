<?php
session_start();
include './lib/class_mysql.php';
include './lib/config.php';
include './lib/Config_Correo.php';
header('Content-Type: text/html; charset=UTF-8');

if($_SESSION['tipo']!="admin"){
    session_start(); 
    session_unset();
    session_destroy();
    header("Location: ./index.php"); 
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Administracion</title>
        <?php include "./inc/links.php"; ?>        
    </head>
    <body>   
        <?php include "./inc/navbar.php"; ?>
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-header">
                <h1 class="animated lightSpeedIn">Panel Administrativo</h1>
                <span class="label label-success">Universidad Tecnologica de Jalisco</span>
                <p class="pull-right text-success">
                  <strong>
                  <?php include "./inc/timezone.php"; ?>
                 </strong>
               </p>
              </div>
            </div>
          </div>
        </div>
        <div class="container-fluid">
            <?php
            $WhiteList=["ticketadmin","ticketedit","users","admin","config"];
            if(isset($_GET['view']) && in_array($_GET['view'], $WhiteList) && is_file("./admin/".$_GET['view']."-view.php")){
                include "./admin/".$_GET['view']."-view.php";
            }else{
                echo '<div class="container">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="./img/Stop.png" alt="Image" class="img-responsive"/><br>
                                <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>

                            </div>
                            <div class="col-sm-7 text-center">
                                <h1 class="text-danger">Lo sentimos, la opción que ha seleccionado no se encuentra disponible</h1>
                                <h3 class="text-info">Por favor intente nuevamente</h3>
                            </div>
                            <div class="col-sm-1">&nbsp;</div>
                        </div>
                    </div>';
            }
            ?>
        </div>


        <?php include './inc/footer.php'; ?>
        <script>
        $(document).ready(function (){

            $("#input_user").keyup(function(){
                $.ajax({
                    url:"./process/val_admin.php?id="+$(this).val(),
                    success:function(data){
                        $("#com_form").html(data);
                    }
                });
            });


            $("#input_user2").keyup(function(){
                $.ajax({
                    url:"./process/val_admin.php?id="+$(this).val(),
                    success:function(data){
                        $("#com_form2").html(data);
                    }
                });
            });

        });
        </script>
    </body>
</html>
