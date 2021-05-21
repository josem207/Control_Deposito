<?php

  class compras extends Conectar{


  	  public function get_compras(){


  	  	 $conectar=parent::conexion();
  	  	 parent::set_names();

  	  	 $sql="select * from orden_compras;";

  	  	 $sql=$conectar->prepare($sql);

  	  	 $sql->execute();

  	  	 return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
  	  }

      public function get_compra_por_id($id_compra){

            $conectar=parent::conexion();
            parent::set_names();

           $sql="select * from orden_compras where id_orden_compras=?";

           $sql=$conectar->prepare($sql);

           $sql->bindValue(1, $id_compra);

           $sql->execute();

           return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
      }

  	  public function agregar_compra(){

  	  	  $conectar=parent::conexion();
  	  	  parent::set_names();

  	  	  if(empty($_POST["cod_compra"]) or empty($_POST["cod_producto"]) or empty($_POST["producto"]) or empty($_POST["precio_orden"]) or empty($_POST["cantidad_compra"]) or empty($_POST["cuit_proveedor"])){
             
             header("Location:".Conectar::ruta()."agregar_compra.php?m=1");
             exit();
  	  	  }

  	  	  $sql="insert into orden_compras values(null,?,?,?,?,?,?,now());";
  	  	  $sql=$conectar->prepare($sql);

          $cod_compra=$_POST["cod_compra"];
          $cod_producto=$_POST["cod_producto"];
          $producto=$_POST["producto"];
          $precio_orden=$_POST["precio_orden"];
          $cantidad_compra=$_POST["cantidad_compra"];
          $cuit_proveedor=$_POST["cuit_proveedor"];

          if (!empty($_POST['cod_compra'])) {

          $sql->bindValue(1,$cod_compra);
          $sql->bindValue(2,$cod_producto);
          $sql->bindValue(3,$producto);
          $sql->bindValue(4,$precio_orden);
          $sql->bindValue(5,$cantidad_compra);
          $sql->bindValue(6,$cuit_proveedor); 
          $sql->execute();
          $resultado=$sql->fetch(PDO::FETCH_ASSOC);
          //$resultado=$sql->fetchAll();

          }//fin de IF    

  //---------------------------
        $sql2="select existencia from producto_almacen where cod_producto=?"; // 
        $sql2=$conectar->prepare($sql2);

         $sql2->bindValue(1,$cod_producto);
         $sql2->execute();

         $resultado2=$sql2->fetchAll();

         foreach ($resultado2 as $k=>$v) {  //$k es la clave del item actual y $v su valor. el foreach iterar sobre arrays.
    
              $row["existe"]=$v["cod_producto"];
              $row["existencia"]=$v["existencia"];   
         }
      
          $sql3="select * from orden_compras where cod_compra=? and cod_producto=?"; // 
          $sql3=$conectar->prepare($sql3);

          $sql3->bindValue(1,$cod_compra);
          $sql3->bindValue(2,$cod_producto);
          $sql3->execute();

           $resultado3=$sql3->fetchAll();

            foreach ($resultado3 as $a=>$b) {  //$a es la clave del item actual y $b su valor. el foreach iterar sobre arrays.
                $row["existencia"]=$b["cantidad_compra"];   
            }
      
          $cantidad=$v["existencia"] + $b["cantidad_compra"]; //exsitencia sale de $sql2 y cantidad_compra salio de $sql3

 //ACTUALIZO LA EXISTENCIA DE PORDUCTOS 
          $sql4="update producto_almacen set 
          existencia=? 
          where 
          cod_producto=?
          ";

          $sql4=$conectar->prepare($sql4);

          $sql4->bindValue(1,$cantidad);
          $sql4->bindValue(2,$cod_producto);
          $sql4->execute();
         
        $resultado4=$sql4->fetch(PDO::FETCH_ASSOC); //

//----------------fin actualizar tabla almacen--------

  	  	  header("Location:".Conectar::ruta()."agregar_compra.php?m=2");
  	  	  exit();
  	  }

//EDITAR COMPRA--------------------

  	  public function editar_compra(){

  	  	   $conectar=parent::conexion();
  	  	   parent::set_names();

  	  	    if(empty($_POST["cod_compra"]) or empty($_POST["cod_producto"]) or empty($_POST["producto"]) or empty($_POST["precio_orden"]) or empty($_POST["cantidad_compra"]) or empty($_POST["cuit_proveedor"])){
             
             header("Location:".Conectar::ruta()."editar_compra.php?id_compra=".$_POST["id"]."&m=1");
             exit();
  	  	  }

          $cod_compra=$_POST["cod_compra"];
          $cod_producto=$_POST["cod_producto"];
          $producto=$_POST["producto"];
          $precio_orden=$_POST["precio_orden"];
          $cantidad_compra=$_POST["cantidad_compra"];
          $cuit_proveedor=$_POST["cuit_proveedor"];

          $sql="select existencia from producto_almacen where cod_producto=?";
          
          $sql=$conectar->prepare($sql);

          $sql->bindValue(1,$_POST["cod_producto"]);
          $sql->execute();
  
          $resultado=$sql->fetchAll();

          foreach ($resultado as $k=>$v) { 
    
              $row["existe"]=$v["cod_producto"];
              $row["existe"]=$v["existencia"];    
          }
    
          $sql2="select * from orden_compras where cod_compra=? and cod_producto=?"; // 
          $sql2=$conectar->prepare($sql2);

          $sql2->bindValue(1,$cod_compra);
          $sql2->bindValue(2,$cod_producto);
          $sql2->execute();

          $resultado2=$sql2->fetchAll();

          foreach ($resultado2 as $a=>$b) {  //$a es la clave del item actual y $b su valor. el foreach iterar sobre arrays.
                $row["existencia"]=$b["cantidad_compra"];   
            }
           
         $cantidad=$v["existencia"] + $b["cantidad_compra"]; 


   //ACTUALIZO LA EXISTENCIA DE PORDUCTOS EN PRODUCTO_ALMACEN-- 
           
          $sql3="update producto_almacen set 
          existencia=? 
          where 
          cod_producto=?
          ";

          $sql3=$conectar->prepare($sql3);

          $sql3->bindValue(1,$cantidad);
          $sql3->bindValue(2,$_POST["cod_producto"]);
          
          $sql3->execute();

          $resultado3=$sql3->fetchAll();

//ACTUALIZO LA EXISTENCIA DE PORDUCTOS EN CONSUMO_ALMACEN--   
  	  	  
          $sql4="update orden_compras set 

          cod_compra=?,
          cod_producto=?,
          producto=?,
          precio_orden=?,
          cantidad_compra=?,
          cuit_proveedor=?,
          fecha_ingreso=now()
          where id_orden_compras=?
  	  	  ";

  	  	  $sql4=$conectar->prepare($sql4);

  	  	  $sql4->bindValue(1,$_POST["cod_compra"]);
          $sql4->bindValue(2,$_POST["cod_producto"]);
  	  	  $sql4->bindValue(3,$_POST["producto"]);
  	  	  $sql4->bindValue(4,$_POST["precio_orden"]);
  	  	  $sql4->bindValue(5,$_POST["cantidad_compra"]);
  	  	  $sql4->bindValue(6,$_POST["cuit_proveedor"]);
  	  	  $sql4->bindValue(7,$_POST["id"]);
  	  	  $sql4->execute();

  	  	  $resultado4=$sql4->fetch(PDO::FETCH_ASSOC);

  	  	  header("Location:".Conectar::ruta()."editar_compra.php?id_compra=".$_POST["id"]."&m=2");
  	  	  exit();
  	  }

//ELIMINAR COMPRA-------------------OK

  	  public function eliminar_compra($cod_compra,$cod_producto,$producto,$precio_orden,$cantidad_compra,$cuit_proveedor){

          $conectar=parent::conexion();
          parent::set_names();

          $sql= "select * from orden_compras where cod_compra=?";

          $sql=$conectar->prepare($sql);

          $cod_compra=$_GET["cod_compra"];
          $cod_producto=$_GET["cod_producto"];

          $sql->bindValue(1,$cod_compra);
          $sql->execute();

         $resultado=$sql->fetchAll();

         if (is_array($resultado)==true and count($resultado)>=1) {
            
            $sql2="select existencia from producto_almacen where cod_producto=?"; // 
            $sql2=$conectar->prepare($sql2);

            $sql2->bindValue(1,$cod_producto);
            $sql2->execute();

          $resultado2=$sql2->fetchAll();

            foreach ($resultado2 as $k=>$v) {  
    
              $row["existe"]=$v["cod_producto"];
              $row["existencia"]=$v["existencia"];   
            }
         
          $sql3="select * from orden_compras where cod_compra=? and cod_producto=?"; // 
          $sql3=$conectar->prepare($sql3);

          $sql3->bindValue(1,$cod_compra);
          $sql3->bindValue(2,$cod_producto);
          $sql3->execute();

            $resultado3=$sql3->fetchAll();

            foreach ($resultado3 as $a=>$b) {
    
              $row["existencia"]=$b["cantidad_compra"];    
            }

          //REALIZO EL CALCULO Y LE RESTO A EXISTENCIA LA CANTIDAD QUE ELIMINE.
          $cantidad=$v["existencia"] - $b["cantidad_compra"]; //exsitencia sale de $sql2 y cantidad_compra salio de $sql3
        
          $sql4="delete from orden_compras where cod_compra=? and cod_producto=?"; // 
         
          $sql4=$conectar->prepare($sql4);
          
          $sql4->bindValue(1,$cod_compra);
          $sql4->bindValue(2,$cod_producto);
          $sql4->execute();

          //ACTUALIZO LA EXISTENCIA DEL PRODUCTO CON LA CANTIDAD QUE ELIMINE
          $sql5="update producto_almacen set 
          existencia=? 
          where 
          cod_producto=?
          ";

          $sql5=$conectar->prepare($sql5);
          $sql5->bindValue(1,$cantidad);  //$cantidad es la que sacamos aca: $v["existencia"] - $b["cantidad];
          $sql5->bindValue(2,$cod_producto);
          $sql5->execute();

         $resultado5=$sql5->fetch(PDO::FETCH_ASSOC); //esto va ultimo

         }//fin de IF.

      }//fin de metodo eliminar_consumo.

  }// fin CLASS EXTENDER CONECTAR.

?>

