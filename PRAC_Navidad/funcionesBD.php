<?
require('./conexionBD.php');
function existeBD()
{
    $nombreBase = 'tienda';

    try {
        $con = mysqli_connect(IP, USER, PASS, $nombreBase);
        leerdatos();
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

function crearBD() //creo la base de datos a partir del script que hemos creado anteriormente 
{
    try {
        $con = new mysqli();
        $con->connect(IP, USER, PASS, );
        $script = file_get_contents('./TIENDA_SMAIL.sql');
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
function leerdatos() //leo los datos y en creo la tabla con la informacion 
{
    ?>
    <div class="container">
        <div class="row">
            <?php
            // Conectarte a la base de datos y obtener los productos
            $conexion = new mysqli(IP, USER, PASS, 'tienda');

            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            $query = "SELECT * FROM Productos";
            $result = $conexion->query($query);
            $contador = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $contador++;
                    ?>
                    <div class="col-md-4 mb-4" id="art<? echo $contador; ?>">
                        <div class="card">
                            <img src="<?php echo $row['imagen_url']; ?>" class="card-img-top" alt="<?php echo $row['nombre']; ?>">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $row['nombre']; ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $row['descripcion']; ?>
                                </p>
                                <p class="card-text">Precio: $
                                    <?php echo $row['precio']; ?>
                                </p>
                                <a href="#" class="btn btn-dark">Agregar al carrito</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No hay productos disponibles.";
            }

            $conexion->close();
            ?>
        </div>
    </div>
    <?
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
        $stmt->bind_param("sds", $empresa, $meses, $fecha_entrada); //sds es string,double,string :)
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
        if (
            !preg_match('/^(202[0-4]|20[0-1]\d|\d{1,3})-(0?[1-9]|1[0-2])-(0?[1-9]|1[0-9]|2[0-9])$/', $_REQUEST['fecha'])
        ) {
            $errores['fecha'] = 'CAMPO VACIO O FORMATO INVALIDO (YYYY-MM-DD)';
        }
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
        $meses = (float) $_REQUEST['meses'] ?? 0;
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
