<?php
date_default_timezone_set('America/Bogota');

include 'modelos/config.php';

require_once 'controladores/plantilla.controlador.php';


$template = new PlantillaControlador();
$template -> plantilla();