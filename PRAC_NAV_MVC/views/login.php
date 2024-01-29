<div class="container">
    <div class="row justify-content-center p-2">
        <div class="home col-md-4 text-center d-flex justify-content-center align-items-center">
            <h1> SMAILSHOP</h1>
            <img src="./public/imagenes/images.jpg" alt="" style="border-radius: 50%; height: 75px; width: 75px;">
        </div>
    </div>

    <div class="row justify-content-center">
        <!-- Formulario de Login -->
        <div class="col-md-6">
            <div class="card p-3">
                <h3 class="mb-4">Inicio de Sesión</h3>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuarioLog">
                        <?php escribirErrores($errores, "usuarioLog"); ?>
                    </div>
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contraseña" name="contraLog">
                        <?php escribirErrores($errores, "contraLog"); ?>
                    </div>
                    <input type="submit" class="btn btn-dark" value="Iniciar" name="Iniciar"></input>
                    <input type="submit" class="btn btn-dark m-1" name="Volver" value="Vover">
                </form>

                <p> <?php escribirErrores($errores, "validado"); ?></p>
            </div>
        </div>

        <!-- Formulario de Registro -->
        <div class="col-md-6">
            <div class="card p-3">
                <h3 class="mb-4">Registro</h3>
                <form action="" method="post">
                    <!-- Aquí va el contenido del formulario de registro -->
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuarioReg" value="<?php
                                                                                                        escribirNombre('usuarioReg');
                                                                                                        ?>">
                        <?php
                        escribirErrores($errores, "usuarioReg");
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombreReg" value="<?php
                                                                                                    escribirNombre('nombreReg');
                                                                                                    ?>">
                        <?php
                        escribirErrores($errores, "nombreReg");
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="emailReg" value="<?php
                                                                                                    escribirNombre('emailReg');
                                                                                                    ?>">
                        <?php
                        escribirErrores($errores, "emailReg");
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="contraReg">
                        <?php
                        escribirErrores($errores, "contraReg");
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="repContraseña" class="form-label">Repite Contraseña</label>
                        <input type="password" class="form-control" name="repContraReg">
                        <?php
                        escribirErrores($errores, "repContraReg");
                        ?>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha Nacimiento</label>
                        <input type="text" class="form-control" id="fecha" name="fechaReg" placeholder="dd/mm/aaaa" value="<?php
                                                                                                                            escribirNombre('fechaReg');
                                                                                                                            ?>">
                        <?php
                        escribirErrores($errores, "fechaReg");
                        ?>
                    </div>
                        <input type="submit" class="btn btn-dark" value="Registrarse" name="Registrarse"></input>
                        <input type="submit" class="btn btn-dark m-1" name="Volver" value="Vover">
                 
                </form>
                <p> <?php escribirErrores($errores, "validado"); ?></p>
            </div>
        </div>
    </div>
</div>