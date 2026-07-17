<?php


require_once '../modelos/gastos.modelo.php';
require_once '../modelos/movimientos-caja.modelo.php';
require_once '../controladores/gastos.controlador.php';



class MostrarGastos
{

    public function TablaGastos()
    {

        $item = null;
        $valor = null;

        $Gastos = GastosControlador::ctrMostrarGastos($item, $valor);

        if (count($Gastos) == 0) {

            echo '{"data": []}';

            return;
        }

        $datosJson = '{
		  "data": [';

        for ($i = 0; $i < count($Gastos); $i++) {
            $botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdgasto' aboid='" . $Gastos[$i]["gas_Id"] . "' gas_Fecha='" . $Gastos[$i]["gas_Fecha"] . "' ><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger btneliminargasto' aboid='" . $Gastos[$i]["gas_Id"] . "' gas_Fecha='" . $Gastos[$i]["gas_Fecha"] . "' ><i class='fas fa-trash'></i></button></div>";
            $monto = number_format($Gastos[$i]["gas_Monto"], 0, ",", ".");
            $datosJson .= '[
			      "' . $monto . '",
			      "' . $Gastos[$i]["gas_Fecha"] . '",
			      "' . $Gastos[$i]["gas_Tipo"] . '",
			      "' . $Gastos[$i]["gas_Cancelado"] . '",
			      "' . $botones . '"
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
        $ver = new MostrarGastos();
        $ver->TablaGastos();
        break;
    case 'traer':
        $item = "gas_Id";
        $valor = trim($_POST["gas_Id"]);
        $traer = GastosControlador::ctrMostrarGastos($item, $valor);
        echo json_encode($traer);
        break;
    case 'add':
        $traer = GastosControlador::ctrGuardarGasto();
        echo json_encode($traer);
        break;
    case 'eliminarGastos':
        $traer = GastosControlador::ctrEliminarGasto();
        echo json_encode($traer);
        break;
    default:
        # code...
        break;
}
