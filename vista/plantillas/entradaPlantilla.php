<?php
$html = '<body>
    <div id="entrada">
        <img id="logo" src="' . __DIR__ . '/../img/logo.png">
        <img id="imgGrupo" src="' . $this->datos["imagen"] . '">
        <h1 id="grupo">' . $this->datos["titulo"] . '</h1>
        <h3 id="subtitulo">' . $this->datos["subtitulo"] . '</h3>
        <div id="datos">
            <p id="info">#' . $this->datos["id"] . ' - DNI: ' . $this->datos["dni"] . ' - <span id="subinfo">' . $this->datos["fecha"] . ' ' . $this->datos["hora"] . ' - B:' . $this->datos["butaca"] . ' F:' . $this->datos["fila"] . ' ' . $this->datos["zona"] . '</span></p>
            <p id="subtexto">' . $this->datos["lugar"] . ' - ' . $this->datos["direccion"] . ' - ' . $this->datos["localidad"] . '</p>
        </div>
        <div id="recortar">
            <barcode id="qr" code="' . $uri . '" size="0.7" type="QR" class="barcode" />
            <barcode id="barra" code="' . $this->datos["ref_externa"] . '" size="0.8" height="2.2" type="C128B" class="barcode" />
        </div>
    </div>
</body>';
?>