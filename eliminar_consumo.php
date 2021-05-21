<?php

 require_once("class/config.php");

   if(isset($_SESSION["backend_id"])){

   	  require_once("class/consumoModulo.php");

   	  $consumo= new consumo();

        $consumo->eliminar_consumo($_GET["cod_consumo"],$_GET["cod_producto"],$_GET["producto_consumo"],$_GET["cantidad_consumo"]);

        header("Location:".Conectar::ruta()."consumo.php");
      exit();
   
   } else {

         header("Location:".Conectar::ruta()."login.php");
         exit();
   }

?>