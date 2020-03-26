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


}