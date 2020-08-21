<?php session_start(); ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>APPDIARIO | WEB</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="vistas/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="vistas/plugins/toastr/toastr.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">
  <!-- Estilos Personalizados -->
  <link rel="stylesheet" href="vistas/dist/css/masestilos.css?v=<?php echo filemtime("vistas/dist/css/masestilos.css"); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="icon" type="image/png" href="vistas/dist/img/fav-icon.png">
</head>
<body class="hold-transition sidebar-mini">
<?php

  if(isset($_SESSION["validar"]) && $_SESSION["validar"] === true)
  {

    echo '<div class="wrapper">';
    include 'modulos/navegador.php';
    echo '<div class="content-wrapper">';
      if(isset($_GET["action"]))
      {
        if ($_GET["action"] == "inicio" ||
            $_GET["action"] == "clientes" ||
            $_GET["action"] == "cobro" ||
            $_GET["action"] == "abonos" ||
            $_GET["action"] == "forma-pago" ||
            $_GET["action"] == "prestamos" ||
            $_GET["action"] == "rol" ||
            $_GET["action"] == "ruta" ||
            $_GET["action"] == "salir" ||
            $_GET["action"] == "perfil" ||
            $_GET["action"] == "usuarios" ||
            $_GET["action"] == "reportes"

            ) {
          include "modulos/".$_GET["action"].".vista.php";
        }else{
          include 'modulos/error404.php';
        }
      }else
      {
        include 'modulos/salir.vista.php';
      }
    echo '</div>';

          include 'modulos/footer.php';


  echo '</div>';

  }else{
    include 'modulos/ingreso.vista.php';
  }


 ?>
<input type="hidden" value="<?php echo $_SESSION["usuario_Id"]; ?>" id="user_Id">

 <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="vistas/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- SweetAlert2 -->
<script src="vistas/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="vistas/plugins/toastr/toastr.min.js"></script>
<!-- InputMask -->
<script src="vistas/plugins/moment/moment.min.js"></script>
<script src="vistas/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.min.js"></script>
<!-- Jquery Number -->
<script src="vistas/js/jquery.number.js"></script>

<!--=====================================
  SCRIPT JAVASCRIPT PERSONALIZADOS
  ======================================-->


<script src="vistas/js/plantilla.js?v=<?php echo filemtime("vistas/js/plantilla.js"); ?>"></script>
<script src="vistas/js/clientes.js?v=<?php echo filemtime("vistas/js/clientes.js"); ?>"></script>
<script src="vistas/js/rutas.js?v=<?php echo filemtime("vistas/js/rutas.js"); ?>"></script>
<script src="vistas/js/forma-pago.js?v=<?php echo filemtime("vistas/js/forma-pago.js"); ?>"></script>
<script src="vistas/js/cobros.js?v=<?php echo filemtime("vistas/js/cobros.js"); ?>"></script>
<script src="vistas/js/prestamo.js?v=<?php echo filemtime("vistas/js/prestamo.js"); ?>"></script>
<script src="vistas/js/usuario.js?v=<?php echo filemtime("vistas/js/usuario.js"); ?>"></script>
<script src="vistas/js/abonos.js?v=<?php echo filemtime("vistas/js/abonos.js"); ?>"></script>
<script src="vistas/js/perfil.js?v=<?php echo filemtime("vistas/js/perfil.js"); ?>"></script>
<script src="vistas/js/reportes.js?v=<?php echo filemtime("vistas/js/reportes.js"); ?>"></script>

</body>
</html>
