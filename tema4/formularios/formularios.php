<?php
include("./validacion.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    $errores = array();
    if (enviado()) {

        if (textVacio('nombre')) {
            $errores['nombre'] =   "nombre vacio;";
        }
        if (textVacio('apellido')) {
            $errores['apellido'] =   "apellido vacio;";
        }
    }



    ?>
    <form action="" method="post" name="formulario1" enctype="multipart/form-data">

        <label for="nombre">Nombre:<input type="text" name="nombre" id="nombre" placeholder="nombre" value= <?php
                                                                                                                recuerda('nombre'); ?>></label>
        <br>
        <p class="error">
            <?php
            errores($errores, 'nombre');
            ?>
        </p>
        <label for="apellido">Apellido:<input type="text" name="apellido" id="apellido"></label>
        <p class="error">
            <?php
            errores($errores, 'apellido');
            ?>
        </p>
        <br>
        <label for="hombre"> Hombre:<input type="radio" name="genero" id="hombre" value="hombre"></label>
        <label for="mujer"> Mujer:<input type="radio" name="genero" id="muher" value="mujer"></label>
        <br>
        <label for="ch1">Montar a caballo<input type="checkbox" name="aficion[]" id="ch1" value="jinete"></label>
        <label for="ch2">Bicicleta<input type="checkbox" name="aficion[]" id="ch2" value="ciclista"></label>
        <label for="ch3">Nadar<input type="checkbox" name="aficion[]" id="ch3" value="natacion"></label>
        <br>
        <label for="fecha_N">Fecha Nacimiento
            <input type="datetime-local" name="fecha_n" id="fehca_n">
        </label>
        <br>
        <p>Equipos de Baloncesto</p>
        <select name="equipos baloncesto" id="">
            <option value="0">seleccione una</option>
            <option value="lakers">lakers</option>
            <option value="celtics">celtics</option>
            <option value="bulls">bulls</option>
        </select>
        <br>
        <input type="file" name="fichero" id="">
        <br>
        <input type="hidden" name="usuarioVIP" value="123456">
        <br>

        <input type="submit" value="Enviar" name="Enviar">
        <input type="reset" value="Borrar" name="Borrar">
    </form>
</body>

</html>
<?php

?>