<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>APPDIARIO | WEB</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="vistas/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="vistas/adminlte/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="vistas/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vistas/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="vistas/adminlte/dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="vistas/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="vistas/adminlte/plugins/toastr/toastr.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="vistas/adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- Estilos Personalizados -->
    <link rel="stylesheet"
        href="vistas/adminlte/dist/css/masestilos.css?v=<?= filemtime("vistas/adminlte/dist/css/masestilos.css"); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="icon" type="image/png" href="vistas/img/fav_icon.png">
</head>

<body class="hold-transition sidebar-mini">
    <?php if (isset($_SESSION["validar"]) && $_SESSION["validar"] === true) : ?>
        <div class="wrapper">
            <?php include 'modulos/navegador.php'; ?>
            <div class="content-wrapper">
                <?php if (isset($_GET["action"])) : ?>
                    <?php if (
                        $_GET["action"] == "inicio" ||
                        $_GET["action"] == "clientes" ||
                        $_GET["action"] == "abonos" ||
                        $_GET["action"] == "forma-pago" ||
                        $_GET["action"] == "prestamos" ||
                        $_GET["action"] == "gastos" ||
                        $_GET["action"] == "rol" ||
                        $_GET["action"] == "salir" ||
                        $_GET["action"] == "perfil" ||
                        $_GET["action"] == "usuarios" ||
                        $_GET["action"] == "reportes" ||
                        $_GET["action"] == "movimientos-caja"

                    ) : include "modulos/" . $_GET["action"] . ".vista.php"; ?>
                    <?php else :  include 'modulos/error404.php';  ?>
                    <?php endif; ?>
                <?php else : include 'modulos/salir.vista.php'; ?>
                <?php endif; ?>
            </div>
            <?php include 'modulos/footer.php'; ?>
        </div>
    <?php else : include 'modulos/ingreso.vista.php'; ?>
    <?php endif; ?>
    <input type="hidden" value="<?= $_SESSION["usuario_Id"]; ?>" id="user_Id">

    <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="vistas/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="vistas/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="vistas/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="vistas/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vistas/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vistas/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="vistas/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="vistas/adminlte/plugins/toastr/toastr.min.js"></script>
    <!-- InputMask -->
    <script src="vistas/adminlte/plugins/moment/moment.min.js"></script>
    <script src="vistas/adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <!-- date-range-picker -->
    <script src="vistas/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- AdminLTE App -->
    <script src="vistas/adminlte/dist/js/adminlte.min.js"></script>
    <!-- Jquery Number -->
    <script src="vistas/js/jquery.number.js"></script>

    <!--=====================================
  SCRIPT JAVASCRIPT PERSONALIZADOS
  ======================================-->


    <script src="vistas/js/plantilla.js?v=<?= filemtime("vistas/js/plantilla.js"); ?>"></script>
    <script src="vistas/js/clientes.js?v=<?= filemtime("vistas/js/clientes.js"); ?>"></script>
    <script src="vistas/js/forma-pago.js?v=<?= filemtime("vistas/js/forma-pago.js"); ?>"></script>
    <script src="vistas/js/prestamo.js?v=<?= filemtime("vistas/js/prestamo.js"); ?>"></script>
    <script src="vistas/js/usuario.js?v=<?= filemtime("vistas/js/usuario.js"); ?>"></script>
    <script src="vistas/js/abonos.js?v=<?= filemtime("vistas/js/abonos.js"); ?>"></script>
    <script src="vistas/js/perfil.js?v=<?= filemtime("vistas/js/perfil.js"); ?>"></script>
    <script src="vistas/js/reportes.js?v=<?= filemtime("vistas/js/reportes.js"); ?>"></script>
    <script src="vistas/js/gastos.js?v=<?= filemtime("vistas/js/gastos.js"); ?>"></script>
    <script src="vistas/js/movimientos-caja.js?v=<?= filemtime("vistas/js/movimientos-caja.js"); ?>"></script>

</body>

</html>