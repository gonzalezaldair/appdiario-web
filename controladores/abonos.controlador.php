<?php



class AbonosControlador{



	/*=============================================
	MOSTRAR Abonos
	=============================================*/

	public static function ctrMostrarAbonos($item, $valor){

		$tabla = "abono";

		$respuesta = AbonosModelo::mdlMostrarAbonos($tabla, $item, $valor);

		return $respuesta;

	}


}