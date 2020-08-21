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
	public static function ctrLiveSearch($item, $valor){

		$tabla = "cliente";

		$respuesta = ClientesModelo::mdlLiveSearch($tabla, $item, $valor);

		return $respuesta;

	}


	public static function ctrGuardarClientes(){

		$tabla = "cliente";

		if (isset($_POST)) {

			session_start();

			if (in_array(5, $_SESSION["permisos"]) || in_array(7, $_SESSION["permisos"]))
			{
				$correo = ($_POST["cli_Correo"] != "") ? $_POST["cli_Correo"] : "notiene@notiene.com" ;
				$direccion = ($_POST["cli_Direccion"] != "") ? $_POST["cli_Direccion"] : "Sin Direccion" ;

				if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["cli_Nombre"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $direccion) && preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $correo) ) {

					$cli_Id = intval($_POST["cli_Id"]);
					$cli_Cedula = intval($_POST["cli_Cedula"]);
					$cli_Nombre = strtoupper(trim($_POST["cli_Nombre"]));
					$cli_Celular  = intval($_POST["cli_Celular"]);
					$cli_Direccion = strtoupper(trim($direccion));
					$cli_Correo = strtoupper(trim($correo));
					$cli_Posicion = intval($_POST["cli_Posicion"]);
					$cli_RUTA  = intval($_POST["cli_RUTA"]);
					$cli_DiaCobro = intval($_POST["cli_DiaCobro"]);
					$cli_Activo = intval($_POST["cli_Activo"]);

					$datosControlador = array(
						'cli_Id' => $cli_Id,
						'cli_Cedula' => $cli_Cedula,
						'cli_Nombre' => $cli_Nombre,
						'cli_Celular' => $cli_Celular,
						'cli_Direccion' => $cli_Direccion,
						'cli_Correo' => $cli_Correo,
						'cli_Posicion' => $cli_Posicion,
						'cli_RUTA' => $cli_RUTA,
						'cli_DiaCobro' => $cli_DiaCobro,
						'cli_Activo' => $cli_Activo,
					);

					if ($cli_Id > 0) {

						return $respuestaModelo = ClientesModelo::mdlactualizarClientes($tabla,$datosControlador);

					}else{

						return $respuestaModelo = ClientesModelo::mdlGuardarClientes($tabla,$datosControlador);

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

}