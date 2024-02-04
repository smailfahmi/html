</div>
<?
require('./config/confi.php');
session_start();

if (isset($_REQUEST['Iniciar'])) {
    $_SESSION['controller'] = CON . 'LoginController.php';
} elseif (isset($_REQUEST['Recordar'])) {
    $_SESSION['controller'] = CON . 'LoginController.php';
} elseif (isset($_REQUEST['Mandar'])) {
    $_SESSION['controller'] = CON . 'SorteoController.php';
    // $_SESSION['vista'] = VIEW . 'sorteo.php';
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
