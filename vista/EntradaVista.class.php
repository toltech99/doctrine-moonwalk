<?php

class EntradaVista
{

    private $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    function show()
    {
        $uri = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        include_once __DIR__ . "/plantillas/entradaPlantilla.php";

        return $html;
    }
}

?>