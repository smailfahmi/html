<style>
    table,
    th,
    td {
        border: 1px solid black;
    }
</style>
<?php
$liga =
    array(
        "Zamora" =>  array(
            "Salamanca" => array(
                "Resultado" => "3-2", "Roja" => 1, "Amarilla" => 0, "Penalti" => 0
            ),
            "Avila" => array(
                "Resultado" => "4-1", "Roja" => 0, "Amarilla" => 0, "Penalti" => 0
            ),
            "Valladolid" => array(
                "Resultado" => "1-2", "Roja" => 1, "Amarilla" => 1, "Penalti" => 1
            )
        ),
        "Salamanca" =>  array(
            "Zamora" => array(
                "Resultado" => "3-2", "Roja" => 1, "Amarilla" => 0, "Penalti" => 0
            ),
            "Avila" => array(
                "Resultado" => "4-1", "Roja" => 0, "Amarilla" => 0, "Penalti" => 0
            ),
            "Valladolid" => array(
                "Resultado" => "1-2", "Roja" => 1, "Amarilla" => 2, "Penalti" => 1
            )
        ),
        "Avila" =>  array(
            "Zamora" => array(
                "Resultado" => "3-2", "Roja" => 1, "Amarilla" => 0, "Penalti" => 2
            ),
            "Salamanca" => array(
                "Resultado" => "1-3", "Roja" => 1, "Amarilla" => 3, "Penalti" => 0
            ),
            "Valladolid" => array(
                "Resultado" => "1-3", "Roja" => 1, "Amarilla" => 0, "Penalti" => 1
            )
        ),
        "Valladolid" =>  array(
            "Zamora" => array(
                "Resultado" => "3-2", "Roja" => 1, "Amarilla" => 0, "Penalti" => 0
            ),
            "Salamanca" => array(
                "Resultado" => "3-1", "Roja" => 0, "Amarilla" => 0, "Penalti" => 0
            ),
            "Avila" => array(
                "Resultado" => "1-1", "Roja" => 1, "Amarilla" => 1, "Penalti" => 2
            )
        ),
    );
?>

<?php
// $auxiliar = array();

// echo "<pre>";
// echo "equipos ";
// foreach ($liga as $key => $value) {
//     echo "   " . $key;
// }
// echo "<br>";
// echo "<br>";
// while (current($liga)) {
//     //print_r(current($ciclos));
//     // echo current($liga);



//     echo key($liga);

//     $equipo = current($liga);

//     while (current($equipo)) {
//         // echo  key($equipo);
//         $resultado = current($equipo);
//         // while (current($resultado)) {
//         //   echo  "   ".current($resultado);

//         //   echo "<br>";
//         //     next($resultado);
//         // }
//         echo "   ";

//         foreach ($resultado as $key => $value) {
//             echo key($equipo) . "===" . key($liga) ;


//             echo "" . $value . " ";
//         }
//         echo " ";

//         next($equipo);
//     }
//     next($liga);
//     echo "<br>";
//     echo "<br>";
// }
?>

<table>
    <thead>
        <?php
        echo "<th>Equipos </th>";
        foreach ($liga as $key => $value) {
            echo "<th>$key </th>";
        }
        ?>
    </thead>
    <tbody>
        <?php
        $auxiliar = array();
        $contador = 0;
        foreach ($liga as $key => $value) {
            $auxiliar[$contador] = $key;
            $contador++;
        }

        //   print_r($auxiliar);

        foreach ($liga as $key => $value) {
            $contador = 0;
            echo "<tr>";
            echo "<td>";
            echo $key;
            echo "</td>";
            $equipo = current($liga);
            $contador = 0;
            foreach ($equipo as $key1 => $value1) {
                echo " $key == $auxiliar[$contador]==$key1 //  ";

                if ($key === $auxiliar[$contador]) {
                    echo "<td>";
                    echo "</td>";
                    echo "<td>";
                    $resultado = current($equipo);

                    foreach ($resultado as $key2 => $value2) {

                        echo "$value2";
                    }
                    echo "</td>";
                } else {
                    echo "<td>";
                    $resultado = current($equipo);

                    foreach ($resultado as $key2 => $value2) {

                        echo $value2;
                    }
                    echo "</td>";
                }
                $contador++;
            }
            echo "</tr>";
        }

        ?>



    </tbody>
</table>



<table>
    <tr>
        <th>Equipos</th>
        <?php
        // Encabezados de columnas
        foreach ($liga as $local => $partidos) {
            echo "<th>$local</th>";
        }
        ?>
    </tr>
    <?php
    foreach ($liga as $key => $value) {
        $auxiliar[$contador] = $key;
        $contador++;
    }

    foreach ($liga as $local => $partidos) {
        echo "<tr>";
        echo "<td>$local</td>";
        $contador = 0;
        foreach ($partidos as $visitante => $datos) {

            echo "$local // $visitante";
            $resultado = $datos["Resultado"];
            // Dividir el resultado en goles locales y visitantes
            if ($local === $auxiliar[$contador]) {
                echo "<td></td>";
            }
            echo "<td>";
            foreach ($datos as $key2 => $value2) {

                echo $value2." ";
            }
            echo "</td>";

            // list($golesLocal, $golesVisitante) = explode("-", $resultado);
            // echo "<td>$golesLocal-$golesVisitante</td>";
            $contador++;
        }
        echo "</tr>";
    }
    ?>
</table>