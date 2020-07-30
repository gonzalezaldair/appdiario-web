<?php



class UsuariosControlador{



	/*=============================================
	MOSTRAR Usuarios
	=============================================*/

	public static function ctrMostrarUsuarios($item, $valor){

		$tabla = "usuario";

		$respuesta = UsuariosModelo::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	permisos por  Usuario
	=============================================*/

	public static function ctrPermisosUsuario($item, $valor){

		$tabla = "rol_usuario";

		$respuesta = UsuariosModelo::mdlPermisosUsuario($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	todos - permisos - modulos
	=============================================*/

	public static function ctrModulosPermisos(){

		$respuesta = UsuariosModelo::mdlModulosPermisos();

		return $respuesta;

	}


	/*=============================================
				AGREGAR USUARIO
	=============================================*/

	public static function ctrGuardarUsuario(){
		$tabla ="usuario";
		if (isset($_POST)) {
			if ($_POST["usu_Id"] > 0) {
				$respuestaModelo =UsuariosModelo::mdlactualizarUsuario($tabla, $_POST);
			}else{
				$respuestaModelo =UsuariosModelo::mdlGuardarUsuario($tabla, $_POST);
			}

			return $respuestaModelo;
		}

	}


}