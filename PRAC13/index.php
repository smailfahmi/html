<style>
    .boton {
        width: 100%;
        height: 50px;
        background-color: black;
        color: white;
    }

    .boton:hover {
        background-color: gray;
        color: black;
    }

    table,
    td,
    th {
        border: solid 2px black;
        text-align: center;
    }
</style>
<?
require('./conexionBD.php');
include('./funcionesBD.php');
$nombreBase = "trabajos";
if (isset($_REQUEST['crear'])) {
    if ($_REQUEST['crear'] == 'CREAR') {
        crearFichero($nombreBase);
    }
} elseif (isset($_REQUEST['insertar'])) {
    if ($_REQUEST['insertar'] == 'INSERTAR') {
        header('Location: ./editar.php?nombre=' . $nombreBase);
    }
} elseif (isset($_REQUEST['borrar'])) {
    if ($_REQUEST['borrar'] == 'BORRAR')
        borrarLinea($nombreBase, $_REQUEST['oculto']);
} elseif (isset($_REQUEST['editar'])) {
    if ($_REQUEST['editar'] == 'EDITAR') {
        header('Location: ./editar.php?nombre=' . $nombreBase . '&id=' . $_REQUEST['oculto']);
    }
} else {
    try {
        $con = mysqli_connect(IP, USER, PASS, $nombreBase);
        leerdatos($con);
        // echo 'la base de datos si existe';
    } catch (\Throwable $th) {
        switch ($th->getCode()) {
            case 1044:
                echo 'Acceso denegado';
                break;
            case 1045:
                echo 'Usuario o contraseña inválidos';
                break;
            case 2002:
                echo 'No se puede conectar al servidor';
                break;
            case 1049:
                echo 'La base de datos no existe';
                echo '<form action="" method="get">';
                echo '<p><label for=""><input class="boton" type="submit" name="crear" value="CREAR"></label></p>';
                echo '</form>';
                break;
            case 2003:
                echo 'No se puede conectar al servidor MySQL';
                break;
            case 1062:
                echo 'Entrada duplicada para clave única';
                break;
            case 1146:
                echo 'Tabla no encontrada';
                break;
            default:
                echo 'Error: ' . $th->getMessage();
                break;
        }
    }
}
