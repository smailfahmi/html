<?
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
    echo 'bienvenido' . $_SESSION['usuario']['nombre'];
    ?>
    <a href="./logOut.php">salitr</a>

</body>

</html>