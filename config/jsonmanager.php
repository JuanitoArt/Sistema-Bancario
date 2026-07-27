<?php

class JsonManager
{


    public static function leer($archivo)
    {

        if (!file_exists($archivo)) {

            file_put_contents(
                $archivo,
                json_encode([], JSON_PRETTY_PRINT)
            );

        }


        $contenido = file_get_contents($archivo);


        $datos = json_decode($contenido, true);


        return $datos ?? [];

    }



    public static function guardar($archivo, $datos)
    {

        file_put_contents(
            $archivo,
            json_encode(
                $datos,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );

    }



    public static function siguienteId($datos)
    {

        if(empty($datos)){

            return 1;

        }


        $ids = array_column($datos, "id");


        return max($ids) + 1;

    }


}

?>