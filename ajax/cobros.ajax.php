<?php

require_once '../modelos/cobros.modelo.php';
require_once '../controladores/cobros.controlador.php';

class MostrarCobros{

	public function TablaCobros()
	{

		$item = null;
    	$valor = null;

    	$Cobros = CobrosControlador::ctrMostrarCobros($item, $valor);

    	if (count($Cobros) == 0) {

    		echo '{"data": []}';

		  	return;
    	}

    	$datosJson = '{
		  "data": [';

		for($i = 0; $i < count($Cobros); $i++)
		{
			$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdcobro' cobid='".$Cobros[$i]["cob_Id"]."' cobcodigo='".$Cobros[$i]["cob_Codigo"]."'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger btneliminarcobro' cobid='".$Cobros[$i]["cob_Id"]."'><i class='fas fa-trash'></i></button></div>";
			$datosJson .='[
			      "'.$Cobros[$i]["cob_Id"].'",
			      "'.$Cobros[$i]["cob_Codigo"].'",
			      "'.$Cobros[$i]["cob_Nombre"].'",
			      "'.$Cobros[$i]["cob_Fecha"].'",
			      "'.$Cobros[$i]["cob_Activo"].'",
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
		$ver = new MostrarCobros();
		$ver -> TablaCobros();
		break;
	case 'traer':
		$item = "cob_Id";
		$valor = trim($_POST["cobid"]);
		$traer = CobrosControlador::ctrMostrarCobros($item, $valor);
		echo json_encode($traer);
		break;
	case 'comboCobros':
		$item = null;
		$valor = null;
		$comboCobros = CobrosControlador::ctrMostrarCobros($item, $valor);
		echo json_encode($comboCobros);
		break;
	default:
		# code...
		break;
}