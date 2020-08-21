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

			if (in_array(25, $_SESSION["permisos"]) || in_array(27, $_SESSION["permisos"])) {

				$correo = ($_POST["usu_Correo"] != "") ? $_POST["usu_Correo"] : "notiene@notiene.com" ;
				$direccion = ($_POST["usu_Direccion"] != "") ? $_POST["usu_Direccion"] : "Sin Direccion" ;

				if (preg_match('/^[0-9 ]+$/', $_POST["usu_Cedula"]) && preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["usu_Login"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["usu_Nombre"]) && preg_match('/^[0-9 ]+$/', $_POST["usu_Celular"]) && preg_match('/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/', $correo) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $direccion))
				{
					$usu_Id = intval($_POST["usu_Id"]);
					$usu_Cedula = intval($_POST["usu_Cedula"]);
					$usu_Login = trim($_POST["usu_Login"]);
					$usu_Nombre = strtoupper(trim($_POST["usu_Nombre"]));
					$usu_Celular = intval($_POST["usu_Celular"]);
					$usu_Correo = strtoupper(trim($correo));
					$usu_Direccion = strtoupper(trim($direccion));
					$usu_RUTA = intval($_POST["usu_RUTA"]);
					$usu_Perfil = intval($_POST["usu_Perfil"]);
					$usu_Activo = intval($_POST["usu_Activo"]);
				//$encriptar = crypt($_POST["usu_Password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					$usu_Password = password_hash($_POST["usu_Password"], PASSWORD_DEFAULT, ['cost' => 10]);

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
						'usu_Password' => $usu_Password
					);

					if ($usu_Id > 0) {

						return $respuestaModelo =UsuariosModelo::mdlactualizarUsuario($tabla, $datosControlador);

					}else{

						return $respuestaModelo =UsuariosModelo::mdlGuardarUsuario($tabla, $datosControlador);

					}
				}else{

					$arrayName = array('codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio' );

					return $arrayName;
				}
			}else{
				$arrayName = array('codigo' => 'No tienes permisos para realizar esta accion');

				return $arrayName;
			}
		}

	}

	/**
	 * ELIMINAR USUARIO
	 */

	public static function ctrEliminarUsuario()
	{
		$tabla = "usuario";
		if (in_array(28, $_SESSION["permisos"])) {
			$valor = intval($_POST["valor"]);
			$item = trim($_POST["item"]);
			$respuestaModelo = UsuariosModelo::mdlEliminarUsuario($tabla,$item, $valor);
			return $respuestaModelo;
		}else{
			$arrayName = array('codigo' => 'No tienes permisos para realizar esta accion');

			return $arrayName;
		}

	}


}