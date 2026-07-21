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

            if (!(in_array(29, $_SESSION["permisos"]) || in_array(31, $_SESSION["permisos"]))) return ['codigo' => 'No tienes permisos para realizar esta accion'];

            if (
                filter_var(
                    $_POST["pre_Interes"],
                    FILTER_VALIDATE_INT,
                    ["options" => ["min_range" => 1]]
                ) === false
            ) {
                return ['codigo' => 'El interés debe ser un número entero mayor que cero'];
            }

            if (
                filter_var(
                    $_POST["pre_Cuotas"],
                    FILTER_VALIDATE_INT,
                    ["options" => ["min_range" => 1]]
                ) === false
            ) {
                return ['codigo' => 'El número de cuotas debe ser un número entero mayor que cero'];
            }
            if ($_POST["pre_FormaPago"] == "0") return ['codigo' => 'Debe seleccionar una forma de pago'];

            if (
                filter_var(
                    $_POST["pre_MontoPrestado"],
                    FILTER_VALIDATE_INT,
                    ["options" => ["min_range" => 1]]
                ) === false
            ) {
                return ['codigo' => 'El monto prestado debe ser un número entero mayor que cero'];
            }

            if (
                filter_var(
                    $_POST["pre_CLIENTE"],
                    FILTER_VALIDATE_INT,
                    ["options" => ["min_range" => 1]]
                ) === false
            ) {
                return ['codigo' => 'Debe seleccionar un cliente'];
            }

            $pre_Id = intval($_POST["pre_Id"]);
            $pre_Fecha = date('Y-m-d H:i:s');
            $pre_CLIENTE = intval($_POST["pre_CLIENTE"]);
            $pre_FormaPago = intval($_POST["pre_FormaPago"]);
            $pre_FormaPagoTexto = $_POST["pre_FormaPagoTexto"];
            $pre_Interes = $_POST["pre_Interes"];
            $pre_MontoPrestado = $_POST["pre_MontoPrestado"];
            $pre_Cuotas = intval($_POST["pre_Cuotas"]);
            $pre_Observaciones = preg_replace(["/[\r\n|\n|\r]+/", "/\s+/"], " ", $_POST["pre_Observaciones"]);
            $pre_MontoInteres = self::generarInteresReal($pre_Interes, $pre_MontoPrestado, $pre_Cuotas, $pre_FormaPagoTexto);

            $interesBoletas = $_SESSION["configuraciones"]["conf_ActivoBoletas"] == "Y" ? $_SESSION["configuraciones"]["conf_BoletasNumero"] : 0;

            $montoBoletas = self::generarMontoBoleta($interesBoletas, $pre_MontoPrestado);

            $datosControlador = [
                'pre_Id' => $pre_Id,
                'pre_Fecha' => $pre_Fecha,
                'pre_CLIENTE' => $pre_CLIENTE,
                'pre_FormaPago' => $pre_FormaPago,
                'pre_Interes' => $pre_Interes,
                'pre_MontoPrestado' => $pre_MontoPrestado,
                'pre_Cuotas' => $pre_Cuotas,
                'pre_Observaciones' => $pre_Observaciones . " Monto Boleta: " . number_format($montoBoletas, 0, ",", "."),
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
                    "mov_Observacion" => "Préstamo Registrado: " . number_format($pre_MontoPrestado, 0, ",", ".") . " con interes de " . $pre_Interes . "% por " . $pre_Cuotas . " cuotas",
                    "mov_Monto" => $pre_MontoPrestado - $montoBoletas,
                    "mov_Tipo" => "PRESTAMO",
                    "created_by" => $_SESSION["usuario_Id"],
                    "mov_Referencia" => $respuestaModelo["lastInsertId"],
                    "mov_Fecha" => date("Y-m-d H:i:s")
                ]);
            }
            return $respuestaModelo;
        }
    }


    private static function generarMontoBoleta($interes, $montoPrestado)
    {
        if ($interes == 0) return 0;
        return ($montoPrestado * ($interes / 100));
    }

    private static function generarInteresReal($interes, $montoPrestado, $cuotas, $formaPago)
    {
        $factor = 0;

        switch ($formaPago) {
            case "MENSUAL":
                $factor = 1;
                break;
            case "QUINCENAL":
                $factor = 0.5;
                break;
            case "SEMANAL":
                $factor = 0.25;
                break;
            case "DIARIO":
                $factor = 0.03;
                break;
        }

        $interes = $interes * ceil($cuotas * $factor);

        return $montoPrestado * (1 + $interes / 100);
    }
}