<?php
  
  require_once("class/config.php");

    if(isset($_SESSION["backend_id"])){

    require_once("class/consumoModulo.php");

    $consumo=new Consumo();
    //$consumo=new Consumo(); PROBAR UNO DE ESTOS DOS
   
    $datos=$consumo->get_consumo_por_id($_GET["id_consumo"]);

    if(isset($_POST["grabar"]) and $_POST["grabar"]=="si"){
       
       $consumo=new Consumo();
       $consumo->editar_consumo();
       exit();
    }

?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>editar consumo</title>
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
        

<div class="page-header"> <!-- panel compra -->
  
    <nav class="navbar navbar-expand-">  
       <a class="navbar-brand" href="#">Editar Consumo</a>
    </nav><!--fin navbar-->

  </div><!--fin page-header-->

<section class="no-padding-top"> <!--aca tablas-->
  <div class="container-fluid"> <!--diseño cuadrilla-->            
      <div class="col-lg-6"> <!-- Horizontal Form-->
        <div class="block">
          <form action="" method="post" class="form-horizontal">

         <?php 
                       if(isset($_GET["m"])){
                         switch($_GET["m"]){
                           case "1";
                           ?> 
                          <div class="alert alert-danger" role="alert">Algun campo esta vacio!</div>                 
                           <?php
                           break;
                          
                           case "2";
                           ?> 
                           <div class="alert alert-success" role="alert">los datos de consumo se modificaron correctamente!</div>
                          <?php
                           break;
                         }
                       }
          ?>

                      
                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Código consumo</label>
                    <div class="col-sm-9">                   
                      <input type="text" name="cod_consumo" class="form-control form-control-success" placeholder="ingrese codigo consumo"
                      value="<?php echo $datos[0]["cod_consumo"];?>">
                    </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Código Producto</label>
                    <div class="col-sm-9">                   
                      <input type="text" name="cod_producto" class="form-control form-control-success" placeholder="ingrese codigo producto"
                      value="<?php echo $datos[0]["cod_producto"];?>">
                    </div>
                  </div>
 
                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">producto</label>
                    <div class="col-sm-9">
                       <input type="text" name="producto_consumo" class="form-control form-control-success" placeholder="Ingrese producto"
                       value="<?php echo $datos[0]["producto_consumo"];?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Cantidad</label>
                    <div class="col-sm-9">
                       <input type="text" name="cantidad_consumo" class="form-control form-control-success" placeholder="Ingrese cantidad_consumo" 
                       value="<?php echo $datos[0]["cantidad_consumo"];?>">
                    </div>
                  </div>

                <div class="form-group row"> <!--BOTON-->      
                  <div class="col-sm-9 offset-sm-3">  
                      <input type="hidden" name="grabar" value="si">
                      <input type="hidden" name="id" value="<?php echo $_GET["id_consumo"];?>">
                      <button class="btn btn-primary">Guardar</button>
                      <a class="btn btn-info" href="<?php echo Conectar::ruta();?>consumo.php">Cancelar</a>
                  </div>         
              </div>     
          
        </form>
     </div> <!--block-->
  </div> <!--col lg-6-->
  
  </section>
  </div> <!--fin container-fluid -->
  </div> <!--fin row-->

</div>  <!-- FIN CONTENIDO -->



 <!-- ACA FOOTER -->
       <?php require_once("footer.php");?>

    
  </body>
</html>

<?php } else {
   header("Location:".Conectar::ruta()."login.php");
}?>