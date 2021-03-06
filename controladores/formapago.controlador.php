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

	/*=============================================
				GENERAR CONSECUTIVO
	=============================================*/


	public static function ctrConsecutivo()
	{
		$tabla = "formapago";
		$respuestaModelo = FormaPagoModelo::mdlconsecutivo($tabla,"frm_Codigo");
		return $respuestaModelo;
	}


	/*=============================================
				GUARDAR FORMA DE PAGO
	=============================================*/


	public static function ctrguardarFormaPago()
	{
		$tabla = "formapago";
		if (isset($_POST)) {
			session_start();
			if (in_array(13, $_SESSION["permisos"]) || in_array(15, $_SESSION["permisos"]))
			{
				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["frm_Nombre"])) {

					$frm_Id = intval($_POST["frm_Id"]);
					$frm_Codigo = strtoupper(trim($_POST["frm_Codigo"]));
					$frm_Nombre = strtoupper(trim($_POST["frm_Nombre"]));
					$frm_Activo = intval($_POST["frm_Activo"]);


					$datosControlador = array(
						'frm_Codigo' => $frm_Codigo,
						'frm_Id' => $frm_Id,
						'frm_Nombre' => $frm_Nombre,
						'frm_Activo' => $frm_Activo
					);

					if ($frm_Id > 0) {

						return $respuestaModelo = FormaPagoModelo::mdlactualizarFormaPago($tabla,$datosControlador);

					}else{

						return $respuestaModelo = FormaPagoModelo::mdlguardarFormaPago($tabla,$datosControlador);

					}

				}else{

					return $arrayName = array('codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio');

				}
			}else{
				$arrayName = array('codigo' => 'No tienes permisos para realizar esta accion');

				return $arrayName;
			}

		}
	}


	/*=============================================
				ELIMINAR FORMA DE PAGO
	=============================================*/


	public static function ctrEliminarFormaPago()
	{
		$tabla = "formapago";
		if (isset($_POST["frm_Id"])) {
			if (in_array(16, $_SESSION["permisos"]))
			{
				$respuestaModelo = FormaPagoModelo::mdlEliminarFormaPago($tabla,"frm_Id",$_POST["frm_Id"]);
				return $respuestaModelo;
			}else{
				$arrayName = array('codigo' => 'No tienes permisos para realizar esta accion');

				return $arrayName;
			}
		}
	}


}