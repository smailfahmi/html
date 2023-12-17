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
// include('./funcionesBD.php');
include('./funcionesBD_PSQL.php');
$nombreBase = "trabajos";
if (isset($_REQUEST['crear'])) {
    if ($_REQUEST['crear'] == 'CREAR') {
        crearBD();
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
        $DSN = 'pgsql:host=' . IP . ';dbname=trabajos';
        $con = new PDO($DSN, USER, PASS);
        darpermisos();
        leerdatos($con);
    } catch (\PDOException $th) {
        $errorCode = $th->getCode();
        switch ($errorCode) {
            case '08001':
                echo 'Error de conexión: Problema de conexión';
                break;
            case '08006':
                echo 'Error de conexión: Conexión rechazada por el servidor';
                break;
            case '3D000':
                echo 'Error de conexión: Base de datos no encontrada';
                echo '<form action="" method="get">';
                echo '<p><label for=""><input class="boton" type="submit" name="crear" value="CREAR"></label></p>';
                echo '</form>';
                break;
            case '7':
                echo 'Error de conexión: Base de datos no encontrada';
                echo '<form action="" method="get">';
                echo '<p><label for=""><input class="boton" type="submit" name="crear" value="CREAR"></label></p>';
                echo '</form>';
                break;
                // Agrega más casos según los códigos de error que necesites manejar
            default:
                echo 'Error no identificado: ' . $th->getMessage();
                break;
        }
    }
}
