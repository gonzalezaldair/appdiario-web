<?php


class AbonosControlador
{



	/*=============================================
	MOSTRAR Abonos
	=============================================*/

	public static function ctrMostrarAbonos($item, $valor)
	{

		$tabla = "abono";

		$respuesta = AbonosModelo::mdlMostrarAbonos($tabla, $item, $valor);

		return $respuesta;
	}


	public static function ctrGuardarAbonos()
	{
		$tabla = "abono";

		if (isset($_POST)) {

			if (!in_array(1, $_SESSION["permisos"])) {
				return ['codigo' => 'No tienes permisos para realizar esta accion'];
			}

			if (!preg_match('/^[0-9]+$/', $_POST["abo_Monto"])) {
				return ['codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio'];
			}

			$abo_Id = intval($_POST["abo_Id"]);
			$abo_PRESTAMO = intval($_POST["abo_PRESTAMO"]);
			$abo_Monto = intval($_POST["abo_Monto"]);
			$abo_Fecha = date("Y-m-d H:i:s");
			$abo_CajaId = intval($_SESSION["cajaAbiertaId"]);

			$datosControlador = [
				'abo_Id' => $abo_Id,
				'abo_PRESTAMO' => $abo_PRESTAMO,
				'abo_Monto' => $abo_Monto,
				'abo_Fecha' => $abo_Fecha,
				'abo_CUADRE_CAJA' => $abo_CajaId,
				'abo_USUARIO' => $_SESSION["usuario_Id"]
			];


			if ($abo_Id > 0) {

				return  AbonosModelo::mdlActualizarAbonos($tabla, $datosControlador);
			}


			$respuestaModelo = AbonosModelo::mdlGuardarAbonos($tabla, $datosControlador);

			if ($respuestaModelo["mensaje"] == "ok") {

				return MovimientosCajaModelo::mdlRegistrarMovimientoCaja("movimiento_caja", [
					"mov_Observacion" => "Abono Registrado: " . number_format($abo_Monto, 2, ",", "."),
					"mov_Monto" => $abo_Monto,
					"mov_Tipo" => "ABONO",
					"mov_Usuario" => $_SESSION["usuario_Id"],
					"mov_Referencia" => $respuestaModelo["lastInsertId"],
					"mov_Fecha" => date("Y-m-d H:i:s")
				]);
			}

			return $respuestaModelo;
		}
	}
}
