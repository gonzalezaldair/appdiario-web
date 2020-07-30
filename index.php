<?php
date_default_timezone_set('America/Bogota');

require_once 'modelos/clientes.modelo.php';
require_once 'modelos/rutas.modelo.php';
require_once 'modelos/usuario.modelo.php';
require_once 'modelos/prestamos.modelo.php';
require_once 'modelos/abonos.modelo.php';


require_once 'controladores/plantilla.controlador.php';
require_once 'controladores/clientes.controlador.php';
require_once 'controladores/rutas.controlador.php';
require_once 'controladores/usuario.controlador.php';
require_once 'controladores/prestamos.controlador.php';
require_once 'controladores/abonos.controlador.php';

$template = new PlantillaControlador();
$template -> plantilla();