<?php

require_once 'conexion.php';

class ModulosModelo{


	/*=============================================
	MOSTRAR MODULOS
	=============================================*/


	public static function mdlMostrarModulos($tabla, $item, $valor, $orden)
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

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY mod_Nombre $orden");

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

	public static function mdlMostrarModulosPersonalizados($usuario)
	{
		try {

			$stmt = Conexion::conectar()->prepare("SELECT T3.* FROM perfiles T INNER JOIN perfil_operaciones T1 ON T.per_Id = T1.po_PERFIL INNER JOIN operaciones T2 ON T1.po_OPERACION = T2.ope_Id INNER JOIN modulos T3 ON T2.ope_MODULO = T3.mod_Id WHERE T.per_Id = $usuario AND T2.ope_Nombre = 'LEER'");

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

		$stmt = null;
	}

	public static function mdlMostrarPermisos($perfil)
	{
		try {

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT T1.*, T2.ope_Nombre FROM perfiles T INNER JOIN perfil_operaciones T1 ON T.per_Id = T1.po_PERFIL INNER JOIN operaciones T2 ON T1.po_OPERACION = T2.ope_Id INNER JOIN modulos T3 ON T2.ope_MODULO = T3.mod_Id WHERE T.per_Id = $perfil");

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

		$stmt = null;
	}
}