<?
require('../funciones/funciones.php');
require('../funciones/funci.php');
if (!isset($_GET['id'])) {
    header('Location: home.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?
    echo '<a href="./home.php">volver</a>';
    $producto = findId($_GET['id']);
    if ($producto) {
        insertarcookier();
        echo
            '<h1>' . $producto['nombre'] . '</h1>
        <p>' . $producto['descripcion'] . '</p>
    <td> <img src="../' . $producto['alta'] . '" > </td>';       # code...
    }
    ?>
</body>

</html>