
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
    if (empty($_REQUEST[$variable])) {
        return true;
    }
    return false;
}
function validacio(&$errores)
{

    if (textoVacio('Alfabetico') && textoVacio('NumericoOpci')) {
        $errores['Alfabetico'] = "Escribe alguna letra ";
    }
    if (textoVacio('AlfabeticoOpci')) {
        $errores['AlfabeticoOpci'] = "Escribe alguna letra ";
    }
    if (textoVacio('Alfanumerico')) {
        $errores['Alfanumerico'] = "Escribe alguna letra ";
    }
    if (textoVacio('AlfanumericoOpci')) {
        $errores['AlfanumericoOpci'] = "Escribe alguna letra ";
    }
    if (textoVacio('NumericoOpci')) {
        $errores['NumericoOpci'] = "Escribe alguna letra ";
    }
    if (textoVacio('Numerico')) {
        $errores['Numerico'] = "Escribe alguna letra ";
    } else {
        if ($_REQUEST['Numerico'] <= 0 || $_REQUEST['Numerico'] >= 100) {
            $errores['Numerico'] = "El numro introducido no es correcto";
        }
    }
    if (textoVacio('Contraseña')) {
        $errores['Contraseña'] = "Escribe alguna letra ";
    }
    if (textoVacio('Telefono')) {
        $errores['Telefono'] = "Escribe alguna letra ";
    }
    if (textoVacio('Email')) {
        $errores['Email'] = "Escribe alguna letra ";
    }
    if (textoVacio('Fecha')) {
        $errores['Fecha'] = "Introduce una fecha ";
    } else {
        $fechaActual = date('Y-m-d');
        $fechaNacimiento  = $_REQUEST['Fecha'];
        $fechaNacimientoObj = new DateTime($fechaNacimiento);
        $fechaActualObj = new DateTime($fechaActual);
        $diferencia = $fechaNacimientoObj->diff($fechaActualObj);
        $edad = $diferencia->y;
        if ($edad <= 18) {
            $errores['Fecha'] =  "La persona no es mayor de edad.";
        }
    }
    if (textoVacio('opcion')) {
        $errores['opcion'] = "Marca una opcion";
    } else {
        $valor = current($_REQUEST['opcion']);
        //echo $valor;
        // foreach ($_REQUEST['opcion'] as $key => $value) {
        if ($valor == 'opcion1') {
            $errores['opcion'] = "Marca otra opcion que no sea la opcion1";
            //   }

        }
    }
    if (count($errores) == 0) {
        return true;
    } else
        return false;
}
function escribirErrores($errores, $name)
{

    if (isset($errores[$name])) {
        echo '<span style="color: red;">' . $errores[$name] . '</span>';
    }
}
function radiovacio($name)
{
    if (!isset($_REQUEST[$name])) {
        return true;
    }
    return false;
}
