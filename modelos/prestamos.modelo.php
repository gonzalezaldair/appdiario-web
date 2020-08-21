<?php

require_once 'conexion.php';

class PrestamosModelo{


	/*=============================================
	MOSTRAR Prestamos
	=============================================*/


	public static function mdlMostrarPrestamos($tabla, $item, $valor)
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

	public static function mdldatatableprestamos($usuario)
	{

		try {

			$stmt = Conexion::conectar()->prepare("SELECT T1.pre_Id,T1.pre_Fecha,T1.pre_CLIENTE,cliente.cli_Nombre, (T1.pre_MontoInteres - T1.pre_MontoPrestado) as interes, formapago.frm_Nombre,T1.pre_MontoInteres, T1.pre_MontoPrestado,T1.pre_Cuotas,T1.pre_Observaciones,usuario.usu_Nombre , IFNULL(( (T1.pre_MontoInteres) - ( SELECT SUM(Abo_Monto) FROM abono WHERE abono.abo_PRESTAMO = T1.pre_Id )), T1.pre_MontoInteres) as Saldo FROM prestamo T1 INNER JOIN cliente ON T1.pre_CLIENTE = cliente.cli_Id INNER JOIN formapago ON T1.pre_FormaPago = formapago.frm_Id INNER JOIN usuario ON T1.pre_USUARIO = usuario.usu_Id WHERE T1.pre_USUARIO = $usuario ORDER BY T1.pre_Id DESC");

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


	public static function mdlguardarPrestamo($tabla,$datosModelo)
	{
		try {

			$fecha = date("Y-m-d H:i:s");
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(pre_Fecha,pre_CLIENTE, pre_FormaPago, pre_Interes, pre_MontoPrestado, pre_MontoInteres, pre_Cuotas, pre_Observaciones, pre_USUARIO) VALUES (:pre_Fecha,:pre_CLIENTE, :pre_FormaPago, :pre_Interes, :pre_MontoPrestado, :pre_MontoInteres, :pre_Cuotas, :pre_Observaciones, :pre_USUARIO)");

			$stmt -> bindParam(":pre_Fecha", $fecha, PDO::PARAM_STR);
			$stmt -> bindParam(":pre_CLIENTE", $datosModelo["pre_CLIENTE"], PDO::PARAM_INT);
			$stmt -> bindParam(":pre_FormaPago", $datosModelo["pre_FormaPago"], PDO::PARAM_INT);
			$stmt -> bindParam(":pre_Interes", $datosModelo["pre_Interes"], PDO::PARAM_INT);
			$stmt -> bindParam(":pre_MontoPrestado", $datosModelo["pre_MontoPrestado"], PDO::PARAM_INT);
			$stmt -> bindParam(":pre_MontoInteres", $datosModelo["pre_MontoInteres"], PDO::PARAM_INT);
			$stmt -> bindParam(":pre_Cuotas", $datosModelo["pre_Cuotas"], PDO::PARAM_INT);
			$stmt -> bindParam(":pre_Observaciones", $datosModelo["pre_Observaciones"], PDO::PARAM_STR);
			$stmt -> bindParam(":pre_USUARIO", $datosModelo["pre_USUARIO"], PDO::PARAM_INT);

			$stmt->execute();

			$stmt = null;

			$arrayName = array(
				'mensaje' => 'ok'
			);

			return $arrayName;

		} catch (PDOException $e) {

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

	public static function mdlactualizarPrestamo($tabla,$datosModelo)
	{

		try {

			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pre_FormaPago=:pre_FormaPago,pre_Interes=:pre_Interes,pre_MontoInteres=:pre_MontoInteres,pre_Cuotas=:pre_Cuotas,pre_Observaciones=:pre_Observaciones,pre_USUARIO=:pre_USUARIO WHERE pre_Id = :id");

			$stmt -> bindParam(":pre_FormaPago", $datosModelo["pre_FormaPago"], PDO::PARAM_INT);
			$stmt -> bindParam(":pre_Interes", $datosModelo["pre_Interes"], PDO::PARAM_INT);
			$stmt -> bindParam(":pre_MontoInteres", $datosModelo["pre_MontoInteres"], PDO::PARAM_INT);
			$stmt -> bindParam(":pre_Cuotas", $datosModelo["pre_Cuotas"], PDO::PARAM_INT);
			$stmt -> bindParam(":pre_Observaciones", $datosModelo["pre_Observaciones"], PDO::PARAM_STR);
			$stmt -> bindParam(":pre_USUARIO", $datosModelo["pre_USUARIO"], PDO::PARAM_INT);
			$stmt -> bindParam(":id", $datosModelo["pre_Id"], PDO::PARAM_INT);

			$stmt->execute();

			$stmt = null;

			$arrayName = array(
				'mensaje' => 'ok'
			);

			return $arrayName;

		} catch (PDOException $e) {

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