<?php

class ControladorSalida extends Controlador
{

    public function generarXML($data)
    {
        require_once "bootstrap.php";

        $consulta = $entityManager->createQuery("SELECT e FROM Entrada e");
        $resultado = $consulta->getResult();

        $conciertos = [];

        foreach ($resultado as $auxiliar) {
            if ($auxiliar->getData()->getData() == $data) {
                $concierto["data"] = $auxiliar->getData()->getData();
                $concierto["hora"] = $auxiliar->getData()->getHora();
                $concierto["titulo"] = $auxiliar->getEvent()->getTitol();
                $concierto["subtitulo"] = $auxiliar->getEvent()->getSubtitol();
                $concierto["lugar"] = $auxiliar->getLocalitzacio()->getLloc();
                $concierto["direccion"] = $auxiliar->getLocalitzacio()->getAdreca();
                $concierto["localidad"] = $auxiliar->getLocalitzacio()->getLocalitat();

                // Para eliminar duplicado
                if (! in_array($concierto, $conciertos)) {
                    array_push($conciertos, $concierto);
                }
            }
        }

        if (count($conciertos) != 0) {

            // Crear xml con dom
            $dom = new DOMDocument();
            $dom->encoding = 'utf-8';
            $dom->xmlVersion = '1.0';
            $dom->formatOutput = true;

            $xml_file_name = "conciertos-" . str_replace("/", ".", $data) . ".xml";

            $root = $dom->createElement('conciertos');

            foreach ($conciertos as $concierto) {
                $concierto_nodo = $dom->createElement('concierto');
                $attr_concierto_fecha = new DOMAttr('fecha', $data);
                $concierto_nodo->setAttributeNode($attr_concierto_fecha);
                $attr_concierto_hora = new DOMAttr('hora', $concierto["hora"]);
                $concierto_nodo->setAttributeNode($attr_concierto_hora);
                $child_nodo_titulo = $dom->createElement('titulo', $concierto["titulo"]);
                $concierto_nodo->appendChild($child_nodo_titulo);
                $child_nodo_subtitulo = $dom->createElement('subtitulo', $concierto["subtitulo"]);
                $concierto_nodo->appendChild($child_nodo_subtitulo);
                $child_nodo_lugar = $dom->createElement('lugar', $concierto["lugar"]);
                $concierto_nodo->appendChild($child_nodo_lugar);
                $attr_concierto_direccion = new DOMAttr('direccion', $concierto["direccion"]);
                $child_nodo_lugar->setAttributeNode($attr_concierto_direccion);
                $child_nodo_localidad = $dom->createElement('localidad', $concierto["localidad"]);
                $concierto_nodo->appendChild($child_nodo_localidad);

                $root->appendChild($concierto_nodo);
            }

            $dom->appendChild($root);

            $xml_string = $dom->saveXML();
            header("Content-type: text/xml");
            echo $xml_string;
        } else {
            $error = "No hay conciertos para la fecha.";
            $vista = new ErrorVista($error);
            $vista->show();
        }
    }
}

?>