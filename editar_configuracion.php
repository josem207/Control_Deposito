
<?php
 require_once("class/config.php");

  if(isset($_SESSION["backend_id"])){

    require_once("class/configuracionModulo.php");

    $config= new Configuracion();

    $datos=$config->get_configuracion_por_id($_GET["id_configuracion"]);

  if(isset($_POST["grabar"]) and $_POST["grabar"]=="si"){      
       $config->editar_configuracion();
       exit();
    }
?>

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Editar configuracion</title>
   <?php require_once("head.php");?>
</head>

  <body>
  <!-- para que class = active en menu principal--> 
  <?php $mi_pagina="Configuracion"; ?>   
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
       <a class="navbar-brand" href="#">Editar Datos empresa</a>
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
                           <div class="alert alert-success" role="alert">Se editaron datos correctamente!!</div>
                          <?php
                           break;
                         }
                       }
          ?>
                 
                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">CUIT Empresa</label>
                        <div class="col-sm-9">
                          <input  type="text" name="cuit_empresa"  class="form-control form-control-success" placeholder="Ingrese Nro de CUIT" 
                           value="<?php echo $datos[0]["cuit_empresa"];?>">
                        </div>
                  </div>

                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Nombre Empresa</label>
                        <div class="col-sm-9">
                          <input type="text" name="nombre_empresa" class="form-control form-control-success" placeholder="Ingrese nombre de Empresa"
                          value="<?php echo $datos[0]["nombre_empresa"];?>">
                        </div>
                  </div>

                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Direccion</label>
                        <div class="col-sm-9">
                          <input type="text" name="direccion_empresa" class="form-control form-control-success" placeholder="Ingrese Direccion" 
                           value="<?php echo $datos[0]["direccion_empresa"];?>">
                        </div>
                  </div>
                      
                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Telefono</label>
                        <div class="col-sm-9">
                          <input type="text" name="telefono_empresa" class="form-control form-control-success" placeholder="Ingrese Telefono" 
                          value="<?php echo $datos[0]["telefono_empresa"];?>">
                        </div>
                  </div>

                  <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Correo Electronico</label>
                        <div class="col-sm-9">
                          <input type="text" name="correo_empresa" class="form-control form-control-success" placeholder="Ingrese email" 
                           value="<?php echo $datos[0]["correo_empresa"];?>">
                        </div>
                  </div>

                  <h1 class="h6">Datos Gerente: </h1>
                  
                 <div class="form-group row">
                      <label class="col-sm-3 form-control-label">DNI</label>
                      <div class="col-sm-9">
                       <input type="text" name="dni_gerente" class="form-control form-control-success" placeholder="Ingrese DNI" 
                        value="<?php echo $datos[0]["dni_gerente"];?>">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Nombre y Apellido</label>
                    <div class="col-sm-9">                   
                      <input type="text" name="nombre_gerente" class="form-control form-control-success" placeholder="Nombre y Apellido Gerente" 
                       value="<?php echo $datos[0]["nombre_gerente"];?>">
                    </div>
                  </div>
                      
                   <div class="form-group row">
                        <label class="col-sm-3 form-control-label">Correo Electronico</label>
                        <div class="col-sm-9">
                          <input type="text" name="correo_gerente" class="form-control form-control-success" placeholder="Ingrese email" 
                           value="<?php echo $datos[0]["correo_gerente"];?>">
                        </div>
                  </div>

              <div class="form-group row"> 
                <!--Botones: -->      
                  <div class="col-sm-9 offset-sm-3">  
                      <input type="hidden" name="grabar" value="si">

                      <input type="hidden" name="id" value="<?php echo $_GET["id_configuracion"];?>">
                      <button class="btn btn-primary">Guardar</button>
                      
                      <a class="btn btn-info" href="<?php echo Conectar::ruta();?>configuracion.php">Cancelar</a>
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