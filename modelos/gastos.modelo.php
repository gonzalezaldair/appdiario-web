<?php

require_once 'conexion.php';

class GastoModelo
{


    /*=============================================
	MOSTRAR Cobros
	=============================================*/


    public static function mdlMostrarGastos($tabla, $item, $valor)
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

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

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

    /*=============================================
				GUARDAR COBROS
	=============================================*/

    public static function mdlguardarGasto($tabla, $datosModelo)
    {
        try {

            $conexion = Conexion::conectar();

            $stmt = $conexion->prepare("INSERT INTO $tabla (gas_Monto, gas_Fecha, gas_Tipo,gas_USUARIO,gas_CUADRE_CAJA) VALUES (:gas_Monto, :gas_Fecha, :gas_Tipo,:gas_USUARIO,:gas_CUADRE_CAJA)");
            $stmt->bindParam(":gas_Monto", $datosModelo["gas_Monto"], PDO::PARAM_STR);
            $stmt->bindParam(":gas_Fecha", $datosModelo["gas_Fecha"], PDO::PARAM_STR);
            $stmt->bindParam(":gas_Tipo", $datosModelo["gas_Tipo"], PDO::PARAM_STR);
            $stmt->bindParam(":gas_USUARIO", $datosModelo["gas_USUARIO"], PDO::PARAM_INT);
            $stmt->bindParam(":gas_CUADRE_CAJA", $datosModelo["gas_CUADRE_CAJA"], PDO::PARAM_INT);

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

    /*=============================================
				ACTUALIZAR COBROS
	=============================================*/

    public static function mdlActualizarGasto($tabla, $datosModelo)
    {

        try {

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET gas_Cancelado= 'Y' WHERE gas_Id = :gas_Id");
            $stmt->bindParam(":gas_Id", $datosModelo, PDO::PARAM_INT);

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
