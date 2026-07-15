<?php


class CajasControlador
{
    public static function ctrMostrarCajas($item, $valor)
    {
        $tabla = "cuadre_caja";

        $respuesta = CajasModelo::mdlMostrarCajas($tabla, $item, $valor, ["usuario" => $_SESSION["usuario_Id"], "perfil" => $_SESSION["usuario_PERFIL"]]);

        return $respuesta;
    }

    public static function ctrIniciarCaja()
    {
        $tabla = "cuadre_caja";
        if (isset($_POST)) {

            if (!in_array(34, $_SESSION["permisos"]) || !in_array(35, $_SESSION["permisos"])) {
                return ["mensaje" => "No tienes Permiso para realizar esta accion", "codigo" => "0"];
            }

            $existe = self::ctrConsultarCajaAbierta($_SESSION["usuario_Id"]);

            if ($existe) {

                return ["mensaje" => "YA tiene un cuadre de caja abierto", "codigo" => "0"];
            }

            if (!preg_match('/^[0-9]+$/', $_POST["cuc_MontoInicial"])) {
                return ["mensaje" => "El monto inicial no es válido", "codigo" => "0"];
            }

            $datosControlador = [
                'cuc_MontoInicial' => $_POST["cuc_MontoInicial"],
                'cuc_FechaInicial' => date("Y-m-d h:i:s"),
                'cuc_USUARIO' => $_SESSION["usuario_Id"],
                'cuc_RUTA' => $_SESSION["usuario_RUTA"]
            ];

            $respuestaModelo = CajasModelo::mdlIniciarCaja($tabla, $datosControlador);

            $_SESSION["cajaAbiertaId"] = $respuestaModelo["lastInsertId"];

            return $respuestaModelo;
        }
    }

    public static function ctrConsultarCajaAbierta($usuario)
    {
        return CajasModelo::mdlConsultarCajaAbierta($usuario);
    }

    public static function ctrCerrarCaja()
    {
        $tabla = "cuadre_caja";
        if (isset($_POST)) {

            if (!in_array(34, $_SESSION["permisos"]) || !in_array(35, $_SESSION["permisos"])) {
                return ["mensaje" => "No tienes Permiso para realizar esta accion", "codigo" => "0"];
            }

            $baseDiaria = $_POST["cuc_MontoInicial"];
            $gastos = self::ctrConsultarSumaGastosPorUsuarioDiaro($_SESSION["usuario_Id"]);
            $prestamos = self::ctrConsultarSumaPrestamosPorUsuarioDiaro($_SESSION["usuario_Id"]);
            $abonos = self::ctrConsultarSumaAbonosPorUsuarioDiario($_SESSION["usuario_Id"]);

            $cuc_MontoFinal = ($baseDiaria + $abonos) - ($gastos + $prestamos);

            $datosControlador = [
                'cuc_MontoFinal' => $cuc_MontoFinal,
                'cuc_FechaFinal' => date("Y-m-d h:i:s"),
                'cuc_Id' => $_POST["cuc_Id"]
            ];

            return CajasModelo::mdlCerrarCaja($tabla, $datosControlador);
        }
    }

    public static function ctrConsultarSumaAbonosPorUsuarioDiario($usuario)
    {
        $fechaActual = date("Y-m-d");
        $respuesta = CajasModelo::mdlConsultarSumaAbonosPorUsuarioDiario($usuario, $fechaActual);
        return ($respuesta) ? $respuesta[0] : 0;
    }

    public static function ctrConsultarSumaPrestamosPorUsuarioDiaro($usuario)
    {
        $fechaActual = date("Y-m-d");
        $respuesta = CajasModelo::mdlConsultarSumaPrestamosPorUsuarioDiaro($usuario, $fechaActual);
        return ($respuesta) ? $respuesta[0] : 0;
    }
    public static function ctrConsultarSumaGastosPorUsuarioDiaro($usuario)
    {
        $fechaActual = date("Y-m-d");
        $respuesta = CajasModelo::mdlConsultarSumaGastosPorUsuarioDiaro($usuario, $fechaActual);
        return ($respuesta) ? $respuesta[0] : 0;
    }
}
