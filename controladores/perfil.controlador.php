<?php



class PerfilControlador{



	/*=============================================
	MOSTRAR Perfil
	=============================================*/

	public static function ctrMostrarPerfil($item, $valor){

		$tabla = "perfiles";

		$respuesta = PerfilModelo::mdlMostrarPerfil($tabla, $item, $valor);

		return $respuesta;

	}


}