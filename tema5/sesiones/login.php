<?
session_start();

include('./funciones.php');
include('./conexionBd.php');
if (enviado() && !textoVacio('user') && !textoVacio('pass')) {
    $usuario = validaUsuari($_REQUEST['user'], $_REQUEST['pass']);
    if ($usuario) {
        $_SESSION['usuario'] = $usuario;
        header('Location:./homeUsuario.php');
    } else {
        echo 'false';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?

    if (
        isset($_SESSION['error'])
    ) {
        echo 'no tines permiso';
    }
    ?>
    <h1>login</h1>
    <form action="" method="post">
        <label for="user">Nombre :</label>
        <input type="text" name="user" id="user">
        <label for="pass">contraseña: </label>
        <input type="password" name="pass" id="pass">
        <input type="submit" value="Enviar" name="Enviar">
    </form>

    <? ?>
</body>

</html>