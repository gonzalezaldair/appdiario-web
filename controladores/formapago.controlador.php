<?php



class FormaPagoControlador{



	/*=============================================
	MOSTRAR FormaPago
	=============================================*/

	public static function ctrMostrarFormaPago($item, $valor){

		$tabla = "formapago";

		$respuesta = FormaPagoModelo::mdlMostrarFormaPago($tabla, $item, $valor);

		return $respuesta;

	}


}