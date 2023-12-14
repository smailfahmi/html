<?
require('./seguro/datos.php');

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    if (
        $_SERVER['PHP_AUTH_USER'] != USERA ||
        hash('sha256', $_SERVER['PHP_AUTH_PW']) != PASSA
    ) {
        header('Location: ./index.php');
        exit;
    }
} else {
    header('Location: ./index.php');
    exit;
}

echo ' hola1';
?>
<a href="./cerrar.php">cerrar sesion</a>