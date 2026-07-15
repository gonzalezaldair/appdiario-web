<?php
class ingresoControlador
{
	public static function ctrIngresarUsuario()
	{
		if (isset($_POST["ingresoUsuario"])) {
			if (preg_match('/^[a-zA-Z0-9-]+$/', $_POST["ingresoUsuario"]) && preg_match('/^[a-zA-Z0-9-]+$/', $_POST["ingresoPassword"])) {
				$encriptar = password_hash($_POST["ingresoPassword"], PASSWORD_DEFAULT, ['cost' => 10]);
				$datosControador = [
					"usu_Login" => $_POST["ingresoUsuario"],
					"usu_Password" => $encriptar
				];

				$respuesta = IngresoModelo::mdlingresoUsuario($datosControador, "usuario");

				if (!isset($respuesta["mensaje"])) {

					if (is_array($respuesta) && $respuesta["usu_Login"] == $_POST["ingresoUsuario"] && password_verify($_POST["ingresoPassword"], $respuesta["usu_Password"])) {

						if (!isset($_SESSION)) {
							session_start();
						}
						$_SESSION["validar"] = true;
						$_SESSION["usuario_Login"] = $respuesta["usu_Login"];
						$_SESSION["usuario_Id"] = $respuesta["usu_Id"];
						$_SESSION["usuario_Nombre"] = $respuesta["usu_Nombre"];
						$_SESSION["usuario_PERFIL"] = $respuesta["usu_Perfil"];
						$_SESSION["usuario_RUTA"] = $respuesta["usu_RUTA"];
						$permisos = ModulosControlador::ctrMostrarPermisos($respuesta["usu_Perfil"]);
						$_SESSION["cuandre_caja"] = CajasControlador::ctrConsultarCajaAbierta($respuesta["usu_Id"]);
						$_SESSION["permisos"] = array_column($permisos, "po_OPERACION");
						echo '<script> window.location = "inicio"; </script>';
					} else {

						echo '<div class="alert alert-warning alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h5><i class="icon fas fa-exclamation-triangle"></i> Advertencia!</h5> Usuario y/o Contraseña incorecctos. </div>';
					}
				} else {

					echo '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h5><i class="icon fas fa-exclamation-triangle"></i> Advertencia!</h5> Error: ' . $respuesta["mensaje"] . '</div>';
				}
			} else {

				echo '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h5><i class="icon fas fa-exclamation-triangle"></i> Advertencia!</h5> Los campos Estan vacios o ingresaron caracteres no permitidos. </div>';
			}
		}
	}
}
