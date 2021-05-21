<?php

 require_once("class/config.php");

  if(isset($_SESSION["backend_id"])){
     
     require_once("class/userModulo.php");
   
    $usuario=new Usuarios();

    $datos= $usuario->get_usuario_por_id($_GET["id_usuario"]);

    if(isset($_POST["grabar"]) and $_POST["grabar"]=="si"){
       
       $usuario->editar_usuario();
       exit();
    }

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
  
    <nav class="navbar navbar-expand-">  
       <a class="navbar-brand" href="#">Editar usuario</a>
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
                          <div class="alert alert-danger" role="alert">los campos estan vacios?</div>                 
                           <?php
                           break;
                           case "2";
                           ?> 
                           <div class="alert alert-success" role="alert">el usuario se ha editado!</div>
                          <?php
                           break;
                         }
                       }
          ?>

                  <div class="form-group row">
                    <label class="col-sm-3 form-control-label">nombres</label>
                    <div class="col-sm-9">                   
                      <input type="text" name="nombres" class="form-control form-control-success" placeholder="ingrese nombre y apellido" 
                       value="<?php echo $datos[0]["nombres"];?>">
                    </div>
                  </div>
                      
                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">DNI</label>
                      <div class="col-sm-9">
                       <input type="text" name="dni" class="form-control form-control-success" placeholder="Ingrese DNI" 
                        value="<?php echo $datos[0]["dni"];?>">
                    </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Sector</label>
                      <div class="col-sm-9">      
                       <input type="text" name="sector" class="form-control form-control-success" placeholder="ingrese sector" 
                        value="<?php echo $datos[0]["sector"];?>">
                    </div>
                  </div>

                  <div class="form-group row">
                      <label class="col-sm-3 form-control-label">Usuario</label>
                      <div class="col-sm-9">
                       <input type="text" name="usuario" class="form-control form-control-success" placeholder="Ingrese usuario" 
                        value="<?php echo $datos[0]["usuario"];?>">
                    </div>
                  </div>

               <div class="form-group row">
                    <label class="col-sm-3 form-control-label">Clave</label>
                  <div class="col-sm-9">                      
                     <div class="input-group">
                        <input id="1Password" type="Password" name="password" class="form-control form-control-warning" placeholder="ingrese su clave">
                        <div class="input-group-append">
                          <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> 
                          <span class="fa fa-eye-slash icon"></span> </button>                        
                        </div>
                     </div>
                  </div>
               </div>

                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">Repita clave</label>
                    <div class="col-sm-9">
                       <div class="input-group">
                          <input ID="2Password" type="Password" name="password2" class="form-control form-control-warning" placeholder="Repita su clave">
                        <div class="input-group-append">
                          <button id="2Password" class="btn btn-primary" type="button" onclick="mostrarPassword2()"> 
                          <span class="fa fa-eye-slash icon"></span> </button>                        
                        </div>
                       </div>
                    </div>
                </div>

                 <div class="form-group row">
                     <label class="col-sm-3 form-control-label">Nivel Acceso</label>
                     <div class="col-sm-9">       
                     <select name="nivel" class="form-control mb-3 mb-3">
                            <option value="0">SELECCIONE</option>
                           
                            <option value="ADMINISTRADOR" <?php if($datos[0]["nivel"]=='ADMINISTRADOR')
                            {echo "selected='selected'";}?> >ADMINISTRADOR</option>
                            
                            <option value="EMPLEADO" <?php if($datos[0]["nivel"]=='EMPLEADO'){echo "selected='selected'";}?>>EMPLEADO</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row"> <!--BOTON-->      
                  <div class="col-sm-9 offset-sm-3">  
                      <input type="hidden" name="grabar" value="si">
                      <input type="hidden" name="id" value="<?php echo $_GET["id_usuario"];?>">
                      <button class="btn btn-primary">Guardar</button>
                      <a class="btn btn-info" href="<?php echo Conectar::ruta();?>usuarios.php">Cancelar</a>
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