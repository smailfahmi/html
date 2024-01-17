<form action="" method="get">


    <label for="nombre">Nombre: <input type="text" name="nombre" id="nombre"></label>
    <p>
        <?php
        if (isset($errores)) {
            escribirErrores($errores, "nombre");
        }

        ?>
    </p>
    <label for="password">Contraseña: <input type="password" name="pass" id="pass"></label>
    <p>
        <?php
        if (isset($errores)) {
            escribirErrores($errores, "pass");
        }

        ?>
    </p>
    <label for="nombre"><input type="submit" name="login" value="Iniciar" id="nombre"></label>
    <p>
        <?php
        if (isset($errores)) {
            escribirErrores($errores, "validado");
        }

        ?>
    </p>
</form>