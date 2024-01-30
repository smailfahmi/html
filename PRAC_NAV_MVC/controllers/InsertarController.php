<?
$errores = array();
if (!validado()) {
    $_SESSION['vista'] = VIEW . 'login.php';
    $_SESSION['controller'] = CON . 'LoginController.php';
} elseif (isset($_REQUEST['Volver'])) {
    if ($_SESSION['usuario']->perfil == 'ADM') {
        $_SESSION['vista'] = VIEW . 'admin.php';
        $_SESSION['controller'] =  CON . 'AdminController.php';
    } elseif ($_SESSION['usuario']->perfil == 'MOD') {
        $_SESSION['vista'] = VIEW . 'mod.php';
        $_SESSION['controller'] = CON . 'ModController.php';
    }
} elseif (isset($_REQUEST['Agregar'])) {
    guardaImagen();
    $ruta = "./imagenes/prod/" . $_FILES["imagenInser"]["name"];
    $producto = new Productos(null, $_REQUEST['nombreInser'], $_REQUEST['precioInser'], $_REQUEST['descripcionInser'], $ruta, $_REQUEST['stockInser'], $_REQUEST['categoriaInser'], 1);
    ProductoDAO::insert($producto);
    $id = ProductoDAO::cuentaFilas();
    $albaran = new Albaran(null, $id, $_SESSION['usuario']->id, $_REQUEST['stockInser'], date('Y-m-d'));
    AlbaranDAO::insert($albaran);
    $errores['insertado'] = 'Insercion exitosa';
}
