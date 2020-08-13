<?php

require_once 'conexion.php';

class RutasModelo{


	/*=============================================
	MOSTRAR Rutas
	=============================================*/


	public static function mdlMostrarRutas($tabla, $item, $valor)
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
				GUARDAR RUTAS
	=============================================*/

	public static function mdlguardarRutas($tabla,$datosModelo)
	{
		try {

			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (rut_Codigo, rut_Nombre, rut_COBRO) VALUES (:codigo, :nombre,:cobro)");
			$stmt -> bindParam(":codigo", $datosModelo["rut_Codigo"], PDO::PARAM_STR);
			$stmt -> bindParam(":nombre", $datosModelo["rut_Nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":cobro", $datosModelo["rut_Cobro"], PDO::PARAM_INT);

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
				ACTUALIZAR RUTAS
	=============================================*/

	public static function mdlactualizarRutas($tabla,$datosModelo)
	{
		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET rut_Nombre=:nombre,rut_COBRO=:cobro,rut_Activo=:estado WHERE rut_Id = :id");
			$stmt -> bindParam(":nombre", $datosModelo["rut_Nombre"], PDO::PARAM_STR);
			$stmt -> bindParam(":cobro", $datosModelo["rut_Cobro"], PDO::PARAM_INT);
			$stmt -> bindParam(":estado", $datosModelo["rut_Activo"], PDO::PARAM_INT);
			$stmt -> bindParam(":id", $datosModelo["rut_Id"], PDO::PARAM_INT);
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
				ELIMINAR RUTAS
	=============================================*/

	public static function mdlEliminarRutas($tabla,$item,$valor)
	{
		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET rut_Activo= 0 WHERE $item = :$item");
			$stmt -> bindParam(":".$item,$valor, PDO::PARAM_INT);

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