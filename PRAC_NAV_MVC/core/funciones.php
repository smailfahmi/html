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
