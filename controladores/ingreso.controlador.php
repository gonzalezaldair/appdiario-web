<?php
class ingresoControlador
{
	public static function ctrIngresarUsuario()
	{
		if(isset($_POST["ingresoUsuario"]))
		{
			if(preg_match('/^[a-zA-Z0-9-]+$/', $_POST["ingresoUsuario"]) && preg_match('/^[a-zA-Z0-9-]+$/', $_POST["ingresoPassword"]))
			{
				//$encriptar = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				$encriptar = password_hash($_POST["ingresoPassword"], PASSWORD_DEFAULT, ['cost' => 10]);
				$datosControador = array(
					"usu_Login"=>$_POST["ingresoUsuario"],
					"usu_Password"=>$encriptar
				);

				$respuesta = IngresoModelo::mdlingresoUsuario($datosControador, "usuario");

				$usuarioActual = trim($_POST["ingresoUsuario"]);

				if (!isset($respuesta["mensaje"])) {

					if(is_array($respuesta) &&$respuesta["usu_Login"] == $_POST["ingresoUsuario"] && password_verify($_POST["ingresoPassword"], $respuesta["usu_Password"]))
					{

						session_start();
						$_SESSION["validar"] = true;
						$_SESSION["usuario_Login"] = $respuesta["usu_Login"];
						$_SESSION["usuario_Id"] = $respuesta["usu_Id"];
						$_SESSION["usuario_Nombre"] = $respuesta["usu_Nombre"];
						$_SESSION["usuario_PERFIL"] = $respuesta["usu_Perfil"];
						$_SESSION["permisos"][] = array();
						$permisos = ModulosControlador::ctrMostrarPermisos($respuesta["usu_Perfil"]);
						for ($i=0; $i < count($permisos); $i++) {
							$_SESSION["permisos"][$i] = $permisos[$i]["po_OPERACION"];
						}
						//$_SESSION["modulos_permisos"] = ModulosControlador::ctrMostrarModulosPersonalizados($respuesta["usu_Id"]);
						echo '<script> window.location = "inicio"; </script>';

					}else{

						echo '<div class="alert alert-warning alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h5><i class="icon fas fa-exclamation-triangle"></i> Advertencia!</h5> Usuario y/o Contraseña incorecctos. </div>';
					}
				}else{

					echo '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h5><i class="icon fas fa-exclamation-triangle"></i> Advertencia!</h5> Error: '.$respuesta["codigo"].'</div>';
				}

			}else{

				echo '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h5><i class="icon fas fa-exclamation-triangle"></i> Advertencia!</h5> Los campos Estan vacios o ingresaron caracteres no permitidos. </div>';
			}
		}
	}
}