<?php

$fechaActual = new DateTime();


$fechaFutura = $fechaActual->modify('+60 days');


$nombreDiaSemana = $fechaFutura->format('l');


$fechaFormateada = $fechaFutura->format('d/m/Y');

echo "Fecha dentro de 60 días: $fechaFormateada<br>";
echo "Día de la semana: $nombreDiaSemana";
