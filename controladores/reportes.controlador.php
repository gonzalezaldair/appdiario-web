<?php


class ReportesControlador
{

	public static function ctrReportePrestamosTotal($fechaInicial, $fechaFinal)
	{
		return ReportesModelo::mdlReportePrestamosTotal($fechaInicial, $fechaFinal);
	}
}
