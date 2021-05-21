<?php

  class consumo extends Conectar{

//---------LISTO
  	  public function get_consumo(){


  	  	 $conectar=parent::conexion();
  	  	 parent::set_names();

  	  	 $sql="select * from consumo_almacen;";

  	  	 $sql=$conectar->prepare($sql);

  	  	 $sql->execute();

  	  	 return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
  	  }

//---------
      //ACA IRIA public function cod_consumo($id_consumo){ VER SI LO NESECITO MAS ADELANTE. 

      public function get_consumo_por_id($id_consumo){

            $conectar=parent::conexion();
            parent::set_names();

           $sql="select * from consumo_almacen where id_consumo=?";

           $sql=$conectar->prepare($sql);

           $sql->bindValue(1, $id_consumo);

           $sql->execute();

           return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
      }
       
//AGREGAR CONSUMO--------------------OK

 public function agregar_consumo(){

          $conectar=parent::conexion();
          parent::set_names();

          if(empty($_POST["cod_consumo"]) or empty($_POST["cod_producto"]) or empty($_POST["producto_consumo"]) or empty($_POST["cantidad_consumo"])){
             
             header("Location:".Conectar::ruta()."agregar_consumo.php?m=1");
             exit();
          }

           $conectar=parent::conexion();
           parent::set_names();

         //INGRESA NUEVOS DATOS A TABLA--OK
         $sql="insert into consumo_almacen values(null,?,?,?,?,now());";
         $sql=$conectar->prepare($sql);


          $cod_consumo=$_POST["cod_consumo"];
          $cod_producto=$_POST["cod_producto"];
          $producto_consumo=$_POST["producto_consumo"];
          $cantidad_consumo=$_POST["cantidad_consumo"];


          if (!empty($_POST['cod_consumo'])) {

          $sql->bindValue(1,$cod_consumo);
          $sql->bindValue(2,$cod_producto);
          $sql->bindValue(3,$producto_consumo);
          $sql->bindValue(4,$cantidad_consumo);
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
      
          //FOREACH es un bucle sobre una matriz, $k es la clave y $v es el valor, y está haciendo un bucle a través de cada par usando un foreach.
          //ROW lo que hace es mostrar el resultado de un campo al hacer la consulta, devuelve un renglon de la tabla a la que se esta consultando.

          $sql3="select * from consumo_almacen where cod_consumo=? and cod_producto=?"; // 
          $sql3=$conectar->prepare($sql3);

          $sql3->bindValue(1,$cod_consumo);
          $sql3->bindValue(2,$cod_producto);
          $sql3->execute();

           $resultado3=$sql3->fetchAll();

            foreach ($resultado3 as $a=>$b) {  //$a es la clave del item actual y $b su valor. el foreach iterar sobre arrays.
                $row["existencia"]=$b["cantidad_consumo"];   
            }
      
          $cantidad=$v["existencia"] - $b["cantidad_consumo"]; //exsitencia sale de $sql2 y cantidad_consumo salio de $sql3

 //ACTUALIZO LA EXISTENCIA DE PORDUCTOS 
          $sql4="update producto_almacen set 
          existencia=? 
          where 
          cod_producto=?
          ";

          $sql4=$conectar->prepare($sql4);

          $sql4->bindValue(1,$cantidad);
          $sql4->bindValue(2,$cod_producto);
          //$sql4->bindValue(2,$_POST["cod_producto"]);
          $sql4->execute();
         

        $resultado4=$sql4->fetch(PDO::FETCH_ASSOC); //esto va ultimo

//------------------------
          header("Location:".Conectar::ruta()."agregar_consumo.php?m=2");// ver si va esto
          exit();

}// fin de funcion agregar_consumo


//EDITAR CONSUMO--------------------OK

public function editar_consumo(){


           $conectar=parent::conexion();
           parent::set_names();

            if(empty($_POST["cod_consumo"]) or empty($_POST["cod_producto"]) or empty($_POST["producto_consumo"]) or empty($_POST["cantidad_consumo"])){
             
             header("Location:".Conectar::ruta()."agregar_consumo.php?m=1");
             exit();
          }//fin de IF

          $cod_consumo=$_POST["cod_consumo"];
          $cod_producto=$_POST["cod_producto"];// conecta una variable a un valor dado
          $cantidad=$_POST["producto_consumo"]; // ver de sacar esto o no.   
          $cantidad=$_POST["cantidad_consumo"];
         

          $sql="select existencia from producto_almacen where cod_producto=?";
          
          $sql=$conectar->prepare($sql);

          $sql->bindValue(1,$_POST["cod_producto"]);
          $sql->execute();
  
          $resultado=$sql->fetchAll();

          foreach ($resultado as $k=>$v) {  //$k es la clave del item actual y $v su valor. el foreach iterar sobre arrays.
    
              $row["existe"]=$v["cod_producto"];
              $row["existe"]=$v["existencia"];    
          }
    
          $sql2="select * from consumo_almacen where cod_consumo=? and cod_producto=?"; // 
          $sql2=$conectar->prepare($sql2);

          $sql2->bindValue(1,$cod_consumo);
          $sql2->bindValue(2,$cod_producto);
          $sql2->execute();

          $resultado2=$sql2->fetchAll();

          foreach ($resultado2 as $a=>$b) {  //$a es la clave del item actual y $b su valor. el foreach iterar sobre arrays.
                $row["existencia"]=$b["cantidad_consumo"];   
            }
           

       $cantidad=$v["existencia"] - $b["cantidad_consumo"]; //exsitencia sale de $sql y cantidad_consumo salio de $sql2


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
          $sql4="update consumo_almacen set 

          cod_consumo=?,
          cod_producto=?,
          producto_consumo=?,
          cantidad_consumo=?,
          fecha_consumo=now()
          where id_consumo=?
          ";

          $sql4=$conectar->prepare($sql4);

          $sql4->bindValue(1,$_POST["cod_consumo"]);
          $sql4->bindValue(2,$_POST["cod_producto"]);
          $sql4->bindValue(3,$_POST["producto_consumo"]);
          $sql4->bindValue(4,$_POST["cantidad_consumo"]);
          $sql4->bindValue(5,$_POST["id"]);
          $sql4->execute();

         //$resultado=$sql->fetch(PDO::FETCH_ASSOC);
          $resultado4=$sql4->fetchAll();

          header("Location:".Conectar::ruta()."editar_consumo.php?id_consumo=".$_POST["id"]."&m=2");
          exit();
      } // fin editar consumo

 //ELIMINAR CONSUMO--------------------OK

      public function eliminar_consumo($cod_consumo,$cod_producto,$producto_consumo,$cantidad_consumo){

          $conectar=parent::conexion();
          parent::set_names();

          $sql= "select * from consumo_almacen where cod_consumo=?";

          $sql=$conectar->prepare($sql);

          $cod_consumo=$_GET["cod_consumo"];
          $cod_producto=$_GET["cod_producto"];// conecta una variable a un valor dado
                    
          $sql->bindValue(1,$cod_consumo);
          $sql->execute();

         $resultado=$sql->fetchAll();

         if (is_array($resultado)==true and count($resultado)>=1) {
            
            $sql2="select existencia from producto_almacen where cod_producto=?"; // 
            $sql2=$conectar->prepare($sql2);

            $sql2->bindValue(1,$cod_producto);
            $sql2->execute();

         $resultado2=$sql2->fetchAll();

            foreach ($resultado2 as $k=>$v) {  //$k es la clave del item actual y $v su valor. el foreach iterar sobre arrays.
    
              $row["existe"]=$v["cod_producto"];
              $row["existencia"]=$v["existencia"];   
          }//fin de FOREACH
          
          //FOREACH es un bucle sobre una matriz, $k es la clave y $v es el valor, y está haciendo un bucle a través de cada par usando un foreach.
          //ROW lo que hace es mostrar el resultado de un campo al hacer la consulta, devuelve un renglon de la tabla a la que se esta consultando.

          $sql3="select * from consumo_almacen where cod_consumo=? and cod_producto=?"; // 
          $sql3=$conectar->prepare($sql3);

          $sql3->bindValue(1,$cod_consumo);
          $sql3->bindValue(2,$cod_producto);
          $sql3->execute();

            $resultado3=$sql3->fetchAll();

            foreach ($resultado3 as $a=>$b) {  //$a es la clave del item actual y $b su valor. el foreach iterar sobre arrays.
    
              $row["existencia"]=$b["cantidad_consumo"];   
            }
      

//REALIZO EL CALCULO Y LE SUMA A EXISTENCIA LA CANTIDAD QUE ELIMINE.
          $cantidad=$v["existencia"] + $b["cantidad_consumo"]; //exsitencia sale de $sql2 y cantidad_consumo salio de $sql3

          $sql4="delete from consumo_almacen where cod_consumo=? and cod_producto=?";

          $sql4=$conectar->prepare($sql4);

          $sql4->bindValue(1,$cod_consumo);
          $sql4->bindValue(2,$cod_producto);

          $sql4->execute();

//LE ACTUALIZO A LA EXISTENCIA DEL PRODUCTO LA CANTIDAD QUE ELIMINE

          $sql5="update producto_almacen set 
          existencia=? 
          where 
          cod_producto=?
          ";

          $sql5=$conectar->prepare($sql5);

          $sql5->bindValue(1,$cantidad);  //$cantidad es la que sacamos aca: $v["existencia"] + $b["cantidad_consumo"];
          $sql5->bindValue(2,$cod_producto);

          $sql5->execute();

         $resultado5=$sql5->fetch(PDO::FETCH_ASSOC); //esto va ultimo

         }//fin de IF.


      }//fin de metodo eliminar_consumo.

}// fin CLASS EXTENDER CONECTAR.
  
?>

