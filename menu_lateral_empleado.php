
<!-- MENU LATERAL PARA USUARIOS EMPLEADO -->
 
  <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center"> 
          <div class="title">
            <h1 class="h5">MENU EMPLEADO</h1>
          </div>
        </div>
<!-- Menu lateral-->
    <span class="heading">Inicio</span>
        <ul class="list-unstyled">
    <li <?php if($mi_pagina == 'Inicio'){ echo 'class="active"';}?>>
        <a href="<?php echo Conectar::ruta();?>index.php"> <i class="icon-home"></i>Inicio </a></li>
    <li <?php if($mi_pagina == 'Inventario'){ echo 'class="active"';}?>>
        <a href="almacen.php"> <i class="icon-layers"></i>Inventario </a></li> 
    <li <?php if($mi_pagina == 'Compras'){ echo 'class="active"';}?>>
        <a href="compras.php"> <i class="icon-grid"></i>Compras </a></li> 
    <li <?php if($mi_pagina == 'Consumo'){ echo 'class="active"';}?>>
        <a href="consumo.php"> <i class="icon-dashboard"></i>Consumo </a></li> 
    <li><a href="#menuDesplegable" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Provedores </a>
      <ul id="menuDesplegable" class="collapse list-unstyled ">
        <li <?php if($mi_pagina == 'Proveedores'){ echo 'class="active"';}?>>
            <a href="proveedores.php"> <i class="icon-user-1"></i>Lista Proveedores </a></li>   
        <li <?php if($mi_pagina == 'Pedidos'){ echo 'class="active"';}?>>
            <a href="Pedidos.php"> <i class="icon-settings"></i>Pedidos</a></li>       
      </ul>  
    </li>

  </nav><!-- Fin menu lateral-->
     