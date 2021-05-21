<?php

  require_once("class/config.php");

  if(isset($_SESSION["backend_id"])){

    require_once("class/proveedoresModulo.php");
    
    $proveedor=new Proveedores();

    $proveedor->eliminar_proveedor($_GET["id_proveedor"]);

    header("Location:".Conectar::ruta()."proveedores.php");
    exit();
  
  } else {

  	 header("Location:".Conectar::ruta()."login.php");
  	 exit();
  }


?>