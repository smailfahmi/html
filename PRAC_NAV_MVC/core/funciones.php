<?

function CrearTarjetas($productos) //leo los datos y en creo la tabla con la informacion 
{
    echo   '<div class="container">';
    echo   '  <div class="row">';

    foreach ($productos as $producto) {

        if ($producto->visible == 1) { // Suponiendo que `visible` es un atributo público en la clase `Productos`
            echo '<div class="col-md-4 mb-4" id="art' . $producto->id . '">';
            echo '<div class="card">';
            echo ' <img src="' . IMG . $producto->imagen_url . '" class="card-img-top" alt="' . $producto->nombre . '">';
            echo '<div class="card-body">';
            echo ' <h5 class="card-title">' . $producto->nombre . '</h5>';
            echo '<p class="card-text">' . $producto->descripcion . '</p>';
            echo '<p class="card-text">Precio: ' . $producto->precio . ' €</p>';
            echo '<form action="" method="post">';
            echo '<input type="hidden" name="idOculto" value="art' . $producto->id . '">';
            echo '<input type="submit" class="carrito btn btn-dark m-1" name="Agregar_carrito" value="Agregar al carrito"></input>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }

    echo '  </div>';
    echo '  </div>';
}
function leerCarrito($producto)
{
    echo '<div class="container mt-4">';
    echo '<div class="card">';
    echo '<div class="card-body">';
    echo '<div class="row">';
    echo '<div class="col-md-4">';
    echo '<img src="' . IMG . $producto->imagen_url . '" class="img-fluid" alt="Imagen">';
    echo '</div>';
    echo '<div class="col-md-8">';
    echo '<h5 class="card-title">' . $producto->nombre .  '</h5>';
    echo '<p class="card-text">' . $producto->descripcion . '</p>';
    echo '<p class="card-text">' . $producto->precio .  ' €</p>';
    echo '<form action="" method="post">';
    echo '<input type="submit" name="finalizar_compra" value="Finalizar Comprar" class="btn btn-dark"></input>';
    echo '<input type="submit" name="Volver" value="Volver" class="btn btn-dark m-1"></input>';
    echo '<input type="hidden" name="idOculto" value="' . $producto->id . '" ></input>';
    echo '</form>';
    echo '</div></div></div></div></div>';
}
function guardaImagen()
{

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["imagenInser"]) && $_FILES["imagenInser"]["error"] == UPLOAD_ERR_OK) {
            $nombre_temporal = $_FILES["imagenInser"]["tmp_name"];
            $nombre_archivo = $_FILES["imagenInser"]["name"];
            $directorio_destino = "./public/imagenes/prod/";

            move_uploaded_file($nombre_temporal, $directorio_destino . $nombre_archivo);
        }
    }
}

function mostraPedidos($pedidos)
{

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
    foreach ($pedidos as $pedido) {
        echo '<tbody>';
        echo '<tr>';
?>
        <form method="post" action="">
            <td><input class="form-control" type="number" name="id" value="<?php echo $pedido->id; ?>" readonly></td>
            <td><input class="form-control" type="number" name="producto_id" value="<?php echo $pedido->producto_id; ?>"></td>
            <td><input class="form-control" type="number" name="usuario_id" value="<?php echo $pedido->usuario_id; ?>"></td>
            <td><input class="form-control" type="number" name="cantidad" value="<?php echo $pedido->cantidad; ?>"></td>
            <td><input class="form-control" type="text" name="fecha_pedido" value="<?php echo $pedido->fecha_pedido; ?>" readonly></td>
            <? if ($_SESSION['usuario']->perfil == 'ADM') { ?>
                <input type="hidden" name="pedOculto" value="<?php echo $pedido->id ?>">
                <td><input class="btn btn-dark" type="submit" name="actualiPed" value="Actualizar"></td>
            <?   } ?>
        </form>
    <?

        echo '</tr>';
        echo ' </tbody>';
    }

    echo '</table>';
    echo '</div>';
    echo '</div>';
}


function mostrarAlbaran($alabaranes)
{

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
    foreach ($alabaranes as $albaran) {
        echo '<tbody>';
        echo '<tr>';
    ?>
        <form method="post" action="">
            <td><input class="form-control" type="number" name="id" value="<?php echo $albaran->id; ?>" readonly></td>
            <td><input class="form-control" type="number" name="producto_id" value="<?php echo $albaran->producto_id; ?>"></td>
            <td><input class="form-control" type="number" name="administrador_id" value="<?php echo $albaran->administrador_id; ?>"></td>
            <td><input class="form-control" type="number" name="cantidad_anadida" value="<?php echo $albaran->cantidad_anadida; ?>"></td>
            <td><input class="form-control" type="text" name="fecha_albaran" value="<?php echo $albaran->fecha_albaran; ?>" readonly></td>
            <? if ($_SESSION['usuario']->perfil == 'ADM') { ?>
                <input type="hidden" name="pedOculto" value="<?php echo $albaran->id ?>">
                <td><input class="btn btn-dark" type="submit" name="actualiAlb" value="Actualizar"></td>
            <?   } ?>
        </form>
<?
        echo '</tr>';
        echo ' </tbody>';
    }

    echo '</table>';
    echo '</div>';
    echo '</div>';
}
function mostrarProductosT($productosT)
{
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
    foreach ($productosT as $productoT) {
        echo '<form action="" method="post">';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>' . $productoT->id . '</td>';
        echo '<td><input class="form-control" type="text" name="nombreEd" value="' . $productoT->nombre . '" id=""></td>';
        echo '<td><input class="form-control" type="number" name="precioEd" value="' . $productoT->precio . '" id=""></td>';
        echo '<td><input class="form-control" type="text" name="descripcionEd" value="' . $productoT->descripcion . '" id=""></td>';
        echo '<td><img src="' . IMG . $productoT->imagen_url . '" width="100" height="100"></td>';
        echo '<td><input class="form-control" type="number" name="stockEd" value="' . $productoT->stock . '" id=""></td>';
        echo '<td>' . $productoT->categoria_id . '</td>';
        echo '<td>' . ($productoT->visible == 1 ? 'Sí' : 'No') . '</td>';
        if ($_SESSION['usuario']->perfil == 'ADM') {
            echo '<td>
                    <input type="submit" class="btn btn-primary" name="editarProducto" value="Editar">
                    <input type="submit" class="btn btn-danger" name="eliminarProducto" value="Visibilidad">
                    <input type="hidden" name="saberId" value="' . $productoT->id . '">      
              </td>';
        }
        echo '</tr>';
        echo ' </tbody>';
        echo '</form>';
    }

    echo '</table>';
    echo '</div>';
    echo '</div>';
}
