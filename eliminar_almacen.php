<?php

 require_once("class/config.php");

   if(isset($_SESSION["backend_id"])){

   	  require_once("class/almacenModulo.php");

   	  $almacen= new almacen();

   	  $almacen->eliminar_almacen($_GET["id_almacen"]);

   	  header("Location:".Conectar::ruta()."almacen.php");
      exit();
   
   } else {

   	   header("Location:".Conectar::ruta()."login.php");
   	   exit();
   }

?>