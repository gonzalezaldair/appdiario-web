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

			if (preg_match('/^[0-9]+$/', $_POST["usu_Cedula"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["usu_Password"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["usu_Login"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["usu_Nombre"]) && preg_match('/^[0-9]+$/', $_POST["usu_Celular"]) && preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["usu_Correo"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["usu_Direccion"])) {

				$usu_Id = intval($_POST["usu_Id"]);
				$usu_Cedula = intval($_POST["usu_Cedula"]);
				$usu_Login = trim($_POST["usu_Login"]);
				$usu_Nombre = trim($_POST["usu_Nombre"]);
				$usu_Celular = intval($_POST["usu_Celular"]);
				$usu_Correo = trim($_POST["usu_Correo"]);
				$usu_Direccion = trim($_POST["usu_Direccion"]);
				$usu_RUTA = intval($_POST["usu_RUTA"]);
				$usu_Perfil = intval($_POST["usu_Perfil"]);
				$usu_Activo = intval($_POST["usu_Activo"]);
				//$encriptar = crypt($_POST["usu_Password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$user_Password = password_hash($_POST["usu_Password"], PASSWORD_DEFAULT, ['cost' => 10]);

				$datosControlador = array(
					'usu_Id' => $usu_Id,
					'usu_Cedula' => $usu_Cedula,
					'usu_Login' => $usu_Login,
					'usu_Nombre' => $usu_Nombre,
					'usu_Celular' => $usu_Celular,
					'usu_Correo' => $usu_Correo,
					'usu_Direccion' => $usu_Direccion,
					'usu_RUTA' => $usu_RUTA,
					'usu_Perfil' => $usu_Perfil,
					'usu_Activo' => $usu_Activo,
					'user_Password' => $user_Passwords
				);

				if ($usu_Id > 0) {

					return $respuestaModelo =UsuariosModelo::mdlactualizarUsuario($tabla, $datosControlador);

				}else{

					return $respuestaModelo =UsuariosModelo::mdlGuardarUsuario($tabla, $datosControlador);

				}
			}else{

				return "Revisar Campos Alguno debe contener un caracter no permitido o esta vacio";
			}
		}

	}


}