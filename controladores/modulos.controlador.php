<?php



class ModulosControlador
{



	/*=============================================
	MOSTRAR MODULOS
	=============================================*/

	public static function ctrMostrarModulos($item, $valor, $orden)
	{

		$tabla = "modulos";

		return ModulosModelo::mdlMostrarModulos($tabla, $item, $valor, $orden);
	}

	public static function ctrMostrarModulosPersonalizados($perrfil)
	{

		return ModulosModelo::mdlMostrarModulosPersonalizados($perrfil);
	}

	public static function ctrMostrarPermisos($perrfil)
	{
		return ModulosModelo::mdlMostrarPermisos($perrfil);
	}
}
