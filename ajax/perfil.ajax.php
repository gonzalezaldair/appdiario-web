<?php

require_once '../modelos/perfil.modelo.php';
require_once '../controladores/perfil.controlador.php';


require_once '../modelos/modulos.modelo.php';
require_once '../controladores/modulos.controlador.php';

class MostrarPerfil
{

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

		for ($i = 0; $i < count($Perfil); $i++) {
			$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdperfil' perfilid='" . $Perfil[$i]["per_Id"] . "'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-warning btnpermisosperfil' perfilid='" . $Perfil[$i]["per_Id"] . "'><i class='fas fa-user-lock'></i></button><button type='button' class='btn btn-danger btneliminarperfil' perfilid='" . $Perfil[$i]["per_Id"] . "'><i class='fas fa-trash'></i></button></div>";
			$activo = ($Perfil[$i]["per_Activo"] == 1) ? "<span class='badge badge-success'>Activo</span>" : "<span class='badge badge-danger'>Inactivo</span>";
			$datosJson .= '[
			      "' . $Perfil[$i]["per_Id"] . '",
			      "' . $Perfil[$i]["per_Nombre"] . '",
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
		$ver = new MostrarPerfil();
		$ver->TablaPerfil();
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
	case 'traerpermisos':
		$valor = trim($_POST["perid"]);
		$modulos = ModulosControlador::ctrMostrarPermisos($valor);
		echo json_encode($modulos);
		break;
	case 'addnuevospermisos':
		$valor = trim($_POST["perid"]);
		$nuevospermisos = PerfilControlador::ctrGuardarNuevosPermisos();
		$permisos = ModulosControlador::ctrMostrarPermisos($valor);

		$_SESSION["permisos"] = array_column($permisos, 'po_OPERACION');

		echo json_encode($nuevospermisos);
		/*if (isset($_SESSION["permisos"])) {
			unset($_SESSION["permisos"]);
			$_SESSION["permisos"][] = array();
			for ($i = 0; $i < count($permisos); $i++) {
				$_SESSION["permisos"][$i] = $permisos[$i]["po_OPERACION"];
			}
			echo json_encode($nuevospermisos);
		} else {
			$_SESSION["permisos"][] = array();
			for ($i = 0; $i < count($permisos); $i++) {
				$_SESSION["permisos"][$i] = $permisos[$i]["po_OPERACION"];
			}
			echo json_encode($nuevospermisos);
		}*/
		break;

	default:
		# code...
		break;
}
