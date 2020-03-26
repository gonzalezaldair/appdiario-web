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


}