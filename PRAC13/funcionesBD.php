<?
function crearFichero($nombre)
{
    $contenido = " DROP DATABASE IF EXISTS " . $nombre . ";
create database " . $nombre . ";
DROP USER IF EXISTS " . $nombre . ";
create user " . $nombre . " identified by 'SmailSmail';
use " . $nombre . ";
grant all on " . $nombre . ".* to " . $nombre . ";";
    $fichero = 'baseInexistente.sql';
    if (existe($fichero)) {
        # code...

        if (file_exists($fichero)) {
            if (!$fp = fopen($fichero, 'w'))
                echo "Ha habido un problema al abrir el fichero";
            else {
                if (!fwrite($fp, $contenido, strlen($contenido)))
                    echo "Error al escribir";
                fclose($fp);
            }
        } else {
            echo "No existe";
        }
    }
    crearBD($nombre);
}
function existe($name)
{

    if (file_exists($name)) {
        return true;
    } else {
        $ficheroCreado = fopen($name, 'w');
        $texto = "linea creada automaticamente";
        fwrite($ficheroCreado, $texto);
        if (file_exists($name)) {
            return true;
        } else
            return false;
    }
}
function crearBD($nombre)
{
    try {
    $con = new mysqli();
    $con->connect(IP, USER, PASS,);
    $script = file_get_contents('./baseInexistente.sql');
    $con->multi_query($script);
    do {
        $con->store_result();
        if (!$con->next_result()) {
            break;
        }
    } while (true);
    $con->close();
} catch (\Throwable $th) {
    switch ($th->getCode()) {
        case '1062':
            echo 'id repetido';
            break;

        default:
            echo $th->getMessage();
            break;
    }

    mysqli_close($con);
}
}
