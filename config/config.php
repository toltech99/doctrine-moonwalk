<?php
// Configuració de l'aplicació
// Accés a la base de dades
$dbParams = [
    'driver' => 'pdo_mysql',
    'host' => '127.0.0.1',
    'dbname' => 'entrades',
    'user' => 'usr_consulta', // o 'usr_generic': l'usuari ha de tenir permisos de SELECT a la base de dades.
    'password' => 'Thico@2020'
];

// La contrasenya per obrir el PDF s'estableix a ControladorEntrada.class.php, Línia 50: $mpdf->SetProtection(array(), '1234');

// Estamos en modo desarrollo?
$dev = true;

?>