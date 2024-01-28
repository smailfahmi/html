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
            echo '<form action="carrito.php" method="post">';
            echo '<input type="hidden" name="oculto" value="art' . $producto->id . '">';
            echo '<input type="submit" class="carrito btn btn-dark" value="Agregar al carrito"></input>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }

    echo '  </div>';
    echo '  </div>';
}
