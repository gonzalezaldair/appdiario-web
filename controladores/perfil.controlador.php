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

	/*=============================================
				GUARDAR PERFIL
	=============================================*/


	public static function ctrguardarPerfil()
	{
		$tabla = "perfiles";
		if (isset($_POST["per_Codigo"])) {
			$datosControlador = array('per_Codigo' => $_POST["per_Codigo"], 'per_Nombre' => $_POST["per_Nombre"]);
			$respuestaModelo = PerfilModelo::mdlguardarPerfil($tabla, $datosControlador);
			return $respuestaModelo;
		}
	}

	/*=============================================
				GENERAR CONSECUTIVO
	=============================================*/


	public static function ctrConsecutivo()
	{
		$tabla = "perfiles";
		$respuestaModelo = PerfilModelo::mdlconsecutivo($tabla,"per_Codigo");
		return $respuestaModelo;
	}

}