<?php

require_once 'conexion.php';

class PerfilModelo
{


	/*=============================================
	MOSTRAR Perfil
	=============================================*/


	public static function mdlMostrarPerfil($tabla, $item, $valor)
	{
		if ($item != null) {

			try {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

				$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

				$stmt->execute();

				return $stmt->fetch();
			} catch (PDOException $e) {

				return [
					'mensaje'         => $e->getMessage(),
					'codigo'          => $e->getCode(),
					'script'          => $e->getFile(),
					'linea'           => $e->getLine(),
					'excepcionprevia' => $e->getPrevious(),
					'cadena'          => $e->__toString()
				];
			}
		} else {

			try {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

				$stmt->execute();

				return $stmt->fetchAll();
			} catch (PDOException $e) {

				return [
					'mensaje'         => $e->getMessage(),
					'codigo'          => $e->getCode(),
					'script'          => $e->getFile(),
					'linea'           => $e->getLine(),
					'excepcionprevia' => $e->getPrevious(),
					'cadena'          => $e->__toString()
				];
			}
		}
	}

	/*=============================================
				GUARDAR PERFIL
	=============================================*/

	public static function mdlguardarPerfil($tabla, $datosModelo)
	{
		try {

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (per_Nombre) VALUES (:nombre)");
			$stmt->bindParam(":nombre", $datosModelo["per_Nombre"], PDO::PARAM_STR);

			$stmt->execute();

			$stmt = null;

			return ["mensaje" => "ok"];
		} catch (PDOException $e) {

			return [
				'mensaje'         => $e->getMessage(),
				'codigo'          => $e->getCode(),
				'script'          => $e->getFile(),
				'linea'           => $e->getLine(),
				'excepcionprevia' => $e->getPrevious(),
				'cadena'          => $e->__toString()
			];
		}
	}


	/*=============================================
				ACTUALIZAR PERFIL
	=============================================*/

	public static function mdlActualizarPerfil($tabla, $datosModelo)
	{
		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET per_Nombre= :per_Nombre ,per_Activo= :per_Activo WHERE per_Id = :per_Id");
			$stmt->bindParam(":per_Nombre", $datosModelo["per_Nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":per_Activo", $datosModelo["per_Activo"], PDO::PARAM_INT);
			$stmt->bindParam(":per_Id", $datosModelo["per_Id"], PDO::PARAM_INT);

			$stmt->execute();

			$stmt = null;

			return ["mensaje" => "ok"];
		} catch (PDOException $e) {

			return [
				'mensaje'         => $e->getMessage(),
				'codigo'          => $e->getCode(),
				'script'          => $e->getFile(),
				'linea'           => $e->getLine(),
				'excepcionprevia' => $e->getPrevious(),
				'cadena'          => $e->__toString()
			];
		}
	}


	/*=============================================
				ELIMINAR PERFIL
	=============================================*/

	public static function mdlEliminarPerfil($tabla, $item, $valor)
	{
		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET per_Activo= 0 WHERE per_Id = :$item");
			$stmt->bindParam(":" . $item, $valor);

			$stmt->execute();

			$stmt = null;

			return ["mensaje" => "ok"];
		} catch (PDOException $e) {

			return [
				'mensaje'         => $e->getMessage(),
				'codigo'          => $e->getCode(),
				'script'          => $e->getFile(),
				'linea'           => $e->getLine(),
				'excepcionprevia' => $e->getPrevious(),
				'cadena'          => $e->__toString()
			];
		}
	}

	/**
	 * ELIMINAR PERMISOS
	 */
	public static function mdlEliminarPermisosPerfil($tabla, $perfil)
	{

		try {

			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE po_PERFIL = :po_PERFIL");
			$stmt->bindParam(":po_PERFIL", $perfil);

			$stmt->execute();

			$stmt = null;

			return ["mensaje" => "ok"];
		} catch (PDOException $e) {

			return [
				'mensaje'         => $e->getMessage(),
				'codigo'          => $e->getCode(),
				'script'          => $e->getFile(),
				'linea'           => $e->getLine(),
				'excepcionprevia' => $e->getPrevious(),
				'cadena'          => $e->__toString()
			];
		}
	}

	public static function mdlGuardarNuevosPermisos($query)
	{
		try {

			$stmt = Conexion::conectar()->prepare($query);

			$stmt->execute();

			$stmt = null;

			return ["mensaje" => "ok"];
		} catch (PDOException $e) {

			return [
				'mensaje'         => $e->getMessage(),
				'codigo'          => $e->getCode(),
				'script'          => $e->getFile(),
				'linea'           => $e->getLine(),
				'excepcionprevia' => $e->getPrevious(),
				'cadena'          => $e->__toString()
			];
		}
	}
}
