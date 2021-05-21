<?php

 require_once("class/config.php");

  if(isset($_SESSION["backend_id"])){

  require_once("class/almacenModulo.php");
  require_once("class/proveedoresModulo.php");

   $almacen=new Almacen();

   $proveedores=new Proveedores();

   $proveedor=$proveedores->get_proveedores();

   $datos=$almacen->get_almacen_por_id($_GET["id_almacen"]);

  if(isset($_POST["grabar"]) and $_POST["grabar"]=="si"){
     
       require_once("class/almacenModulo.php");

       $almacen=new almacen();

       $almacen->editar_almacen();
       exit();

   }
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Editar producto</title>
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
        

<div class="page-header"> <!-- panel compra -->
  
    <nav class="navbar navbar-expand-">  
       <a class="navbar-brand" href="#">Editar producto en inventario</a>
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
                           <div class="alert alert-success" role="alert">el producto se ha modificado correctamente!</div>
                          <?php
                           break;
                         }
                       }
          ?>


                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Código Producto</label>
                    <div class="col-sm-9">                   
                      <input type="text" name="cod_producto" class="form-control form-control-success" placeholder="ingrese codigo producto" 
                      value="<?php echo $datos[0]["cod_producto"];?>">
                    </div>
                  </div>
                      
                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Descripcion Producto</label>
                    <div class="col-sm-9">
                       <input type="text" name="producto" class="form-control form-control-success" placeholder="Ingrese producto" 
                       value="<?php echo $datos[0]["producto"];?>">
                    </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Precio</label>
                    <div class="col-sm-9">      
                       <input type="text" name="precio" class="form-control form-control-success" placeholder="ingrese precio" 
                       value="<?php echo $datos[0]["precio"];?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Existencia</label>
                    <div class="col-sm-9">
                       <input type="text" name="existencia" class="form-control form-control-success" placeholder="Ingrese existencia" 
                       value="<?php echo $datos[0]["existencia"];?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Ubicacion</label>
                    <div class="col-sm-9">
                       <input type="text" name="ubicacion_deposito" class="form-control form-control-success" placeholder="Ingrese ubicacion" 
                       value="<?php echo $datos[0]["ubicacion_deposito"];?>">
                    </div>
                  </div>                  

                  <div class="form-group row">
                      <label for="" class="col-sm-3 control-label">Estado Producto</label>
                      <div class="col-sm-9">
                          <select name="estado_producto" class="form-control" id="">
                                        
                            <option value="0">SELECCIONE</option>
                            <option value="activo" <?php if ($datos[0]["estado_producto"]=="activo")
                                    {echo "selected='selected'";}?>>ACTIVO</option>

                           <option value="inactivo" <?php if ($datos[0]["estado_producto"]=="inactivo"){
                              echo "selected= 'selected'";}?>>INACTIVO</option>
                          </select>
                        </div>
                 </div>


                 <div class="form-group row">
                      <label for="" class="col-sm-3 control-label">Proveedor Producto</label>
                      <div class="col-sm-9">
                          <select name="cuit_proveedor" class="form-control" >
                                        
                              <?php             
                                 for($i=0;$i<sizeof($proveedor);$i++){
                                 if($datos[0]["cuit_proveedor"]==$proveedor[$i]["cuit_proveedor"]){  // inicia en proveedor actual.
                              ?>
                                  <option value="<?php echo $proveedor[$i]["cuit_proveedor"];?>"><?php echo $proveedor[$i]["nombre_proveedor"];?></option>
                              <?php
                              }else {                             
                                ?>
                                  <option value="<?php echo $proveedor[$i]["cuit_proveedor"];?>"><?php echo $proveedor[$i]["nombre_proveedor"];?></option>
                                <?php
                                } //fin else
                              } //fin for
                              ?>
                          </select>
                     </div>
                 </div>


                <div class="form-group row"> <!--BOTON-->      
                  <div class="col-sm-9 offset-sm-3">  
                      <input type="hidden" name="grabar" value="si">
                      <input type="hidden" name="id" value="<?php echo $_GET["id_almacen"];?>">
                      <button class="btn btn-primary">Guardar</button>
                      <a class="btn btn-info" href="<?php echo Conectar::ruta();?>almacen.php">Cancelar</a>
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