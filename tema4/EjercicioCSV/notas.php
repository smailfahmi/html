<?
include("./verificacion.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td {
            text-align: center;
            border: solid;
        }
    </style>
</head>

<body>
    <?php
    $boton = 0;
    if (isset($_GET['editar'])) {
        print_r($datis);
        $nombreArchivo = "notas.php";
        if (existe($nombreArchivo)) {
            $oculto = $_REQUEST['oculto'];

            header("Location: editar.php?clave=$nombreArchivo&nom=$oculto");
        } else {
            echo "NO EXISTE";
        }
    } elseif (isset($_GET['eliminar'])) {

        $nombreArchivo = "notas.php";
        if (existe($nombreArchivo)) {
            header("Location: escribir.php?clave=$nombreArchivo");
        } else {
            echo "NO EXISTE";
        }
    } else {
    ?>
        <table class="default">
            <tr>
                <td>nota</td>
                <td>nota 1</td>
                <td>nota 2</td>
                <td>nota 3</td>
                <td>botones</td>

            </tr>
            <?
            $elemento = 0;
            $fila = 0;
            if (($gestor = fopen("notas.csv", "r")) !== FALSE) {
                while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                    $numero = count($datos);
                    echo "<tr>";
                    echo        " <form action='' method='get'>";
                    for ($c = 0; $c < $numero; $c++) {

                        echo "<td>";
                        echo $datos[$c];

                        echo "</td>";
                        $elemento++;

                        if ($elemento == 4) {  ?>
                            <td> <label for="Leer">
                                    <input type="hidden" value="<? echo $fila; ?>" name="oculto">
                                    <input type="submit" value="editar" name="editar">
                                </label>
                                <label for="Escribir">
                                    <input type="submit" value="eliminar" name="eliminar">
                                </label>
                            </td>
            <?

                            echo "  </form>";
                            echo "</tr>";
                            $elemento = 0;
                            $boton++;
                        }
                    }
                    $fila++;
                }
                fclose($gestor);
            }
            ?>

        </table>

    <?php } ?>
</body>

</html>