<?php

require_once '../modelos/usuario.modelo.php';
require_once '../controladores/usuario.controlador.php';

require_once '../modelos/rutas.modelo.php';
require_once '../controladores/rutas.controlador.php';

require_once '../modelos/perfil.modelo.php';
require_once '../controladores/perfil.controlador.php';

class MostrarUsuarios{

	public function TablaUsuarios()
	{

		$item = null;
    	$valor = null;

    	$Usuarios = UsuariosControlador::ctrMostrarUsuarios($item, $valor);

    	if (count($Usuarios) == 0) {

    		echo '{"data": []}';

		  	return;
    	}

    	$datosJson = '{
		  "data": [';

		for($i = 0; $i < count($Usuarios); $i++)
		{
			//$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdusuario' usuarioid='".$Usuarios[$i]["usu_Id"]."' usuariocedula='".$Usuarios[$i]["usu_Cedula"]."'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-warning btnpermisosusuario' usuarioid='".$Usuarios[$i]["usu_Id"]."'><i class='fas fa-user-lock'></i></button><button type='button' class='btn btn-danger btneliminarusuario' usuarioid='".$Usuarios[$i]["usu_Id"]."'><i class='fas fa-trash'></i></button></div>";

			$botones = "<div class='btn-group' role='group' aria-label='Basic example'><button type='button' class='btn btn-success btnupdusuario' usuarioid='".$Usuarios[$i]["usu_Id"]."' usuariocedula='".$Usuarios[$i]["usu_Cedula"]."'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-danger btneliminarusuario' usuarioid='".$Usuarios[$i]["usu_Id"]."'><i class='fas fa-trash'></i></button></div>";

			$item = "rut_Id";
    		$valor = $Usuarios[$i]["usu_RUTA"];
    		$Rutas = RutasControlador::ctrMostrarRutas($item, $valor);
    		$item1 = "per_Id";
    		$valor1 = $Usuarios[$i]["usu_Perfil"];
    		$perfil = PerfilControlador::ctrMostrarPerfil($item1, $valor1);
    		if ($Usuarios[$i]["usu_Activo"] == 1) {
    			$estado = "<span class='badge badge-success'>Activo</span>";
    		}else{
    			$estado = "<span class='badge badge-danger'>Inactivo</span>";
    		}
			$datosJson .='[
			      "'.$Usuarios[$i]["usu_Login"].'",
			      "'.$Usuarios[$i]["usu_Nombre"].'",
			      "'.$Usuarios[$i]["usu_Celular"].'",
			      "'.$Usuarios[$i]["usu_Direccion"].'",
			      "'.$Rutas["rut_Nombre"].'",
			      "'.$perfil["per_Nombre"].'",
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
		$ver = new MostrarUsuarios();
		$ver -> TablaUsuarios();
		break;
	case 'add':
		$add = UsuariosControlador::ctrGuardarUsuario();
		echo json_encode($add);
		break;
	case 'traer':
		$item = trim($_POST["item"]);
		$valor = trim($_POST["valor"]);
		$traer = UsuariosControlador::ctrMostrarUsuarios($item, $valor);
		echo json_encode($traer);
		break;
	case 'permisos':
		$item = "rolus_USUARIO";
		$valor = trim($_POST["usuarioid"]);
		$permisos = UsuariosControlador::ctrPermisosUsuario($item, $valor);
		echo json_encode($permisos);
		break;
	case 'allpermisos':
		$permisos = UsuariosControlador::ctrModulosPermisos();
		echo json_encode($permisos);
		break;
	case 'eliminar':
		$traer = UsuariosControlador::ctrEliminarUsuario();
		echo json_encode($traer);
		break;

	default:
		# code...
		break;
}