<?php

/*
 * Clase base de los controladores
 *
 * Aquí definimos las propiedades y métodos comunes a todos
 *
 */
class Controlador
{

    function sanitize($input)
    {
        $search = array(
            '@<script[^>]*?>.*?</script>@si', // Elimina javascript
            '@<[\/\!]*?[^<>]*?>@si', // Elimina les etiquetes HTML
            '@<style[^>]*?>.*?</style>@siU', // Elimina les etiquetes d'estil
            '@<![\s\S]*?--[ \t\n\r]*>@' // Elimina els comentaris multi-linia
        );

        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $input[$var] = $this->sanitize($val);
            }
        } else {
            $input = preg_replace($search, "", htmlspecialchars(stripslashes(trim($input))));
            // $output = mysql_real_escape_string ( $input );
        }

        $input = trim($input, '/'); // Elimina la barra del final, si la hubiere.
        $input = filter_var($input, FILTER_SANITIZE_URL);

        return $input;
    }

    function comprobarControlador($nombre_controlador)
    {
        if (file_exists(__DIR__ . "/$nombre_controlador.class.php")) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        return $resultado;
    }

    function comprobarMetodo($controlador, $accion)
    {
        if (method_exists($controlador, $accion)) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        return $resultado;
    }
}

?>