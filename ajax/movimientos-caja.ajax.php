<?php

require_once '../modelos/movimientos-caja.modelo.php';
require_once '../controladores/movimientos-caja.controlador.php';

class MostrarMovimientosCaja
{

    public function TablaMovimientosCaja()
    {

        $item = null;
        $valor = null;

        $Movimientos = MovimientosCajaControlador::ctrMostrarMovimientosCaja($item, $valor);

        if (count($Movimientos) == 0) {

            echo '{"data": []}';

            return;
        }

        $datosJson = '{
		  "data": [';

        for ($i = 0; $i < count($Movimientos); $i++) {
            //$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdabono' aboid='".$Movimientos[$i]["mov_Id"]."' movprestamo='".$Movimientos[$i]["mov_PRESTAMO"]."' ><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger btneliminarabono' aboid='".$Movimientos[$i]["mov_Id"]."' movprestamo='".$Movimientos[$i]["mov_PRESTAMO"]."' ><i class='fas fa-trash'></i></button></div>";
            $monto = number_format($Movimientos[$i]["mov_Monto"], 2, ",", ".");
            $datosJson .= '[
			      "' . $Movimientos[$i]["mov_Fecha"] . '",
			      "' . $Movimientos[$i]["mov_Tipo"] . '",
			      "' . $monto . '",
			      "' . $Movimientos[$i]["mov_Referencia"] . '",
			      ""
			    ],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .=   ']

		}';

        echo $datosJson;
    }
}

$acc = $_POST["acc"] ?? $_GET["acc"] ?? "ver";

if (!isset($_SESSION)) {
    session_start();
}

date_default_timezone_set('America/Bogota');


switch ($acc) {
    case 'ver':
        $ver = new MostrarMovimientosCaja();
        $ver->TablaMovimientosCaja();
        break;
    case 'add':
        $traer = MovimientosCajaControlador::ctrRegistrarMovimientoCaja();
        echo json_encode($traer);
        break;
    case 'traer':
        $item = "mov_Id";
        $valor = trim($_POST["mov_Id"]);
        $traer = MovimientosCajaControlador::ctrMostrarMovimientosCaja($item, $valor);
        echo json_encode($traer);
        break;
    default:
        $ver = new MostrarMovimientosCaja();
        $ver->TablaMovimientosCaja();
        break;
}