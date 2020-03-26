<?php

require_once '../modelos/cobros.modelo.php';
require_once '../controladores/cobros.controlador.php';

class MostrarAbonos{

	public function TablaAbonos()
	{

		$item = null;
    	$valor = null;

    	$Abonos = AbonosControlador::ctrMostrarAbonos($item, $valor);

    	if (count($Abonos) == 0) {

    		echo '{"data": []}';

		  	return;
    	}

    	$datosJson = '{
		  "data": [';

		for($i = 0; $i < count($Abonos); $i++)
		{
			$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdcobro' cobid='".$Abonos[$i]["cob_Id"]."' cobcodigo='".$Abonos[$i]["cob_Codigo"]."'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger btneliminarcobro' cobid='".$Abonos[$i]["cob_Id"]."'><i class='fas fa-trash'></i></button></div>";
			$datosJson .='[
			      "'.$Abonos[$i]["cob_Id"].'",
			      "'.$Abonos[$i]["cob_Codigo"].'",
			      "'.$Abonos[$i]["cob_Nombre"].'",
			      "'.$Abonos[$i]["cob_Fecha"].'",
			      "'.$Abonos[$i]["cob_Activo"].'",
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
		$ver = new MostrarAbonos();
		$ver -> TablaAbonos();
		break;
	case 'traer':
		$item = "abo_Id";
		$valor = trim($_POST["aboid"]);
		$traer = AbonosControlador::ctrMostrarAbonos($item, $valor);
		echo json_encode($traer);
		break;
	case 'comboAbonos':
		$item = null;
		$valor = null;
		$comboAbonos = AbonosControlador::ctrMostrarAbonos($item, $valor);
		echo json_encode($comboCobros);
		break;
	default:
		# code...
		break;
}