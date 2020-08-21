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
			session_start();

			if (in_array(1, $_SESSION["permisos"])) {
				if (preg_match('/^[0-9]+$/', $_POST["abo_Monto"])) {

					$abo_Id = intval($_POST["abo_Id"]);
					$abo_PRESTAMO = intval($_POST["abo_PRESTAMO"]);
					$abo_Monto = intval($_POST["abo_Monto"]);
					$abo_Fecha = date("Y-m-d H:i:s");

					$datosControlador = array(
						'abo_Id' => $abo_Id,
						'abo_PRESTAMO' => $abo_PRESTAMO,
						'abo_Monto' => $abo_Monto,
						'abo_Fecha' => $abo_Fecha,
					);


					if ($abo_Id > 0) {

						return $respuestaModelo = AbonosModelo::mdlActualizarAbonos($tabla, $datosControlador);

					}else{

						return $respuestaModelo = AbonosModelo::mdlGuardarAbonos($tabla, $datosControlador);
					}
				}else{

					$arrayName = array('codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio');

					return $arrayName;

				}
			}else{
				$arrayName = array('codigo' => 'No tienes permisos para realizar esta accion');

				return $arrayName;
			}

		}
	}


}