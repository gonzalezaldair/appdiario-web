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


}