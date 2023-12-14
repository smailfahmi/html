<?
require('./seguro/datos.php');

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    if (
        $_SERVER['PHP_AUTH_USER'] != USER ||
        hash('sha256', $_SERVER['PHP_AUTH_PW']) != PASS
    ) {
        header('Location: ./index.php');
        exit;
    }
} else {
    header('Location: ./index.php');
    exit;
}

echo ' hola';
?>
<a href="./cerrar.php">cerrar sesion</a>