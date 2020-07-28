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
		if (isset($_POST["frm_Codigo"])) {
			$datosControlador = array(
				'frm_Codigo' => $_POST["frm_Codigo"],
				'frm_Id' => $_POST["frm_Id"],
				'frm_Nombre' => $_POST["frm_Nombre"],
				'frm_Activo' => $_POST["frm_Activo"]
			 );
			if (isset($_POST["frm_Codigo"]) && $_POST["frm_Id"] > 0) {
				$respuestaModelo = FormaPagoModelo::mdlactualizarFormaPago($tabla,$datosControlador);
				return $respuestaModelo;
			}else{
				$respuestaModelo = FormaPagoModelo::mdlguardarFormaPago($tabla,$datosControlador);
				return $respuestaModelo;
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
			$respuestaModelo = FormaPagoModelo::mdlEliminarFormaPago($tabla,"frm_Id",$_POST["frm_Id"]);
			return $respuestaModelo;
		}
	}


}