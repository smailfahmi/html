<div class="container">
    <div class="row justify-content-center p-2">
        <div class="home col-md-4 text-center d-flex justify-content-center align-items-center">
            <h1> SMAILSHOP</h1>
            <img src="./public/imagenes/images.jpg" alt="" style="border-radius: 50%; height: 75px; width: 75px;">
        </div>
    </div>
</div>
<p class="w-100 text-center p-2"> <?php escribirErrores($errores, "stock"); ?></p>
<?
leerCarrito($producto);
?>