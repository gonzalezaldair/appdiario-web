<?php



class AbonosControlador{



	/*=============================================
	MOSTRAR Abonos
	=============================================*/

	public static function ctrMostrarAbonos($item, $valor){

		$tabla = "cobro";

		$respuesta = AbonosModelo::mdlMostrarAbonos($tabla, $item, $valor);

		return $respuesta;

	}


}