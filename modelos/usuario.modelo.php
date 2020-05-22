<?php

require_once 'conexion.php';

class UsuariosModelo{


	/*=============================================
	MOSTRAR Usuarios
	=============================================*/


	public static function mdlMostrarUsuarios($tabla, $item, $valor)
	{
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	permisos de  Usuarios
	=============================================*/

	public static function mdlPermisosUsuario($tabla, $item, $valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	public static function mdlModulosPermisos()
	{
		$stmt = Conexion::conectar()->prepare("select t1.mod_Nombre,
				(select t2.rol_Id from roles t2 WHERE t2.rol_Nombre = 'Crear' AND t2.rol_MODULO = t1.mod_Id) as 'Crear',
				(select t2.rol_Id from roles t2 WHERE t2.rol_Nombre = 'Actualizar' AND t2.rol_MODULO = t1.mod_Id) as 'Actualizar',
				(select t2.rol_Id from roles t2 WHERE t2.rol_Nombre = 'Leer' AND t2.rol_MODULO = t1.mod_Id) as 'Leer',
				(select t2.rol_Id from roles t2 WHERE t2.rol_Nombre = 'Borrar' AND t2.rol_MODULO = t1.mod_Id) as 'Borrar'
				FROM modulos t1");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
}