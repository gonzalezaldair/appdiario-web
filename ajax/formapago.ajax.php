<?php

require_once '../modelos/formapago.modelo.php';
require_once '../controladores/formapago.controlador.php';

class MostrarFormaPago
{

	public function TablaFormaPago()
	{

		$item = null;
		$valor = null;

		$FormaPago = FormaPagoControlador::ctrMostrarFormaPago($item, $valor);

		if (count($FormaPago) == 0) {

			echo '{"data": []}';

			return;
		}

		$datosJson = '{
		  "data": [';

		for ($i = 0; $i < count($FormaPago); $i++) {
			$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdformapago' frmid='" . $FormaPago[$i]["frm_Id"] . "' frmcodigo='" . $FormaPago[$i]["frm_Codigo"] . "'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger btneliminarformapago' frmid='" . $FormaPago[$i]["frm_Id"] . "'><i class='fas fa-trash'></i></button></div>";
			$activo = ($FormaPago[$i]["frm_Activo"] == 1) ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-danger'>Inactivo</span>";
			$datosJson .= '[
				  "' . $FormaPago[$i]["frm_Id"] . '",
			      "' . $FormaPago[$i]["frm_Codigo"] . '",
			      "' . $FormaPago[$i]["frm_Nombre"] . '",
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
		$ver = new MostrarFormaPago();
		$ver->TablaFormaPago();
		break;
	case 'add':
		$add = FormaPagoControlador::ctrguardarFormaPago();
		echo json_encode($add);
		break;
	case 'traer':
		$item = "frm_Id";
		$valor = trim($_POST["frmid"]);
		$traer = FormaPagoControlador::ctrMostrarFormaPago($item, $valor);
		echo json_encode($traer);
		break;
	case 'eliminarfrmpago':
		$item = "frm_Id";
		$valor = trim($_POST["frm_Id"]);
		$traer = FormaPagoControlador::ctrEliminarFormaPago($item, $valor);
		echo json_encode($traer);
		break;
	case 'comboFormaPago':
		$item = null;
		$valor = null;
		$comboFormaPago = FormaPagoControlador::ctrMostrarFormaPago($item, $valor);
		echo json_encode($comboFormaPago);
		break;
	case 'consecutivo':
		$consecutivo = FormaPagoControlador::ctrConsecutivo();
		//echo json_encode($consecutivo);
		$consecutivo =  $consecutivo[0] + 1;
		$prefijo = ($consecutivo >= 10) ? $consecutivo : "0" . $consecutivo;
		echo json_encode($prefijo);
		break;
	default:
		# code...
		break;
}
