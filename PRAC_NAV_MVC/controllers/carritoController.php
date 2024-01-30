
<?
$errores = array();
if (!validado()) {
    $_SESSION['vista'] = VIEW . 'login.php';
    $_SESSION['controller'] = CON . 'LoginController.php';
} elseif (isset($_REQUEST['finalizar_compra'])) {
    $id = ProductoDAO::extraerID($_REQUEST['idOculto']);
    $producto =   ProductoDAO::findById($id);
    if (ProductoDAO::compruebastock($producto)) {
        $producto->stock = ($producto->stock - 1);
        ProductoDAO::update($producto);
        $errores['stock'] = 'Compra exitosa';
    } else {
        $errores['stock'] = 'No quedan articulos de este producto';
    }
} elseif (isset($_REQUEST['Volver'])) {
    $_SESSION['vista'] = VIEW . 'principal.php';
    unset($_SESSION['controller']);
    $array_productos = ProductoDAO::findAll();
} else {
    $id = ProductoDAO::extraerID($_REQUEST['idOculto']);
    $producto =   ProductoDAO::findById($id);
}
?>