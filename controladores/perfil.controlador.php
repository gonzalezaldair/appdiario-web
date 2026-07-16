<?php



class PerfilControlador
{

	/*=============================================
	MOSTRAR Perfil
	=============================================*/

	public static function ctrMostrarPerfil($item, $valor)
	{

		$tabla = "perfiles";
		return PerfilModelo::mdlMostrarPerfil($tabla, $item, $valor);
	}

	/*=============================================
				GUARDAR PERFIL
	=============================================*/


	public static function ctrguardarPerfil()
	{
		$tabla = "perfiles";
		if (isset($_POST)) {


			if (!(in_array(17, $_SESSION["permisos"]) || in_array(19, $_SESSION["permisos"])))  return ['codigo' => 'No tienes permisos para realizar esta accion'];

			if (!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["per_Nombre"])) return ['codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio'];


			$per_Id = intval($_POST["per_Id"]);
			$per_Nombre = strtoupper(trim($_POST["per_Nombre"]));
			$per_Activo = intval($_POST["per_Activo"]);

			$datosControlador = [
				'per_Id' => $per_Id,
				'per_Nombre' => $per_Nombre,
				'per_Activo' => $per_Activo
			];

			if ($per_Id > 0) {
				return PerfilModelo::mdlActualizarPerfil($tabla, $datosControlador);
			}
			return PerfilModelo::mdlguardarPerfil($tabla, $datosControlador);
		}
	}



	public static function ctrEliminarPerfil()
	{
		$tabla = "perfiles";
		if (!in_array(20, $_SESSION["permisos"])) {

			return ['codigo' => 'No tienes permisos para realizar esta accion'];
		}

		return PerfilModelo::mdlEliminarPerfil($tabla, "per_Id", intval($_POST["perid"]));
	}

	public static function ctrEliminarPermisosPerfil($perfil)
	{
		$tabla = "perfil_operaciones";
		if (isset($_POST)) {
			return PerfilModelo::mdlEliminarPermisosPerfil($tabla, $perfil);
		}
	}

	public static function ctrGuardarNuevosPermisos()
	{

		$tabla = "perfil_operaciones";

		if (isset($_POST)) {
			$respuestaEliminar = self::ctrEliminarPermisosPerfil(intval($_POST["perid"]));
			if ($respuestaEliminar["mensaje"] == "ok") {

				$query = 'INSERT INTO perfil_operaciones(po_PERFIL, po_OPERACION) VALUES ';
				$permisos = (strlen($_POST["permisos"]) > 0) ? explode(",", $_POST["permisos"]) : false;

				if ($permisos !== false) {
					for ($i = 0; $i < count($permisos); $i++) {
						$query .= '(' . intval($_POST["perid"]) . ',' . intval($permisos[$i]) . '),';
					}
					$query = substr($query, 0, -1);

					$respuestaModelo = PerfilModelo::mdlGuardarNuevosPermisos($query);

					return $respuestaModelo;
				} else {
					return $respuestaEliminar;
				}
			} else {
				return $respuestaEliminar;
			}
		}
	}
}
