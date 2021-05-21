<?php

  require_once("class/config.php");

  if(isset($_SESSION["backend_id"])){

     require_once("class/proveedoresModulo.php");

     $proveedor= new Proveedores();

     $datos=$proveedor->get_proveedores();
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Proveedores</title>
   <?php require_once("head.php");?>
</head>

  <body>
  <!-- para que class = active en menu principal--> 
  <?php $mi_pagina="Proveedores"; ?>  
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
        <h1 class="h4">Consulta sobre Proveedores</h1>
        <div class="btn-toolbar mb-3 mb-md-0">
          <div class="btn-group mr-3">
            <a class="btn btn-outline-primary" href="<?php echo Conectar::ruta();?>agregar_proveedor.php">Nuevo Proveedor</a>
            <a class="btn btn-outline-primary" href="<?php echo Conectar::ruta();?>reporte_proveedores.php" target="_blank">Informe</a>
          </div>
        </div>
      </div>
</div><!--fin page-header-->

  <section class="no-padding-top"> <!--aca tablas-->
 <div class="container-fluid">
 <div class="row"> <!--diseño cuadrilla-->
                
      <div class="col-lg-14">
                <div class="block margin-bottom-sm"> <!--le da el color de fondo -->
                  <div class="title"><strong>Proveedores</strong></div>
                 
      <div class="table-responsive"> 
                    <table class="table" id="myTable">
                     <!--OPCIONES TABLA -->
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>CUIT</th>
                          <th>Ciudad</th>
                          <th>Direccion</th>
                          <th>Email</th>
                          <th>Telefono</th>
                          <th>Fecha</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>

               <tbody>
                    <?php for($i=0;$i<sizeof($datos);$i++){?>
                  <tr>
                    <td><?php echo $datos[$i]["cod_proveedor"];?></td>
                    <td><?php echo $datos[$i]["nombre_proveedor"];?></td>
                    <td><?php echo $datos[$i]["cuit_proveedor"];?></td>
                    <td><?php echo $datos[$i]["ciudad_proveedor"];?></td>
                    <td><?php echo $datos[$i]["direc_proveedor"];?></td>
                    <td><?php echo $datos[$i]["email_proveedor"];?></td>
                    <td><?php echo $datos[$i]["tel_proveedor"];?></td>
                    <td><?php echo Conectar::invierte_fecha($datos[$i]["fecha_ingreso"])?></td>
                    <!-- BOTONES ACCIONES -->
                    <td> 
                      <a <?php if($_SESSION["nivel"] == "administrador"){ echo 'class="btn btn-primary "'; } else {echo 'class="btn btn-primary disabled"';} ?> href="<?php echo Conectar::ruta();?>editar_proveedor.php?id_proveedor=<?php echo $datos[$i]["cod_proveedor"];?>"><span></span> Editar</a>

                         <a <?php if($_SESSION["nivel"] == "administrador"){ echo 'class="btn btn-info"'; } else {echo 'class="btn btn-info disabled"';} ?> href="<?php echo Conectar::ruta();?>eliminar_proveedor.php?id_proveedor=<?php echo $datos[$i]["cod_proveedor"];?>" onclick="return confirm('Esta seguro?');">Eliminar</a>


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
