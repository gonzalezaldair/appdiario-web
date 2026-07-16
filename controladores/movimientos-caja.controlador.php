<?php

class MovimientosCajaControlador
{
    public static function ctrMostrarMovimientosCaja($item, $valor)
    {
        $tabla = "movimiento_caja";

        return MovimientosCajaModelo::mdlMostrarMovimientosCaja($tabla, $item, $valor);
    }

    public static function ctrRegistrarMovimientoCaja()
    {
        $tabla = "movimiento_caja";



        if (isset($_POST)) {


            if (!(in_array(42, $_SESSION["permisos"]) || in_array(44, $_SESSION["permisos"])))  return ['codigo' => 'No tienes permisos para realizar esta accion'];

            if (!(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ,. ]+$/', $_POST["observacionMovimiento"]) && preg_match('/^[0-9.,]+$/', $_POST["montoMovimiento"]))) return ['codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio'];

            $datosMovimiento = [
                "mov_Fecha" => date("Y-m-d H:i:s"),
                "mov_Tipo" => $_POST["tipoMovimiento"],
                "mov_Monto" => $_POST["montoMovimiento"],
                "mov_Observacion" => $_POST["observacionMovimiento"],
                "mov_Referencia" => $_POST["tipoMovimiento"],
                "created_by" => $_SESSION["usuario_Id"],
                "updated_by" => $_SESSION["usuario_Id"]
            ];

            return MovimientosCajaModelo::mdlRegistrarMovimientoCaja($tabla, $datosMovimiento);
        }
    }
}