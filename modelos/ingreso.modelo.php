<?php

require_once 'conexion.php';

class IngresoModelo
{

	public static function mdlingresoUsuario($datosModelo, $tabla)
	{

		try {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE usu_Login = :usu_Login");

			$stmt->bindParam(":usu_Login", $datosModelo["usu_Login"], PDO::PARAM_STR);

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
}
