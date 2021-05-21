<?php

require_once("class/config.php"); 

require_once("class/proveedoresModulo.php");
require_once("class/configuracionModulo.php");

$proveedor= new Proveedores();
$datos=$proveedor->get_proveedores();

$config= new configuracion();
$datos_empresa=$config->get_configuracion();
//$datos_empresa=$informacion_empresa->get_configuracion();

ob_start();   
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <header class="clearfix">
      
      <div id="logo">
        <img class="logoEmpresa" src="img/logoV3.png">
      </div>

      <h1>Listado Proveedores</h1>

      <div id="empresa">
        <h2 class="name"><?php echo $datos_empresa[0]["nombre_empresa"]; ?></h2>
        <div><span>CUIT </span> <?php echo $datos_empresa[0]["cuit_empresa"];?></div>
        <div><span>Direccion </span> <?php echo $datos_empresa[0]["direccion_empresa"];?></div>
        <div><span>Telefono </span> <?php echo $datos_empresa[0]["telefono_empresa"];?></div>
        <div><span> .</span></div>
      </div>

     
    </header>
    <main>
      <table>
        <thead>
          <tr>
          <th>ID</th>
          <th>NOMBRES</th>
          <th>CUIT</th>         
          <th>CIUDAD</th>
          <th>DIRECCION</th>
          <th>EMAIL</th>
          <th>FECHA </th>
          </tr>
        </thead>
        <tbody>
   <tbody>

      <?php
      for($i=0;$i<sizeof($datos);$i++) {
      ?>
        <tr>
          <td style="text-align: center"><div align="center"><span><?php echo $datos[$i]["cod_proveedor"]; ?></span></div></td>
          <td style="text-align: center"><div align="center"><span><?php echo $datos[$i]["nombre_proveedor"]; ?></span></div></td>
          <td style="text-align: center"><div align="center"><span><?php echo $datos[$i]["cuit_proveedor"]; ?></span></div></td>
          <td style="text-align: center"><div align="center"><span><?php echo $datos[$i]["direc_proveedor"]; ?></span></div></td>
          <td style="text-align: center"><div align="center"><span><?php echo $datos[$i]["email_proveedor"]; ?></span></div></td>
          <td style="text-align: center"><div align="center"><span><?php echo $datos[$i]["tel_proveedor"]; ?></span></div></td>
          <td style="text-align: center"><div align="center"><span><?php echo Conectar::invierte_fecha($datos[$i]["fecha_ingreso"]) ?></span></div></td>
        </tr>
      <?php } ?>

        </tbody>

        </tbody>
      </table>
      <div id="notices">
        <div>NOTICIA:</div>
        <div class="noticia">Este reporte no tendra efecto hasta que sea revisado y firmado por un empleado de la empresa.</div>
      </div>
    </main>
    <footer>
       <div align="center">Realizado el dia <?php echo date("d")?> de <?php echo Conectar::convertir(date('m'))?> del <?php echo date("Y")?></div>
    </footer>
  </body>
</html>

<?php
$plantilla = ob_get_contents();
ob_end_clean(); 

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$css = file_get_contents('css/mpdf/estiloMpdf.css ');

$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($plantilla,2);  //, \mpdf\HTMLParserMode::HTML_BODY

$mpdf->SetFooter('Pagina {PAGENO}');
$mpdf->Output('InformeProveedores.pdf','I'); //muestra a usuario

//$mpdf->Output('/ruta/para/guardar/tu/InformeUsuarios.pdf','F'); 
//$mpdf->Output('my_filename.pdf','D'); // direcamente descarga el PDf 

?>