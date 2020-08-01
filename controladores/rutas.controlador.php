<?php



class RutasControlador{



	/*=============================================
	MOSTRAR Rutas
	=============================================*/

	public static function ctrMostrarRutas($item, $valor){

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

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["rut_Nombre"])) {

				$rut_Id = intval($_POST["rut_Id"]);
				$rut_Codigo = trim($_POST["rut_Codigo"]);
				$rut_Nombre = trim($_POST["rut_Nombre"]);
				$rut_Cobro = intval($_POST["rut_Cobro"]);
				$rut_Activo = intval($_POST["rut_Activo"]);

				$datosControlador = array(
					'rut_Id' => $_POST["rut_Id"],
					'rut_Codigo' => $_POST["rut_Codigo"],
					'rut_Nombre' => $_POST["rut_Nombre"],
					'rut_Cobro' => $_POST["rut_Cobro"],
					'rut_Activo' => $_POST["rut_Activo"]
				);

				if ($rut_Id > 0) {
					$respuestaModelo = RutasModelo::mdlactualizarRutas($tabla, $datosControlador);
					return $respuestaModelo;
				}else{
					$respuestaModelo = RutasModelo::mdlguardarRutas($tabla, $datosControlador);
					return $respuestaModelo;
				}
			}

		}
	}

	/*=============================================
				GENERAR CONSECUTIVO
	=============================================*/


	public static function ctrConsecutivo()
	{
		$tabla = "ruta";
		$respuestaModelo = RutasModelo::mdlconsecutivo($tabla,"rut_Codigo");
		return $respuestaModelo;
	}

	/*=============================================
				ELIMINAR RUTA
	=============================================*/


	public static function ctrEliminarRutas($item,$valor)
	{
		$tabla = "ruta";
		$respuestaModelo = RutasModelo::mdlEliminarRutas($tabla,$item,$valor);
		return $respuestaModelo;
	}


}