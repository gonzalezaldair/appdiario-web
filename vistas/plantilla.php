

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
  <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<?php

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
            $_GET["action"] == "usuarios"

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


 ?>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="vistas/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="vistas/plugins/datatables/jquery.dataTables.js"></script>
<script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.min.js"></script>


<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
</body>
</html>
