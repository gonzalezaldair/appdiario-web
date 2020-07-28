<?php

require_once 'conexion.php';

class FormaPagoModelo{


	/*=============================================
	MOSTRAR FormaPago
	=============================================*/


	public static function mdlMostrarFormaPago($tabla, $item, $valor)
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
				GENERAR CONSECUTIVO
	=============================================*/

	public static function mdlconsecutivo($tabla,$item)
	{
		$stmt = Conexion::conectar()->prepare("SELECT IFNULL(MAX($item),0) as Consecutivo FROM $tabla LIMIT 1");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
				GUARDAR FORMA DE PAGO
	=============================================*/

	public static function mdlguardarFormaPago($tabla,$datosModelo)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(frm_Codigo, frm_Nombre) VALUES (:codigo, :nombre)");

		$stmt -> bindParam(":codigo", $datosModelo["frm_Codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datosModelo["frm_Nombre"], PDO::PARAM_STR);

		if($stmt->execute())
		{
			return "ok";
		}
		else
		{
			$err = $stmt->errorInfo();
			return $err[2];
		}
		$stmt -> close();
		$stmt = null;
	}

	/*=============================================
				ACTUALIZAR FORMA DE PAGO
	=============================================*/

	public static function mdlactualizarFormaPago($tabla,$datosModelo)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET frm_Codigo= :codigo, frm_Nombre= :nombre, frm_Activo = :estado WHERE frm_Id = :id");

		$stmt -> bindParam(":codigo", $datosModelo["frm_Codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datosModelo["frm_Nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $datosModelo["frm_Activo"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datosModelo["frm_Id"], PDO::PARAM_INT);

		if($stmt->execute())
		{
			return "ok";
		}
		else
		{
			$err = $stmt->errorInfo();
			return $err[2];
		}
		$stmt -> close();
		$stmt = null;
	}

	/*=============================================
				ELIMINAR FORMA DE PAGO
	=============================================*/

	public static function mdlEliminarFormaPago($tabla,$item,$valor)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET frm_Activo = 0 WHERE $item  = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		if($stmt->execute())
		{
			return "ok";
		}
		else
		{
			$err = $stmt->errorInfo();
			return $err[2];
		}
		$stmt -> close();
		$stmt = null;
	}
}