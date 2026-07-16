<?php



class GastosControlador
{



    /*=============================================
	MOSTRAR Cobros
	=============================================*/

    public static function ctrMostrarGastos($item, $valor)
    {

        $tabla = "gasto";

        return GastoModelo::mdlMostrarGastos($tabla, $item, $valor);
    }

    public static function ctrGuardarGasto()
    {
        $tabla = "gasto";
        if (isset($_POST)) {

            if (!in_array(9, $_SESSION["permisos"]) || !in_array(11, $_SESSION["permisos"])) {
                return ['codigo' => 'No tienes permisos para realizar esta accion'];
            }

            if (!preg_match('/^\d+(\.\d{1,2})?$/', $_POST["gas_Monto"])) {
                return ['codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio'];
            }

            $gas_Monto = trim($_POST["gas_Monto"]);

            $datosControlador = [
                'gas_Monto' => $gas_Monto,
                'gas_Fecha' => date("Y-m-d h:i:s"),
                'gas_Tipo' => $_POST["gas_Tipo"],
                'created_by' => $_SESSION["usuario_Id"],
                'updated_by' => $_SESSION["usuario_Id"],
            ];

            $respuestaModelo = GastoModelo::mdlguardarGasto($tabla, $datosControlador);

            if ($respuestaModelo["mensaje"] == "ok") {

                return MovimientosCajaModelo::mdlRegistrarMovimientoCaja("movimiento_caja", [
                    "mov_Observacion" => "Gasto Registrado: " . number_format($gas_Monto, 2, ",", "."),
                    "mov_Monto" => $gas_Monto,
                    "mov_Tipo" => "GASTO",
                    "created_by" => $_SESSION["usuario_Id"],
                    "mov_Referencia" => $respuestaModelo["lastInsertId"],
                    "mov_Fecha" => date("Y-m-d H:i:s")
                ]);
            }

            return $respuestaModelo;
        }
    }

    public static function ctrEliminarGasto()
    {
        $tabla = "gasto";
        if (isset($_POST["gas_Id"])) {
            if (!in_array(12, $_SESSION["permisos"])) {

                return ['codigo' => 'No tienes permisos para realizar esta accion'];
            }

            return GastoModelo::mdlActualizarGasto($tabla, [
                "gas_Id" => $_POST["gas_Id"],
                "updated_by" => $_SESSION["usuario_Id"]
            ]);
        }
    }
}