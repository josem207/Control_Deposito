<?php

   require_once("class/config.php");

  if(isset($_SESSION["backend_id"])){
      
  require_once("class/inicioModulo.php");
  $total= new Inicio();
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Inicio</title>
   <?php require_once("head.php");?>
</head>

  <body> 
  <!-- para que class = active en menu principal--> 
  <?php $mi_pagina='Inicio'; ?> 
  <!-- LLAMO A MENU PRINCIPAL-->
  <?php require_once("menu_principal.php");?>
  <!--Area trabajo fija -->
  <div class="d-flex align-items-stretch<">
  <!--LLAMO A MENU LATERAL-->
  <div class="d-flex">  
    <?php 
      if(isset($_SESSION["nivel"])){     
        if($_SESSION["nivel"] == "administrador")
          { require_once("menu_lateral.php"); }
        else {require_once("menu_lateral_empleado.php");}
     }
    ?>
  </div>

 <!-- ACA CONTENIDO -->

  <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h3 no-margin-bottom">Inicio</h2>
          </div>
  </div>

<section class="no-padding-top no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-user-1"></i></div><strong>Usuarios</strong>
                    </div>
                    <div class="number dashtext-1"><?php $total->get_total_usuarios();?></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: <?php $total->get_total_usuarios();?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-dashboard"></i></div><strong>Compras/ingresos</strong>
                    </div>
                    <div class="number dashtext-2"><?php $total->get_total_compras();?></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: <?php $total->get_total_compras();?>%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-layers"></i></div><strong>Inventario</strong>
                    </div>
                    <div class="number dashtext-2"><?php $total->get_total_almacen();?></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: <?php $total->get_total_almacen();?>%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                       <div class="stats-2-arrow height"><i class="fa fa-caret-up"></i></div><strong>Pedidos</strong>
                    </div>
                    <div class="number dashtext-2"> <?php $total->get_total_pedidos();?></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: <?php $total->get_total_pedidos();?>%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                  </div>
                </div>
              </div>
        
            </div>
          </div>
        </section>

</div>  <!-- FIN CONTENIDO -->

</div>
 <!-- ACA FOOTER -->
       <?php require_once("footer.php");?>
  </body>
</html>

<?php
  } else { header("Location:".Conectar::ruta()."login.php"); }
?>