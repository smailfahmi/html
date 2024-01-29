<?
$errores = array();
if (!validado()) {
    $_SESSION['vista'] = VIEW . 'login.php';
    $_SESSION['controller'] = CON . 'LoginController.php';
} elseif (isset($_REQUEST['Volver'])) {
    $_SESSION['vista'] = VIEW . 'principal.php';
    unset($_SESSION['controller']);
    $array_productos = ProductoDAO::findAll();
} else {
    if (isset($_REQUEST['Guardar'])) {
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
}
