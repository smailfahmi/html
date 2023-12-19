<?
function crearBD()
{
    $DSN = 'pgsql:host=' . IP . ';dbname=postgres'; //me conecto a una bd que existe y general para tener conexion

    try {
        //conexion
        $con = new PDO($DSN, USER, PASS);
        //ater user smail createdb -- para poer crear bd
        $con->exec("DROP DATABASE IF EXISTS trabajos");
        $con->exec("CREATE DATABASE trabajos"); // creo la base de datos que me interesa
        //darle permiso alter user smail to createrole para que pueda hacer drop
        $con->exec("DROP USER IF EXISTS trabajos"); //creo el usuario 
        $con->exec("CREATE USER trabajos WITH PASSWORD 'SmailSmail'");
        $con->exec("GRANT ALL PRIVILEGES ON DATABASE trabajos TO trabajos");
        // Conexión a la nueva base de datos
        $DSN = 'pgsql:host=' . IP . ';dbname=trabajos'; //me cambio de la base de datos postgres a trabajos para crear dentro la tabla
        $con = new PDO($DSN, USER, PASS);
        $archivoSQL = './baseInexistente.sql'; //cargo el script y creo la tabla
        $sqlScript = file_get_contents($archivoSQL);
        try {
            $con->exec($sqlScript);
        } catch (PDOException $e) {
            echo "Error al ejecutar el script: " . $e->getMessage();
        }

        header('Location: ./index.php');
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function leerdatos($con)
{
    try {
        $sql = 'SELECT * FROM mistrabajos';
        $stmt = $con->query($sql);

        if ($stmt) {
            echo '<pre>';
            echo '<table>';
            $columns = array();
            $columnCount = $stmt->columnCount();
            // Obtener los nombres de las columnas
            for ($i = 0; $i < $columnCount; $i++) {
                $columnMeta = $stmt->getColumnMeta($i);
                $columns[] = $columnMeta['name'];
            }
            // Mostrar los nombres de las columnas
            echo '<tr>';
            foreach ($columns as $column) {
                echo '<th>' . $column . '</th>';
            }
            echo '<th>modificar</th>';
            echo '</tr>';
            // Mostrar los datos
            while ($array = $stmt->fetch(PDO::FETCH_ASSOC)) {
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

            echo '</table>';
            echo '<form action="" method="get">
                    <label for=""><input type="submit" name="insertar" value="INSERTAR"></label>
                  </form>';
        } else {
            echo 'No se pudo ejecutar la consulta';
        }
    } catch (\PDOException $e) {
        echo 'Error: ' . $e->getMessage();
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


    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $_REQUEST['fecha'])) {
        $errores['fecha'] = 'Campo vacío o formato inválido (YYYY-MM-DD)';
    }
    return empty($errores); // Devuelve true si no hay errores
}
function darpermisos()
{
    $host = $_SERVER['SERVER_ADDR'];
    $con = new PDO("pgsql:host=$host;dbname=trabajos;user=smail;password=smail"); //me conecto con un usuario con permisos a la base de datos de trabajos 
    $con->exec('GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE MisTrabajos TO trabajos'); //le doy al usuario trabajos todos los permisoso con el usuario smail
    $con->exec('GRANT USAGE ON SEQUENCE mistrabajos_id_seq TO trabajos'); //esta linea sirve para darle permisos para usar el autoincrement a trabajos
}
function borrarLinea($nombre, $id)
{
    try {
        $host = $_SERVER['SERVER_ADDR'];
        $con = new PDO("pgsql:host=$host;dbname=$nombre;user=$nombre;password=SmailSmail");

        if ($con) {
            // Consulta preparada para eliminar la fila con el id proporcionado
            $sql = 'DELETE FROM MisTrabajos WHERE id = :id';
            $stmt = $con->prepare($sql);
            // Enlazar el parámetro id a la consulta preparada
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            // Ejecutar la consulta
            $stmt->execute();
            // Verificar si se afectó alguna fila
            if ($stmt->rowCount() > 0) {
                echo "La fila con el ID $id ha sido eliminada correctamente.";
                header('Location: ./index.php');
            } else {
                echo "No se encontró ninguna fila con el ID $id.";
            }
        } else {
            echo "Conexión fallida.";
        }
    } catch (\PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
function rellenar($id, $nombre, $valor) //vamos llamando a esta funcion para rellenar el valor de los inputs
{
    try {
        $host = $_SERVER['SERVER_ADDR'];
        $con = new PDO("pgsql:host=$host;dbname=$nombre;user=$nombre;password=SmailSmail");

        if ($con) {
            $sql = 'SELECT ' . $valor . ' FROM MisTrabajos WHERE id = :id';
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                echo $result[$valor]; //esto es lo que escribe el valor en cada input
            } else {
                echo 'No se encontraron resultados para el ID ' . $id;
            }
        } else {
            echo 'Conexión fallida.';
        }
    } catch (\PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

function editarvalor($nombre, $id)
{
    try {
        $host = $_SERVER['SERVER_ADDR'];
        $con = new PDO("pgsql:host=$host;dbname=$nombre;user=$nombre;password=SmailSmail");
        //ahora el usuario trabajos ya tiene todos los permisos necesarios

        if ($con) {
            $sql = "UPDATE MisTrabajos SET empresa = :empresa, meses = :meses, fecha_entrada = :fecha_entrada WHERE id = :id";
            $stmt = $con->prepare($sql);
            $empresa = $_REQUEST['empresa'] ?? ''; // Verifica si estos valores no son nulos antes de pasarlos
            $meses = (float) ($_REQUEST['meses'] ?? 0); //en caso de nulo devuelve 0
            $fecha_entrada = $_REQUEST['fecha'] ?? '';

            $stmt->bindParam(':empresa', $empresa);
            $stmt->bindParam(':meses', $meses);
            $stmt->bindParam(':fecha_entrada', $fecha_entrada);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                echo "Se ha actualizado la fila con el ID $id";
                header('Location: ./index.php');
            } else {
                echo "No se pudo actualizar la fila con el ID $id";
            }
        } else {
            echo 'Conexión fallida.';
        }
    } catch (\PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
function aniadirvalor($bd)
{
    try {
        $host = $_SERVER['SERVER_ADDR'];
        $con = new PDO("pgsql:host=$host;dbname=$bd;user=$bd;password=SmailSmail");

        if ($con) {
            $empresa = $_REQUEST['empresa'];
            $meses = $_REQUEST['meses'];
            $fecha_entrada = $_REQUEST['fecha'];

            $sql = "INSERT INTO MisTrabajos (empresa, meses, fecha_entrada) VALUES (?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->execute([$empresa, $meses, $fecha_entrada]);

            if ($stmt->rowCount() > 0) {
                echo "Valores insertados correctamente.";
                header('Location: ./index.php');
            } else {
                echo "Error al insertar valores.";
            }
        } else {
            echo "Conexión fallida.";
        }
    } catch (\PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
