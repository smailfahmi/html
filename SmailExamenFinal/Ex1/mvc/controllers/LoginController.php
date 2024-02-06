<?

$errores = array();
if (isset($_REQUEST['Iniciar'])) {
    if (validarFormulario($errores)) {
        $usuario = UsuarioDao::validarUsuario($_REQUEST['usuarioLog'], $_REQUEST['contraLog']);
        if ($usuario != null) {
            if (validarchek()) { //coompruebo que si quiere recordar
                setcookie("usuario", $_REQUEST['usuarioLog'], 0, '/');
            } else {
                setcookie("usuario", $_REQUEST['usuarioLog'], time() - 1, '/');
            }
            if ($usuario->perfil = 'user') {
                $_SESSION['vista'] = VIEW . 'usuario.php';
                $_SESSION['usuario'] = $usuario;
                unset($_SESSION['controller']);
            } elseif ($usuario->perfil = 'admin') {
                $_SESSION['vista'] = VIEW . 'admin.php';
                $_SESSION['usuario'] = $usuario;
                unset($_SESSION['controller']);
            }
        } else {
            $errores['validado'] = 'no se ha encontrado';
        }

        //valido
    } else {
        unset($_SESSION['controller']);
    }
} elseif (isset($_REQUEST['Recordar'])) {
    if (isset($_COOKIE['usuario'])) {
        $arrayRecordar = array('recUser' => $_COOKIE['usuario']);
        // print_r($_COOKIE);
    }
}
