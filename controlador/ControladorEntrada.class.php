<?php

class ControladorEntrada extends Controlador
{

    public function generarEntrada($ref)
    {
        require_once "bootstrap.php";

        $consulta = $entityManager->createQuery("SELECT e FROM Entrada e WHERE e.id = ?1");
        $consulta->setParameter(1, $ref);
        $resultado = $consulta->getResult();

        foreach ($resultado as $auxiliar) {
            // Doble check!
            if ($auxiliar->getId() == $ref) {
                $entrada = $auxiliar;
            }
        }

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

            try {
                $mpdf = new \Mpdf\Mpdf();
                $mpdf->SetProtection(array(), '123456');
                $mpdf->SetWatermarkImage(__DIR__ . "/../vista/img/logo.png", '0.1', array(100,100),array(57,20));
                $mpdf->showWatermarkImage = true;

                $css = file_get_contents(__DIR__ . "/../vista/css/css.css");
                $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);

                $vista = new EntradaVista($datos);
                $mpdf->WriteHTML($vista->show(), \Mpdf\HTMLParserMode::HTML_BODY);

                $mpdf->Output('filename.pdf', "I");
            } catch (\Mpdf\MpdfException $e) {
                $error = $e->getMessage();
                $vista = new ErrorVista($error);
                $vista->show();
            }
        } else {
            $error = "No se ha encontrado la referencia.";
            $vista = new ErrorVista($error);
            $vista->show();
        }
    }
}

?>