<?php

 require_once("class/config.php");

  if(isset($_SESSION["backend_id"])){

    require_once("class/proveedoresModulo.php");

    $proveedor= new Proveedores();

    $datos=$proveedor->get_proveedor_por_id($_GET["id_proveedor"]);
  
  if(isset($_POST["grabar"]) and $_POST["grabar"]=="si") {

    $proveedor->editar_proveedor();
    exit();

 }
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Editar proveedor</title>
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
       <a class="navbar-brand" href="#">Editar Proveedors</a>
    </nav><!--fin navbar-->

  </div><!--fin page-header-->

<section class="no-padding-top"> <!--aca tablas-->
  <div class="container-fluid"> <!--diseño cuadrilla-->               
      <div class="col-lg-6"> <!-- Horizontal Form-->
        <div class="block">
          <form action="" method="post" class="form-horizontal"><!-- ESTO ES IMPORTANTISIIMO -->

          <?php 
                       if(isset($_GET["m"])){
                         switch($_GET["m"]){
                           case "1";
                           ?> 
                          <div class="alert alert-danger" role="alert">Existe un campo vacio!</div>                 
                           <?php
                           break;
                                     
                           case "2";
                           ?> 
                           <div class="alert alert-success" role="alert">El proveedor se ha editado!</div>
                          <?php
                           break;
                         }
                       }
          ?>

                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Nombre Proveedor</label>
                        <div class="col-sm-9">
                          <input type="text" name="nombre_proveedor" class="form-control form-control-success" placeholder="Ingrese nombre del proveedor"
                          value="<?php echo $datos[0]["nombre_proveedor"];?>">
                        </div>
                  </div>
                     
                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">CUIT</label>
                        <div class="col-sm-9">
                          <input  type="text" name="cuit_proveedor"  class="form-control form-control-success" placeholder="Ingrese el nro de CUIT" 
                           value="<?php echo $datos[0]["cuit_proveedor"];?>">
                        </div>
                  </div>

                 <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Ciudad</label>
                        <div class="col-sm-9">
                          <input type="text" name="ciudad_proveedor" class="form-control form-control-success" placeholder="Ingrese ciudad" 
                           value="<?php echo $datos[0]["ciudad_proveedor"];?>">
                        </div>
                  </div>
                      
                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Direccion</label>
                        <div class="col-sm-9">
                          <input type="text" name="direc_proveedor" class="form-control form-control-success" placeholder="Ingrese domicilio" 
                           value="<?php echo $datos[0]["direc_proveedor"];?>">
                        </div>
                  </div>

                 <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Correo</label>
                        <div class="col-sm-9">
                          <input type="text" name="email_proveedor" class="form-control form-control-success" placeholder="Ingrese email" 
                           value="<?php echo $datos[0]["email_proveedor"];?>">
                        </div>
                  </div>
                      
                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Telefono</label>
                        <div class="col-sm-9">
                          <input type="text" name="tel_proveedor" class="form-control form-control-success" placeholder="Ingrese telefono" 
                          value="<?php echo $datos[0]["tel_proveedor"];?>">
                        </div>
                  </div>
                      
                <div class="form-group row">       
                  <div class="col-sm-9 offset-sm-3">             
                      <input type="hidden" name="grabar" value="si">
                      <input type="hidden" name="id" value="<?php echo $_GET["id_proveedor"];?>">
                      <button class="btn btn-primary">Guardar</button>
                      <a class="btn btn-info" href="<?php echo Conectar::ruta();?>proveedores.php">Cancelar</a>
                  </div>
               </div>
      
                    </form>
                  </div> <!--block-body-->
                </div> <!--block-->
              
  </section>
  </div> <!--fin container-fluid -->
  </div> <!--fin row-->

</div>



 <!-- ACA FOOTER -->
       <?php require_once("footer.php");?>

    
  </body>
</html>

<?php } else {
  header("Location:".Conectar::ruta()."login.php");
}?>