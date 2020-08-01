<?php

require_once '../modelos/clientes.modelo.php';
require_once '../controladores/clientes.controlador.php';

require_once '../modelos/rutas.modelo.php';
require_once '../controladores/rutas.controlador.php';

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

			$item = "rut_Id";
    		$valor = $clientes[$i]["cli_RUTA"];
    		$Rutas = RutasControlador::ctrMostrarRutas($item, $valor);
    		$dia = "";
    		switch ($clientes[$i]["cli_DiaCobro"]) {
    			case 0:
    				$dia = "Domingo";
    				break;
    			case 1:
    				$dia = "Lunes";
    				break;
    			case 2:
    				$dia = "Martes";
    				break;
    			case 3:
    				$dia = "Miercoles";
    				break;
    			case 4:
    				$dia = "Jueves";
    				break;
    			case 5:
    				$dia = "Viernes";
    				break;
    			case 6:
    				$dia = "Sabado";
    				break;

    			default:
    				$dia = "Domingo";
    				break;
    		}
    		if ($clientes[$i]["cli_Activo"] == 1) {
    			$estado = "<span class='badge badge-success'>Activo</span>";
    		}else{
    			$estado = "<span class='badge badge-danger'>Inactivo</span>";
    		}
			$datosJson .='[
			      "'.$clientes[$i]["cli_Cedula"].'",
			      "'.$clientes[$i]["cli_Nombre"].'",
			      "'.$clientes[$i]["cli_Celular"].'",
			      "'.$clientes[$i]["cli_Direccion"].'",
			      "'.$clientes[$i]["cli_Correo"].'",
			      "'.$Rutas["rut_Nombre"].'",
			      "'.$dia.'",
			      "'.$estado.'",
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
	case 'add':
		$traer = ClientesControlador::ctrGuardarClientes();
		echo json_encode($traer);
		break;
	case 'traer':
		$item = "cli_Id";
		$valor = trim($_POST["clienteid"]);
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
		$item = "cli_Id";
		$valor = trim($_POST["clienteid"]);
		$traer = ClientesControlador::ctrLiveSearch($item, $valor);
		echo json_encode($traer);
		break;

	default:
		# code...
		break;
}