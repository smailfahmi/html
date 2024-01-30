<?
$errores = array();
if (!validado()) {
    $_SESSION['vista'] = VIEW . 'login.php';
    $_SESSION['controller'] = CON . 'LoginController.php';
} elseif (isset($_REQUEST['Volver'])) {
    unset($_SESSION['vista']);
    unset($_SESSION['controller']);
}
