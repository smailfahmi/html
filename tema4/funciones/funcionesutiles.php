<?php
function edad($ano, $mes, $dia)
{
    $edad = new DateTime($ano . "-" . $mes . "-" . $dia);
    $fecha2 = new DateTime();
    $annos = ($edad->diff($fecha2))->y;
    return $annos;
}
function iva($precio, $ivap = 0.21)
{
    return $precio * $ivap;
}
