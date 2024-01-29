<?

require('./config/confi.php');
session_start();

if (isset($_REQUEST['Sign_in'])) {
    $_SESSION['vista'] = VIEW . 'login.php';
    $_SESSION['controller'] = CON . 'LoginController.php';
}


if (isset($_SESSION['controller'])) {
    require($_SESSION['controller']);
}
require('./views/layout.php');
