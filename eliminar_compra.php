<?php

 require_once("class/config.php");

   if(isset($_SESSION["backend_id"])){

   	  require_once("class/comprasModulo.php");

   	  $compra= new compras();

        $compra->eliminar_compra($_GET["cod_compra"],$_GET["cod_producto"],$_GET["producto"],$_GET["precio_orden"],$_GET["cantidad_compra"],$_GET["cuit_proveedor"]);

   	  header("Location:".Conectar::ruta()."compras.php");
      exit();
   
   } else {
   	   header("Location:".Conectar::ruta()."login.php");
   	   exit();
   }

?>

