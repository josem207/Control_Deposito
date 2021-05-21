<?php
  
  require_once("class/config.php");

   if(isset($_SESSION["backend_id"])){

    require_once("class/almacenModulo.php");

    $compra=new almacen();

    $datos= $compra->get_almacen();
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Inventario</title>
   <?php require_once("head.php");?>
</head>

  <body>
  <!-- para que class = active en menu principal--> 
  <?php $mi_pagina="Inventario"; ?>
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
      <!-- prueba nueva navbar-->
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h4">Consulta general sobre inventarios</h1>
        <div class="btn-toolbar mb-3 mb-md-0">
            <!-- ACA PUEDE IR BARRA BUSQUEDA -->
          <div class="btn-group mr-3">
           <a class="btn btn-outline-primary" href="<?php echo Conectar::ruta();?>agregar_almacen.php">Nuevo Producto</a>
            <a class="btn btn-outline-primary" href="<?php echo Conectar::ruta();?>reporte_almacen.php" target="_blank" >Informe</a>
          </div>
        </div>
      </div>
       <!-- fin de prueba nueva navbar-->    
</div><!--fin page-header-->

  <section class="no-padding-top"> <!--aca tablas-->
 <div class="container-fluid">
 <div class="row"> <!--diseño cuadrilla-->
                
      <div class="col-lg-12">
                <div class="block margin-bottom-sm"> <!--le da el color de fondo -->
                  <div class="title"><strong>inventario</strong></div>
                 
  <div class="table-responsive"> 
                  <table class="table" id="myTable">
                     <!--OPCIONES TABLA -->
                      <thead>
                        <tr>
                          <th>Codigo</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Existencia</th>
                          <th>Ubicacion</th>
                          <th>Estado</th>
                          <th>Fecha Ingreso</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>

               <tbody>
                    <?php for($i=0;$i<sizeof($datos);$i++){?>
                  <tr>
                    <td><?php echo $datos[$i]["cod_producto"];?></td>
                    <td><?php echo $datos[$i]["producto"];?></td>
                    <td><?php echo $datos[$i]["precio"];?></td>
                    <td><?php echo $datos[$i]["existencia"];?></td>
                    <td><?php echo $datos[$i]["ubicacion_deposito"];?></td>
                    <td><?php echo $datos[$i]["estado_producto"];?></td>
                    <td><?php echo Conectar::invierte_fecha($datos[$i]["fecha_ingreso"])?></td>
                    
                    <!-- BOTONES ACCIONES -->
                  <td>
                    <a <?php if($_SESSION["nivel"] == "administrador"){ echo 'class="btn btn-primary "'; } else {echo 'class="btn btn-primary disabled"';} ?>  href="<?php echo Conectar::ruta();?>editar_almacen.php?id_almacen=<?php echo $datos[$i]["id_producto_almacen"];?>">
                     <span></span> Editar</a>

                    <a <?php if($_SESSION["nivel"] == "administrador"){ echo 'class="btn btn-info"'; } else {echo 'class="btn btn-info disabled"';} ?> href="<?php echo Conectar::ruta();?>eliminar_almacen.php?id_almacen=<?php echo $datos[$i]["id_producto_almacen"];?>" 
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
</div>


 <!-- ACA FOOTER -->
       <?php require_once("footer.php");?>  
  </body>
</html>

<?php } else {

    header("Location:".Conectar::ruta()."login.php");
}?>
