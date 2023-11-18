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
// $golesEquipo = array();

// foreach ($liga as $equipo => $partidos) {
//     $golesMarcados = 0;
//     $golesEncajados = 0;
//     $puntos = 0;

//     foreach ($partidos as $oponente => $datosPartido) {
//         $resultado = explode("-", $datosPartido["Resultado"]);
//         $golesMarcados += intval($resultado[0]);
//         $golesEncajados += intval($resultado[1]);

//         if ($resultado[0] > $resultado[1]) {
//             $puntos += 3; // Victoria
//         } elseif ($resultado[0] == $resultado[1]) {
//             $puntos += 1; // Empate
//         }
//     }

//     $golesEquipo[$equipo] = array(
//         "Equipo" => $equipo,
//         "Goles Marcados" => $golesMarcados,
//         "Goles Encajados" => $golesEncajados,
//         "Puntos" => $puntos
//     );
// }

// // Ahora puedes acceder a la información de cada equipo, incluyendo los puntos
// foreach ($golesEquipo as $equipoInfo) {
//     echo "Equipo: " . $equipoInfo["Equipo"] . "\n";
//     echo "Goles Marcados: " . $equipoInfo["Goles Marcados"] . "\n";
//     echo "Goles Encajados: " . $equipoInfo["Goles Encajados"] . "\n";
//     echo "Puntos: " . $equipoInfo["Puntos"] . "\n";
//     echo "\n";
// }
// echo "<br>";
// echo "<br>";
// $golesEquipo = array();

// foreach ($liga as $equipo => $partidos) {
//     $golesMarcadosCasa = 0;
//     $golesEncajadosCasa = 0;
//     $golesMarcadosFuera = 0;
//     $golesEncajadosFuera = 0;
//     $puntos = 0;

//     foreach ($partidos as $oponente => $datosPartido) {
//         $resultado = explode("-", $datosPartido["Resultado"]);
//         $golesMarcadosCasa += intval($resultado[0]);
//         $golesEncajadosCasa += intval($resultado[1]);

//         if ($equipo != $oponente) {
//             // El partido se jugó fuera de casa
//             $golesMarcadosFuera += intval($resultado[1]);
//             $golesEncajadosFuera += intval($resultado[0]);
//         }

//         if ($resultado[0] > $resultado[1]) {
//             $puntos += 3; // Victoria
//         } elseif ($resultado[0] == $resultado[1]) {
//             $puntos += 1; // Empate
//         }
//     }

//     $golesEquipo[$equipo] = array(
//         "Equipo" => $equipo,
//         "Goles Marcados Casa" => $golesMarcadosCasa,
//         "Goles Encajados Casa" => $golesEncajadosCasa,
//         "Goles Marcados Fuera" => $golesMarcadosFuera,
//         "Goles Encajados Fuera" => $golesEncajadosFuera,
//         "Puntos" => $puntos
//     );
// }

// // Ahora puedes acceder a la información de cada equipo, incluyendo los goles en casa y fuera
// foreach ($golesEquipo as $equipoInfo) {
//     echo "Equipo: " . $equipoInfo["Equipo"] . "\n";
//     echo "Goles Marcados Casa: " . $equipoInfo["Goles Marcados Casa"] . "\n";
//     echo "Goles Encajados Casa: " . $equipoInfo["Goles Encajados Casa"] . "\n";
//     echo "Goles Marcados Fuera: " . $equipoInfo["Goles Marcados Fuera"] . "\n";
//     echo "Goles Encajados Fuera: " . $equipoInfo["Goles Encajados Fuera"] . "\n";
//     echo "Puntos: " . $equipoInfo["Puntos"] . "\n";
//     echo "\n";
// }
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";

$golesEquipo = array();

foreach ($liga as $equipo => $partidos) {
    $golesMarcadosCasa = 0;
    $golesEncajadosCasa = 0;
    $golesMarcadosFuera = 0;
    $golesEncajadosFuera = 0;
    $puntos = 0;

    foreach ($partidos as $oponente => $datosPartido) {
        $resultado = explode("-", $datosPartido["Resultado"]);
        $golesMarcadosCasa += intval($resultado[0]);
        $golesEncajadosCasa += intval($resultado[1]);

        if ($equipo != $oponente) {
            // El partido se jugó fuera de casa
            $golesMarcadosFuera += intval($resultado[0]);
            $golesEncajadosFuera += intval($resultado[1]);
            if ($resultado[0] > $resultado[1]) {
                $puntos += 3; // Victoria fuera de casa
            } elseif ($resultado[0] == $resultado[1]) {
                $puntos += 1; // Empate fuera de casa
            }
        }

        if ($resultado[0] > $resultado[1]) {
            $puntos += 3; // Victoria en casa
        } elseif ($resultado[0] == $resultado[1]) {
            $puntos += 1; // Empate en casa
        }
    }

    $golesEquipo[$equipo] = array(
        "Equipo" => $equipo,
        "Goles Marcados Casa" => $golesMarcadosCasa,
        "Goles Encajados Casa" => $golesEncajadosCasa,
        "Goles Marcados Fuera" => $golesMarcadosFuera,
        "Goles Encajados Fuera" => $golesEncajadosFuera,
        "Puntos" => $puntos
    );
}

// Ahora puedes acceder a la información de cada equipo, incluyendo los goles en casa y fuera, y los puntos
foreach ($golesEquipo as $equipoInfo) {
    echo "Equipo: " . $equipoInfo["Equipo"] . "\n";
    echo "Goles Marcados Casa: " . $equipoInfo["Goles Marcados Casa"] . "\n";
    echo "Goles Encajados Casa: " . $equipoInfo["Goles Encajados Casa"] . "\n";
    echo "Goles Marcados Fuera: " . $equipoInfo["Goles Marcados Fuera"] . "\n";
    echo "Goles Encajados Fuera: " . $equipoInfo["Goles Encajados Fuera"] . "\n";
    echo "Puntos: " . $equipoInfo["Puntos"] . "\n";
    echo "\n";
}

