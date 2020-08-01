<?php

require_once 'conexion.php';

class AbonosModelo{


	/*=============================================
	MOSTRAR Abonos
	=============================================*/


	public static function mdlMostrarAbonos($tabla, $item, $valor)
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


	public static function mdlGuardarAbonos($tabla, $datosModelo)
	{
		$usuario = 2;
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (abo_PRESTAMO, abo_Monto, abo_Fecha) VALUES (:abo_PRESTAMO, :abo_Monto, :abo_Fecha)");

		$stmt -> bindParam(":abo_PRESTAMO", $datosModelo["abo_PRESTAMO"], PDO::PARAM_INT);
		$stmt -> bindParam(":abo_Monto", $datosModelo["abo_Monto"], PDO::PARAM_INT);
		$stmt -> bindParam(":abo_Fecha", $datosModelo["abo_Fecha"], PDO::PARAM_STR);

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