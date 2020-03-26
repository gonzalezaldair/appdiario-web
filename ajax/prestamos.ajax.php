<?php

require_once '../modelos/prestamos.modelo.php';
require_once '../controladores/prestamos.controlador.php';

class MostrarPrestamos{

	public function TablaPrestamos()
	{

		$item = null;
    	$valor = null;

    	$Prestamos = PrestamosControlador::ctrMostrarPrestamos($item, $valor);

    	if (count($Prestamos) == 0) {

    		echo '{"data": []}';

		  	return;
    	}

    	$datosJson = '{
		  "data": [';

		for($i = 0; $i < count($Prestamos); $i++)
		{
			$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdprestamo' prestamoid='".$Prestamos[$i]["pre_Id"]."'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-warning btnabono' prestamoid='".$Prestamos[$i]["pre_Id"]."'><i class='fas fa-dollar-sign'></i></i></button><button type='button' class='btn btn-danger btneliminarprestamo' prestamoid='".$Prestamos[$i]["pre_Id"]."'><i class='fas fa-trash'></i></button></div>";
			$datosJson .='[
			      "'.$Prestamos[$i]["pre_Fecha"].'",
			      "'.$Prestamos[$i]["pre_CLIENTE"].'",
			      "'.$Prestamos[$i]["pre_FormaPago"].'",
			      "'.$Prestamos[$i]["pre_Interes"].'",
			      "'.$Prestamos[$i]["pre_MontoPrestado"].'",
			      "'.$Prestamos[$i]["pre_Cuotas"].'",
			      "'.$Prestamos[$i]["pre_Observaciones"].'",
			      "'.$Prestamos[$i]["pre_USUARIO"].'",
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
		$ver = new MostrarPrestamos();
		$ver -> TablaPrestamos();
		break;
	case 'traer':
		$item = "pre_Id";
		$valor = trim($_POST["prestamoid"]);
		$traer = PrestamosControlador::ctrMostrarPrestamos($item, $valor);
		echo json_encode($traer);
		break;

	default:
		# code...
		break;
}