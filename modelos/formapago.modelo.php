<?php

require_once 'conexion.php';

class FormaPagoModelo
{


	/*=============================================
	MOSTRAR FormaPago
	=============================================*/


	public static function mdlMostrarFormaPago($tabla, $item, $valor)
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
				GUARDAR FORMA DE PAGO
	=============================================*/

	public static function mdlguardarFormaPago($tabla, $datosModelo)
	{
		try {

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(frm_Nombre, created_by) VALUES ( :nombre, :created_by)");

			$stmt->bindParam(":nombre", $datosModelo["frm_Nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":created_by", $datosModelo["created_by"], PDO::PARAM_INT);

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
				ACTUALIZAR FORMA DE PAGO
	=============================================*/

	public static function mdlactualizarFormaPago($tabla, $datosModelo)
	{

		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET updated_by = :updated_by, frm_Nombre= :nombre, frm_Activo = :estado WHERE frm_Id = :id");


			$stmt->bindParam(":updated_by", $datosModelo["updated_by"], PDO::PARAM_INT);
			$stmt->bindParam(":nombre", $datosModelo["frm_Nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":estado", $datosModelo["frm_Activo"], PDO::PARAM_INT);
			$stmt->bindParam(":id", $datosModelo["frm_Id"], PDO::PARAM_INT);

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
				ELIMINAR FORMA DE PAGO
	=============================================*/

	public static function mdlEliminarFormaPago($tabla, $item, $valor, $userId)
	{
		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET updated_by = :updated_by, frm_Activo = 0 WHERE $item  = :$item");
			$stmt->bindParam(":updated_by", $userId, PDO::PARAM_INT);
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);

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