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
    <?
}
function leerCarrito($id) //leo los datos y en creo la tabla con la informacion 
{
    $numer = substr($id, 3, 1); // Obtiene el carácter en la posición 3 (considerando que la indexación comienza desde 0)

    ?>
    <div class="container">
        <div class="row">
            <?php
            // Conectarte a la base de datos y obtener los productos
            $conexion = new mysqli(IP, USER, PASS, 'tienda');

            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            $query = "SELECT * FROM Productos WHERE id= $numer";
            $result = $conexion->query($query);
            $contador = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="container mt-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="<?php echo $row['imagen_url']; ?>" class="img-fluid" alt="Imagen">
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="card-title">
                                            <?php echo $row['nombre']; ?>
                                        </h5>
                                        <p class="card-text">
                                            <?php echo $row['descripcion']; ?>
                                        </p>
                                        <p class="card-text">
                                            <?php echo $row['precio']; ?> €
                                        </p>
                                        <a href="#" class="btn btn-primary">Finalizar compra</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?
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
