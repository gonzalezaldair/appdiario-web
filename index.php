<?php
error_reporting(E_ALL); // ERROR / EXCEPCION

ini_set('ignore_repeated_errors', true);

ini_set('display_error', false);

ini_set('log_errors', true);

ini_set('error_log', 'php-error' . date("Y-m-d") . '.log');

/*error_log('ERRORES');*/

date_default_timezone_set('America/Bogota');

require_once 'modelos/ingreso.modelo.php';
require_once 'modelos/clientes.modelo.php';
require_once 'modelos/rutas.modelo.php';
require_once 'modelos/usuario.modelo.php';
require_once 'modelos/prestamos.modelo.php';
require_once 'modelos/abonos.modelo.php';
require_once 'modelos/modulos.modelo.php';
require_once 'modelos/reportes.modelo.php';
require_once 'modelos/cajas.modelo.php';
require_once 'modelos/gastos.modelo.php';
require_once 'modelos/movimientos-caja.modelo.php';


require_once 'controladores/ingreso.controlador.php';
require_once 'controladores/plantilla.controlador.php';
require_once 'controladores/clientes.controlador.php';
require_once 'controladores/rutas.controlador.php';
require_once 'controladores/usuario.controlador.php';
require_once 'controladores/prestamos.controlador.php';
require_once 'controladores/abonos.controlador.php';
require_once 'controladores/modulos.controlador.php';
require_once 'controladores/reportes.controlador.php';
require_once 'controladores/cajas.controlador.php';
require_once 'controladores/movimientos-caja.controlador.php';

$template = new PlantillaControlador();
$template->plantilla();
