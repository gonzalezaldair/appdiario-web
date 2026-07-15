<?php

require_once '../modelos/movimientos-caja.modelo.php';
require_once '../controladores/movimientos-caja.controlador.php';


$acc = $_POST["acc"] ?? $_GET["acc"] ?? "ver";

if (!isset($_SESSION)) {
    session_start();
}

date_default_timezone_set('America/Bogota');

switch ($acc) {
    /*case 'ver':
        $ver = new MostrarMovimientosCaja();
        $ver->TablaMovimientosCaja();
        break;*/
    case 'add':
        $add = MovimientosCajaControlador::ctrRegistrarMovimientoCaja();
        echo json_encode($add);
        break;
    default:
        # code...
        break;
}
