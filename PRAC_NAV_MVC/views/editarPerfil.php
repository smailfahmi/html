<div class="container">
    <div class="row justify-content-center p-2">
        <div class="home col-md-4 text-center d-flex justify-content-center align-items-center">
            <h1> SMAILSHOP</h1>
            <img src="./public/imagenes/images.jpg" alt="" style="border-radius: 50%; height: 75px; width: 75px;">
        </div>
    </div>
    <div class="container mt-5">
        <h2>Modificar Usuario</h2>
        <p class="w-100 text-center"> <?php escribirErrores($errores, "update"); ?></p>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" name="usuario" readonly value="<? echo $_SESSION['usuario']->usuario ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="contraNuevo" required value="<? echo $_SESSION['usuario']->clave ?>">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="nombreNuevo" required value="<? echo $_SESSION['usuario']->nombre ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="emailNuevo" required value="<? echo $_SESSION['usuario']->correo ?>">
            </div>
            <div class="mb-3">
                <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required readonly value="<? echo $_SESSION['usuario']->fecha_nacimiento ?>">
            </div>
            <div class="row">
                <input type="submit" class="btn btn-dark m-1" name="Guardar" value="Guardar Cambios">
                <input type="submit" class="btn btn-dark m-1" name="Volver" value="Vover">
                <input type="submit" class="btn btn-dark m-1" name="Cerrar_sesion" value="Cerrar sesion">
            </div>
            </input>
        </form>

    </div>