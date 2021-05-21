
<?php

 require_once("class/config.php");

   session_start(); // para asegurarte de que estás usando la misma sesión
   session_destroy(); // destruir la sesión

   header("Location:".Conectar::ruta()."login.php");
   exit();
?>


