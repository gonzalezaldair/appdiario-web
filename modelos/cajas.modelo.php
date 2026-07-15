<?php

require_once 'conexion.php';

class CajasModelo
{
    public static function mdlMostrarCajas($tabla, $item, $valor, $usuario)
    {

        if ($item != null) {

            try {

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

                $stmt->bindParam(":" . $item, $valor);

                $stmt->execute();

                return $stmt->fetch();
            } catch (PDOException $e) {

                return [
                    'mensaje'         => $e->getMessage(),
                    'codigo'          => $e->getCode(),
                    'script'          => $e->getFile(),
                    'linea'           => $e->getLine(),
                    'excepcionprevia' => $e->getPrevious(),
                    'cadena'          => $e->__toString()
                ];
            }
        } else {

            try {

                if ($usuario["perfil"] == "1") {
                    $stmt = Conexion::conectar()->prepare("SELECT t0.* , t1.rut_Nombre,t2.usu_Nombre FROM `cuadre_caja` t0 left join ruta t1 on t0.cuc_RUTA = t1.rut_Id left join usuario t2 on t0.cuc_USUARIO = t2.usu_Id");
                } else {
                    $stmt = Conexion::conectar()->prepare("SELECT t0.* , t1.rut_Nombre,t2.usu_Nombre FROM cuadre_caja t0 left join ruta t1 on t0.cuc_RUTA = t1.rut_Id left join usuario t2 on t0.cuc_USUARIO = t2.usu_Id where T0.cuc_USUARIO = " . $usuario["usuario"]);
                }

                $stmt->execute();

                return $stmt->fetchAll();
            } catch (PDOException $e) {

                return [
                    'mensaje'         => $e->getMessage(),
                    'codigo'          => $e->getCode(),
                    'script'          => $e->getFile(),
                    'linea'           => $e->getLine(),
                    'excepcionprevia' => $e->getPrevious(),
                    'cadena'          => $e->__toString()
                ];
            }
        }
    }

    public static function mdlIniciarCaja($tabla, $datosModelo)
    {
        try {

            $conexion = Conexion::conectar();

            $stmt = $conexion->prepare("INSERT INTO $tabla(cuc_RUTA, cuc_USUARIO,cuc_FechaInicial,cuc_MontoInicial) VALUES (:cuc_RUTA, :cuc_USUARIO,:cuc_FechaInicial,:cuc_MontoInicial)");

            $stmt->bindParam(":cuc_RUTA", $datosModelo["cuc_RUTA"], PDO::PARAM_INT);
            $stmt->bindParam(":cuc_USUARIO", $datosModelo["cuc_USUARIO"], PDO::PARAM_INT);
            $stmt->bindParam(":cuc_FechaInicial", $datosModelo["cuc_FechaInicial"], PDO::PARAM_STR);
            $stmt->bindParam(":cuc_MontoInicial", $datosModelo["cuc_MontoInicial"], PDO::PARAM_STR);

            $stmt->execute();

            $lastInsertId = $conexion->lastInsertId();

            $stmt = null;

            return ["mensaje" => "ok", "lastInsertId" => $lastInsertId];
        } catch (PDOException $e) {

            return [
                'mensaje'         => $e->getMessage(),
                'codigo'          => $e->getCode(),
                'script'          => $e->getFile(),
                'linea'           => $e->getLine(),
                'excepcionprevia' => $e->getPrevious(),
                'cadena'          => $e->__toString()
            ];
        }
    }

    public static function mdlCerrarCaja($tabla, $datosModelo)
    {
        try {

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla set cuc_MontoFinal = :cuc_MontoFinal, cuc_FechaFinal = :cuc_FechaFinal, cuc_Estado = 1 WHERE cuc_Id = :cuc_Id ");

            $stmt->bindParam(":cuc_MontoFinal", $datosModelo["cuc_MontoFinal"], PDO::PARAM_STR);
            $stmt->bindParam(":cuc_FechaFinal", $datosModelo["cuc_FechaFinal"], PDO::PARAM_STR);
            $stmt->bindParam(":cuc_Id", $datosModelo["cuc_Id"], PDO::PARAM_INT);

            $stmt->execute();

            $stmt = null;

            return ['mensaje' => "ok"];
        } catch (PDOException $e) {

            return [
                'mensaje'         => $e->getMessage(),
                'codigo'          => $e->getCode(),
                'script'          => $e->getFile(),
                'linea'           => $e->getLine(),
                'excepcionprevia' => $e->getPrevious(),
                'cadena'          => $e->__toString()
            ];
        }
    }

    public static function mdlConsultarCajaAbierta($usuario)
    {
        try {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM cuadre_caja WHERE cuc_USUARIO = :usuario and cuc_Estado = 0");

            $stmt->bindParam(":usuario", $usuario);

            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {

            return [
                'mensaje'         => $e->getMessage(),
                'codigo'          => $e->getCode(),
                'script'          => $e->getFile(),
                'linea'           => $e->getLine(),
                'excepcionprevia' => $e->getPrevious(),
                'cadena'          => $e->__toString()
            ];
        }
    }

    public static function mdlConsultarSumaAbonosPorUsuarioDiario($usuario, $fecha)
    {
        try {

            $stmt = Conexion::conectar()->prepare("SELECT sum(abo_Monto) as Abonos FROM abono WHERE abo_USUARIO = :usuario and date(abo_Fecha) = :fecha group by abo_Usuario");

            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":fecha", $fecha);

            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {

            return [
                'mensaje'         => $e->getMessage(),
                'codigo'          => $e->getCode(),
                'script'          => $e->getFile(),
                'linea'           => $e->getLine(),
                'excepcionprevia' => $e->getPrevious(),
                'cadena'          => $e->__toString()
            ];
        }
    }

    public static function mdlConsultarSumaPrestamosPorUsuarioDiaro($usuario, $fecha)
    {
        try {

            $stmt = Conexion::conectar()->prepare("SELECT sum(pre_MontoPrestado) as Prestamos FROM prestamo WHERE pre_USUARIO = :usuario and date(pre_Fecha) = :fecha group by pre_Usuario");

            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":fecha", $fecha);

            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {

            return [
                'mensaje'         => $e->getMessage(),
                'codigo'          => $e->getCode(),
                'script'          => $e->getFile(),
                'linea'           => $e->getLine(),
                'excepcionprevia' => $e->getPrevious(),
                'cadena'          => $e->__toString()
            ];
        }
    }

    public static function mdlConsultarSumaGastosPorUsuarioDiaro($usuario, $fecha)
    {
        try {

            $stmt = Conexion::conectar()->prepare("SELECT sum(gas_Monto) as Gastos FROM gasto WHERE gas_USUARIO = :usuario and date(gas_Fecha) = :fecha group by gas_USUARIO");

            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":fecha", $fecha);

            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {

            return [
                'mensaje'         => $e->getMessage(),
                'codigo'          => $e->getCode(),
                'script'          => $e->getFile(),
                'linea'           => $e->getLine(),
                'excepcionprevia' => $e->getPrevious(),
                'cadena'          => $e->__toString()
            ];
        }
    }
}
