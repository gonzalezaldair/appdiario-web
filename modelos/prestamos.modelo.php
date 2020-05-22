<?php

require_once 'conexion.php';

class PrestamosModelo{


	/*=============================================
	MOSTRAR Prestamos
	=============================================*/


	public static function mdlMostrarPrestamos($tabla, $item, $valor)
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

	public static function mdldatatableprestamos()
	{

		$stmt = Conexion::conectar()->prepare("SELECT T1.pre_Id,T1.pre_Fecha,T1.pre_CLIENTE,cliente.cli_Nombre,
												(T1.pre_MontoInteres - T1.pre_MontoPrestado) as interes,
												formapago.frm_Nombre,T1.pre_MontoInteres,
												T1.pre_MontoPrestado,T1.pre_Cuotas,T1.pre_Observaciones,usuario.usu_Nombre ,
												( (T1.pre_MontoInteres) - ( SELECT SUM(Abo_Monto) FROM abono WHERE abono.abo_PRESTAMO = T1.pre_Id ))as Saldo
												FROM prestamo T1
												INNER JOIN cliente ON T1.pre_CLIENTE = cliente.cli_Id
												INNER JOIN formapago ON T1.pre_FormaPago = formapago.frm_Id
												INNER JOIN usuario ON T1.pre_USUARIO = usuario.usu_Id
												ORDER BY T1.pre_Id ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}
}