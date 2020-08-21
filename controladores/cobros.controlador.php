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
		$fecha = date('Y-m-d');
		$tabla = "cobro";
		if (isset($_POST)) {
			session_start();
			if (in_array(9, $_SESSION["permisos"]) || in_array(11, $_SESSION["permisos"]))
			{
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["cob_Nombre"])) {

					$cob_Id = intval($_POST["cob_Id"]);
					$cob_Codigo = trim($_POST["cob_Codigo"]);
					$cob_Nombre = trim($_POST["cob_Nombre"]);
					$cob_Activo = intval($_POST["cob_Activo"]);
					$cob_Fecha = trim($fecha);

					$datosControlador = array(
						'cob_Id' => $_POST["cob_Id"],
						'cob_Codigo' => $_POST["cob_Codigo"],
						'cob_Nombre' => $_POST["cob_Nombre"],
						'cob_Activo' => $_POST["cob_Activo"],
						'cob_Fecha' => $cob_Fecha
					);

					if ($cob_Id > 0) {
						return $respuestaModelo = CobrosModelo::mdlActualizarCobros($tabla,$datosControlador);
					}else{
						return $respuestaModelo = CobrosModelo::mdlguardarCobros($tabla,$datosControlador);
					}

				}else
				{
					return $arrayName = array('codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio');
				}
			}else{
				$arrayName = array('codigo' => 'No tienes permisos para realizar esta accion');

				return $arrayName;
			}

		}
	}


	/*=============================================
				ELIMINAR COBRO
	=============================================*/


	public static function ctrEliminarCobros()
	{
		$tabla = "cobro";
		if (isset($_POST["cobid"])) {
			session_start();
			if (in_array(12, $_SESSION["permisos"]))
			{
				$respuestaModelo = CobrosModelo::mdlEliminarCobros($tabla,"cob_Id", $_POST["cobid"]);
				return $respuestaModelo;
			}else{
				$arrayName = array('codigo' => 'No tienes permisos para realizar esta accion');

				return $arrayName;
			}
		}
	}


}