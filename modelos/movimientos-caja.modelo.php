<?php

require_once 'conexion.php';

class MovimientosCajaModelo
{

    public static function mdlMostrarMovimientosCaja($tabla, $item, $valor)
    {
        if ($item != null) {

            try {

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

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

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY mov_Id DESC");

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

    public static function mdlRegistrarMovimientoCaja($tabla, $datosMovimiento)
    {
        try {

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (mov_Fecha, mov_Tipo, mov_Monto, mov_Observacion, mov_Referencia, created_by) VALUES (:mov_Fecha, :mov_Tipo, :mov_Monto, :mov_Observacion, :mov_Referencia, :created_by)");

            $stmt->bindParam(":mov_Fecha", $datosMovimiento["mov_Fecha"], PDO::PARAM_STR);
            $stmt->bindParam(":mov_Tipo", $datosMovimiento["mov_Tipo"], PDO::PARAM_STR);
            $stmt->bindParam(":mov_Monto", $datosMovimiento["mov_Monto"], PDO::PARAM_STR);
            $stmt->bindParam(":mov_Observacion", $datosMovimiento["mov_Observacion"], PDO::PARAM_STR);
            $stmt->bindParam(":mov_Referencia", $datosMovimiento["mov_Referencia"], PDO::PARAM_INT);
            $stmt->bindParam(":created_by", $datosMovimiento["created_by"], PDO::PARAM_INT);

            $stmt->execute();

            $stmt = null;

            return ["mensaje" => "ok"];
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