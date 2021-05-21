<?php

require_once("class/config.php");

 if(isset($_SESSION["backend_id"])){
   
   require_once("class/userModulo.php");
   
   $usuario=new Usuarios();

   $datos=$usuario->get_usuario();
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Usuarios</title>
   <?php require_once("head.php");?>
</head>

  <body>
  <!-- para que class = active en menu principal--> 
  <?php $mi_pagina="Usuarios"; ?> 
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
        <h4 class="h4">Consulta sobre Usuarios</h4>
        <div class="btn-toolbar mb-3 mb-md-0">
          <div class="btn-group mr-3">
            <a class="btn btn-outline-primary" href="<?php echo Conectar::ruta();?>agregar_usuario.php">Nuevo Usuario</a>
            <a class="btn btn-outline-primary" href="<?php echo Conectar::ruta();?>reporte_usuarios.php" target="_blank" >Informe</a>
          </div>      
        </div>
        
      </div>
</div><!--fin page-header-->

  <section class="no-padding-top"> <!--aca tablas-->
 <div class="container-fluid">
 <div class="row"> <!--diseño cuadrilla-->
                
      <div class="col-lg-12">
                <div class="block margin-bottom-sm"> <!--le da el color de fondo -->
                  <div class="title"><strong>Usuarios</strong></div>
                 
      <div class="table-responsive"> 
                    <table class="table" id="myTable">
                     <!--OPCIONES TABLA -->
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>usuario</th>
                          <th>DNI</th>
                          <th>Sector</th>
                          <th>Nivel Acesso</th>
                          <th>Fecha</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>

               <tbody>
                    <?php for($i=0;$i<sizeof($datos);$i++){?>
                  <tr>
                    <td><?php echo $datos[$i]["id"];?></td>
                    <td><?php echo $datos[$i]["nombres"];?></td>
                    <td><?php echo $datos[$i]["usuario"];?></td>
                    <td><?php echo $datos[$i]["dni"];?></td>
                    <td><?php echo $datos[$i]["sector"];?></td>
                    <td><?php echo $datos[$i]["nivel"];?></td>
                    <td><?php echo Conectar::invierte_fecha($datos[$i]["fecha_ingreso"])?></td>
                    <!-- BOTONES ACCIONES -->
                    <td>
                      <a class="btn btn-primary" href="<?php echo Conectar::ruta();?>editar_usuario.php?id_usuario=<?php echo $datos[$i]["id"];?>">
                        <span></span> Editar</a>  
                      <a class="btn btn-info" href="<?php echo Conectar::ruta();?>eliminar_usuario.php?id_usuario=<?php echo $datos[$i]["id"];?>"
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
