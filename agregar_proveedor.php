<?php

 require_once("class/config.php");

  if(isset($_SESSION["backend_id"])){
  
  if(isset($_POST["grabar"]) and $_POST["grabar"]=="si") {

    require_once("class/proveedoresModulo.php");

    $proveedor= new Proveedores();

    $proveedor->agregar_proveedor();
    exit();

 }
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Agregar proveedor</title>
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
  
    <nav class="navbar navbar-expand-">  
       <a class="navbar-brand" href="#">Registro de Proveedores</a>
      </nav><!--fin navbar-->

  </div><!--fin page-header-->

  <section class="no-padding-top"> <!--aca tablas-->
 <div class="container-fluid">
 <div class="row"> <!--diseño cuadrilla-->
                
                 <!-- Horizontal Form-->
              <div class="col-lg-6">
                <div class="block">
                  <div class="block-body">
                    <form action="" method="post" class="form-horizontal">

          <?php 
                       if(isset($_GET["m"])){
                         switch($_GET["m"]){
                           case "1";
                           ?> 
                          <div class="alert alert-danger" role="alert">los campos estan vacios?</div>                 
                           <?php
                           break;
                          
                           case "2";
                           ?> 
                           <div class="alert alert-success" role="alert">el proveedor se ha agregado!</div>
                          <?php
                           break;
                         }
                       }
          ?>

                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Nombre</label>
                        <div class="col-sm-9">
                          <input type="text" name="nombre_proveedor" placeholder="Ingrese nombre del proveedor" class="form-control form-control-success">
                        </div>
                  </div>
                      
                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">CUIT</label>
                        <div class="col-sm-9">
                          <input  type="text" name="cuit_proveedor" placeholder="Ingrese el nro de CUIT" class="form-control form-control-success">
                        </div>
                  </div>

                 <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Ciudad</label>
                        <div class="col-sm-9">
                          <input type="text" name="ciudad_proveedor" placeholder="Ingrese ciudad" class="form-control form-control-success">
                        </div>
                  </div>
                      
                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Direccion</label>
                        <div class="col-sm-9">
                          <input type="text" name="direc_proveedor" placeholder="Ingrese domicilio" class="form-control form-control-success">
                        </div>
                  </div>

                 <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Correo</label>
                        <div class="col-sm-9">
                          <input type="text" name="email_proveedor" placeholder="Ingrese email" class="form-control form-control-success">
                        </div>
                  </div>
                      
                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Telefono</label>
                        <div class="col-sm-9">
                          <input type="text" name="tel_proveedor" placeholder="Ingrese telefono" class="form-control form-control-success">
                        </div>
                  </div>

                      
                <div class="form-group row">  <!--BOTON-->       
                        <div class="col-sm-9 offset-sm-3">             
                        <input type="hidden" name="grabar" value="si">
                        <button class="btn btn-primary">Guardar</button>
                        <a class="btn btn-info" href="<?php echo Conectar::ruta();?>proveedores.php">Cancelar</a>
                        </div>
               </div>
      
                    </form>
                  </div> <!--block-body-->
                </div> <!--block-->
              </div>  <!--col lg-6-->

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