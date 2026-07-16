<?php

require_once 'conexion.php';

class ClientesModelo
{


    public static function mdlMostrarClientes($tabla, $item, $valor)
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


    public static function mdlLiveSearch($tabla, $item, $valor)
    {

        try {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE cli_Cedula LIKE :cli_Cedula or cli_Celular LIKE :cli_Cedula");

            $valor = "%" . trim($valor) . "%";

            $stmt->bindParam(":cli_Cedula", $valor, PDO::PARAM_STR);

            // Ejecutar la consulta
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public static function mdlGuardarClientes($tabla, $datosModelo)
    {
        try {

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cli_Cedula, cli_Nombre, cli_Celular, cli_Direccion, cli_Correo, cli_Posicion,  cli_DiaCobro,created_by) VALUES (:cli_Cedula, :cli_Nombre, :cli_Celular, :cli_Direccion, :cli_Correo, 0,  :cli_DiaCobro,:created_by)");

            $stmt->bindParam(":cli_Cedula", $datosModelo["cli_Cedula"], PDO::PARAM_INT);
            $stmt->bindParam(":cli_Nombre", $datosModelo["cli_Nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":cli_Celular", $datosModelo["cli_Celular"], PDO::PARAM_INT);
            $stmt->bindParam(":cli_Direccion", $datosModelo["cli_Direccion"], PDO::PARAM_STR);
            $stmt->bindParam(":cli_Correo", $datosModelo["cli_Correo"], PDO::PARAM_STR);
            $stmt->bindParam(":cli_DiaCobro", $datosModelo["cli_DiaCobro"], PDO::PARAM_INT);
            $stmt->bindParam(":created_by", $datosModelo["created_by"], PDO::PARAM_INT);

            $stmt->execute();



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


    public static function mdlactualizarClientes($tabla, $datosModelo)
    {

        try {

            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET updated_by=:updated_by, cli_Nombre=:cli_Nombre, cli_Celular=:cli_Celular, cli_Direccion=:cli_Direccion, cli_Correo=:cli_Correo, cli_Posicion=:cli_Posicion, cli_DiaCobro=:cli_DiaCobro, cli_Activo=:cli_Activo  WHERE cli_Id = :id");

            $stmt->bindParam(":updated_by", $datosModelo["updated_by"], PDO::PARAM_INT);
            $stmt->bindParam(":cli_Nombre", $datosModelo["cli_Nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":cli_Celular", $datosModelo["cli_Celular"], PDO::PARAM_INT);
            $stmt->bindParam(":cli_Direccion", $datosModelo["cli_Direccion"], PDO::PARAM_STR);
            $stmt->bindParam(":cli_Correo", $datosModelo["cli_Correo"], PDO::PARAM_STR);
            $stmt->bindParam(":cli_Posicion", $datosModelo["cli_Posicion"], PDO::PARAM_INT);
            $stmt->bindParam(":cli_DiaCobro", $datosModelo["cli_DiaCobro"], PDO::PARAM_INT);
            $stmt->bindParam(":cli_Activo", $datosModelo["cli_Activo"], PDO::PARAM_INT);
            $stmt->bindParam(":id", $datosModelo["cli_Id"], PDO::PARAM_INT);


            $stmt->execute();



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