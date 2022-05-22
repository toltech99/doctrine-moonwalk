<?php

class ControladorFrontal extends Controlador
{

    function run()
    {
        if (isset($_GET['ref'])) {
            $ref = $this->sanitize($_GET['ref']);

            $nombre_controlador = "ControladorEntrada";
            $accion = "generarEntrada";

            if ($this->comprobarControlador($nombre_controlador)) {
                $controlador = new $nombre_controlador();
                if ($this->comprobarMetodo($controlador, $accion)) {
                    $controlador->$accion($ref);
                } else {
                    $error = "La acción no existe.";
                    $vista = new ErrorVista($error);
                    $vista->show();
                }
            } else {
                $error = "El controlador no existe.";
                $vista = new ErrorVista($error);
                $vista->show();
            }
        } else if (isset($_GET['data'])) {
            $data = $this->sanitize($_GET['data']);

            $nombre_controlador = "ControladorSalida";
            $accion = "generarXML";

            if ($this->comprobarControlador($nombre_controlador)) {
                $controlador = new $nombre_controlador();
                if ($this->comprobarMetodo($controlador, $accion)) {
                    $controlador->$accion($data);
                } else {
                    $error = "La acción establecida no existe. Introduzca parámetros:";
                    $vista = new ErrorVista($error);
                    $vista->show();
                }
            } else {
                $error = "El controlador establecido no existe. Introduzca parámetros:";
                $vista = new ErrorVista($error);
                $vista->show();
            }
        } else {
            $error = "Introduzca parámetros:";
            $vista = new ErrorVista($error);
            $vista->show();
        }
    }
    
}

?>