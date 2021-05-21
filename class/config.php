
<?php

  session_start();

   class Conectar{

   	   protected $dbh; //"Manejador de base de datos"

   	   protected function conexion(){ //conecta a Bdatos

   	   	$conectar= $this->dbh= new PDO("mysql:local=localhost; dbname=base_datos","root","");
   	    return $conectar;
   	   }

   	   public function set_names(){ //para evitar problema con tildes

   	   	 return $this->dbh->query("SET NAMES 'utf8'"); // elejimos el idioma español.
   	   }

   	  
   	  public function ruta(){ //RUTA EN HTDOCS

   	  	return "http://localhost/CDeposito/";
   	  }

   	  //Función para invertir fecha
      public static function invierte_fecha($fecha){
      $dia=substr($fecha,8,2);
      $mes=substr($fecha,5,2);
      $anio=substr($fecha,0,4);
      $correcta=$dia."-".$mes."-".$anio;
      return $correcta;
      }

      //Función para convertir fecha del mes de numero al nombre, ejemplo de 01 a enero
      public static function convertir($string)
       {

       $string = str_replace(
       array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'),
       array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', ' DICIEMBRE'),
       $string
      );        
      return $string;
    }
   
   

   }



?>