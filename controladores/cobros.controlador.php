<?php



class CobrosControlador
{



	/*=============================================
	MOSTRAR Cobros
	=============================================*/

	public static function ctrMostrarCobros($item, $valor)
	{

		$tabla = "cobro";

		return CobrosModelo::mdlMostrarCobros($tabla, $item, $valor);
	}

	/*=============================================
				GENERAR CONSECUTIVO
	=============================================*/


	public static function ctrConsecutivo()
	{
		$tabla = "cobro";
		return CobrosModelo::mdlconsecutivo($tabla, "cob_Codigo");
	}

	/*=============================================
				GUARDAR COBRO
	=============================================*/


	public static function ctrGuardarCobros()
	{
		$fecha = date('Y-m-d');
		$tabla = "cobro";
		if (isset($_POST)) {
			if (in_array(9, $_SESSION["permisos"]) || in_array(11, $_SESSION["permisos"])) {
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["cob_Nombre"])) {

					$cob_Id = intval($_POST["cob_Id"]);
					$cob_Codigo = trim($_POST["cob_Codigo"]);
					$cob_Nombre = trim($_POST["cob_Nombre"]);
					$cob_Activo = intval($_POST["cob_Activo"]);
					$cob_Fecha = trim($fecha);

					$datosControlador = [
						'cob_Id' => $_POST["cob_Id"],
						'cob_Codigo' => $cob_Codigo,
						'cob_Nombre' => $cob_Nombre,
						'cob_Activo' => $cob_Activo,
						'cob_Fecha' => $cob_Fecha
					];

					if ($cob_Id > 0) {
						return CobrosModelo::mdlActualizarCobros($tabla, $datosControlador);
					} else {
						return CobrosModelo::mdlguardarCobros($tabla, $datosControlador);
					}
				} else {
					return ['codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio'];
				}
			} else {
				return ['codigo' => 'No tienes permisos para realizar esta accion'];
			}
		}
	}


	/*=============================================
				ELIMINAR COBRO
	=============================================*/


	public static function ctrEliminarCobros()
	{
		$tabla = "cobro";
		if (isset($_POST["cobid"])) {
			if (!in_array(12, $_SESSION["permisos"])) {

				return ['codigo' => 'No tienes permisos para realizar esta accion'];
			}

			return CobrosModelo::mdlEliminarCobros($tabla, "cob_Id", $_POST["cobid"]);
		}
	}
}
