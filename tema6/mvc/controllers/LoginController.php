<?
if (isset($_REQUEST['login'])) {

    $errores = array();
    if (validarFormulario($errores)) {
        //validar usuario 
        $usuario = UserDao::validarUsuario($_REQUEST['nombre'], $_REQUEST['pass']);
        if ($usuario != null) {
            $usuario->fechaUltimaConexion = date('Y-m-d');
            UserDao::update($usuario);
            $_SESSION['usuario'] = $usuario;

            $_SESSION['vista'] = VIEW . 'home.php';
            unset($_SESSION['controller']);
        } else {
            $errores['validado'] = 'no se ha encontrado';
        }

        //valido
    } else {

    }
} elseif (isset($_REQUEST['registrar'])) {

}