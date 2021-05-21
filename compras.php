<!--INGRESOS = COMPRAS = ENTRADAS -->
<?php
  
  require_once("class/config.php");

   if(isset($_SESSION["backend_id"])){

    require_once("class/comprasModulo.php");

    $compra=new compras();

    $datos= $compra->get_compras();
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Compras</title>
   <?php require_once("head.php");?>
</head>

  <body>  
  <!-- para que class = active en menu principal--> 
  <?php $mi_pagina="Compras"; ?> 
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
        <h1 class="h4">Consulta sobre Ingresos</h1>
        <div class="btn-toolbar mb-3 mb-md-0">
          <div class="btn-group mr-3">
            <a class="btn btn-outline-primary" href="<?php echo Conectar::ruta();?>agregar_compra.php">Nueva compra</a>
            <a class="btn btn-outline-primary" href="<?php echo Conectar::ruta();?>reporte_compras.php" target="_blank" >Informe</a>
          </div>
        </div>
      </div>
</div><!--fin page-header-->

  <section class="no-padding-top"> <!--aca tablas-->
 <div class="container-fluid">
 <div class="row"> <!--diseño cuadrilla-->
                
      <div class="col-lg-12">
                <div class="block margin-bottom-sm"> <!--le da el color de fondo -->
                  <div class="title"><strong>Compras</strong></div>
                 
  <div class="table-responsive"> 
                    <table class="table" id="myTable">
                     <!--OPCIONES TABLA -->
                      <thead>
                        <tr>
                          <th>Codigo</th>
                          <th>Cod. producto</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Cantidad</th>
                          <th>Proveedor</th>
                          <th>Fecha ingreso</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>

               <tbody>
                    <?php for($i=0;$i<sizeof($datos);$i++){?>
                  <tr>
                    <td><?php echo $datos[$i]["cod_compra"];?></td>
                    <td><?php echo $datos[$i]["cod_producto"];?></td>
                    <td><?php echo $datos[$i]["producto"];?></td>
                    <td><?php echo $datos[$i]["precio_orden"];?></td>
                    <td><?php echo $datos[$i]["cantidad_compra"];?></td>
                    <td><?php echo $datos[$i]["cuit_proveedor"];?></td>
                    <td><?php echo Conectar::invierte_fecha($datos[$i]["fecha_ingreso"])?></td>
                    <!-- BOTONES ACCIONES -->
                    <td> <a <?php if($_SESSION["nivel"] == "administrador"){ echo 'class="btn btn-primary "'; } else {echo 'class="btn btn-primary disabled"';} ?> href="<?php echo Conectar::ruta();?>editar_compra.php?id_compra=<?php echo $datos[$i]["id_orden_compras"];?>">
                         <span></span> Editar</a>

                        <a <?php if($_SESSION["nivel"] == "administrador"){ echo 'class="btn btn-info"'; } else {echo 'class="btn btn-info disabled"';} ?> href="<?php echo Conectar::ruta();?>eliminar_compra.php?cod_compra=<?php echo $datos[$i]["cod_compra"];?>&cod_producto=<?php echo $datos[$i]["cod_producto"];?>&producto=<?php echo $datos[$i]["producto"];?>&cantidad_compra=<?php echo $datos[$i]["cantidad_compra"];?>" 
                          onclick="return confirm('Esta seguro?');">Eliminar</a>

                   </td>
                   </tr>
                  <?php }?>
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
