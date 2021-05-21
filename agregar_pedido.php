<?php
  
  require_once("class/config.php");

  if(isset($_SESSION["backend_id"])){

    require_once("class/proveedoresModulo.php");

    $pedido=new Proveedores();

    $proveedor=$pedido->get_proveedores();

    if(isset($_POST["grabar"]) and $_POST["grabar"]=="si"){
       
       $pedido->agregar_pedido();
       exit();
    }

?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Agregar pedido</title>
   <?php require_once("head.php");?>
</head>

  <body>   
  <!-- para que class = active en menu principal--> 
  <?php $mi_pagina="Pedidos"; ?>   
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
    <nav class="navbar">  
       <a class="navbar-brand" href="#">Registro de pedido</a>
    </nav>
 </div><!--fin page-header-->


 <section class="no-padding-top"> <!--aca tablas-->
 <div class="container-fluid"> <!--diseño cuadrilla-->
              
    <!-- Horizontal Form-->
      <div class="col-lg-6">
        <div class="block">
          <form action="" class="form-horizontal" method="post">


            <?php if(isset($_GET["m"]))
                       
                       switch($_GET["m"]){
                          
                          case "1";
                          ?>
                          <div class="alert alert-danger" role="alert">los campos estan vacios!</div>   
                          <?php 
                          break;

                          case "2";
                          ?>
                          <div class="alert alert-success" role="alert">el pedido fue agregado!</div>
                          <?php 
                          break;
                       }
            ?>

                    <div class="form-group row">
                         <label for="" class="col-sm-3 form-control-label">Código Producto</label>
                         <div class="col-sm-9">
                          <input type="text" name="cod_producto" class="form-control form-control-success" placeholder="codigo producto">
                         </div>
                      </div>
                      
                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Descripción Producto</label>
                    <div class="col-sm-9">
                       <input type="text" name="producto_pedido" class="form-control form-control-success" placeholder="descripcion producto">
                    </div>
                  </div>


                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Cantidad producto</label>
                    <div class="col-sm-9">
                       <input type="text" name="cantidad_pedido" class="form-control form-control-success" placeholder="cantidad producto">
                    </div>
                  </div>

                 <div class="form-group row">
                      <label for="" class="col-sm-3 control-label">Proveedor Producto</label>
                      <div class="col-sm-9">
                          <select name="producto" class="form-control">
                                        
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
                      <button type="submit" class="btn btn-primary">Guardar</button>
                      <a class="btn btn-info" href="<?php echo Conectar::ruta();?>pedidos.php">Cancelar</a>
                  </div>         
              </div>   
           
        </form>
     </div> <!--block-->
  </div> <!--col lg-6-->
  

  </section>
    </div> <!--page-content -->
      </div>  <!-- FIN CONTENIDO -->

 <!-- ACA FOOTER -->
       <?php require_once("footer.php");?>

</body>
</html>

<?php } else {

  header("Location:".Conectar::ruta()."login.php");
}?>