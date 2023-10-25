<?php
include("./valida.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $errores = array();
    if (enviado()) {
        // validarformu($errores);
        echo "esta enviado";
        echo "<pre>";
        print_r(
            $_REQUEST
        );

        // echo"</pre>";
    } else {



    ?>
        <form action="" method="get" name="formulario1" enctype="multipart/form-data">
            <p><label for="">Alfabetico <input type="text" name="Nombre" id="Nombre" placeholder="Nombre"></label>

            </p>
            <p> <?php

                textoVacio('Nombre');

                ?></p>
            <p><label for="">Alfabetico Opcional <input type="text" name="" id="" placeholder="Nombre"></label></p>
            <p><label for="">Alfanumérico <input type="text" name="" id="" placeholder="Nombre"></label></p>
            <p><label for="">Alfanumérico Opcional <input type="text" name="" id="" placeholder="Nombre"></label></p>
            <p><label for="">Numerico <input type="number" name="" id="" placeholder="Nombre"></label></p>
            <p><label for="">Numerico Opcional <input type="number" name="" id="" placeholder="Nombre"></label></p>
            <p><label for="">Fecha <input type="date" name="" id=""></label></p>
            <p><label for="">Fecha Opcional <input type="date" name="" id=""></label></p>
            <p><label for="">Opcion1<input type="radio" name="" id=""></label>
                <label for="">Opcion2<input type="radio" name="" id=""></label>
                <label for="">Opcion3<input type="radio" name="" id=""></label>
            </p>
            <p>
                <?php
                for ($i = 1; $i < 7; $i++) {
                    echo '<label for=""><input type="checkbox" name="" id="">Check' . ' ' . $i . '</label>';
                    echo ' <br>';
                }
                ?>
            </p>
            <p><label for="">Nº Telefono <input type="text" name="" id=""></label></p>
            <p><label for="">Email <input type="text" name="" id=""></label></p>
            <p><label for="">Contraseña <input type="text" name="" id=""></label></p>
            <p><label for="">Subir documento <input type="file" name="" id=""></label></p>

            <p> <input type="submit" value="Enviar" name="Enviar"></p>
        </form>
    <? //abrir php 
    } // cerrar el else

    // cerrar php
    ?>
</body>

</html>