<?

$errores = array();
if (isset($_REQUEST['Iniciar'])) {
    if (validarFormulario($errores)) {
        $usuario = UserDao::validarUsuario($_REQUEST['usuarioLog'], $_REQUEST['contraLog']);
        if ($usuario != null) {
            setcookie("usuario", $usuario->nombre, 0, '/');
            setcookie("contra", $usuario->contra, 0, '/');
            if ($usuario->perfil = 'USR') {
                $_SESSION['vista'] = VIEW . 'sorteo.php';
                $_SESSION['usuario'] = $usuario;
                unset($_SESSION['controller']);
            } elseif ($usuario->perfil = 'ADM') {
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
        $arrayRecordar = array('recUser' => $_COOKIE['usuario'], 'recCont' => $_COOKIE['contra']);
        // print_r($_COOKIE);
    }
}
