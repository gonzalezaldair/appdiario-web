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
		if (isset($_POST)) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["per_Nombre"])) {

				$per_Id = intval($_POST["per_Id"]);
				$per_Codigo = strtoupper (trim($_POST["per_Codigo"]));
				$per_Nombre = strtoupper (trim($_POST["per_Nombre"]));
				$per_Activo = intval($_POST["per_Activo"]);

				$datosControlador = array(
					'per_Id' => $per_Id,
					'per_Codigo' => $per_Codigo,
					'per_Nombre' => $per_Nombre,
					'per_Activo' => $per_Activo
				);

				if ($per_Id > 0) {
					return $respuestaModelo = PerfilModelo::mdlActualizarPerfil($tabla, $datosControlador);
				}else{
					return $respuestaModelo = PerfilModelo::mdlguardarPerfil($tabla, $datosControlador);
				}
			}else{

				return $arrayName = array('codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio');
			}

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



	public static function ctrEliminarPerfil()
	{
		$tabla = "perfiles";
		$per_Id = intval($_POST["perid"]);
		$respuestaModelo = PerfilModelo::mdlEliminarPerfil($tabla,"per_Id", $per_Id);
		return $respuestaModelo;
	}

}