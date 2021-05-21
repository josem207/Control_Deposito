<?php

require_once("class/config.php");

require_once("class/userModulo.php");

$usuario= new Usuarios();

 if(isset($_POST["grabar"]) and $_POST["grabar"]=="si"){
    $usuario->login();
    exit();
 }

?>

<!DOCTYPE html>
<html>
  <head>
   <?php require_once("head.php");?>
  </head>

<body>
    <div class="login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">

            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>Control Deposito </h1>
                  </div>
                  <p>Sistema de gestion de Inventario</p>
                </div>
              </div>
            </div>
            <!-- formulario   -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form method="post" class="form-validate">
                    <div class="form-group">
                      <input id="login-usuario" type="text" name="usuario" required data-msg="Por favor ingrese su nombre de usuario" class="input-material">
                      <label for="login-usuario" class="label-material">Nombre Usuario</label>
                    </div>
                    <div class="form-group">
                      <input id="login-password" type="password" name="password" required data-msg="Por favor ingrese su clave" class="input-material">
                      <label for="login-password" class="label-material">Contraseña</label>
                        Ver contraseña <input ID="VerPassword" type="checkbox" class="radio-template"/>                          
                   </div>                              


          <!-- BOTONCITO-->
                    <input type="hidden" name="grabar" value="si">
                     <button type="submit" class="btn btn-primary">ENVIAR</button>
             </div>
          </div>
        </div> <!-- fin col-lg-6-->
      
      </div>
      
 <!-- ACA FOOTER -->
       <?php require_once("footer.php");?> <!-- acomodar esto -->
  
  </body>
</html>

