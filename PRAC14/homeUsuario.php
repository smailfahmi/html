<?
require('./conexionBd.php');
session_start();
if (!isset($_SESSION['usuario'])) {
    $_SESSION['error'] = 'no tiene permisos';
    header('Location: ./login.php');
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
    <h1>pagina user</h1>
    <?
    print_r($_SESSION['usuario']);
    echo 'bienvenido' . $_SESSION['usuario']['nombre'];
    $paginas = misPaginas();
    echo ' las paginas a la que puedo acceder ';
    foreach ($paginas as $value) {
        echo "<a href='./paginas/" . $value . "'>" . $value . "</a> <br>";
    }

    ?>
    <a href="./logOut.php">salitr</a>

</body>

</html>