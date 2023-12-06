<?
function crearFichero($nombre) //esto creara un script con todo lo que contiene contenido para crear despues la base de datos 
{
    $contenido = "
    DROP DATABASE IF EXISTS " . $nombre . ";
    CREATE DATABASE " . $nombre . ";
    DROP USER IF EXISTS " . $nombre . ";
    CREATE USER " . $nombre . " IDENTIFIED BY 'SmailSmail';
    GRANT ALL ON " . $nombre . ".* TO " . $nombre . ";
    USE " . $nombre . ";
    CREATE TABLE MisTrabajos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        empresa VARCHAR(50),
        meses DECIMAL(10, 2),
        fecha_entrada date  -- Cambio el tipo de datos a VARCHAR
    );
    INSERT INTO MisTrabajos (empresa, meses, fecha_entrada) 
    VALUES 
    ('Cobadu', 5.5, '2023-01-15'),
    ('Tellepiza', 8.2, '2022-09-30'),
    ('Coviran', 3.7, '2023-03-22');
";
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
    crearBD();
}
function existe($name) //comprobamos que existe el fichero y si no lo creamos para rellenarlo 
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
function crearBD() //creo la base de datos a partir del script que hemos creado anteriormente 
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
        header('Location: ./index.php');
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
function leerdatos($con) //leo los datos y en creo la tabla con la informacion 
{
    try {
        $sql = 'select * from MisTrabajos';
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo '<pre>';
            echo '<table>';
            // Obtener los nombres de las columnas
            $columns = array();
            while ($field = mysqli_fetch_field($result)) {
                $columns[] = $field->name;
            }
            // Mostrar los nombres de las columnas
            foreach ($columns as $column) {
                echo '<th>' . $column . '</th>';
            }
            echo '<th>modificar</th>';
            while ($array = mysqli_fetch_assoc($result)) {
                echo "<form action='' method='get'>";
                echo '<tr>';
                foreach ($columns as $column) {
                    echo '<td>' . $array[$column] . '</td>';
                }
                echo '<td>
                <form action="" method="get">
                    <label for=""><input type="submit" name="editar" value="EDITAR"></label>
                    <label for=""><input type="submit" name="borrar" value="BORRAR"></label>
                    <input type="hidden" name="oculto" value="' . $array[$columns[0]] . '">
                </form>
              </td>';
                echo '</tr>';
            }
            echo ' <form action="" method="get">
            <label for=""><input type="submit" name="insertar" value="INSERTAR"></label>  </form>';
        } else {
            echo 'No se pudo ejecutar la consulta';
        }

        mysqli_close($con);
    } catch (\Throwable $th) {
        echo 'Error: ' . $th->getMessage();
    }
}
function aniadirvalor($bd) //funcion para insertar una nueva fila
{
    try {
        $con = new mysqli($_SERVER['SERVER_ADDR'], $bd, 'SmailSmail', $bd); //hago uso del usuario creado para esta base de datos determinada 
        //uso la ip del servidor porque todo lo que hacemos es de manera local 
        if ($con->connect_error) {
            die("Conexión fallida: " . $con->connect_error);
        }
        //los datos ya llegan verificados se podrian volver a verificar
        $empresa = $_REQUEST['empresa'];
        $meses = $_REQUEST['meses'];
        $fecha_entrada = $_REQUEST['fecha'];
        $sql = "INSERT INTO MisTrabajos (empresa, meses, fecha_entrada) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sds", $empresa, $meses, $fecha_entrada);//sds es string,double,string :)
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Valores insertados correctamente.";
            header('Location: ./index.php');
        } else {
            echo "Error al insertar valores: " . $con->error;
        }
        $stmt->close();
        $con->close();
    } catch (\Throwable $th) {
        echo "Error: " . $th->getMessage();
    }
}
function valido(&$errores) //verifico los campos esto se hace tanto para editar como al insertar
{
    if (!isset($_REQUEST['empresa']) || !preg_match('/\S/', $_REQUEST['empresa'])) {
        $errores['empresa'] = 'CAMPO VACIO';
    }

    if (!isset($_REQUEST['meses']) || !preg_match('/^\d+(\.\d+)?$/', $_REQUEST['meses'])) {
        $errores['meses'] = 'CAMPO VACIO O NO NUMERICO O NO DECIMAL';
    }


    if (!isset($_REQUEST['fecha']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $_REQUEST['fecha'])) {
        $errores['fecha'] = 'CAMPO VACIO O FORMATO INVALIDO (YYYY-MM-DD)';
    }

    return empty($errores); // Devuelve true si no hay errores
}
function borrarLinea($nombre, $id) //funcion al borrar lineas
{
    try {
        $con = new mysqli($_SERVER['SERVER_ADDR'], $nombre, 'SmailSmail', $nombre);
        // Consulta preparada para eliminar la fila con el id proporcionado
        $sql = 'DELETE FROM MisTrabajos WHERE id = ?';
        $stmt = $con->prepare($sql);
        // Enlazar el parámetro id a la consulta preparada
        $stmt->bind_param("i", $id);
        // Ejecutar la consulta
        $stmt->execute();
        // Verificar si se afectó alguna fila
        if ($stmt->affected_rows > 0) {
            echo "La fila con el ID $id ha sido eliminada correctamente.";
            header('Location: ./index.php');
        } else {
            echo "No se encontró ninguna fila con el ID $id.";
        }
        // Cerrar la consulta y la conexión
        $stmt->close();
        mysqli_close($con);
    } catch (\Throwable $th) {
        echo "Error: " . $th->getMessage();
    }
}
function rellenar($id, $nombre, $valor) //funcion para rellenar los inputs cuando le damos a editar una linea
{
    try {
        $con = new mysqli($_SERVER['SERVER_ADDR'], $nombre, 'SmailSmail', $nombre);
        $sql = 'SELECT ' . $valor . ' FROM MisTrabajos WHERE id = ?';
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            while ($fila = $result->fetch_assoc()) {
                echo $fila[$valor];
            }
        } else {
            echo 'No se pudo ejecutar la consulta';
        }
        $stmt->close();
        mysqli_close($con);
    } catch (\Throwable $th) {
        echo 'Error: ' . $th->getMessage();
    }
}
function editarvalor($nombre, $id) //edito los valores con el id pasado  
{
    try {
        $con = new mysqli($_SERVER['SERVER_ADDR'], $nombre, 'SmailSmail', $nombre);
        $sql = "UPDATE MisTrabajos SET empresa = ?, meses = ?, fecha_entrada = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $empresa = $_REQUEST['empresa'] ?? ''; // las interrogacions son porsi es nulo pero yo he verificado estos valores antes de pasarlos 
        $meses = (float)$_REQUEST['meses'] ?? 0;
        $fecha_entrada = $_REQUEST['fecha'] ?? '';

        $stmt->bind_param("sdsi", $empresa, $meses, $fecha_entrada, $id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo "Se ha actualizado la columna ";
            header('Location: ./index.php');
        } else {
            echo "No se pudo actualizar la columna";
        }
        $stmt->close();
        mysqli_close($con);
    } catch (\Throwable $th) {
        echo 'Error: ' . $th->getMessage();
    }
}
