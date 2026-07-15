<?php

class MovimientosCajaControlador
{
    public static function ctrMostrarMovimientosCaja($item, $valor)
    {
        $tabla = "movimiento_caja";

        $respuesta = MovimientosCajaModelo::mdlMostrarMovimientosCaja($tabla, $item, $valor, ["usuario" => $_SESSION["usuario_Id"], "perfil" => $_SESSION["usuario_PERFIL"]]);

        return $respuesta;
    }

    public static function ctrRegistrarMovimientoCaja()
    {
        $tabla = "movimiento_caja";


        if (isset($_POST)) {
            $datosMovimiento = array(
                "mov_Fecha" => date("Y-m-d H:i:s"),
                "mov_Tipo" => $_POST["tipoMovimiento"],
                "mov_Monto" => $_POST["montoMovimiento"],
                "mov_Observacion" => $_POST["observacionMovimiento"],
                "mov_Usuario" => $_SESSION["usuario_Id"]
            );

            $respuesta = MovimientosCajaModelo::mdlRegistrarMovimientoCaja($tabla, $datosMovimiento);

            return $respuesta;
        }
    }
}
