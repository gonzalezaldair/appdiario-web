<?php

require_once '../modelos/clientes.modelo.php';
require_once '../controladores/clientes.controlador.php';

require_once '../modelos/rutas.modelo.php';
require_once '../controladores/rutas.controlador.php';

class MostrarClientes
{

	public function TablaClientes()
	{

		$item = null;
		$valor = null;

		$clientes = ClientesControlador::ctrMostrarClientes($item, $valor);

		if (count($clientes) == 0) {

			echo '{"data": []}';

			return;
		}

		$datosJson = '{
		  "data": [';

		for ($i = 0; $i < count($clientes); $i++) {

			if ($clientes[$i]["cli_Activo"] == 0) {
				$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdcliente' clienteid='" . $clientes[$i]["cli_Id"] . "' clientecedula='" . $clientes[$i]["cli_Cedula"] . "'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-warning btnnuevoprestamo' clienteid='" . $clientes[$i]["cli_Id"] . "' clientecedula='" . $clientes[$i]["cli_Cedula"] . "'><i class='fas fa-dollar-sign'></i></i></button><button type='button' class='btn btn-danger btneliminarcliente' clienteid='" . $clientes[$i]["cli_Id"] . "'><i class='fas fa-trash'></i></button></div>";
			} else {
				$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdcliente' clienteid='" . $clientes[$i]["cli_Id"] . "' clientecedula='" . $clientes[$i]["cli_Cedula"] . "'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger btneliminarcliente' clienteid='" . $clientes[$i]["cli_Id"] . "'><i class='fas fa-trash'></i></button></div>";
			}



			$item = "rut_Id";
			$valor = $clientes[$i]["cli_RUTA"];
			$Rutas = RutasControlador::ctrMostrarRutas($item, $valor);
			$dia = match ($clientes[$i]["cli_DiaCobro"]) {
				0 => "Domingo",
				1 => "Lunes",
				2 => "Martes",
				3 => "Miércoles",
				4 => "Jueves",
				5 => "Viernes",
				6 => "Sábado",
				default => "Domingo",
			};

			$estado = ($clientes[$i]["cli_Activo"] == 1) ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-danger'>Inactivo</span>";

			$datosJson .= '[
			      "' . $clientes[$i]["cli_Cedula"] . '",
			      "' . $clientes[$i]["cli_Nombre"] . '",
			      "' . $clientes[$i]["cli_Celular"] . '",
			      "' . $clientes[$i]["cli_Direccion"] . '",
			      "' . $clientes[$i]["cli_Correo"] . '",
			      "' . $Rutas["rut_Nombre"] . '",
			      "' . $dia . '",
			      "' . $estado . '",
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
		$ver = new MostrarClientes();
		$ver->TablaClientes();
		break;
	case 'add':
		$traer = ClientesControlador::ctrGuardarClientes();
		echo json_encode($traer);
		break;
	case 'traer':
		$item = trim($_POST["item"]);
		$valor = trim($_POST["valor"]);
		$traer = ClientesControlador::ctrMostrarClientes($item, $valor);
		echo json_encode($traer);
		break;
	case 'existe':
		$item = trim($_POST["item"]);
		$valor = trim($_POST["valor"]);
		$traer = ClientesControlador::ctrMostrarClientes($item, $valor);
		echo json_encode($traer);
		break;
	case 'livesearch':
		$item = "cli_Cedula";
		$valor = trim($_POST["clienteid"]);
		$traer = ClientesControlador::ctrLiveSearch($item, $valor);
		echo json_encode($traer);
		break;

	default:
		# code...
		break;
}
