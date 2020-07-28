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
		$tabla = "cobro";
		$respuestaModelo = CobrosModelo::mdlguardarCobros($tabla,"cob_Codigo");
		return $respuestaModelo;
		if (isset($_POST["cob_Codigo"])) {
			$datosControlador = array(
				'cob_Id' => $_POST["cob_Id"],
				'cob_Codigo' => $_POST["cob_Codigo"],
				'cob_Nombre' => $_POST["cob_Nombre"],
				'cob_Activo' => $_POST["cob_Activo"]
			);
			$respuestaModelo =
		}
	}


}