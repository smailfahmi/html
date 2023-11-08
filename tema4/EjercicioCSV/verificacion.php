<?php
function existe($name)
{

    if (file_exists($name)) {
        return true;
    } else {
        $ficheroCreado = fopen($name, 'w');
        $texto = "linea creada automaticamente";
        fwrite($ficheroCreado, $texto);
        if (file_exists($name)) {
            return true;
        } else
            return false;
    }
}