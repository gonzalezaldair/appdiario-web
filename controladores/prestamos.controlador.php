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


}