<?
session_start();
session_destroy();
if (!isset($_SESSION['usuario'])) {
    $_SESSION['error'] = 'no tiene permisos';
    header('Location: ./login.php');
    exit;
}

?>