<style>
    input {
        width: 100%;
        height: 50px;
        background-color: black;
        color: white;
    }

    input:hover {
        background-color: gray;
        color: black;
    }
</style>
<?
require('./conexionBD.php');
include('./funcionesBD.php');
$nombreBase = "hola";
if (isset($_REQUEST['crear'])) {
    if ($_REQUEST['crear'] == 'CREAR') {
        crearFichero($nombreBase);
    }
} else {
    try {
        $con = mysqli_connect(IP, USER, PASS, $nombreBase);
        echo 'la base de datos si existe';
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
                echo '<p><label for=""><input type="submit" name="crear" value="CREAR"></label></p>';
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
