
<?php

  class Usuarios extends Conectar{
     
    //INICIAR SESION
  	   public function login(){

  	  	 $conectar=parent::conexion(); //Devuelve las clases padre de la clase dada.
  	  	 parent::set_names();

  	  	 if(empty($_POST["usuario"]) and empty($_POST["password"])){  //si campos vacios no pasa de login.
           header("Location:".Conectar::ruta()."login.php");
           exit();
  	  	 }

  	  	 $sql="select * from usuarios where usuario=? and password=?"; //si estan completados correctamente.
  	  	 $sql=$conectar->prepare($sql); //Prepara una sentencia para su ejecución y devuelve un objeto sentencia.

  	  	 $sql->bindValue(1, $_POST["usuario"]); //Vincula un valor a un parámetro.
  	  	 $sql->bindValue(2, $_POST["password"]);
        
  	  	 $sql->execute();
  	  	 
         $resultado=$sql->fetch(PDO::FETCH_ASSOC); 

  	  	 if(is_array($resultado)==true and count($resultado)>=1){
          
           $_SESSION["backend_id"]=$resultado["id"];
           $_SESSION["nombres"]=$resultado["nombres"];
           $_SESSION["usuario"]=$resultado["usuario"];
           $_SESSION["dni"]=$resultado["dni"];
           $_SESSION["nivel"]=$resultado["nivel"];
 
          header("Location:".Conectar::ruta()."index.php");
           exit();
         
  	  	 }else{
  	  	 	header("Location:".Conectar::ruta()."login.php");
  	  	 	 exit();
  	  	 }
  	   }

    //LLAMAR USUARIO
  	  public function get_usuario(){  //conectar con usuario

  	  	$conectar=parent::conexion();
  	  	parent::set_names();

  	  	$sql="select * from usuarios";
  	  	$sql=$conectar->prepare($sql);
  	  	$sql->execute();

  	  	return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
  	  }


     public function get_nivel(){  //conectar con usuario

        $conectar=parent::conexion();
        parent::set_names();

        $sql="select * from usuarios";
        $sql=$conectar->prepare($sql);
        $sql->execute();

        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
      }

    //LLAMAR USUARIO POR ID
      public function get_usuario_por_id($id_usuario){

         $conectar=parent::conexion();
         parent::set_names();

         $sql="select * from usuarios where id=?";
         $sql=$conectar->prepare($sql);
         $sql->bindValue(1,$id_usuario);
         $sql->execute();

         return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
      }

    //AGREGAR USUARIO
      public function agregar_usuario(){

        $conectar=parent::conexion();
        parent::set_names();

        if( empty($_POST["nombres"]) or empty($_POST["dni"]) or empty($_POST["sector"]) or empty($_POST["usuario"]) 
            or empty($_POST["password"]) or empty($_POST["password2"]) or empty($_POST["nivel"]))
        {

           header("Location:".Conectar::ruta()."agregar_usuario.php?m=1"); //si los campos estan vacios cierra conexion.
           exit(); // M=1 ES MENSAJE NUMERO UNO
        }

        $sql="insert into usuarios values(null,?,?,?,?,?,?,?,now() );";

        $sql=$conectar->prepare($sql);

        $sql->bindValue(1,$_POST["nombres"]);
        $sql->bindValue(2,$_POST["dni"]);
        $sql->bindValue(3,$_POST["sector"]);
        $sql->bindValue(4,$_POST["usuario"]);
        $sql->bindValue(5,$_POST["password"]);
        $sql->bindValue(6,$_POST["password2"]);
        $sql->bindValue(7,$_POST["nivel"]);
        $sql->execute();
        $resultado=$sql->fetch(PDO::FETCH_ASSOC);

        header("Location:".Conectar::ruta()."agregar_usuario.php?m=2"); //si los campos estan completos se crea usuario.
        exit(); // M=2 ES MENSAJE NUMERO DOS
      }

    //EDITAR USUARIO
      public function editar_usuario(){

        $conectar=parent::conexion();
        parent::set_names();

        if( empty($_POST["nombres"]) or empty($_POST["dni"]) or empty($_POST["sector"]) or empty($_POST["usuario"]) 
            or empty($_POST["password"]) or empty($_POST["password2"]) or empty($_POST["nivel"]))
        {       
           header("Location:".Conectar::ruta()."editar_usuario.php?id_usuario=".$_POST["id"]."&m=1");
           exit();
        }

        $sql="update usuarios set 
        nombres=?, 
        dni=?,
        sector=?,
        usuario=?,
        password=?,
        password2=?,
        nivel=?
        where id=?
        ";

        $sql=$conectar->prepare($sql);

        $sql->bindValue(1,$_POST["nombres"]);
        $sql->bindValue(2,$_POST["dni"]);
        $sql->bindValue(3,$_POST["sector"]);
        $sql->bindValue(4,$_POST["usuario"]);
        $sql->bindValue(5,$_POST["password"]);
        $sql->bindValue(6,$_POST["password2"]);
        $sql->bindValue(7,$_POST["nivel"]);
        $sql->bindValue(8,$_POST["id"]);
        $sql->execute();

        $resultado=$sql->fetch(PDO::FETCH_ASSOC);

        header("Location:".Conectar::ruta()."editar_usuario.php?id_usuario=".$_POST["id"]."&m=2");
        exit();
      }

    //ELIMINAR USUARIO
      public function eliminar_usuario($id_usuario){

          $conectar=parent::conexion();
          parent::set_names();

          $sql="delete from usuarios where id=?";
          $sql=$conectar->prepare($sql);
          $sql->bindValue(1,$id_usuario);
          $sql->execute();

          return $resultado=$sql->fetch(PDO::FETCH_ASSOC);

      }
  }

?>