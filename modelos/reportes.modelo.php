<?php


class ReportesModelo
{

	public static function mdlReportePrestamosTotal($fechaInicial, $fechaFinal)
	{
		try {

			if ($fechaInicial == null) {

				$stmt = Conexion::conectar()->prepare("CALL `sp_reporte_caja`(null, null);");
				$stmt->execute();

				return $stmt->fetch();
			} else {

				$stmt = Conexion::conectar()->prepare("CALL `sp_reporte_caja`(:fechaInicial, :fechaFinal);");
				$stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
				$stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
				$stmt->execute();

				return $stmt->fetch();
			}
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
