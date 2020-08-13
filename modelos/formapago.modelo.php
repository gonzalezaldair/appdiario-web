<?php

require_once 'conexion.php';

class FormaPagoModelo{


	/*=============================================
	MOSTRAR FormaPago
	=============================================*/


	public static function mdlMostrarFormaPago($tabla, $item, $valor)
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
				GENERAR CONSECUTIVO
	=============================================*/

	public static function mdlconsecutivo($tabla,$item)
	{
		try {

			$stmt = Conexion::conectar()->prepare("SELECT IFNULL(MAX($item),0) as Consecutivo FROM $tabla LIMIT 1");

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

		$stmt = null;
	}

	/*=============================================
				GUARDAR FORMA DE PAGO
	=============================================*/

	public static function mdlguardarFormaPago($tabla,$datosModelo)
	{
		try {

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(frm_Codigo, frm_Nombre) VALUES (:codigo, :nombre)");

			$stmt -> bindParam(":codigo", $datosModelo["frm_Codigo"], PDO::PARAM_STR);
			$stmt -> bindParam(":nombre", $datosModelo["frm_Nombre"], PDO::PARAM_STR);

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

	/*=============================================
				ACTUALIZAR FORMA DE PAGO
	=============================================*/

	public static function mdlactualizarFormaPago($tabla,$datosModelo)
	{

		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET frm_Codigo= :codigo, frm_Nombre= :nombre, frm_Activo = :estado WHERE frm_Id = :id");

			$stmt -> bindParam(":codigo", $datosModelo["frm_Codigo"], PDO::PARAM_STR);
			$stmt -> bindParam(":nombre", $datosModelo["frm_Nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":estado", $datosModelo["frm_Activo"], PDO::PARAM_INT);
			$stmt -> bindParam(":id", $datosModelo["frm_Id"], PDO::PARAM_INT);

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

	/*=============================================
				ELIMINAR FORMA DE PAGO
	=============================================*/

	public static function mdlEliminarFormaPago($tabla,$item,$valor)
	{
		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET frm_Activo = 0 WHERE $item  = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

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