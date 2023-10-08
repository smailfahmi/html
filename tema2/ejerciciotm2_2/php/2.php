<?php

$variable = $_GET['variable'];
//echo $variable;
echo "Tipo de la variable: " . gettype($variable) . "<br>";


echo "Es numérico: " . is_numeric($variable) . "<br>";


if (is_numeric($variable)) {
    echo "Es entero: " . is_int($variable) . "<br>";
    echo "Es float: " . is_float($variable) . "<br>";
}
