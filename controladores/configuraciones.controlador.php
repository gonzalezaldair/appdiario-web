<?php


class ConfiguracionesControlador
{
    public static function ctrMostrarConfiguraciones()
    {
        $respuesta = ConfiguracionesModelo::mdlMostrarConfiguraciones("configuraciones");
        return $respuesta;
    }
}