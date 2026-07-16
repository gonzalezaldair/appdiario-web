<?php



class PrestamosControlador
{



    /*=============================================
	MOSTRAR Prestamos
	=============================================*/

    public static function ctrMostrarPrestamos($item, $valor)
    {

        $tabla = "prestamo";

        $respuesta = PrestamosModelo::mdlMostrarPrestamos($tabla, $item, $valor);

        return $respuesta;
    }

    /*=============================================
	MOSTRAR DATATABLES PRESTAMOS
	=============================================*/

    public static function ctrdatatableprestamos($usuario)
    {

        $respuesta = PrestamosModelo::mdldatatableprestamos($usuario);

        return $respuesta;
    }

    public static function ctrguardarPrestamo()
    {
        $tabla = "prestamo";
        if (isset($_POST)) {
            if (in_array(29, $_SESSION["permisos"]) || in_array(31, $_SESSION["permisos"])) {
                $Observaciones = ($_POST["pre_Observaciones"] != "") ? $_POST["pre_Observaciones"] : "Sin Observaciones";

                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ,. ]+$/', $Observaciones) && preg_match('/^[0-9]+$/', $_POST["pre_CLIENTE"]) && preg_match('/^[0-9]+$/', $_POST["pre_FormaPago"]) && preg_match('/^[0-9]+$/', $_POST["pre_Interes"]) && preg_match('/^[0-9.,]+$/', $_POST["pre_MontoPrestado"]) && preg_match('/^[0-9]+$/', $_POST["pre_Cuotas"])) {
                    $pre_Id = intval($_POST["pre_Id"]);
                    $pre_Fecha = date('Y-m-d H:i:s');
                    $pre_CLIENTE = intval($_POST["pre_CLIENTE"]);
                    $pre_FormaPago = intval($_POST["pre_FormaPago"]);
                    $pre_Interes = intval($_POST["pre_Interes"]);
                    $pre_MontoPrestado = intval($_POST["pre_MontoPrestado"]);
                    $pre_Cuotas = intval($_POST["pre_Cuotas"]);
                    $pre_Observaciones = strtoupper($Observaciones);
                    $interes = ($pre_Interes > 9) ? "1." . $pre_Interes : "1.0" . $pre_Interes;
                    $pre_MontoInteres = $pre_MontoPrestado * $interes;

                    $datosControlador = [
                        'pre_Id' => $pre_Id,
                        'pre_Fecha' => $pre_Fecha,
                        'pre_CLIENTE' => $pre_CLIENTE,
                        'pre_FormaPago' => $pre_FormaPago,
                        'pre_Interes' => $pre_Interes,
                        'pre_MontoPrestado' => $pre_MontoPrestado,
                        'pre_Cuotas' => $pre_Cuotas,
                        'pre_Observaciones' => $pre_Observaciones,
                        'created_by' => $_SESSION["usuario_Id"],
                        'updated_by' => $_SESSION["usuario_Id"],
                        'pre_MontoInteres' => $pre_MontoInteres
                    ];

                    if ($pre_Id > 0) {

                        return PrestamosModelo::mdlactualizarPrestamo($tabla, $datosControlador);
                    }

                    $respuestaModelo = PrestamosModelo::mdlguardarPrestamo($tabla, $datosControlador);

                    if ($respuestaModelo["mensaje"] == "ok") {

                        return MovimientosCajaModelo::mdlRegistrarMovimientoCaja("movimiento_caja", [
                            "mov_Observacion" => "Préstamo Registrado: " . number_format($pre_MontoPrestado, 2, ",", ".") . " con interes de " . $pre_Interes . "% por " . $pre_Cuotas . " cuotas",
                            "mov_Monto" => $pre_MontoPrestado,
                            "mov_Tipo" => "PRESTAMO",
                            "created_by" => $_SESSION["usuario_Id"],
                            "mov_Referencia" => $respuestaModelo["lastInsertId"],
                            "mov_Fecha" => date("Y-m-d H:i:s")
                        ]);
                    }
                    return $respuestaModelo;
                } else {

                    return ['codigo' => 'Revisar Campos Alguno debe contener un caracter no permitido o esta vacio'];
                }
            } else {
                return ['codigo' => 'No tienes permisos para realizar esta accion'];
            }
        }
    }
}