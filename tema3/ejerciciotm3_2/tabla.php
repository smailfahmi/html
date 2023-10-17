<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>

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


    $teams = array_keys($liga);
    ?>
    <?php
   // $equipos = array_keys($liga);
    print_r($equipos)
    ?>
    <table>
        <thead>
            <tr>
                <th>Equipos</th>
                <?php

                echo "<th>puntos</th>";
                echo "<th>goles +</th>";
                echo "<th>goles -</th>";

                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($teams as $team) {
                echo "<tr>";
                echo "<td>$team</td>";
                $puntitos = 0;
                $golitos = 0;
                $golitosencontra = 0;
                $golesMarcados = 0;
                $golesConcedidos = 0;
                foreach ($teams as $opponent) {
                    //esto es para los partidos en casa
                    if ($team != $opponent) {
                        $match = $liga[$team][$opponent];
                        $gole = $match["Resultado"];

                        list($golesMarcados, $golesConcedidos) = explode("-", $gole);
                        if ($golesMarcados > $golesConcedidos) {
                            $puntitos = $puntitos + 3;
                        } elseif ($golesMarcados == $golesConcedidos) {
                            $puntitos = $puntitos + 1;
                        }
                    }
                    $golitos += $golesMarcados;
                    $golitosencontra += $golesConcedidos;
                }

                echo "<td>";
                echo $puntitos;
                $puntitos = 0;
                echo "</td>";
                echo "<td>";
                echo $golitos;
                $golitos = 0;
                echo "</td>";
                echo "<td>";
                echo $golitosencontra;
                $golitosencontra = 0;
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>