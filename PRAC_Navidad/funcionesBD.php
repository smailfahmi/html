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
                    if ($row['visible'] == 1) {
                        # code...

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
function compruebaPermisoA()
{
    if (isset($_SESSION['usuario'])) {
        if ($_SESSION['usuario']['perfil'] == 'ADM') {
            return true;
        } else
            return false;
    } else
        return false;
}
function compruebaPermisoM()
{
    if (isset($_SESSION['usuario'])) {
        if ($_SESSION['usuario']['perfil'] == 'MOD') {
            return true;
        } else
            return false;
    } else
        return false;
}
function compruebastock($producto_id)
{
    $conn = new mysqli(IP, 'tienda', 'SmailSmail', 'tienda');

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    $producto_id = $_REQUEST['numero'];
    // Consulta para obtener el stock actual del producto
    $sql = "SELECT stock FROM Productos WHERE id = $producto_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stock_actual = $row["stock"];

        // Verificar si hay stock disponible
        if ($stock_actual > 0) {
            // Restar uno al stock disponible
            $nuevo_stock = $stock_actual - 1;

            // Actualizar el stock en la base de datos
            $update_sql = "UPDATE Productos SET stock = $nuevo_stock WHERE id = $producto_id";
            if ($conn->query($update_sql) === TRUE) {
                // Cerrar la conexión y retornar verdadero (se restó el stock con éxito)
                $conn->close();
                return true;
            } else {
                echo "Error al actualizar el stock: " . $conn->error;
            }
        } else {
            // Cerrar la conexión y retornar falso (no hay stock disponible)
            $conn->close();
            return false;
        }
    } else {
        echo "Producto no encontrado";
    }

    // Cerrar la conexión por si hay algún error
    $conn->close();
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
        echo '<a class="btn btn-dark mb-2" href="./mostrar.php">Mostrar albaranes</a>';
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
        $valor = 0;
        $stmt = $con->prepare($sql);

        // Asignar valores a los marcadores de posición y ejecutar la consulta
        $stmt->bind_param('ii', $valor, $id);

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
        $sql = 'UPDATE Productos SET stock=? , visible=? WHERE id=?';
        $stmt = $con->prepare($sql);
        $valor = 1;
        // Asignar valores a los marcadores de posición y ejecutar la consulta
        $stmt->bind_param('iii', $cantidad, $valor, $id,);

        $stmt->execute();
        $stmt->close();
        $con->close();
    } catch (\Throwable $th) {
        echo 'Error: ' . $th->getMessage();
    }
    insertarAlbaran($id, $cantidad);
    mostrarProductos();
}
function insertarAlbaran($id, $cantidad)
{

    // Detalles de la conexión a la base de datos
    $servername = $_SERVER['SERVER_ADDR'];
    $username = "tienda";
    $password = "SmailSmail";
    $dbname = "tienda";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Datos para la inserción
    $producto_id = $id; // Reemplaza con el ID del producto
    $administrador_id = sacarid(); // Reemplaza con el ID del administrador
    $cantidad_anadida = $cantidad; // Cantidad añadida en el albarán

    // Query de inserción
    $sql = "INSERT INTO Albaran (producto_id, administrador_id, cantidad_anadida) 
        VALUES ($producto_id, $administrador_id, $cantidad_anadida)";

    // Ejecutar la inserción y verificar si fue exitosa
    if ($conn->query($sql) === TRUE) {
        echo "Inserción exitosa en la tabla Albaran.";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
function sacarid()
{
    // Detalles de la conexión a la base de datos
    $servername = $_SERVER['SERVER_ADDR'];
    $username = "tienda";
    $password = "SmailSmail";
    $dbname = "tienda";
    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }
    // Sanitizar el nombre de usuario para evitar inyección SQL
    $nombreUsuario = $conn->real_escape_string($_SESSION['usuario']['usuario']);
    // Consulta SQL para obtener el ID del usuario por nombre de usuario
    $sql = "SELECT id FROM Usuarios WHERE usuario = '$nombreUsuario'";
    // Ejecutar la consulta
    $result = $conn->query($sql);
    // Verificar si se obtuvieron resultados y obtener el ID
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idUsuario = $row['id'];
    } else {
        // Si no se encontró ningún usuario con ese nombre de usuario
        $idUsuario = null;
    }
    // Cerrar la conexión
    $conn->close();
    return $idUsuario;
}
function editarMod()
{
    try {
        // Aquí va tu conexión a la base de datos
        $con = new mysqli(IP, 'tienda', 'SmailSmail', 'tienda');

        // Verificar la conexión
        if ($con->connect_error) {
            die("Error de conexión: " . $con->connect_error);
        }

        // Realizar la consulta a la tabla Productos
        $query = "SELECT * FROM Pedidos";
        $result = $con->query($query);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            echo '<div class="container mt-4">';
            echo '<h2>Pedidos</h2>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-hover">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                    <th>ID</th>
                    <th>ID-P</th>
                    <th>ID-U</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>';
            echo '</thead>';
            // Iterar sobre los resultados
            while ($row = $result->fetch_assoc()) {
                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['producto_id'] . '</td>';
                echo '<td>' . $row['usuario_id'] . '</td>';
                echo '<td>' . $row['cantidad'] . '</td>';
                echo '<td>' . $row['fecha_pedido'] . '</td>';
                echo '</tr>';
                echo ' </tbody>';
            }

            echo '</table>';
            echo '</div>';
            echo '</div>';
        } else {
            echo 'No hay productos disponibles.';
        }
        $query = "SELECT * FROM Albaran";
        $result = $con->query($query);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            echo '<div class="container mt-4">';
            echo '<h2>Albaran</h2>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-hover">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                    <th>ID</th>
                    <th>ID-P</th>
                    <th>ID-A</th>
                    <th>Cantidad añadida</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>';
            echo '</thead>';
            // Iterar sobre los resultados
            while ($row = $result->fetch_assoc()) {
                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['producto_id'] . '</td>';
                echo '<td>' . $row['administrador_id'] . '</td>';
                echo '<td>' . $row['cantidad_anadida'] . '</td>';
                echo '<td>' . $row['fecha_albaran'] . '</td>';
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
function editarAdmin()
{
    try {
        // Aquí va tu conexión a la base de datos
        $con = new mysqli(IP, 'tienda', 'SmailSmail', 'tienda');

        // Verificar la conexión
        if ($con->connect_error) {
            die("Error de conexión: " . $con->connect_error);
        }

        // Realizar la consulta a la tabla Productos
        $query = "SELECT * FROM Pedidos";
        $result = $con->query($query);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            echo '<div class="container mt-4">';
            echo '<h2>Pedidos</h2>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-hover">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                    <th>ID</th>
                    <th>ID-P</th>
                    <th>ID-U</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>';
            echo '</thead>';
            // Iterar sobre los resultados
            while ($row = $result->fetch_assoc()) {
                echo '<tbody>';
                echo '<tr>';
    ?>
                <form method="post" action="">
                    <td><input class="form-control" type="number" name="id" value="<?php echo $row['id']; ?>" readonly></td>
                    <td><input class="form-control" type="number" name="producto_id" value="<?php echo $row['producto_id']; ?>"></td>
                    <td><input class="form-control" type="number" name="usuario_id" value="<?php echo $row['usuario_id']; ?>"></td>
                    <td><input class="form-control" type="number" name="cantidad" value="<?php echo $row['cantidad']; ?>"></td>
                    <td><input class="form-control" type="text" name="fecha_pedido" value="<?php echo $row['fecha_pedido']; ?>" readonly></td>
                    <td><input class="btn btn-dark" type="submit" name="actualizar" value="Actualizar"></td>
                </form>
            <?

                echo '</tr>';
                echo ' </tbody>';
            }

            echo '</table>';
            echo '</div>';
            echo '</div>';
        } else {
            echo 'No hay productos disponibles.';
        }
        $query = "SELECT * FROM Albaran";
        $result = $con->query($query);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            echo '<div class="container mt-4">';
            echo '<h2>Albaran</h2>';
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-hover">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                    <th>ID</th>
                    <th>ID-P</th>
                    <th>ID-A</th>
                    <th>Cantidad añadida</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>';
            echo '</thead>';
            // Iterar sobre los resultados
            while ($row = $result->fetch_assoc()) {
                echo '<tbody>';
                echo '<tr>';
            ?>
                <form method="post" action="">
                    <td><input class="form-control" type="number" name="id" value="<?php echo $row['id']; ?>" readonly></td>
                    <td><input class="form-control" type="number" name="producto_id" value="<?php echo $row['producto_id']; ?>"></td>
                    <td><input class="form-control" type="number" name="administrador_id" value="<?php echo $row['administrador_id']; ?>"></td>
                    <td><input class="form-control" type="number" name="cantidad_anadida" value="<?php echo $row['cantidad_anadida']; ?>"></td>
                    <td><input class="form-control" type="text" name="fecha_albaran" value="<?php echo $row['fecha_albaran']; ?>" readonly></td>
                    <td><input class="btn btn-dark" type="submit" name="actualizar1" value="Actualizar"></td>

                </form>
<?
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
function actualiza()
{

    $con = new mysqli(IP, 'tienda', 'SmailSmail', 'tienda');

    // Verificar la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }

    $producto_id = $_REQUEST['producto_id'];
    $usuario_id = $_REQUEST['usuario_id'];
    $cantidad = $_REQUEST['cantidad'];
    $id = $_REQUEST['id'];
    // Query para actualizar el registro en la tabla Albaran
    $sql = "UPDATE Pedidos SET producto_id = $producto_id, usuario_id = $usuario_id, cantidad = $cantidad WHERE id = $id";

    if ($con->query($sql) === TRUE) {
    } else {
        echo "Error al actualizar el registro: " . $con->error;
    }

    $con->close();
}
function actualiza1()
{
    $con = new mysqli(IP, 'tienda', 'SmailSmail', 'tienda');

    // Verificar la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }

    $producto_id = $_REQUEST['producto_id'];
    $administrador_id = $_REQUEST['administrador_id'];
    $cantidad_anadida = $_REQUEST['cantidad_anadida'];
    $id = $_REQUEST['id'];
    // Query para actualizar el registro en la tabla Albaran
    $sql = "UPDATE Albaran SET producto_id = $producto_id, administrador_id = $administrador_id, cantidad_anadida = $cantidad_anadida WHERE id = $id";

    if ($con->query($sql) === TRUE) {
    } else {
        echo "Error al actualizar el registro: " . $con->error;
    }

    $con->close();
}
function aniadirprod()
{
    echo '
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label  class="form-label">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label  class="form-label">Seleccionar imagen:</label>
            <input type="file" id="imagen" name="imagen" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label  class="form-label">Descripción:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="4" cols="30"></textarea>
        </div>
        <div class="mb-3">
            <label  class="form-label">Precio:</label>
            <input type="number" id="precio" name="precio" class="form-control" min="0.01" step="0.01" required>
        </div>
        <div class="mb-3">
        <label class="form-label">Stock:</label>
        <input type="number" id="stock1" name="stock1" class="form-control" min="1" required>
       </div>
        <input type="submit" class="btn btn-primary" value="Agregar" name="agregar">
    </form>
    ';
}

function guardaImagen()
{

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == UPLOAD_ERR_OK) {
            $nombre_temporal = $_FILES["imagen"]["tmp_name"];
            $nombre_archivo = $_FILES["imagen"]["name"];
            $directorio_destino = "./imagenes/prod/";

            move_uploaded_file($nombre_temporal, $directorio_destino . $nombre_archivo);
        }
    }
}
function agregar()
{
    guardaImagen();
    $con = new mysqli(IP, 'tienda', 'SmailSmail', 'tienda');

    // Verificar la conexión
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }
    // Preparar la sentencia SQL con parámetros
    $sql = "INSERT INTO Productos (nombre,imagen_url, descripcion, precio,stock) VALUES (?, ?, ?, ?,?)";
    $stmt = $con->prepare($sql);
    $nombre = $_REQUEST['nombre'];
    $descripcion = $_REQUEST['descripcion'];
    $precio = $_REQUEST['precio'];
    $ruta = "./imagenes/prod/" . $_FILES["imagen"]["name"];
    $stock = $_REQUEST['stock1'];
    // Vincular los parámetros
    $stmt->bind_param("sssdd", $nombre, $ruta, $descripcion, $precio, $stock);

    // Ejecutar la sentencia
    if ($stmt->execute() === TRUE) {
        header('Location: ./admin.php');
    } else {
        echo "Error al agregar el producto: " . $con->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $con->close();
}
