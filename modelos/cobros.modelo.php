<?php

require_once 'conexion.php';

class CobrosModelo
{


	/*=============================================
	MOSTRAR Cobros
	=============================================*/


	public static function mdlMostrarCobros($tabla, $item, $valor)
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
				GENERAR CONSECUTIVO
	=============================================*/

	public static function mdlconsecutivo($tabla, $item)
	{
		try {

			$stmt = Conexion::conectar()->prepare("SELECT IFNULL(MAX($item),0) as Consecutivo FROM $tabla LIMIT 1");

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
	}

	/*=============================================
				GUARDAR COBROS
	=============================================*/

	public static function mdlguardarCobros($tabla, $datosModelo)
	{
		try {

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (cob_Codigo, cob_Nombre, cob_Fecha) VALUES (:codigo, :nombre, :fecha)");
			$stmt->bindParam(":codigo", $datosModelo["cob_Codigo"], PDO::PARAM_STR);
			$stmt->bindParam(":nombre", $datosModelo["cob_Nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha", $datosModelo["cob_Fecha"], PDO::PARAM_STR);

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
				ACTUALIZAR COBROS
	=============================================*/

	public static function mdlActualizarCobros($tabla, $datosModelo)
	{

		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cob_Nombre= :nombre ,cob_Activo= :activo WHERE cob_Id = :id");
			$stmt->bindParam(":nombre", $datosModelo["cob_Nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":activo", $datosModelo["cob_Activo"], PDO::PARAM_INT);
			$stmt->bindParam(":id", $datosModelo["cob_Id"], PDO::PARAM_INT);

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
				ELIMINAR COBROS
	=============================================*/

	public static function mdlEliminarCobros($tabla, $item, $valor)
	{

		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cob_Activo= 'N' WHERE $item = :$item");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

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
