<?php

// Control de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "config/ini-config.php";
require_once __DIR__ . '/vendor/autoload.php';

$app = new ControladorFrontal();
$app->run();


?>