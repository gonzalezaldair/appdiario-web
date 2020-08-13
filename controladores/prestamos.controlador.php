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

			$Observaciones = ($_POST["pre_Observaciones"] != "") ? $_POST["pre_Observaciones"] : "Sin Observaciones" ;

			if (preg_match('/^[,\\.\\a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $Observaciones) && preg_match('/^[0-9]+$/', $_POST["pre_CLIENTE"]) && preg_match('/^[0-9]+$/', $_POST["pre_FormaPago"]) && preg_match('/^[0-9]+$/', $_POST["pre_Interes"]) && preg_match('/^[0-9.,]+$/', $_POST["pre_MontoPrestado"]) && preg_match('/^[0-9]+$/', $_POST["pre_Cuotas"]))
			{
				$pre_Id = intval($_POST["pre_Id"]);
				$pre_Fecha = date('Y-m-d H:i:s');
				$pre_CLIENTE = intval($_POST["pre_CLIENTE"]);
				$pre_FormaPago = intval($_POST["pre_FormaPago"]);
				$pre_Interes = intval($_POST["pre_Interes"]);
				$pre_MontoPrestado = intval($_POST["pre_MontoPrestado"]);
				$pre_Cuotas = intval($_POST["pre_Cuotas"]);
				$pre_Observaciones = $Observaciones;
				$pre_USUARIO  = intval($_POST["pre_USUARIO"]);
				$interes = ($pre_Interes > 9) ? "1.".$pre_Interes : "1.0".$pre_Interes ;
				$pre_MontoInteres = $pre_MontoPrestado*$interes;

				$datosControlador = array(
					'pre_Id' => $pre_Id,
					'pre_Fecha' => $pre_Fecha,
					'pre_CLIENTE' => $pre_CLIENTE,
					'pre_FormaPago' => $pre_FormaPago,
					'pre_Interes' => $pre_Interes,
					'pre_MontoPrestado' => $pre_MontoPrestado,
					'pre_Cuotas' => $pre_Cuotas,
					'pre_Observaciones' => $pre_Observaciones,
					'pre_USUARIO' => $pre_USUARIO,
					'pre_MontoInteres' => $pre_MontoInteres
				);

				if ($pre_Id > 0) {

					return $respuestaModelo = PrestamosModelo::mdlactualizarPrestamo($tabla, $datosControlador);

				}else{

					return $respuestaModelo = PrestamosModelo::mdlguardarPrestamo($tabla, $datosControlador);

				}
			}else{
				$arrayName = array('codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio');
				return $arrayName;
			}
		}
	}


}