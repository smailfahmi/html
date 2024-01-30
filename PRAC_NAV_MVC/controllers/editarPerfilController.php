<?
$errores = array();
if (!validado()) {
    $_SESSION['vista'] = VIEW . 'login.php';
    $_SESSION['controller'] = CON . 'LoginController.php';
} elseif (isset($_REQUEST['Volver'])) {
    unset($_SESSION['vista']);
    unset($_SESSION['controller']);
} elseif (isset($_REQUEST['Guardar'])) {
    $usuario = $_SESSION['usuario'];
    $usuario->nombre = $_REQUEST['nombreNuevo'];
    $usuario->clave = $_REQUEST['contraNuevo'];
    $usuario->correo = $_REQUEST['emailNuevo'];
    if (UsuarioDao::update($usuario)) {
        $errores['update'] = 'Modificacion exitosa';
        $_SESSION['usuario'] = $usuario;
    } else
        $errores['update'] = 'no se ha podido modificar';
    //updateo los campos en la bd

}
