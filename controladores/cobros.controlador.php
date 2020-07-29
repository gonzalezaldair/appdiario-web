<?php



class CobrosControlador{



	/*=============================================
	MOSTRAR Cobros
	=============================================*/

	public static function ctrMostrarCobros($item, $valor){

		$tabla = "cobro";

		$respuesta = CobrosModelo::mdlMostrarCobros($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
				GENERAR CONSECUTIVO
	=============================================*/


	public static function ctrConsecutivo()
	{
		$tabla = "cobro";
		$respuestaModelo = CobrosModelo::mdlconsecutivo($tabla,"cob_Codigo");
		return $respuestaModelo;
	}

	/*=============================================
				GUARDAR COBRO
	=============================================*/


	public static function ctrGuardarCobros()
	{
		$fecha = date('Y-m-d');
		$tabla = "cobro";
		if (isset($_POST["cob_Codigo"])) {
			$datosControlador = array(
				'cob_Id' => $_POST["cob_Id"],
				'cob_Codigo' => $_POST["cob_Codigo"],
				'cob_Nombre' => $_POST["cob_Nombre"],
				'cob_Activo' => $_POST["cob_Activo"],
				'cob_Fecha' => $fecha
			);
			if (isset($_POST["cob_Id"]) && $_POST["cob_Id"] > 0) {
				$respuestaModelo = CobrosModelo::mdlActualizarCobros($tabla,$datosControlador);
				return $respuestaModelo;
			}else{
				$respuestaModelo = CobrosModelo::mdlguardarCobros($tabla,$datosControlador);
				return $respuestaModelo;
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
			$respuestaModelo = CobrosModelo::mdlEliminarCobros($tabla,"cob_Id", $_POST["cobid"]);
			return $respuestaModelo;
		}
	}


}