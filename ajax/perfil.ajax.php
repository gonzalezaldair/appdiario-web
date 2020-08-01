<?php

require_once '../modelos/perfil.modelo.php';
require_once '../controladores/perfil.controlador.php';

class MostrarPerfil{

	public function TablaPerfil()
	{

		$item = null;
    	$valor = null;

    	$Perfil = PerfilControlador::ctrMostrarPerfil($item, $valor);

    	if (count($Perfil) == 0) {

    		echo '{"data": []}';

		  	return;
    	}

    	$datosJson = '{
		  "data": [';

		for($i = 0; $i < count($Perfil); $i++)
		{
			$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdperfil' perfilid='".$Perfil[$i]["per_Id"]."' perfilcodigo='".$Perfil[$i]["per_Codigo"]."'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger btneliminarperfil' perfilid='".$Perfil[$i]["per_Id"]."'><i class='fas fa-trash'></i></button></div>";
			$activo = ($Perfil[$i]["per_Activo"] == 1) ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-danger'>Inactivo</span>" ;
			$datosJson .='[
			      "'.$Perfil[$i]["per_Id"].'",
			      "'.$Perfil[$i]["per_Codigo"].'",
			      "'.$Perfil[$i]["per_Nombre"].'",
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
		$ver = new MostrarPerfil();
		$ver -> TablaPerfil();
		break;
	case 'add':
		$add = PerfilControlador::ctrguardarPerfil();
		echo json_encode($add);
		break;
	case 'traer':
		$item = "per_Id";
		$valor = trim($_POST["perid"]);
		$traer = PerfilControlador::ctrMostrarPerfil($item, $valor);
		echo json_encode($traer);
		break;
	case 'eliminar':
		$traer = PerfilControlador::ctrEliminarPerfil();
		echo json_encode($traer);
		break;
	case 'comboperfil':
		$item = null;
		$valor = null;
		$traer = PerfilControlador::ctrMostrarPerfil($item, $valor);
		echo json_encode($traer);
		break;
	case 'consecutivo':
		$consecutivo = PerfilControlador::ctrConsecutivo();
		$numero = intval(substr($consecutivo[0], 4)+1);
		$prefijo = substr($consecutivo[0], 0,4);
		echo json_encode($prefijo.$numero);
		break;

	default:
		# code...
		break;
}