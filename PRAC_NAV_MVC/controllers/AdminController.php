<?
$errores = array();
if (!validado()) {
    $_SESSION['vista'] = VIEW . 'login.php';
    $_SESSION['controller'] = CON . 'LoginController.php';
} elseif ($_SESSION['usuario']->perfil != 'ADM' && $_SESSION['usuario']->perfil != 'MOD') {
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
} elseif (isset($_REQUEST['actualiPed'])) {
    $pedido = PedidoDAO::findById($_REQUEST['pedOculto']);
    $pedido->producto_id = $_REQUEST['producto_id'];
    $pedido->usuario_id = $_REQUEST['usuario_id'];
    $pedido->cantidad = $_REQUEST['cantidad'];
    if (PedidoDAO::update($pedido)) {
        $errores['pedidoActua'] = 'Edicion exitosa';
        $array_pedidos = PedidoDAO::findAll();
    }
    $_SESSION['vista'] = VIEW . 'tablas.php';
    $_SESSION['controller'] =  CON . 'AdminController.php';
} elseif (isset($_REQUEST['actualiAlb'])) {
    $albaran = AlbaranDAO::findById($_REQUEST['pedOculto']);
    $albaran->producto_id = $_REQUEST['producto_id'];
    $albaran->administrador_id = $_REQUEST['administrador_id'];
    $albaran->cantidad_anadida = $_REQUEST['cantidad_anadida'];
    if (AlbaranDAO::update($albaran)) {
        $errores['albaranActua'] = 'Edicion exitosa';
        $array_albaran = AlbaranDAO::findAll();
    }
    $_SESSION['vista'] = VIEW . 'tablas.php';
    $_SESSION['controller'] =  CON . 'AdminController.php';
} elseif (isset($_REQUEST['editarProducto'])) {
    $product = ProductoDAO::findById($_REQUEST['saberId']);
    $product->nombre = $_REQUEST['nombreEd'];
    $product->precio = $_REQUEST['precioEd'];
    $product->descripcion = $_REQUEST['descripcionEd'];
    $product->stock = $_REQUEST['stockEd'];
    if (ProductoDAO::update($product)) {
        $errores['editarProd'] = 'Edicion exitosa';
        $array_productosT = ProductoDAO::findAll();
    }
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
    if ($_SESSION['usuario']->perfil == 'ADM' || $_SESSION['usuario']->perfil == 'MOD') {
        $_SESSION['vista'] = VIEW . 'admin.php';
        $_SESSION['controller'] =  CON . 'AdminController.php';
    }
}
