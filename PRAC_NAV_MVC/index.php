<?

require('./config/confi.php');
session_start();

if (isset($_REQUEST['Sign_in'])) {
    $_SESSION['vista'] = VIEW . 'login.php';
    $_SESSION['controller'] = CON . 'LoginController.php';
} elseif (isset($_REQUEST['Editar_perfil'])) {
    $_SESSION['vista'] = VIEW . 'editarPerfil.php';
    $_SESSION['controller'] = CON . 'editarPerfilController.php';
} elseif (isset($_REQUEST['Cerrar_sesion'])) {
    session_destroy();
    header('Location: ./index.php');
}


if (isset($_SESSION['controller'])) {
    require($_SESSION['controller']);
}
require('./views/layout.php');
