
<?<?php  

//EDITAR CONSUMO--------------------

public function editar_consumo(){


           $conectar=parent::conexion();
           parent::set_names();

            if(empty($_POST["cod_consumo"]) or empty($_POST["cod_producto"]) or empty($_POST["producto_consumo"]) or empty($_POST["cantidad_consumo"])){
             
             header("Location:".Conectar::ruta()."agregar_consumo.php?m=1");
             exit();
          }//fin de IF

          // bindValue = el valor no puede ser actualizado pero acepta variables y valores
   
      /*   --------------VER SI VA ESTO 
      $sql="update consumo_almacen set 

          cod_consumo=?,
          cod_producto=?,
          producto_consumon=?,
          cantidad_consumo=?,
          fecha_consumo=now()
          where id_consumo=?
          ";

          $sql=$conectar->prepare($sql);

          $sql->bindValue(1,$_POST["cod_consumo"]);
          $sql->bindValue(2,$_POST["cod_producto"]);
          $sql->bindValue(3,$_POST["producto_consumo"]);
          $sql->bindValue(4,$_POST["cantidad_consumo"]);
          $sql->bindValue(5,$_POST["id"]);
          $sql->execute();

          //$resultado=$sql->fetch(PDO::FETCH_ASSOC);
          $resultado=$sql->fetchAll();


*/


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

      
        $sql3="update consumo_almacen set 

          cantidad_consumo=?,
          producto_consumo=?,
          where 
          cod_consumo=?
          and
          cod_producto=?
          ";
          $sql3=$conectar->prepare($sql3);

          $sql3->bindValue(1,$_POST["cod_consumo"]); // bindValue = el valor no puede ser actualizado pero acepta variables y valores
          $sql3->bindValue(2,$_POST["cod_producto"]);// conecta una variable a un valor dado
          $sql3->bindValue(3,$_POST["producto_consumo"]);
          $sql3->bindValue(4,$_POST["cantidad_consumo"]);
          
          $sql3->execute();
          $resultado3=$sql3->fetchAll();

   //ACTUALIZO LA EXISTENCIA DE PORDUCTOS  
           
          $sql4="update producto_almacen set 
          existencia=? 
          where 
          cod_producto=?
          ";

          $sql4=$conectar->prepare($sql4);

          $sql4->bindValue(1,$cantidad);
          $sql4->bindValue(2,$_POST["cod_producto"]);
          
          $sql4->execute();


         //$resultado4=$sql4->fetch(PDO::FETCH_ASSOC); //esto va ultimo
          $resultado4=$sql4->fetchAll();

/*
      $sql5="update consumo_almacen set 

          cod_consumo=?,
          cod_producto=?,
          producto_consumon=?,
          cantidad_consumo=?,
          fecha_consumo=now()
          where id_consumo=?
          ";

          $sql5=$conectar->prepare($sql5);

          $sql->bindValue(1,$_POST["cod_consumo"]);
          $sql->bindValue(2,$_POST["cod_producto"]);
          $sql->bindValue(3,$_POST["producto_consumo"]);
          $sql->bindValue(4,$_POST["cantidad_consumo"]);
          $sql->bindValue(5,$_POST["id_consumo"]);
          $sql->execute();

          $resultado5=$sql5->fetch(PDO::FETCH_ASSOC);
          //$resultado=$sql->fetchAll();

*/

          header("Location:".Conectar::ruta()."editar_consumo.php?id_consumo=".$_POST["id"]."&m=2");
          exit();
      }
?>