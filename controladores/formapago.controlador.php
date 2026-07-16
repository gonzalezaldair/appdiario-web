<?php



class FormaPagoControlador
{



	/*=============================================
	MOSTRAR FormaPago
	=============================================*/

	public static function ctrMostrarFormaPago($item, $valor)
	{

		$tabla = "formapago";

		$respuesta = FormaPagoModelo::mdlMostrarFormaPago($tabla, $item, $valor);

		return $respuesta;
	}


	/*=============================================
				GUARDAR FORMA DE PAGO
	=============================================*/


	public static function ctrguardarFormaPago()
	{
		$tabla = "formapago";
		if (isset($_POST)) {

			if (!(in_array(13, $_SESSION["permisos"]) || in_array(15, $_SESSION["permisos"]))) return ['codigo' => 'No tienes permisos para realizar esta accion'];

			if (!preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["frm_Nombre"])) return ['codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio'];

			$frm_Id = intval($_POST["frm_Id"]);
			$frm_Nombre = strtoupper(trim($_POST["frm_Nombre"]));
			$frm_Activo = intval($_POST["frm_Activo"]);


			$datosControlador = [
				'frm_Id' => $frm_Id,
				'frm_Nombre' => $frm_Nombre,
				'frm_Activo' => $frm_Activo,
				'created_by' => $_SESSION["usuario_Id"],
				'updated_by' => $_SESSION["usuario_Id"]
			];

			if ($frm_Id > 0) {

				return FormaPagoModelo::mdlactualizarFormaPago($tabla, $datosControlador);
			}

			return FormaPagoModelo::mdlguardarFormaPago($tabla, $datosControlador);
		}
	}


	/*=============================================
				ELIMINAR FORMA DE PAGO
	=============================================*/


	public static function ctrEliminarFormaPago()
	{
		$tabla = "formapago";
		if (isset($_POST["frm_Id"])) {

			if (!in_array(16, $_SESSION["permisos"])) return ['codigo' => 'No tienes permisos para realizar esta accion'];

			return FormaPagoModelo::mdlEliminarFormaPago($tabla, "frm_Id", $_POST["frm_Id"], $_SESSION["usuario_Id"]);
		}
	}
}