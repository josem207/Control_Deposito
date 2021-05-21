
<?php
  
  Class configuracion extends Conectar{

      
      public function get_configuracion(){

      	 $conectar=parent::conexion();
      	 parent::set_names();

      	 $sql="select * from configuracion";

      	 $sql=$conectar->prepare($sql);

      	 $sql->execute();

      	 return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
      }

    public function get_configuracion_por_id($id_configuracion){

          $conectar=parent::conexion();
          parent::set_names();

          $sql="select * from configuracion where cod_configuracion=?";

          $sql=$conectar->prepare($sql);

          $sql->bindValue(1, $id_configuracion);

          $sql->execute();

          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
      }


//EDITAR CONFIGURACION----------------OK

      public function editar_configuracion(){

      	    $conectar=parent::conexion();
      	    parent::set_names();

           if(empty($_POST["cuit_empresa"]) or empty($_POST["nombre_empresa"]) or empty($_POST["direccion_empresa"]) or empty($_POST["telefono_empresa"]) or empty($_POST["correo_empresa"]) or empty($_POST["dni_gerente"]) or empty($_POST["nombre_gerente"]) or empty($_POST["correo_gerente"]) ){
              
              header("Location:".Conectar::ruta()."editar_configuracion.php?id_configuracion=".$_POST["id"]."&m=1");
              exit();
      	   }

      	   $sql="update configuracion set 

           cuit_empresa=?,
           nombre_empresa=?,
           direccion_empresa=?,
           telefono_empresa=?,
           correo_empresa=?,
           dni_gerente=?,
           nombre_gerente=?,
           correo_gerente=?,
           where 
           cod_configuracion=?
           ";

           $sql=$conectar->prepare($sql);
           $sql->bindValue(1, $_POST["cuit_empresa"]);
           $sql->bindValue(2, $_POST["nombre_empresa"]);
           $sql->bindValue(3, $_POST["direccion_empresa"]);
           $sql->bindValue(4, $_POST["telefono_empresa"]);
           $sql->bindValue(5, $_POST["correo_empresa"]);
           $sql->bindValue(6, $_POST["dni_gerente"]);
           $sql->bindValue(7, $_POST["nombre_gerente"]);
           $sql->bindValue(8, $_POST["correo_gerente"]);
           $sql->bindValue(9,$_POST["id"]);
           $sql->execute();

           $resultado=$sql->fetch(PDO::FETCH_ASSOC);

           header("Location:".Conectar::ruta()."editar_configuracion.php?id_configuracion=".$_POST["id"]."&m=2");
           exit();             
      }

  }
?>