<?
$errores = array();
if (!validado()) { //compruebo que el formulario no este vacio
    $_SESSION['vista'] = VIEW . 'login.php';
    $_SESSION['controller'] = CON . 'LoginController.php';
} elseif (isset($_REQUEST['pruebaLetra'])) {

    $arrayPalabra = $_SESSION['palabra'];
    $arrayPistas = $_SESSION['oculto'];
    if ($_SESSION['errores'] >= 6) { //compruebo los errores
        $resultado = 'Has fallado la palabra ' . implode($arrayPalabra);
        unset($_REQUEST['palabra']);
        unset($_REQUEST['errores']);
        unset($_REQUEST['oculto']);
        unset($_SESSION['controller']);
        $_SESSION['vista'] = VIEW . 'usuario.php';
    } else {

        if (in_array($_REQUEST['letras'], $arrayPalabra)) { //si esta la letra en la palabra convertida en array
            $posicion = 0;
            foreach ($arrayPalabra as $key => $value) { //recorro el array para cambiar asterisco por letra
                if ($value == $_REQUEST['letras']) {
                    $arrayPistas[$posicion] = $_REQUEST['letras'];
                }
                $posicion++;
            }
            $_SESSION['oculto'] = $arrayPistas;
        } else {
            $_SESSION['errores']++;
        }
        $diferencia = array_diff($arrayPistas, $arrayPalabra);
        if (count($diferencia) == 0) { //si no hay diferencias entre los arrays doy acierto 
            $resultado = 'Has acertado la palabra ' . implode($arrayPalabra);
            unset($_REQUEST['palabra']);
            unset($_REQUEST['errores']);
            unset($_REQUEST['oculto']);
            unset($_SESSION['controller']);
            $_SESSION['vista'] = VIEW . 'usuario.php';
        }
    }


} elseif (isset($_REQUEST['ParidaAleatoria'])) {
    $_SESSION['errores'] = 0;
    $palabra = get('palabras');
    $_SESSION['palabra'] = str_split($palabra);
    // $arrayLeras = str_split($_SESSION['palabra']);
    $oculto = [];
    for ($i = 0; $i < strlen($palabra); $i++) {
        $oculto[$i] = '*';
    }
    $_SESSION['oculto'] = $oculto;
    # code...
} elseif (isset($_REQUEST['ParidaAleatoriaMinima'])) {
    $_SESSION['errores'] = 0;
    if (validar2($errores)) {
        $palabra = get('palabras?letras=' . (string) $_REQUEST['letras']);
        $_SESSION['palabra'] = str_split($palabra);
        // $arrayLeras = str_split($_SESSION['palabra']);
        $oculto = [];
        for ($i = 0; $i < strlen($palabra); $i++) {
            $oculto[$i] = '*';
        }
        $_SESSION['oculto'] = $oculto;
    }else{
        $_SESSION['vista'] = VIEW . 'usuario.php';        
        unset($_SESSION['controller']);

    }

    # code...
}
