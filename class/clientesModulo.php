<?php

  class Clientes extends Conectar{


    public function get_clientes(){

       $conectar=parent::conexion();
       parent::set_names();

       $sql="select * from clientes";
       
       $sql=$conectar->prepare($sql);

       $sql->execute();

       return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }


    public function agregar_cliente(){

    	$conectar=parent::conexion();
    	parent::set_names();

    	if(empty($_POST["nombre"]) or empty($_POST["apellido"]) or empty($_POST["cedula"]) or empty($_POST["telefono"]) or empty($_POST["direccion"])){
          
          header("Location:".Conectar::ruta()."agregar_cliente.php?m=1");
          exit();
    	}

    	$sql="insert into clientes 
    	values(null,?,?,?,?,?,now());";

    	$sql=$conectar->prepare($sql);

    	$sql->bindValue(1,$_POST["cedula"]);
    	$sql->bindValue(2, $_POST["nombre"]);
    	$sql->bindValue(3, $_POST["apellido"]);
    	$sql->bindValue(4, $_POST["telefono"]);
    	$sql->bindValue(5, $_POST["direccion"]);
    	$sql->execute();

    	$resultado=$sql->fetch(PDO::FETCH_ASSOC);

    	header("Location:".Conectar::ruta()."agregar_cliente.php?m=2");
    	exit();
    }

    public function get_cliente_por_id($id_cliente){

    	$conectar=parent::conexion();
    	parent::set_names();

    	$sql="select * from clientes where cod_cliente=?";

    	$sql=$conectar->prepare($sql);

    	$sql->bindValue(1,$id_cliente);

    	$sql->execute();

    	return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editar_cliente(){

    	$conectar=parent::conexion();
    	parent::set_names();

    	if(empty($_POST["nombre"]) or empty($_POST["apellido"]) or empty($_POST["cedula"]) or empty($_POST["telefono"]) or empty($_POST["direccion"])){
          
          header("Location:".Conectar::ruta()."editar_cliente.php?id_cliente=".$_POST["id"]."&m=1");
          exit();
    	}

    	$sql="update clientes set 
          
        ced_cliente=?,
        nom_cliente=?,
        ape_cliente=?,
        tlf_cliente=?,
        direc_cliente=?,
        fecha=now()
        where 
        cod_cliente=?
  
    	";

    	$sql=$conectar->prepare($sql);

    	$sql->bindValue(1, $_POST["cedula"]);
    	$sql->bindValue(2, $_POST["nombre"]);
    	$sql->bindValue(3, $_POST["apellido"]);
    	$sql->bindValue(4, $_POST["telefono"]);
    	$sql->bindValue(5, $_POST["direccion"]);
        $sql->bindValue(6, $_POST["id"]);
        $sql->execute();

        $resultado=$sql->fetch(PDO::FETCH_ASSOC);

        header("Location:".Conectar::ruta()."editar_cliente.php?id_cliente=".$_POST["id"]."&m=2");
        exit();
    }

    public function eliminar_cliente($id_cliente){

        $conectar=parent::conexion();
        parent::set_names();

        $sql="delete from clientes where cod_cliente=?";

        $sql=$conectar->prepare($sql);

        $sql->bindValue(1,$id_cliente);

        $sql->execute();

        return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
    }


    public function add_cliente_ventas()

    {

    $conectar=parent::conexion();
    parent::set_names();

    if(empty($_POST["ced_cliente"])  or empty($_POST["nom_cliente"]) or empty($_POST["ape_cliente"]) or empty($_POST["tlf_cliente"]) or empty($_POST["direc_cliente"])){

       header("Location:".Conectar::ruta()."agregar_venta.php?m=1");
       exit();   
    }

    //aqui hago una consulta a la base de datos en clientes si no existe el cliente entonces hace el insert
    $sql="select * from clientes where ced_cliente=? and nom_cliente=?;";

    $sql=$conectar->prepare($sql);

    $sql->bindValue(1,$_POST["ced_cliente"]);
    $sql->bindValue(2,$_POST["nom_cliente"]);
    $sql->execute();
    $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

     
    if(is_array($resultado)==true and count($resultado)==0){

     $sql2="insert into clientes 
    values(null,?,?,?,?,?,now());
     ";

     $sql2=$conectar->prepare($sql2);

     $sql2->bindValue(1,$_POST["ced_cliente"]);
     $sql2->bindValue(2,$_POST["nom_cliente"]);
     $sql2->bindValue(3,$_POST["ape_cliente"]);
     $sql2->bindValue(4,$_POST["tlf_cliente"]);
     $sql2->bindValue(5,$_POST["direc_cliente"]);
     $sql2->execute();
     $resultado=$sql2->fetch(PDO::FETCH_ASSOC);

      } 

  }


  }


?>