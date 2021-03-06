<?php

require_once '../modelos/rutas.modelo.php';
require_once '../controladores/rutas.controlador.php';
require_once '../modelos/cobros.modelo.php';
require_once '../controladores/cobros.controlador.php';

class MostrarRutas{

	public function TablaRutas()
	{

		$item = null;
    	$valor = null;

    	$Rutas = RutasControlador::ctrMostrarRutas($item, $valor);

    	if (count($Rutas) == 0) {

    		echo '{"data": []}';

		  	return;
    	}

    	$datosJson = '{
		  "data": [';

		for($i = 0; $i < count($Rutas); $i++)
		{
			$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdruta' rutid='".$Rutas[$i]["rut_Id"]."' rutcodigo='".$Rutas[$i]["rut_Codigo"]."'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger btneliminarruta' rutid='".$Rutas[$i]["rut_Id"]."'><i class='fas fa-trash'></i></button></div>";
			$cobro = CobrosControlador::ctrMostrarCobros("cob_Id", $Rutas[$i]["rut_COBRO"]);
			$activo = ($Rutas[$i]["rut_Activo"] == 1) ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-danger'>Inactivo</span>" ;
			$datosJson .='[
			      "'.$Rutas[$i]["rut_Id"].'",
			      "'.$Rutas[$i]["rut_Codigo"].'",
			      "'.$Rutas[$i]["rut_Nombre"].'",
			      "'.$cobro["cob_Nombre"].'",
			      "'.$activo.'",
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
		$ver = new MostrarRutas();
		$ver -> TablaRutas();
		break;
	case 'add':
		$traer = RutasControlador::ctrguardarRutas();
		echo json_encode($traer);
		break;
	case 'traer':
		$item = "rut_Id";
		$valor = trim($_POST["rutid"]);
		$traer = RutasControlador::ctrMostrarRutas($item, $valor);
		echo json_encode($traer);
		break;
	case 'eliminarruta':
		$item = "rut_Id";
		$valor = trim($_POST["rutid"]);
		$traer = RutasControlador::ctrEliminarRutas($item, $valor);
		echo json_encode($traer);
		break;
	case 'comborutas':
		$item = null;
		$valor = null;
		$comborutas = RutasControlador::ctrMostrarRutas($item, $valor);
		echo json_encode($comborutas);
		break;
	case 'consecutivo':
		$consecutivo = RutasControlador::ctrConsecutivo();
		$numero = intval(substr($consecutivo[0], 4)+1);
		$prefijo = substr($consecutivo[0], 0,4);
		echo json_encode($prefijo.$numero);
		break;
	default:
		# code...
		break;
}