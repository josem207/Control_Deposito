
 <?php

   require_once("class/config.php");

   if(isset($_SESSION["backend_id"])){

      require_once("class/userModulo.php");

      $usuario=new Usuarios();

      $usuario->eliminar_usuario($_GET["id_usuario"]);

      header("Location:".Conectar::ruta()."usuarios.php");
      exit(); 
   
   } else{

   	  header("Location:".Conectar::ruta()."login.php");
   } 


 ?>