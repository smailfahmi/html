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
        echo '</table>';
        $dom = new DOMDocument("1.0", "utf-8");
        $raiz = $dom->appendChild($dom->createElement('alumnos'));
        echo '<pre>';
        // print_r($array);
        foreach ($array as $key => $value) {
            $alumno = $dom->createElement('alumno');
            $raiz->appendChild($alumno);
            $contador = 0;
            foreach ($value as $elemento) {
                switch ($contador) {
                    case 0:
                        $valor = $dom->createElement('nombre', $elemento);
                        break;
                    case 1:
                        $valor = $dom->createElement('nota1', $elemento);
                        break;
                    case 2:
                        $valor = $dom->createElement('nota2', $elemento);
                        break;

                    default:
                        $valor = $dom->createElement('nota3', $elemento);
                        break;
                }
                $alumno->appendChild($valor);
                $contador++;
            }
        }
        $dom->formatOutput = true;
        $dom->save('notas.xml');



        $dom->load('notas.xml');
        // sabiendo lo qu ehay dentro y que todos los elementos son iguales
        echo '<table> <tr>';

        for ($i = 0; $i < 4; $i++) {
            switch ($i) {
                case 0:
                    echo '<td> nombre </td>';
                    break;
                case 1:
                    echo '<td> nota1 </td>';
                    break;
                case 2:
                    echo '<td> nota2 </td>';
                    break;

                default:
                    echo '<td> nota3 </td>';
                    break;
            }
        }
        echo '</tr>';
        echo '<pre>';
        foreach ($dom->getElementsByTagName('alumno') as $alumno) {
            $nombre = $alumno->getElementsByTagName('nombre')->item(0)->nodeValue;
            $nota1 = $alumno->getElementsByTagName('nota1')->item(0)->nodeValue;
            $nota2 = $alumno->getElementsByTagName('nota2')->item(0)->nodeValue;
            $nota3 = $alumno->getElementsByTagName('nota3')->item(0)->nodeValue;
            echo "<tr> <td>$nombre</td> <td>$nota1</td> <td>$nota2</td> <td>$nota3</td>";
        }

        //esto solo funciona si el xml esta en linea es decir sin el codigo formateado 
        // // print_r($dom);
        // foreach ($dom->childNodes as $key) {
        //     foreach ($key->childNodes as $key1) {
        //         if ($key1->nodeType == 1) {
        //             $nodo = $alumno->firstChild;
        //             do {
        //                 if ($key1->nodeType == 1) {
        //                     echo "\n" . $nodo->tagName . ":" . $nodo->nodeValue;
        //                 }
        //             } while ($nodo = $nodo->nextSibling);
        //         }
        //         // echo "\nNombre: " . $key1->firstChild->nodeValue;
        //         // echo "\nNombre: " . $key1->firstChild->firstChild->data;
        //     }
        // }

        // echo '<pre>';
        // foreach ($dom->childNodes as $key) {
        //     if ($key->nodeType == 1) { // Verificar si el nodo es de tipo elemento (1)
        //         foreach ($key->childNodes as $key1) {
        //             if ($key1->nodeType == 1) { // Verificar si el nodo hijo es de tipo elemento (1)
        //                 echo "\n" . $key1->tagName . ":" . $key1->nodeValue;
        //             }
        //         }
        //     }
        // }


        # code...

        // Iterar sobre los elementos 'alumno$alumno' e imprimir sus detalles

        ?>
</body>

</html>