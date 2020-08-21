<?php



class PerfilControlador{

	/*=============================================
	MOSTRAR Perfil
	=============================================*/

	public static function ctrMostrarPerfil($item, $valor){

		$tabla = "perfiles";

		$respuesta = PerfilModelo::mdlMostrarPerfil($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
				GUARDAR PERFIL
	=============================================*/


	public static function ctrguardarPerfil()
	{
		$tabla = "perfiles";
		if (isset($_POST)) {
			session_start();

			if (in_array(17, $_SESSION["permisos"]) || in_array(19, $_SESSION["permisos"]))
			{
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["per_Nombre"])) {

					$per_Id = intval($_POST["per_Id"]);
					$per_Codigo = strtoupper (trim($_POST["per_Codigo"]));
					$per_Nombre = strtoupper (trim($_POST["per_Nombre"]));
					$per_Activo = intval($_POST["per_Activo"]);

					$datosControlador = array(
						'per_Id' => $per_Id,
						'per_Codigo' => $per_Codigo,
						'per_Nombre' => $per_Nombre,
						'per_Activo' => $per_Activo
					);

					if ($per_Id > 0) {
						return $respuestaModelo = PerfilModelo::mdlActualizarPerfil($tabla, $datosControlador);
					}else{
						return $respuestaModelo = PerfilModelo::mdlguardarPerfil($tabla, $datosControlador);
					}
				}else{

					return $arrayName = array('codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio');
				}
			}else{
				$arrayName = array('codigo' => 'No tienes permisos para realizar esta accion');

				return $arrayName;
			}
		}
	}

	/*=============================================
				GENERAR CONSECUTIVO
	=============================================*/


	public static function ctrConsecutivo()
	{
		$tabla = "perfiles";
		$respuestaModelo = PerfilModelo::mdlconsecutivo($tabla,"per_Codigo");
		return $respuestaModelo;
	}



	public static function ctrEliminarPerfil()
	{
		$tabla = "perfiles";
		session_start();
		if (in_array(20, $_SESSION["permisos"]))
		{
			$per_Id = intval($_POST["perid"]);
			$respuestaModelo = PerfilModelo::mdlEliminarPerfil($tabla,"per_Id", $per_Id);
			return $respuestaModelo;
		}else{
			$arrayName = array('codigo' => 'No tienes permisos para realizar esta accion');

			return $arrayName;
		}
	}

	public static function ctrEliminarPermisosPerfil($perfil)
	{
		$tabla = "perfil_operaciones";
		if (isset($_POST)) {
			$respuestaModelo =PerfilModelo::mdlEliminarPermisosPerfil($tabla, $perfil);
			return $respuestaModelo;
		}
	}

	public static function ctrGuardarNuevosPermisos()
	{

		$tabla = "perfil_operaciones";

		if (isset($_POST)) {
			$respuestaEliminar = self::ctrEliminarPermisosPerfil(intval($_POST["perid"]));
			if ($respuestaEliminar["mensaje"] == "ok") {

				$query = 'INSERT INTO perfil_operaciones(po_PERFIL, po_OPERACION) VALUES ';
				$permisos = (strlen($_POST["permisos"]) > 0) ? explode(",", $_POST["permisos"]) : false ;

				if ($permisos !== false) {
					for ($i=0; $i < count($permisos); $i++) {
						$query .= '('.intval($_POST["perid"]).','.intval($permisos[$i]).'),';
					}
					$query = substr($query, 0, -1);

					$respuestaModelo = PerfilModelo::mdlGuardarNuevosPermisos($query);

					return $respuestaModelo;
				}else{
					return $respuestaEliminar;
				}
			}else{
				return $respuestaEliminar;
			}
		}
	}

}