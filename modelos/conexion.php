<?php
//require_once 'config.php';
class Conexion
{

	public static function conectar()
	{

		/*$link = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".BD,
						USUARIO_BD,
						PASSWORD_BD,
						array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		                      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
						);

		return $link;*/

		$link = new PDO(
			"mysql:host=localhost;dbname=appdiario",
			"root",
			"",
			[
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
			]
		);

		return $link;
	}
}
