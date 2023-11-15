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

    ?>
    <table class="default">
        <tr>
            <td>nota</td>
            <td>nota 1</td>
            <td>nota 2</td>
            <td>nota 3</td>
        </tr>
        <?php
        $array = []; // Array para almacenar los datos del CSV

        if (($gestor = fopen("notas.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                $numero = count($datos);
                echo "<tr>";

                $arrays = []; // Array para almacenar los datos de cada fila

                for ($c = 0; $c < $numero; $c++) {
                    $arrays[$c] = $datos[$c];
                    echo "<td>";
                    echo $datos[$c];
                    echo "</td>";
                }

                $array[] = $arrays; // Agregar el array de la fila al array principal
                echo "</tr>";
            }
            fclose($gestor);
        }

        // Imprimir el array completo para verificar
        echo '<pre>';
        print_r($array);
        ?>
    </table>
    <form action="" method="get">
        <input type="submit" value="convertir" name="convertir">
    </form>
</body>

</html>