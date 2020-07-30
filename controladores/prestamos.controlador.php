<?php



class PrestamosControlador{



	/*=============================================
	MOSTRAR Prestamos
	=============================================*/

	public static function ctrMostrarPrestamos($item, $valor){

		$tabla = "prestamo";

		$respuesta = PrestamosModelo::mdlMostrarPrestamos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR DATATABLES PRESTAMOS
	=============================================*/

	public static function ctrdatatableprestamos(){

		$respuesta = PrestamosModelo::mdldatatableprestamos();

		return $respuesta;

	}


	public static function ctrguardarPrestamo()
	{
		$tabla = "prestamo";
		if (isset($_POST)) {

			if ($_POST["pre_Id"] > 0) {

				return $respuestaModelo = PrestamosModelo::mdlactualizarPrestamo($tabla, $_POST);

			}else{

				return $respuestaModelo = PrestamosModelo::mdlguardarPrestamo($tabla, $_POST);

			}
		}
	}


}