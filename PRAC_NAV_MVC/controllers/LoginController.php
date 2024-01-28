<?

$errores = array();
if (isset($_REQUEST['Iniciar'])) {

    if (validarFormularioLog($errores)) {
        //validar usuario 
        $usuario = UsuarioDao::validarUsuario($_REQUEST['usuarioLog'], $_REQUEST['contraLog']);
        if ($usuario != null) {
            $_SESSION['usuario'] = $usuario;
            if ($usuario->perfil == 'USR') {
                $_SESSION['vista'] = VIEW . 'principal.php';
                unset($_SESSION['controller']);
                $array_productos = ProductoDAO::findAll();
            }
        } else {
            $errores['validado'] = 'no se ha encontrado';
        }

        //valido
    } else {
    }
} elseif (isset($_REQUEST['Registrarse'])) {
    if (validarFormulario($errores)) {
        $usuario = new User($_REQUEST['codUsuarior'], sha1($_REQUEST['passr']), $_REQUEST['descUsuarior'], date('Y-m-d'), 'usuario', true);


        if ($usuario != null) {
            UserDao::insert($usuario);
            $_SESSION['vista'] = VIEW . 'home.php';
            $_SESSION['usuario'] = $usuario;
            unset($_SESSION['controller']);
        } else {
            $errores['validado'] = 'no se ha encontrado';
        }
    }
}
