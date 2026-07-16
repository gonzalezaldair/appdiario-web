<?php

require_once __DIR__ . '/../config/config.php';

class Conexion
{

    public static function conectar()
    {

        $connection = "mysql:host=" . HOST . ";dbname=" . DB . ";";

        $link = new PDO(
            $connection,
            USER,
            PASSWORD,
            array(
                PDO::ATTR_ERRMODE      => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            )
        );

        if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
            $link->exec("SET @datos = '" . $_SESSION["usuario"] . "';");
        }

        $link->exec("SET time_zone = '-5:00';");

        return $link;
    }
}
