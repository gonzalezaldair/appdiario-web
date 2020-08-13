<?php

date_default_timezone_set('America/Bogota');

require_once '../modelos/prestamos.modelo.php';
require_once '../controladores/prestamos.controlador.php';

class MostrarPrestamos{

	public function TablaPrestamos()
	{

    	$Prestamos = PrestamosControlador::ctrdatatableprestamos();
    	//var_dump($Prestamos);

    	if (count($Prestamos) == 0) {

    		echo '{"data": []}';

		  	return;
    	}

    	$datosJson = '{
		  "data": [';

		for($i = 0; $i < count($Prestamos); $i++)
		{

			$saldo = $Prestamos[$i]["Saldo"];
			if ($saldo > 0) {
				$botones = "<div class='btn-group' role='group' aria-label='Basic example'> <button type='button' class='btn btn-success btnupdprestamo' prestamoid='".$Prestamos[$i]["pre_Id"]."'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-warning btnabono' saldo='".$saldo."' prestamoid='".$Prestamos[$i]["pre_Id"]."'><i class='fas fa-coins'></i></i></button> <button type='button' class='btn btn-danger btneliminarprestamo' prestamoid='".$Prestamos[$i]["pre_Id"]."'><i class='fas fa-trash'></i></button> </div>";
			}else{
				$botones = "<div class='btn-group' role='group' aria-label='Basic example'> <button type='button' class='btn btn-success btnupdprestamo' prestamoid='".$Prestamos[$i]["pre_Id"]."'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger btneliminarprestamo' prestamoid='".$Prestamos[$i]["pre_Id"]."'><i class='fas fa-trash'></i></button> </div>";
			}


			$interes = number_format($Prestamos[$i]["interes"], 2, ",",".");
			$prestado = number_format($Prestamos[$i]["pre_MontoPrestado"], 2, ",",".");
			$prestadointeres = number_format($Prestamos[$i]["pre_MontoInteres"], 2, ",",".");
			$saldo = number_format($saldo, 2, ",",".");
			$datosJson .='[
			      "'.$Prestamos[$i]["pre_Fecha"].'",
			      "'.$Prestamos[$i]["cli_Nombre"].'",
			      "'.$Prestamos[$i]["frm_Nombre"].'",
			      "'.$interes.'",
			      "'.$prestado.'",
			      "'.$prestadointeres.'",
			      "'.$Prestamos[$i]["pre_Cuotas"].'",
			      "'.$Prestamos[$i]["pre_Observaciones"].'",
			      "'.$Prestamos[$i]["usu_Nombre"].'",
			      "'.$saldo.'",
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
	case 'add':
		$add = PrestamosControlador::ctrguardarPrestamo();
		echo json_encode($add);
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