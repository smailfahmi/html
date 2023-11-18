<!DOCTYPE html>
<html>
<head>
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
</head>
<body>

<?php
$liga = array(
    "Zamora" => array(
        "Salamanca" => array("Resultado" => "3-2", "Roja" => 1, "Amarilla" => 0, "Penalti" => 0),
        "Avila" => array("Resultado" => "4-1", "Roja" => 0, "Amarilla" => 0, "Penalti" => 0),
        "Valladolid" => array("Resultado" => "1-2", "Roja" => 1, "Amarilla" => 1, "Penalti" => 1)
    ),
    "Salamanca" => array(
        "Zamora" => array("Resultado" => "3-2", "Roja" => 1, "Amarilla" => 0, "Penalti" => 0),
        "Avila" => array("Resultado" => "4-1", "Roja" => 0, "Amarilla" => 0, "Penalti" => 0),
        "Valladolid" => array("Resultado" => "1-2", "Roja" => 1, "Amarilla" => 2, "Penalti" => 1)
    ),
    "Avila" => array(
        "Zamora" => array("Resultado" => "3-2", "Roja" => 1, "Amarilla" => 0, "Penalti" => 2),
        "Salamanca" => array("Resultado" => "1-3", "Roja" => 1, "Amarilla" => 3, "Penalti" => 0),
        "Valladolid" => array("Resultado" => "1-3", "Roja" => 1, "Amarilla" => 0, "Penalti" => 1)
    ),
    "Valladolid" => array(
        "Zamora" => array("Resultado" => "3-2", "Roja" => 1, "Amarilla" => 0, "Penalti" => 0),
        "Salamanca" => array("Resultado" => "3-1", "Roja" => 0, "Amarilla" => 0, "Penalti" => 0),
        "Avila" => array("Resultado" => "1-1", "Roja" => 1, "Amarilla" => 1, "Penalti" => 2)
    ),
);

$teams = array_keys($liga);
?>

<table>
    <thead>
        <tr>
            <th>Equipos</th>
            <?php
            foreach ($teams as $team) {
                echo "<th>$team</th>";
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($teams as $team) {
            echo "<tr>";
            echo "<td>$team</td>";

            foreach ($teams as $opponent) {
                echo "<td>";

                if ($team === $opponent) {
                    echo "-";
                } else {
                    $match = $liga[$team][$opponent];
                    echo $match["Resultado"] . "<br>";
                    echo "Roja: " . $match["Roja"] . "<br>";
                    echo "Amarilla: " . $match["Amarilla"] . "<br>";
                    echo "Penalti: " . $match["Penalti"];
                }

                echo "</td>";
            }

            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
