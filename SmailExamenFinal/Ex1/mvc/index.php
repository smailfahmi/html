</div>
<?
require('./config/confi.php');
session_start();
if (isset($_COOKIE['usuario'])) {
    $arrayRecordar = array('recUser' => $_COOKIE['usuario']);
    // print_r($_COOKIE);
}
if (isset($_REQUEST['Iniciar'])) {
    $_SESSION['controller'] = CON . 'LoginController.php';
} elseif (isset($_REQUEST['ParidaAleatoria'])) {
    $_SESSION['controller'] = CON . 'JuegoController.php';
    $_SESSION['vista'] = VIEW . 'juego.php';
} elseif (isset($_REQUEST['ParidaAleatoriaMinima'])) {
    $_SESSION['controller'] = CON . 'JuegoController.php';
    $_SESSION['vista'] = VIEW . 'juego.php';
} elseif (isset($_REQUEST['editarUltima'])) {
    $_SESSION['controller'] = CON . 'SorteoController.php';
    // $_SESSION['vista'] = VIEW . 'sorteo.php';
} elseif (isset($_REQUEST['CerrarSesion'])) {
    session_destroy();
    header('Location: ./index.php');
}
if (isset($_SESSION['controller'])) {
    require($_SESSION['controller']);
}

require('./views/layout.php');
