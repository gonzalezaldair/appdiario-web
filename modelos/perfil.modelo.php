<?php

require_once 'conexion.php';

class PerfilModelo{


	/*=============================================
	MOSTRAR Perfil
	=============================================*/


	public static function mdlMostrarPerfil($tabla, $item, $valor)
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
				GUARDAR PERFIL
	=============================================*/

	public static function mdlguardarPerfil($tabla,$datosModelo)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (per_Codigo, per_Nombre) VALUES (:codigo, :nombre)");
		$stmt -> bindParam(":codigo", $datosModelo["per_Codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datosModelo["per_Nombre"], PDO::PARAM_STR);
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
}