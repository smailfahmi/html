<?php
// ejercicio 1
$datos = [2, 5, 9, 7, 6, 3, 1, 5, 4, 8, 3, 2, 6, 9, 3, 5, 1, 2, 3];
asort($datos);
$unico = array_unique($datos);
foreach ($unico as $key => $val) {
    echo "$key = $val\n";
}

// ejercicio 2
echo "<br>";
$clave = array_search(3, $datos);
//echo $clave;
while ($clave) {

    $datos[$clave] = $clave;
    $clave = array_search(3, $datos);
}
foreach ($datos as $key => $val) {
    echo "$key = $val\n";
    echo "<br>";
}
//ejercios 3
$largo = 4;
$ancho = 4;
$matriz = array();
echo "<br>";
// for ($i=0; $i <$largo ; $i++){ 
//     $matriz[$i]=1;
// }
foreach ($matriz as $key => $val) {
    echo "$val";
}
