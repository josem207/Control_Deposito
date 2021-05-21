<?php 

class Inicio extends Conectar{

// TOTAL USUARIOS -- falta distinguir entre administrador y empleado.

public function get_total_usuarios(){  //conectar con usuario

  	  	$conectar=parent::conexion();
  	  	parent::set_names();

  	  	$sql="select count(*) as total from usuarios";
  	  	
  	  	$sql=$conectar->prepare($sql);
  	  	$sql->execute();

  	  	$resultado=$sql->fetchAll();

  	  	foreach ($resultado as $k => $v) {
  	  		$row["existe"]=$v["total"];
  	  	}

  	  	echo $usuarios = $v["total"];

  	  }

public function get_total_compras(){

  	  	 $conectar=parent::conexion();
  	  	 parent::set_names();
 	  	
		$sql="select count(*) as total from orden_compras";
  	  	
  	  	$sql=$conectar->prepare($sql);
  	  	$sql->execute();

  	  	$resultado=$sql->fetchAll();

  	  	foreach ($resultado as $k => $v) {
  	  		$row["existe"]=$v["total"];
  	  	}
  	  	echo $orden_compras = $v["total"];
  	  }

public function get_total_almacen(){

  	  	 $conectar=parent::conexion();
  	  	 parent::set_names();
 	  	
		$sql="select count(*) as total from producto_almacen";
  	  	
  	  	$sql=$conectar->prepare($sql);
  	  	$sql->execute();

  	  	$resultado=$sql->fetchAll();

  	  	foreach ($resultado as $k => $v) {
  	  		$row["existe"]=$v["total"];
  	  	}
  	  	echo $producto_almacen = $v["total"];
  	  }


public function get_total_pedidos(){

       $conectar=parent::conexion();
       parent::set_names();

       $sql="select count(*) as total from pedidos";

       $sql=$conectar->prepare($sql);
       $sql->execute();

    $resultado=$sql->fetchAll();

        foreach ($resultado as $k => $v) {
          $row["existe"]=$v["total"];
        }
        echo $pedidos = $v["total"];       
    }



















}
 ?>