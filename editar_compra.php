<?php

 require_once("class/config.php");

   require_once("class/proveedoresModulo.php");
    
    $proveedores=new Proveedores();
    
    $proveedor=$proveedores->get_proveedores();

   require_once("class/comprasModulo.php");
    
    $compra=new compras();

    $datos=$compra->get_compra_por_id($_GET["id_compra"]);

   if(isset($_SESSION["backend_id"])){

    if(isset($_POST["grabar"]) and $_POST["grabar"]=="si"){
     
       require_once("class/comprasModulo.php");

       $compra=new compras();

       $compra->editar_compra();
       exit();
   }
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Editar compra</title>
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
        

<div class="page-header"> <!-- panel compra -->
  
    <nav class="navbar navbar-expand-">  
       <a class="navbar-brand" href="#">Editar compra</a>
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
                           <div class="alert alert-success" role="alert">la compra se ha modificado correctamente!</div>
                          <?php
                           break;
                         }
                       }
          ?>

                   <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Código compra</label>
                    <div class="col-sm-9">                   
                      <input type="text" name="cod_compra" class="form-control form-control-success" placeholder="ingrese codigo compra"
                      value="<?php echo $datos[0]["cod_compra"];?>">
                    </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Código Producto</label>
                    <div class="col-sm-9">                   
                      <input type="text" name="cod_producto" class="form-control form-control-success" placeholder="ingrese cod producto" 
                      value="<?php echo $datos[0]["cod_producto"];?>">
                    </div>
                  </div>
                      
                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">producto</label>
                    <div class="col-sm-9">
                       <input type="text" name="producto" class="form-control form-control-success" placeholder="Ingrese producto" 
                       value="<?php echo $datos[0]["producto"];?>">
                    </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">precio</label>
                    <div class="col-sm-9">      
                       <input type="text" name="precio_orden" class="form-control form-control-success" placeholder="ingrese precio" 
                       value="<?php echo $datos[0]["precio_orden"];?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Cantidad</label>
                    <div class="col-sm-9">
                       <input type="text" name="cantidad_compra" class="form-control form-control-success" placeholder="Ingrese cantidad"
                       value="<?php echo $datos[0]["cantidad_compra"];?>">
                    </div>
                  </div>

                 <div class="form-group row">
                      <label for="" class="col-sm-3 control-label">Proveedor Producto</label>
                      <div class="col-sm-9">
                          <select name="cuit_proveedor" class="form-control" id="">
                                        
                            <option value="0">SELECCIONE</option>

                              <?php             
                                 for($i=0;$i<sizeof($proveedor);$i++){      
                              ?>
                                  <option value="<?php echo $proveedor[$i]["cuit_proveedor"];?>"><?php echo $proveedor[$i]["nombre_proveedor"];?></option>
                              <?php
                              }
                              ?>
                          </select>
                        </div>
                 </div>

                <div class="form-group row"> <!--BOTON-->      
                  <div class="col-sm-9 offset-sm-3">  
                      <input type="hidden" name="grabar" value="si">
                      <input type="hidden" name="id" value="<?php echo $_GET["id_compra"];?>">
                      <button class="btn btn-primary">Guardar</button>
                      <a class="btn btn-info" href="<?php echo Conectar::ruta();?>compras.php">Cancelar</a>
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