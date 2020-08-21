<?php


class ReportesControlador{

	public static function ctrReportePrestamosTotal($fechaInicial, $fechaFinal)
	{
		$respuestamodelo = ReportesModelo::mdlReportePrestamosTotal($fechaInicial, $fechaFinal);

		return $respuestamodelo;
	}
}