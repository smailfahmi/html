<div class="container">
    <div class="row justify-content-center p-2">
        <div class="home col-md-4 text-center d-flex justify-content-center align-items-center">
            <h1> SMAILSHOP</h1>
            <img src="./public/imagenes/images.jpg" alt="" style="border-radius: 50%; height: 75px; width: 75px;">
        </div>
    </div>
</div>
<p class="w-100 text-center p-2"> <?php escribirErrores($errores, "insertado"); ?></p>
<div class="container pt-3 pb-3">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nombre del Producto:</label>
            <input type="text" id="nombreInser" name="nombreInser" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Seleccionar imagen:</label>
            <input type="file" id="imagenInser" name="imagenInser" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <input id="descripcionInser" name="descripcionInser" class="form-control" rows="4" cols="30"></input>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio:</label>
            <input type="number" id="precioInser" name="precioInser" class="form-control" min="0.01" step="0.01">
        </div>
        <div class="mb-3">
            <label class="form-label">Stock:</label>
            <input type="number" id="stockInser" name="stockInser" class="form-control" min="1">
        </div>
        <div class="mb-3">
            <label class="form-label">Categoria:</label>
            <input type="number" id="categoriaInser" name="categoriaInser" class="form-control" min="1">
        </div>
        <input type="submit" class="btn btn-primary" value="Agregar" name="Agregar">
        <input type="submit" class="btn btn-primary" value="Volver" name="Volver">

    </form>

</div>