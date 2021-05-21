<?php
  
  require_once("class/config.php");

   if(isset($_SESSION["backend_id"])){

    require_once("class/consumoModulo.php");

    $consumo=new Consumo();

    $datos= $consumo->get_consumo();
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Consumo</title>
   <?php require_once("head.php");?>
</head>

  <body>  
  <!-- para que class = active en menu principal--> 
  <?php $mi_pagina="Consumo"; ?>
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
          
<div class="page-header"> <!-- panel usuario --> 
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h4">Consulta sobre consumo</h1>
        <div class="btn-toolbar mb-3 mb-md-0">
          <div class="btn-group mr-3">
            <a class="btn btn-outline-primary" href="<?php echo Conectar::ruta();?>agregar_consumo.php">Nuevo consumo</a>
            <a class="btn btn-outline-primary" href="<?php echo Conectar::ruta();?>reporte_consumo.php" target="_blank" >Informe</a>
          </div>
        </div>
      </div>
</div><!--fin page-header-->

  <section class="no-padding-top"> <!--aca tablas-->
 <div class="container-fluid">
 <div class="row"> <!--diseño cuadrilla-->
                
      <div class="col-lg-12">
                <div class="block margin-bottom-sm"> <!--le da el color de fondo -->
                  <div class="title"><strong>Consumo</strong></div>
                 
  <div class="table-responsive"> 
                    <table class="table" id="myTable">
                     <!--OPCIONES TABLA -->
                      <thead>
                        <tr>
                          <th>Codigo</th>
                          <th>Codigo producto</th>
                          <th>Producto</th>
                          <th>Cantidad</th>
                          <th>Fecha egreso</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>

               <tbody>
                    <?php for($i=0;$i<sizeof($datos);$i++){?>
                  <tr>
                    <td><?php echo $datos[$i]["cod_consumo"];?></td>
                    <td><?php echo $datos[$i]["cod_producto"];?></td>
                    <td><?php echo $datos[$i]["producto_consumo"];?></td>
                    <td><?php echo $datos[$i]["cantidad_consumo"];?></td>
                    <td><?php echo Conectar::invierte_fecha($datos[$i]["fecha_consumo"])?></td>
                    <!-- BOTONES ACCIONES -->
                    <td> 
                        <a <?php if($_SESSION["nivel"] == "administrador"){ echo 'class="btn btn-primary "'; } else {echo 'class="btn btn-primary disabled"';} ?> href="<?php echo Conectar::ruta();?>editar_consumo.php?id_consumo=<?php echo $datos[$i]["id_consumo"];?>">
                        <span></span> Editar</a> 
                        
                       <a <?php if($_SESSION["nivel"] == "administrador"){ echo 'class="btn btn-info"'; } else {echo 'class="btn btn-info disabled"';} ?>   href="<?php echo Conectar::ruta();?>eliminar_consumo.php?cod_consumo=<?php echo $datos[$i]["cod_consumo"];?>&cod_producto=<?php echo $datos[$i]["cod_producto"];?>&producto_consumo=<?php echo $datos[$i]["producto_consumo"];?>&cantidad_consumo=<?php echo $datos[$i]["cantidad_consumo"];?>"
                         onclick="return confirm('Esta seguro?');">Eliminar</a>
                   </td>
                   </tr>
                  <?php 
                  }?>
                </tbody>
                    </table>


    </div> <!--table-responsive -->
    </div>
    </div> <!--class="col-lg-8" -->


  </section>
  </div> <!--fin container-fluid -->
  </div> <!--fin row-->

</div>  <!-- FIN CONTENIDO -->

</div>

 <!-- ACA FOOTER -->
       <?php require_once("footer.php");?>

    
  </body>
</html>

<?php } else {

    header("Location:".Conectar::ruta()."login.php");
}?>
