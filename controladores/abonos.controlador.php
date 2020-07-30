<?php



class AbonosControlador{



	/*=============================================
	MOSTRAR Abonos
	=============================================*/

	public static function ctrMostrarAbonos($item, $valor){

		$tabla = "abono";

		$respuesta = AbonosModelo::mdlMostrarAbonos($tabla, $item, $valor);

		return $respuesta;

	}


	public static function ctrGuardarAbonos()
	{
		$tabla = "abono";

		if (isset($_POST)) {

			if ($_POST["abo_Id"] > 0) {

				return $respuestaModelo = AbonosModelo::mdlActualizarAbonos($tabla, $_POST);

			}else{

				return $respuestaModelo = AbonosModelo::mdlGuardarAbonos($tabla, $_POST);
			}
		}
	}


}