<?
include('../funciones.php');
session_start();
if (!isset($_SESSION['usuario'])) {
    $_SESSION['error'] = 'no tiene permisos';
    header('Location: ../login.php');
    exit;
}
permisos(basename($_SERVER['PHP_SELF']));
print_r($_SESSION);
echo basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>pagina 1</h1>
</body>

</html>