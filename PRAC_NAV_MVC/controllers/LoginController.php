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
            } elseif ($usuario->perfil == 'ADM') {
                $_SESSION['vista'] = VIEW . 'admin.php';
                $_SESSION['controller'] =  CON .'AdminController.php';
            } elseif ($usuario->perfil == 'MOD') {
                $_SESSION['vista'] = VIEW . 'mod.php';
                $_SESSION['controller'] = CON . 'ModController.php';
            }
        } else {
            $errores['validado'] = 'No se ha encontrado';
        }

        //valido
    } else {
    }
} elseif (isset($_REQUEST['Registrarse'])) {
    if (validarFormularioReg($errores)) {
        $usuario = new Usuario(NULL, $_REQUEST['usuarioReg'], $_REQUEST['contraReg'], $_REQUEST['nombreReg'], $_REQUEST['emailReg'], 'USR', $_REQUEST['fechaReg']);

        if ($usuario != null) {
            UsuarioDao::insert($usuario);
            $_SESSION['vista'] = VIEW . 'principal.php';
            unset($_SESSION['controller']);
            $array_productos = ProductoDAO::findAll();
        } else {
            $errores['validado'] = 'Vuelve a intentarlo';
        }
    }
} elseif (isset($_REQUEST['Volver'])) {
    unset($_SESSION['vista']);
    unset($_SESSION['controller']);
}
