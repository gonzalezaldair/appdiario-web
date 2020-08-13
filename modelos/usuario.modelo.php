<?php

require_once 'conexion.php';

class UsuariosModelo{


	/*=============================================
	MOSTRAR Usuarios
	=============================================*/


	public static function mdlMostrarUsuarios($tabla, $item, $valor)
	{
		if($item != null){

			try {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();

			} catch (PDOException $e){

				$err = $stmt->errorInfo();
				$arrayName = array(
					'mensaje' => $e->getMessage(),
					'codigo' => $err[1],
					'sqlstate' => $e->getCode(),
					'script' => $e->getFile(),
					'linea' => $e->getLine(),
					'excepcionprevia' => $e->getPrevious(),
					'cadena' => $e->__toString(),
					'errorinfo' => $err[2]
				);

				return $arrayName;
			}

		}else{

			try {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

				$stmt -> execute();

				return $stmt -> fetchAll();

			} catch (PDOException $e){

				$err = $stmt->errorInfo();
				$arrayName = array(
					'mensaje' => $e->getMessage(),
					'codigo' => $err[1],
					'sqlstate' => $e->getCode(),
					'script' => $e->getFile(),
					'linea' => $e->getLine(),
					'excepcionprevia' => $e->getPrevious(),
					'cadena' => $e->__toString(),
					'errorinfo' => $err[2]
				);

				return $arrayName;
			}

		}

		$stmt = null;
	}

	/*=============================================
	permisos de  Usuarios
	=============================================*/

	public static function mdlPermisosUsuario($tabla, $item, $valor)
	{

		try {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetchAll();

		} catch (PDOException $e){

			$err = $stmt->errorInfo();
			$arrayName = array(
				'mensaje' => $e->getMessage(),
				'codigo' => $err[1],
				'sqlstate' => $e->getCode(),
				'script' => $e->getFile(),
				'linea' => $e->getLine(),
				'excepcionprevia' => $e->getPrevious(),
				'cadena' => $e->__toString(),
				'errorinfo' => $err[2]
			);

			return $arrayName;
		}

		$stmt = null;
	}

	public static function mdlModulosPermisos()
	{

		try {

			$stmt = Conexion::conectar()->prepare("select t1.mod_Nombre, (select t2.rol_Id from roles t2 WHERE t2.rol_Nombre = 'Crear' AND t2.rol_MODULO = t1.mod_Id) as 'Crear', (select t2.rol_Id from roles t2 WHERE t2.rol_Nombre = 'Actualizar' AND t2.rol_MODULO = t1.mod_Id) as 'Actualizar', (select t2.rol_Id from roles t2 WHERE t2.rol_Nombre = 'Leer' AND t2.rol_MODULO = t1.mod_Id) as 'Leer', (select t2.rol_Id from roles t2 WHERE t2.rol_Nombre = 'Borrar' AND t2.rol_MODULO = t1.mod_Id) as 'Borrar'FROM modulos t1");

			$stmt -> execute();

			return $stmt -> fetchAll();

		} catch (PDOException $e){

			$err = $stmt->errorInfo();
			$arrayName = array(
				'mensaje' => $e->getMessage(),
				'codigo' => $err[1],
				'sqlstate' => $e->getCode(),
				'script' => $e->getFile(),
				'linea' => $e->getLine(),
				'excepcionprevia' => $e->getPrevious(),
				'cadena' => $e->__toString(),
				'errorinfo' => $err[2]
			);

			return $arrayName;
		}

		$stmt = null;
	}

	public static function mdlGuardarUsuario($tabla, $datosModelo)
	{

		try {

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usu_Login, usu_Password, usu_Nombre, usu_Celular, usu_Correo, usu_Direccion, usu_RUTA, usu_Cedula, usu_Perfil) VALUES (:usu_Login, :usu_Password, :usu_Nombre, :usu_Celular, :usu_Correo, :usu_Direccion, :usu_RUTA, :usu_Cedula, :usu_Perfil)");

			$stmt -> bindParam(":usu_Login", $datosModelo["usu_Login"], PDO::PARAM_STR);
			$stmt -> bindParam(":usu_Password", $datosModelo["usu_Password"], PDO::PARAM_STR);
			$stmt -> bindParam(":usu_Nombre", $datosModelo["usu_Nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":usu_Celular", $datosModelo["usu_Celular"], PDO::PARAM_INT);
			$stmt -> bindParam(":usu_Correo", $datosModelo["usu_Correo"], PDO::PARAM_STR);
			$stmt -> bindParam(":usu_Direccion", $datosModelo["usu_Direccion"], PDO::PARAM_STR);
			$stmt -> bindParam(":usu_RUTA", $datosModelo["usu_RUTA"], PDO::PARAM_INT);
			$stmt -> bindParam(":usu_Cedula", $datosModelo["usu_Cedula"], PDO::PARAM_STR);
			$stmt -> bindParam(":usu_Perfil", $datosModelo["usu_Perfil"], PDO::PARAM_INT);

			$stmt->execute();

			$stmt = null;

			$arrayName = array(
				'mensaje' => 'ok'
			);

			return $arrayName;

		} catch (PDOException $e) {

			$err = $stmt->errorInfo();
			$arrayName = array(
				'mensaje' => $e->getMessage(),
				'codigo' => $err[1],
				'sqlstate' => $e->getCode(),
				'script' => $e->getFile(),
				'linea' => $e->getLine(),
				'excepcionprevia' => $e->getPrevious(),
				'cadena' => $e->__toString(),
				'errorinfo' => $err[2]
			);

			return $arrayName;
		}

		$stmt = null;
	}

	public static function mdlactualizarUsuario($tabla, $datosModelo)
	{

		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usu_Nombre=:usu_Nombre,usu_Celular=:usu_Celular,usu_Correo=:usu_Correo,usu_Direccion=:usu_Direccion,usu_RUTA=:usu_RUTA,usu_Perfil=:usu_Perfil,usu_Activo=:usu_Activo WHERE usu_Id = :id");

			//$stmt -> bindParam(":usu_Password", $datosModelo["usu_Password"], PDO::PARAM_STR);
			$stmt -> bindParam(":usu_Nombre", $datosModelo["usu_Nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":usu_Celular", $datosModelo["usu_Celular"], PDO::PARAM_INT);
			$stmt -> bindParam(":usu_Correo", $datosModelo["usu_Correo"], PDO::PARAM_STR);
			$stmt -> bindParam(":usu_Direccion", $datosModelo["usu_Direccion"], PDO::PARAM_STR);
			$stmt -> bindParam(":usu_RUTA", $datosModelo["usu_RUTA"], PDO::PARAM_INT);
			$stmt -> bindParam(":usu_Perfil", $datosModelo["usu_Perfil"], PDO::PARAM_INT);
			$stmt -> bindParam(":usu_Activo", $datosModelo["usu_Activo"], PDO::PARAM_INT);
			$stmt -> bindParam(":id", $datosModelo["usu_Id"], PDO::PARAM_INT);

			$stmt->execute();

			$stmt = null;

			$arrayName = array(
				'mensaje' => 'ok'
			);

			return $arrayName;

		} catch (PDOException $e) {

			$err = $stmt->errorInfo();
			$arrayName = array(
				'mensaje' => $e->getMessage(),
				'codigo' => $err[1],
				'sqlstate' => $e->getCode(),
				'script' => $e->getFile(),
				'linea' => $e->getLine(),
				'excepcionprevia' => $e->getPrevious(),
				'cadena' => $e->__toString(),
				'errorinfo' => $err[2]
			);

			return $arrayName;
		}

		$stmt = null;
	}

	/*=============================================
				ELIMINAR PERFIL
	=============================================*/

	public static function mdlEliminarUsuario($tabla,$item,$valor)
	{
		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usu_Activo= 0 WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor);

			$stmt->execute();

			$stmt = null;

			$arrayName = array(
				'mensaje' => "ok"
			);

			return $arrayName;

		} catch (PDOException $e){

			$err = $stmt->errorInfo();
			$arrayName = array(
				'mensaje' => $e->getMessage(),
				'codigo' => $err[1],
				'sqlstate' => $e->getCode(),
				'script' => $e->getFile(),
				'linea' => $e->getLine(),
				'excepcionprevia' => $e->getPrevious(),
				'cadena' => $e->__toString(),
				'errorinfo' => $err[2]
			);

			return $arrayName;
		}

		$stmt = null;
	}
}