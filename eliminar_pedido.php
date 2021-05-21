<?php

   require_once("class/config.php");

   if(isset($_SESSION["backend_id"])){

       require_once("class/proveedoresModulo.php");

       $pedido=new Proveedores();

       $pedido->eliminar_pedido($_GET["id_pedido"]);

       header("Location:".Conectar::ruta()."pedidos.php");
       exit();
   
   } else {

   	  header("Location:".Conectar::ruta()."login.php");
   	  exit();
   }


?>