<?php
function enviado()
{
    if (isset($_REQUEST['Enviar'])) {
        return true;
    }
    return false;
}
function textoVacio($variable)
{
    if (isset($_REQUEST[$variable])) {
        echo "hecho";
    }
}
