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
    if (enviado() &&  validacio($errores)) {
        echo "esta enviado";
        echo "<pre>";
        //  print_r($_REQUEST);

        // echo"</pre>";
    } else {



    ?>
        <form action="" method="get" name="formulario1" enctype="multipart/form-data">
            <p><label for="">Alfabetico <input type="text" name="Alfabetico" id="Alfabetico" placeholder="Nombre" value=<?php
                                                                                                                        recuerda('Alfabetico'); ?>></label>
                <?php
                escribirErrores($errores, "Alfabetico");
                ?></p>

            <p><label for="">Alfabetico Opcional <input type="text" name="AlfabeticoOpci" id="AlfabeticoOpci" placeholder="Nombre"></label></p>
            <p><label for="">Alfanumérico <input type="text" name="Alfanumerico" id="Alfanumerico" placeholder="Nombre"></label></p>
            <p><label for="">Alfanumérico Opcional <input type="text" name="AlfanumericoOpci" id="AlfanumericoOpci" placeholder="Nombre"></label></p>
            <p><label for="">Numerico <input type="number" name="Numerico" id="Numerico" placeholder="Numerico"></label> <?php
                                                                                                                            escribirErrores($errores, "Numerico");
                                                                                                                            ?></p>

            <p><label for="">Numerico Opcional <input type="number" name="NumericoOpci" id="NumericoOpci" placeholder="Nombre"></label></p>
            <p><label for="">Fecha <input type="date" name="Fecha" id="Fecha"></label>
                <?php
                escribirErrores($errores, "Fecha");
                ?>
            </p>
            <p><label for="">Fecha Opcional <input type="date" name="" id=""></label></p>
            <p><label for="">Opcion1<input <?php
                                            recuerdaradio('opcion', 'opcion1');
                                            ?> type="radio" name="opcion[]" id="ch1" value="opcion1"></label>
                <label for="">Opcion2<input <?php
                                            recuerdaradio('opcion', 'opcion2');
                                            ?> type="radio" name="opcion[]" id="ch2" value="opcion2"></label>
                <label for="">Opcion3<input <?php
                                            recuerdaradio('opcion', 'opcion3');
                                            ?> type="radio" name="opcion[]" id="ch3" value="opcion3"></label>
                <?php
                escribirErrores($errores, "opcion");
                ?>

            </p>
            <p>
            <p>
                <?php
                for ($i = 1; $i < 7; $i++) {
                    $nombre = "opcion" . $i;
                    echo '<label for=""><input type="checkbox" name="opcionCh[]" id="' . $nombre . '"  value="' . $nombre . '" >Check ' . $i . '</label>';
                    echo ' <br>';
                }
                escribirErrores($errores, "opcionCh");
                ?>
            </p>

            </p>
            <p><label for="">Nº Telefono <input type="text" name="" id=""></label></p>
            <p><label for="">Email <input type="text" name="" id=""></label></p>
            <p><label for="">Contraseña <input type="text" name="" id=""></label></p>
            <p><label for="">Subir documento <input type="file" name="fichero" id="fichero"></label>

                <?php
                escribirErrores($errores, "fichero");
                ?>
            </p>

            <p> <input type="submit" value="Enviar" name="Enviar"></p>
        </form>
    <? //abrir php 
    } // cerrar el else

    // cerrar php
    ?>
</body>

</html>