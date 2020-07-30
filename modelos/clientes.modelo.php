<?php

require_once 'conexion.php';

class ClientesModelo{


	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/


	public static function mdlMostrarClientes($tabla, $item, $valor)
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

	public static function mdlGuardarClientes($tabla, $datosModelo)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cli_Cedula, cli_Nombre, cli_Celular, cli_Direccion, cli_Correo, cli_Posicion, cli_RUTA, cli_DiaCobro) VALUES (:cli_Cedula, :cli_Nombre, :cli_Celular, :cli_Direccion, :cli_Correo, 0, :cli_RUTA, :cli_DiaCobro)");

		$stmt -> bindParam(":cli_Cedula", $datosModelo["cli_Cedula"], PDO::PARAM_INT);
		$stmt -> bindParam(":cli_Nombre", $datosModelo["cli_Nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":cli_Celular", $datosModelo["cli_Celular"], PDO::PARAM_INT);
		$stmt -> bindParam(":cli_Direccion", $datosModelo["cli_Direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":cli_Correo", $datosModelo["cli_Correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":cli_RUTA", $datosModelo["cli_RUTA"], PDO::PARAM_INT);
		$stmt -> bindParam(":cli_DiaCobro", $datosModelo["cli_DiaCobro"], PDO::PARAM_INT);

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


	public static function mdlactualizarClientes($tabla, $datosModelo)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cli_Nombre=:cli_Nombre,cli_Celular=:cli_Celular,cli_Direccion=:cli_Direccion,cli_Correo=:cli_Correo,cli_Posicion=:cli_Posicion,cli_RUTA=:cli_RUTA,cli_DiaCobro=:cli_DiaCobro,cli_Activo=:cli_Activo  WHERE cli_Id = :id");

		$stmt -> bindParam(":cli_Nombre", $datosModelo["cli_Nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":cli_Celular", $datosModelo["cli_Celular"], PDO::PARAM_INT);
		$stmt -> bindParam(":cli_Direccion", $datosModelo["cli_Direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":cli_Correo", $datosModelo["cli_Correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":cli_Posicion", $datosModelo["cli_Posicion"], PDO::PARAM_INT);
		$stmt -> bindParam(":cli_RUTA", $datosModelo["cli_RUTA"], PDO::PARAM_INT);
		$stmt -> bindParam(":cli_DiaCobro", $datosModelo["cli_DiaCobro"], PDO::PARAM_INT);
		$stmt -> bindParam(":cli_Activo", $datosModelo["cli_Activo"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datosModelo["cli_Id"], PDO::PARAM_INT);

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