<?php

class ErrorVista
{

    private $error;

    public function __construct($error)
    {
        $this->error = $error;
    }

    function show()
    {
        include_once __DIR__ . "/plantillas/errorPlantilla.php";

        echo $html;
    }
}

?>