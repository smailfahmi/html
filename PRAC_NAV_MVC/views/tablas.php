<div class="container">
    <div class="row justify-content-center p-2">
        <div class="home col-md-4 text-center d-flex justify-content-center align-items-center">
            <h1> SMAILSHOP</h1>
            <img src="./public/imagenes/images.jpg" alt="" style="border-radius: 50%; height: 75px; width: 75px;">
        </div>
    </div>
</div>
<?php

if (isset($array_pedidos)) {
?> <p class="w-100 text-center"> <?php escribirErrores($errores, "pedidoActua");     ?> </p>
<?php
    mostraPedidos($array_pedidos);
} elseif (isset($array_albaran)) {
?> <p class="w-100 text-center"> <?php escribirErrores($errores, "albaranActua");     ?> </p>
<?php
    mostrarAlbaran($array_albaran);
} elseif (isset($array_productosT)) {
?> <p class="w-100 text-center"> <?php escribirErrores($errores, "editarProd");     ?> </p>
<?php
    mostrarProductosT($array_productosT);
}

?>
<div class="container">
    <form action="" method="post">
        <div class="row">
            <input type="submit" class="btn btn-dark m-2" name="Volver" value="Volver">
        </div>
    </form>
</div>