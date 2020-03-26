<?php

require_once '../modelos/clientes.modelo.php';
require_once '../controladores/clientes.controlador.php';

class MostrarClientes{

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

		for($i = 0; $i < count($clientes); $i++)
		{
			$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdcliente' clienteid='".$clientes[$i]["cli_Id"]."' clientecedula='".$clientes[$i]["cli_Cedula"]."'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-warning btnnuevoprestamo' clienteid='".$clientes[$i]["cli_Id"]."' clientecedula='".$clientes[$i]["cli_Cedula"]."'><i class='fas fa-dollar-sign'></i></i></button><button type='button' class='btn btn-danger btneliminarcliente' clienteid='".$clientes[$i]["cli_Id"]."'><i class='fas fa-trash'></i></button></div>";
			$datosJson .='[
			      "'.$clientes[$i]["cli_Cedula"].'",
			      "'.$clientes[$i]["cli_Nombre"].'",
			      "'.$clientes[$i]["cli_Direccion"].'",
			      "'.$clientes[$i]["cli_Correo"].'",
			      "'.$clientes[$i]["cli_RUTA"].'",
			      "'.$clientes[$i]["cli_DiaCobro"].'",
			      "'.$clientes[$i]["cli_Activo"].'",
			      "'.$botones.'"
			    ],';
		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .=   ']

		}';

		echo $datosJson;

	}
}


if (isset($_POST["acc"])) {
	$acc = trim($_POST["acc"]);
}else if (isset($_GET["acc"])) {
	$acc = trim($_GET["acc"]);
}else{
	$acc = "ver";
}



switch ($acc) {
	case 'ver':
		$ver = new MostrarClientes();
		$ver -> TablaClientes();
		break;
	case 'traer':
		$item = "cli_Id";
		$valor = trim($_POST["clienteid"]);
		$traer = ClientesControlador::ctrMostrarClientes($item, $valor);
		echo json_encode($traer);
		break;

	default:
		# code...
		break;
}