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
        $con->connect(IP, USER, PASS,);
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
                                <form action="carrito.php" method="post">
                                    <input type="hidden" name="oculto" value="art<?php echo $contador; ?>">
                                    <input type="submit" class="carrito btn btn-dark" value="Agregar al carrito"></input>
                                    <!-- Otros campos o elementos del formulario si los hay -->
                                </form>

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
<? }

function extraerNumero($cadena)
{
    preg_match('/\d+/', $cadena, $matches); // Encuentra una secuencia de uno o más dígitos
    return $matches[0]; // Devuelve el primer número encontrado en la cadena
}
function leerCarrito($id)
{
    $numer = extraerNumero($id);

    echo '<div class="container">';
    echo '<div class="row">';

    $conexion = new mysqli(IP, USER, PASS, 'tienda');

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $query = "SELECT * FROM Productos WHERE id= $numer";
    $result = $conexion->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="container mt-4">';
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<div class="row">';
            echo '<div class="col-md-4">';
            echo '<img src="' . $row['imagen_url'] . '" class="img-fluid" alt="Imagen">';
            echo '</div>';
            echo '<div class="col-md-8">';
            echo '<h5 class="card-title">' . $row['nombre'] . '</h5>';
            echo '<p class="card-text">' . $row['descripcion'] . '</p>';
            echo '<p class="card-text">' . $row['precio'] . ' €</p>';
            echo '<form action="" method="post">';
            echo '<input type="submit" name="comprar" value="Finalizar Comprar" class="btn btn-dark"></input>';
            echo '<input type="hidden" name="numero" value="' . $numer . '" ></input>';
            echo '</form>';
            echo '</div></div></div></div></div>';
        }
    } else {
        echo "No hay productos disponibles.";
    }

    $conexion->close();
    echo '</div></div>';
}

function updatear()
{
    try {
        $con = new mysqli($_SERVER['SERVER_ADDR'], 'tienda', 'SmailSmail', 'tienda');

        // Verificar la conexión
        if ($con->connect_error) {
            die("Error de conexión: " . $con->connect_error);
        }

        // Consulta SQL con consulta preparada y marcadores de posición
        $sql = 'UPDATE Usuarios SET clave=?, nombre=?, correo=? WHERE id=?';
        $stmt = $con->prepare($sql);

        // Asignar valores a los marcadores de posición y ejecutar la consulta
        $stmt->bind_param('sssi', $_REQUEST['contra'], $_REQUEST['nombre'], $_REQUEST['email'], $_SESSION['usuario']['id']);
        $_SESSION['usuario']['clave'] = $_REQUEST['contra'];
        $_SESSION['usuario']['correo'] = $_REQUEST['email'];
        $_SESSION['usuario']['nombre'] = $_REQUEST['nombre'];

        $stmt->execute();
        $stmt->close();
        $con->close();
    } catch (\Throwable $th) {
        echo 'Error: ' . $th->getMessage();
    }
}


function compruebaPermisos1()
{
    if (isset($_SESSION['usuario'])) {
        if ($_SESSION['usuario']['perfil'] == 'ADM' || $_SESSION['usuario']['perfil'] == 'MOD') {
            return true;
        } else
            return false;
    } else
        return false;
}
function gestCompra()
{
    try {
        // Configuración de las credenciales en constantes o archivo de configuración externo
        $dsn = 'mysql:host=' . IP . ';dbname=tienda';
        $usuarioDB = 'tienda';
        $contraseñaDB = 'SmailSmail';
        // Crear conexión PDO
        $con = new PDO($dsn, $usuarioDB, $contraseñaDB);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Preparar la consulta para insertar un nuevo pedido
        $sql = 'INSERT INTO Pedidos (producto_id, usuario_id, cantidad, fecha_pedido) 
                VALUES (?, ?, ?, ?)';

        $fecha_hora_actual = date("Y-m-d") . ' ' . date("H:i:s");
        $stmt = $con->prepare($sql);
        // Obtener valores para la inserción (reemplaza los valores por los adecuados)
        $producto_id = $_REQUEST['numero']; // Reemplaza con el ID del producto
        $usuario_id = $_SESSION['usuario']['id']; // Reemplaza con el ID del usuario
        $cantidad = 1; // Reemplaza con la cantidad del producto
        // Ejecutar la consulta con los valores proporcionados
        $stmt->execute([$producto_id, $usuario_id, $cantidad, $fecha_hora_actual]);
        // Cerrar la conexión y retornar true si la inserción fue exitosa
        unset($con);
        return true;
    } catch (PDOException $e) {
        // Manejo de errores: Registra el error en un archivo de registro o muestra un mensaje de error genérico al usuario
        error_log("Error al registrar pedido: " . $e->getMessage(), 0);
        return false;
    }
}

function mostrarProductos()
{
    try {
        // Aquí va tu conexión a la base de datos
        $con = new mysqli(IP, 'tienda', 'SmailSmail', 'tienda');

        // Verificar la conexión
        if ($con->connect_error) {
            die("Error de conexión: " . $con->connect_error);
        }

        // Realizar la consulta a la tabla Productos
        $query = "SELECT * FROM Productos";
        $result = $con->query($query);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            echo '<div class="container mt-4">';
            echo '<h2>Productos</h2>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-hover">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Stock</th>
                    <th>Categoría ID</th>
                    <th>Visible</th>
                    <th>Acciones</th>
                  </tr>';
            echo '</thead>';
            // Iterar sobre los resultados
            while ($row = $result->fetch_assoc()) {
                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['nombre'] . '</td>';
                echo '<td>' . $row['precio'] . '</td>';
                echo '<td>' . $row['descripcion'] . '</td>';
                echo '<td><img src="' . $row['imagen_url'] . '" width="100" height="100"></td>';
                echo '<td>' . $row['stock'] . '</td>';
                echo '<td>' . $row['categoria_id'] . '</td>';
                echo '<td>' . ($row['visible'] == 1 ? 'Sí' : 'No') . '</td>';
                echo '<td>
                <form action="" method="post">
                    <input type="submit" class="btn btn-primary" name="editar" value="Editar">
                    <input type="submit" class="btn btn-danger" name="eliminar" value="Eliminar">
                    <input type="hidden" name="saber" value="' . $row['id'] . '">
                    </form>
              </td>';
                echo '</tr>';
                echo ' </tbody>';
            }

            echo '</table>';
            echo '</div>';
            echo '</div>';
        } else {
            echo 'No hay productos disponibles.';
        }

        // Cerrar la conexión a la base de datos
        $con->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
function mostrarProducto($id)
{
    try {
        // Aquí va tu conexión a la base de datos
        $con = new mysqli(IP, 'tienda', 'SmailSmail', 'tienda');

        // Verificar la conexión
        if ($con->connect_error) {
            die("Error de conexión: " . $con->connect_error);
        }

        // Sanitize the input
        $id = $con->real_escape_string($id);

        // Realizar la consulta a la tabla Productos
        $query = "SELECT * FROM Productos WHERE id =" . $id;
        $result = $con->query($query);

        // Verificar si hay resultados
        if ($result && $result->num_rows > 0) {
            echo '<div class="container mt-4">';
            echo '<h2>Productos</h2>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-hover">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Stock</th>
                    <th>Categoría ID</th>
                    <th>Visible</th>
                  </tr>';
            echo '</thead>';
            echo '<tbody>';

            // Iterar sobre los resultados
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['nombre'] . '</td>';
                echo '<td>' . $row['precio'] . '</td>';
                echo '<td>' . $row['descripcion'] . '</td>';
                echo '<td><img src="' . $row['imagen_url'] . '" width="100" height="100"></td>';
                echo '<td>
                    <form action="" method="post">
                        <input type="number" name="valor" value="' . $row['stock'] . '">
                        <input type="hidden" name="saber1" value="' . $row['id'] . '">
                        <input type="submit" class="btn btn-primary" name="editarstock" value="Editar Stock">
                    </form>
                </td>';
                echo '<td>' . $row['categoria_id'] . '</td>';
                echo '<td>' . ($row['visible'] == 1 ? 'Sí' : 'No') . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
        } else {
            echo 'No hay productos disponibles para el ID proporcionado.';
        }

        echo '
        <form action="" method="post">
            <input type="submit" class="btn btn-primary" name="salir" value="Salir">
        </form>';

        // Cerrar la conexión a la base de datos
        $con->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
function quitar($id)
{
    try {
        $con = new mysqli($_SERVER['SERVER_ADDR'], 'tienda', 'SmailSmail', 'tienda');

        // Verificar la conexión
        if ($con->connect_error) {
            die("Error de conexión: " . $con->connect_error);
        }

        // Consulta SQL con consulta preparada y marcadores de posición
        $sql = 'UPDATE Productos SET visible=? WHERE id=?';
        $stmt = $con->prepare($sql);

        // Asignar valores a los marcadores de posición y ejecutar la consulta
        $stmt->bind_param('ii', 0, $id);

        $stmt->execute();
        $stmt->close();
        $con->close();
    } catch (\Throwable $th) {
        echo 'Error: ' . $th->getMessage();
    }
    mostrarProductos();
}
function cambiarstock($id, $cantidad)
{

    try {
        $con = new mysqli($_SERVER['SERVER_ADDR'], 'tienda', 'SmailSmail', 'tienda');

        // Verificar la conexión
        if ($con->connect_error) {
            die("Error de conexión: " . $con->connect_error);
        }

        // Consulta SQL con consulta preparada y marcadores de posición
        $sql = 'UPDATE Productos SET stock=? SET visible=? WHERE id=?';
        $stmt = $con->prepare($sql);

        // Asignar valores a los marcadores de posición y ejecutar la consulta
        $stmt->bind_param('iii', $cantidad, 1, $id,);

        $stmt->execute();
        $stmt->close();
        $con->close();
    } catch (\Throwable $th) {
        echo 'Error: ' . $th->getMessage();
    }
    mostrarProductos();
}
