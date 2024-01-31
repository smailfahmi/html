<?
$errores = array();
if (!validado()) {
    $_SESSION['vista'] = VIEW . 'login.php';
    $_SESSION['controller'] = CON . 'LoginController.php';
} elseif (isset($_REQUEST['Ver_pedidos'])) {
    $array_pedidos = PedidoDAO::findAll();
    $_SESSION['vista'] = VIEW . 'tablas.php';
    $_SESSION['controller'] =  CON . 'AdminController.php';
} elseif (isset($_REQUEST['Ver_albaran'])) {
    $array_albaran = AlbaranDAO::findAll();
    $_SESSION['vista'] = VIEW . 'tablas.php';
    $_SESSION['controller'] =  CON . 'AdminController.php';
} elseif (isset($_REQUEST['Editar_productos'])) {
    $array_productosT = ProductoDAO::findAll();
    $_SESSION['vista'] = VIEW . 'tablas.php';
    $_SESSION['controller'] =  CON . 'AdminController.php';
} elseif (isset($_REQUEST['editarProducto'])) {
    $array_productosT = ProductoDAO::findAll();
    $_SESSION['vista'] = VIEW . 'tablas.php';
    $_SESSION['controller'] =  CON . 'AdminController.php';
} elseif (isset($_REQUEST['eliminarProducto'])) {
    $product = ProductoDAO::findById($_REQUEST['saberId']);
    if ($product->visible == 1) {
        $cambio = ProductoDAO::delete($_REQUEST['saberId']);
        if ($cambio) {
            $array_productosT = ProductoDAO::findAll();
            $_SESSION['vista'] = VIEW . 'tablas.php';
            $_SESSION['controller'] =  CON . 'AdminController.php';
        }
    } else {
        $cambio = ProductoDAO::activa($_REQUEST['saberId']);
        if ($cambio) {
            $array_productosT = ProductoDAO::findAll();
            $_SESSION['vista'] = VIEW . 'tablas.php';
            $_SESSION['controller'] =  CON . 'AdminController.php';
        }
    }
} elseif (isset($_REQUEST['Volver'])) {
    if ($_SESSION['usuario']->perfil == 'ADM') {
        $_SESSION['vista'] = VIEW . 'admin.php';
        $_SESSION['controller'] =  CON . 'AdminController.php';
    } elseif ($_SESSION['usuario']->perfil == 'MOD') {
        $_SESSION['vista'] = VIEW . 'mod.php';
        $_SESSION['controller'] = CON . 'ModController.php';
    }
}
