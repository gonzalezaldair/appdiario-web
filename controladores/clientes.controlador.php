<?php



class ClientesControlador{



	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	public static function ctrMostrarClientes($item, $valor){

		$tabla = "cliente";

		$respuesta = ClientesModelo::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;

	}


}