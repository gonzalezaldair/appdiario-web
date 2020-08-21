<?php



class ModulosControlador{



	/*=============================================
	MOSTRAR MODULOS
	=============================================*/

	public static function ctrMostrarModulos($item, $valor, $orden){

		$tabla = "modulos";

		$respuesta = ModulosModelo::mdlMostrarModulos($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	public static function ctrMostrarModulosPersonalizados($perrfil){

		$respuesta = ModulosModelo::mdlMostrarModulosPersonalizados($perrfil);

		return $respuesta;

	}

	public static function ctrMostrarPermisos($perrfil){

		$respuesta = ModulosModelo::mdlMostrarPermisos($perrfil);

		return $respuesta;

	}


}