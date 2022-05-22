<?php

class ControladorEntrada extends Controlador
{

    public function generarEntrada($ref)
    {
        //Se recoge el entity manager.
        require_once "bootstrap.php";

        //Se crea una consulta con el parámetro
        $consulta = $entityManager->createQuery("SELECT e FROM Entrada e WHERE e.id = ?1");
        $consulta->setParameter(1, $ref);
        $resultado = $consulta->getResult();

        //Se confirma la id del objeto
        foreach ($resultado as $auxiliar) {
            if ($auxiliar->getId() == $ref) {
                $entrada = $auxiliar;
            }
        }

        //Se extrae la informacion del objeto
        if (isset($entrada)) {

            $datos["id"] = $entrada->getId();
            $datos["fila"] = $entrada->getFila();
            $datos["butaca"] = $entrada->getButaca();
            $datos["dni"] = $entrada->getCompardor();
            $datos["zona"] = $entrada->getZona()->getDescripcio();
            $datos["fecha"] = $entrada->getData()->getData();
            $datos["hora"] = $entrada->getData()->getHora();
            $datos["titulo"] = $entrada->getEvent()->getTitol();
            $datos["subtitulo"] = $entrada->getEvent()->getSubtitol();
            $datos["imagen"] = $entrada->getEvent()->getImatge();
            $datos["lugar"] = $entrada->getLocalitzacio()->getLloc();
            $datos["direccion"] = $entrada->getLocalitzacio()->getAdreca();
            $datos["localidad"] = $entrada->getLocalitzacio()->getLocalitat();
            $datos["banco"] = $entrada->getPagament()->getBanc();
            $datos["ref_externa"] = $entrada->getPagament()->getReferenciaExterna();
            $datos["fecha_conf"] = $entrada->getPagament()->getData();
            $datos["estado"] = $entrada->getPagament()->getEstat();

            //Se intenta hacer un PDF con los datos recogidos.
            try {
                //se genera un Mpdf
                $mpdf = new \Mpdf\Mpdf();
                
                //se establece una contraseña 
                $mpdf->SetProtection(array(), '1234');
                //watermark
                $mpdf->SetWatermarkImage(__DIR__ . "/../vista/img/logo.png", '0.1', array(100,100),array(57,20));
                $mpdf->showWatermarkImage = true;
                //se establece estilo
                $css = file_get_contents(__DIR__ . "/../vista/css/css.css");
                $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS); //Parses the $html as styles and stylesheets only
                //se genera la vista
                $vista = new EntradaVista($datos);
                //se establece la vista como html para el pdf.
                $mpdf->WriteHTML($vista->show(), \Mpdf\HTMLParserMode::HTML_BODY); //Parses the $html as output elements only
                //que el output sea un archivo descargable
                $mpdf->Output('entrada.pdf', "I"); //I de INLINE. Establece la forma de descarga.
            } catch (\Mpdf\MpdfException $e) {
                $error = $e->getMessage();
                $vista = new ErrorVista($error);
                $vista->show();
            }
        } else {
            $error = "No se ha encontrado la referencia de la entrada. Introduzca nuevos parámetros: ";
            $vista = new ErrorVista($error);
            $vista->show();
        }
    }
}

?>