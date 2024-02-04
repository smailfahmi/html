<?
$errores = array();
if (!validado()) {
    unset($_SESSION['vista']);
    unset($_SESSION['controller']);
} elseif (isset($_REQUEST['editarUltima'])) {
    $UltimaApuesta = NumerosDao::ultimaApuesta($_SESSION['usuario']->id);
    $numeros = explode(',', $UltimaApuesta->numeros_elegidos);
} else {
    if (compruebaCheck($errores)) {
        $dia = date('Y-m-d H:i:s');
        $cadena = implode(',', $_REQUEST['opcionCh']);
        $numeros = new Numeros(null, $_SESSION['usuario']->id, $cadena, $dia);
        NumerosDao::insert($numeros);
        echo 'hola';
    };
}
