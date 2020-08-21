<?php


class ReportesModelo{

	public static function mdlReportePrestamosTotal($fechaInicial, $fechaFinal)
	{
		try {

			if ($fechaFinal == null) {

				$stmt = Conexion::conectar()->prepare("SELECT sum(T1.pre_MontoInteres - T1.pre_MontoPrestado) as INTERES, sum(T1.pre_MontoPrestado) AS PRESTADO, sum(IFNULL(((T1.pre_MontoInteres) -(SELECT SUM(Abo_Monto) FROM abono WHERE abono.abo_PRESTAMO = T1.pre_Id ) ), T1.pre_MontoInteres ) )AS SALDO FROM prestamo T1");

				$stmt -> execute();

				return $stmt -> fetch();

			}else if($fechaInicial == $fechaFinal){

				$stmt = Conexion::conectar()->prepare("SELECT sum(T1.pre_MontoInteres - T1.pre_MontoPrestado) as INTERES, sum(T1.pre_MontoPrestado) AS PRESTADO, sum(IFNULL(((T1.pre_MontoInteres) -(SELECT SUM(Abo_Monto) FROM abono WHERE abono.abo_PRESTAMO = T1.pre_Id ) ), T1.pre_MontoInteres ) )AS SALDO FROM prestamo T1 WHERE T1.pre_Fecha LIKE '%$fechaFinal%'");

				$stmt -> execute();

				return $stmt -> fetch();

			}else{

				$fechaActual = new DateTime();
				$fechaActual ->add(new DateInterval("P1D"));
				$fechaActualMasUno = $fechaActual->format("Y-m-d");

				$fechaFinal2 = new DateTime($fechaFinal);
				$fechaFinal2 ->add(new DateInterval("P1D"));
				$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

				$stmt = Conexion::conectar()->prepare("SELECT sum(T1.pre_MontoInteres - T1.pre_MontoPrestado) as INTERES, sum(T1.pre_MontoPrestado) AS PRESTADO, sum(IFNULL(((T1.pre_MontoInteres) -(SELECT SUM(Abo_Monto) FROM abono WHERE abono.abo_PRESTAMO = T1.pre_Id ) ), T1.pre_MontoInteres ) )AS SALDO FROM prestamo T1 WHERE T1.pre_Fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

				$stmt -> execute();

				return $stmt -> fetch();

			}

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