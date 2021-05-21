<?php

  class Almacen extends Conectar{


  	  public function get_almacen(){


  	  	 $conectar=parent::conexion();
  	  	 parent::set_names();

  	  	 $sql="select * from producto_almacen;";

  	  	 $sql=$conectar->prepare($sql);

  	  	 $sql->execute();

  	  	 return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
  	  }

      public function get_almacen_por_id($id_almacen){

            $conectar=parent::conexion();
            parent::set_names();

           $sql="select * from producto_almacen where id_producto_almacen=?" ;

           $sql=$conectar->prepare($sql);

           $sql->bindValue(1,$id_almacen);

           $sql->execute();

           return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
      }


      public function agregar_almacen(){

  	  	  $conectar=parent::conexion();
  	  	  parent::set_names();

  	  	  if(empty($_POST["cod_producto"]) or empty($_POST["producto"]) or empty($_POST["precio"]) or empty($_POST["estado_producto"]) or empty($_POST["existencia"])
             or empty($_POST["ubicacion_deposito"])  or empty($_POST["cuit_proveedor"])){
             
             header("Location:".Conectar::ruta()."agregar_almacen.php?m=1");
             exit();
  	  	  }

  	  	  $sql="insert into producto_almacen values(null,?,?,?,?,?,?,?,now());";
  	  	  $sql=$conectar->prepare($sql);

  	  	  $sql->bindValue(1,$_POST["cod_producto"]);
  	  	  $sql->bindValue(2,$_POST["producto"]);
  	  	  $sql->bindValue(3,$_POST["precio"]);
          $sql->bindValue(4,$_POST["existencia"]);
          $sql->bindValue(5,$_POST["ubicacion_deposito"]);
          $sql->bindValue(6,$_POST["estado_producto"]);	   
          $sql->bindValue(7,$_POST["cuit_proveedor"]); 
  	  	  $sql->execute();

  	  	  $resultado=$sql->fetch(PDO::FETCH_ASSOC);

  	  	  header("Location:".Conectar::ruta()."agregar_almacen.php?m=2");
  	  	  exit();
  	  }


  	  public function editar_almacen(){


  	  	   $conectar=parent::conexion();
  	  	   parent::set_names();

  	  	   if(empty($_POST["cod_producto"]) or empty($_POST["producto"]) or empty($_POST["precio"])  or empty($_POST["existencia"])
             or empty($_POST["ubicacion_deposito"]) or empty($_POST["estado_producto"]) or empty($_POST["cuit_proveedor"])){
             
             header("Location:".Conectar::ruta()."editar_almacen.php?id_almacen=".$_POST["id"]."&m=1" );
             exit();
          }

  	  	  $sql="update producto_almacen set 

          cod_producto=?,
          producto=?,
          precio=?, 
          existencia=?,
          ubicacion_deposito=?,
          estado_producto=?,
          cuit_proveedor=?,
          fecha_ingreso=now()
          where id_producto_almacen=?
  	  	  ";

  	  	  $sql=$conectar->prepare($sql);

          $sql->bindValue(1,$_POST["cod_producto"]);
          $sql->bindValue(2,$_POST["producto"]);
          $sql->bindValue(3,$_POST["precio"]);
          $sql->bindValue(4,$_POST["existencia"]);
          $sql->bindValue(5,$_POST["ubicacion_deposito"]); 
          $sql->bindValue(6,$_POST["estado_producto"]);
          $sql->bindValue(7,$_POST["cuit_proveedor"]); 
          $sql->bindValue(8,$_POST["id"]); 
          $sql->execute();

  	  	  $resultado=$sql->fetch(PDO::FETCH_ASSOC);

  	  	  header("Location:".Conectar::ruta()."editar_almacen.php?id_almacen=".$_POST["id"]."&m=2");
  	  	  exit();
  	  }


  	  public function eliminar_almacen($id_almacen){

          $conectar=parent::conexion();
          parent::set_names();

          $sql="delete from producto_almacen where id_producto_almacen=?";

          $sql=$conectar->prepare($sql);

          $sql->bindValue(1,$id_almacen);

          $sql->execute();

          return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
  	  }

  	  

  } 

?>