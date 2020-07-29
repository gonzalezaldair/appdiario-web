<?php

require_once 'conexion.php';

class CobrosModelo{


	/*=============================================
	MOSTRAR Cobros
	=============================================*/


	public static function mdlMostrarCobros($tabla, $item, $valor)
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
				GUARDAR COBROS
	=============================================*/

	public static function mdlguardarCobros($tabla,$datosModelo)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (cob_Codigo, cob_Nombre, cob_Fecha) VALUES (:codigo, :nombre, :fecha)");
		$stmt -> bindParam(":codigo", $datosModelo["cob_Codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datosModelo["cob_Nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha", $datosModelo["cob_Fecha"], PDO::PARAM_STR);
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
				ACTUALIZAR COBROS
	=============================================*/

	public static function mdlActualizarCobros($tabla,$datosModelo)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cob_Nombre= :nombre ,cob_Activo= :activo WHERE cob_Id = :id");
		$stmt -> bindParam(":nombre", $datosModelo["cob_Nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":activo", $datosModelo["cob_Activo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datosModelo["cob_Id"], PDO::PARAM_INT);
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
				ELIMINAR COBROS
	=============================================*/

	public static function mdlEliminarCobros($tabla,$item,$valor)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cob_Activo= 'N' WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
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