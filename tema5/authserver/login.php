<?

require('./seguro/datos.php');

//Si existe usuario logueado
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) {
    if (
        $_SERVER['PHP_AUTH_USER'] == USER &&
        hash('sha256', $_SERVER['PHP_AUTH_PW']) == PASS
    ) {
        header('Location: ./paginaUser.php');
        exit;
    } elseif (
        $_SERVER['PHP_AUTH_USER'] == USERA &&
        hash('sha256', $_SERVER['PHP_AUTH_PW']) == PASSA
    ) {
        header('Location: ./paginaAdmin.php');
        exit;
    } else {
        header('WWW-Authenticate: Basic Realm="Contenido restringido"');
        header('HTTP/1.0 401 Unauthorized');
    }
} else {
    header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
}