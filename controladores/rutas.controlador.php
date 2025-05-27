<?php



class RutasControlador
{



	/*=============================================
	MOSTRAR Rutas
	=============================================*/

	public static function ctrMostrarRutas($item, $valor)
	{

		$tabla = "ruta";

		$respuesta = RutasModelo::mdlMostrarRutas($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
					GUARDAR RUTAS
	=============================================*/

	public static function ctrguardarRutas()
	{
		$tabla = "ruta";
		if (isset($_POST)) {

			if (in_array(21, $_SESSION["permisos"]) || in_array(23, $_SESSION["permisos"])) {
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["rut_Nombre"])) {

					$rut_Id = intval($_POST["rut_Id"]);
					$rut_Codigo = strtoupper(trim($_POST["rut_Codigo"]));
					$rut_Nombre = strtoupper(trim($_POST["rut_Nombre"]));
					$rut_Cobro = intval($_POST["rut_Cobro"]);
					$rut_Activo = intval($_POST["rut_Activo"]);

					$datosControlador = [
						'rut_Id' => $_POST["rut_Id"],
						'rut_Codigo' => $rut_Codigo,
						'rut_Nombre' => $rut_Nombre,
						'rut_Cobro' => $rut_Cobro,
						'rut_Activo' => $rut_Activo
					];

					if ($rut_Id > 0) {
						return RutasModelo::mdlactualizarRutas($tabla, $datosControlador);
					} else {
						return  RutasModelo::mdlguardarRutas($tabla, $datosControlador);
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
				GENERAR CONSECUTIVO
	=============================================*/


	public static function ctrConsecutivo()
	{
		$tabla = "ruta";
		return RutasModelo::mdlconsecutivo($tabla, "rut_Codigo");
	}

	/*=============================================
				ELIMINAR RUTA
	=============================================*/


	public static function ctrEliminarRutas($item, $valor)
	{
		$tabla = "ruta";
		if (!in_array(24, $_SESSION["permisos"])) {

			return ['codigo' => 'No tienes permisos para realizar esta accion'];
		}

		return RutasModelo::mdlEliminarRutas($tabla, $item, $valor);
	}
}
