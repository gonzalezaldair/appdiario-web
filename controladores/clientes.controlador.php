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


	public static function ctrGuardarClientes(){

		$tabla = "cliente";

		if (isset($_POST)) {

			if ($_POST["cli_Id"] > 0) {

				return $respuestaModelo = ClientesModelo::mdlactualizarClientes($tabla,$_POST);

			}else{

				return $respuestaModelo = ClientesModelo::mdlGuardarClientes($tabla,$_POST);

			}

		}
	}

}