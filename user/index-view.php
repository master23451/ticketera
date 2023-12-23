<!--************ Imagen que reemplaza el carousel para dispositivos moviles ********-->
<div id="img-linux-tux" class="container hidden-lg hidden-md hidden-sm">
    <center><img src="img/slide-header.jpg" class="img-responsive img-rounded" alt="Image"></center>
</div>

<!--************************************Carousel******************************-->
<div class="container hidden-xs">
    <div class="col-xs-12">
<div id="carousel-example-generic" class="carousel slide">

  <ol class="carousel-indicators" style="max-width: 100%; max-height: 100%; height: auto; width: auto;">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
  </ol>
    <div class="carousel-inner">
       <div class="item active">
           <img src="img/slider1.png" alt="">
          <div class="carousel-caption">
          </div>
       </div>
       <div class="item">
          <img src="img/slider2.png" alt="">
          <div class="carousel-caption">
              </div>
       </div>
       <div class="item">
          <img src="img/slider3.png" alt="">
          <div class="carouse bl-caption">
                       </div>
        </div>
        <div class="item">
          <img src="img/slider4.png" alt="">
          <div class="carousel-caption">
              </div>
        </div>
   </div>
   <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
       <span class="icon-prev"></span>
   </a>
   <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
     <span class="icon-next"></span>
   </a>
</div>
        </div>
     <div class="col-sm-2">&nbsp;</div>
</div>
<!--************************************ Fin Carousel******************************-->

 <hr class="hidden-xs">

<!--<div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="text-center text-info">Soporte Tecnico a usuarios Universidad Tecnologica de Jalisco</h1>
    </div>
  </div>
</div>
<br>
/*
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6 thumbnail">
            <h3 class="text-center">Equipo de Computo</h3>
            <img  src="img/logoMint.png" class="img-responsive logos_GnuLinux" alt="Image">
             <p>
                 Las computadoras son nuestra mano derecha y casi que no podemos vivir sin ellas, 
				 aunque pueden darnos varios dolores de cabeza. Y cuando eso pasa, 
				 intentás reiniciar la compu o darle unos golpecitos, porque piensás que quizá así se solucionará…
				 pero no. Si alguna vez te pasa esto levanta un ticket por favor.<br>
             </p>
             <p class="text-center">
                <a href="./index.php?view=soporte" class="btn btn-primary btn-sm" role="button">Levanta ticket</a>
             </p>
        </div>
        <div class="col-xs-12 col-md-6 thumbnail">
          <h3 class="text-center">Impresion</h3>
            <img src="img/logoFedora.png" class="img-responsive logos_GnuLinux" alt="Image">
            <p>
             Comprobar conexiones,<br> 
			 Atasco de papel, <br>
			 Comprobar controladores,<br> 
			 Reinstalar la impresora,<br>
			 Tareas de mantenimiento,<br>
			 Cartuchos de tinta.
			 <br>
            </p>
            <center><a href="./index.php?view=soporte" class="btn btn-primary btn-sm" role="button">Levanta ticket</a></center>
        </div>
        <div class="col-xs-12 col-md-6 thumbnail">
            <h3 class="text-center">Red</h3>
            <img src="img/logoUbuntu.png" class="img-responsive logos_GnuLinux" alt="Image">
            <p>
             Si cuentas con problemas de conectividad a internet en tu equipo de computo, por favor 
			 levanta un ticket, explicando tu problema.<br>
             
            </p>
            <center><a href="./index.php?view=soporte" class="btn btn-primary btn-sm" role="button">Levanta ticket</a></center>
        </div>
        <div class="col-xs-12 col-md-6 thumbnail">
            <h3 class="text-center">Telefonia</h3>
            <img src="img/logoDebian.png" class="img-responsive logos_GnuLinux" alt="Image">
            <p>
                Si tu telefono cuenta con problemas, en donde no puedes realizar o recibir llamadas,
				por favor levanta un ticket explicando tu problema.
            </p>
            <p>
                
            </p>
            <center><a href="./index.php?view=soporte" class="btn btn-primary btn-sm" role="button">Levanta ticket</a></center>
        </div>
    </div>
</div>-->
<script>
    $(document).ready(function(){
        $("#carousel-example-generic").carousel({
            interval: 4000,
        });
    });
</script>