<?php

//$modulos = ModulosControlador::ctrMostrarModulos(null, null, "ASC");
$modulos = ModulosControlador::ctrMostrarModulosPersonalizados($_SESSION["usuario_PERFIL"]);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a href="inicio" class="brand-link logo-inicio">
    <!--<img src="vistas/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"style="opacity: .8">-->
    <img src="vistas/dist/img/fav-icon.png" alt="Logo App" class="brand-image img-circle elevation-3"style="opacity: .8">
    <span class="brand-text font-weight-light">COMERC. El Gato</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="vistas/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $_SESSION["usuario_Nombre"]; ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="inicio" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Inicio
              <!--<span class="right badge badge-danger">New</span>-->
            </p>
          </a>
        </li>
        <?php

            for ($i=0; $i < count($modulos); $i++) {
              echo '<li class="nav-item">
                    <a href="'.$modulos[$i]["mod_Url"].'" class="nav-link">
                      <i class="nav-icon '.$modulos[$i]["mod_Icon"].'"></i>
                      <p>
                        '.$modulos[$i]["mod_Nombre"].'
                        <!--<span class="right badge badge-danger">New</span>-->
                      </p>
                    </a>
                  </li>';
            }
         ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>