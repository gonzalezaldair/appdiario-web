<?php

require_once '../modelos/cajas.modelo.php';
require_once '../controladores/cajas.controlador.php';


class MostrarCuadreCaja
{

    public function TablaCuadreCaja()
    {

        $item = null;
        $valor = null;

        $cuadresCaja = CajasControlador::ctrMostrarCajas($item, $valor);

        if (count($cuadresCaja) == 0) {

            echo '{"data": []}';

            return;
        }

        $datosJson = '{
		  "data": [';

        for ($i = 0; $i < count($cuadresCaja); $i++) {


            $botones = "";

            if ($cuadresCaja[$i]["cuc_Estado"] == 0) {
                $botones = "<div class='btn-group btn-sm' role='group' aria-label='Basic example'><button type='button' class='btn btn-sm btn-danger btn-cerrar-caja' cuc_Id='" . $cuadresCaja[$i]["cuc_Id"] . "' cuc_MontoInicial='" . $cuadresCaja[$i]["cuc_MontoInicial"] . "'><i class='fas fa-window-close'></i></button></div>";
            }



            $fehcaFinal = ($cuadresCaja[$i]["cuc_FechaFinal"] == null) ? "" : date("Y-m-d", strtotime($cuadresCaja[$i]["cuc_FechaFinal"]));

            $activo = ($cuadresCaja[$i]["cuc_Estado"] == 0) ? "<span class='badge badge-success'>Abierta</span>" : "<span class='badge badge-danger'>Cerrada</span>";
            $datosJson .= '[
				  "' . $cuadresCaja[$i]["cuc_Id"] . '",
			      "' . $cuadresCaja[$i]["rut_Nombre"] . '",
			      "' . $cuadresCaja[$i]["usu_Nombre"] . '",
			      "' . date("Y-m-d", strtotime($cuadresCaja[$i]["cuc_FechaInicial"])) . '",
			      "' .  $fehcaFinal . '",
			      "' . number_format($cuadresCaja[$i]["cuc_MontoInicial"], 2, ",", ".") . '",
			      "' . number_format($cuadresCaja[$i]["cuc_MontoFinal"], 2, ",", ".") . '",
			      "' . $activo . '",
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
        $ver = new MostrarCuadreCaja();
        $ver->TablaCuadreCaja();
        break;
    case 'add':
        $add = CajasControlador::ctrIniciarCaja();
        echo json_encode($add);
        break;
    case 'cerrar-caja':
        $add = CajasControlador::ctrCerrarCaja();
        echo json_encode($add);
        break;
    default:
        # code...
        break;
}
