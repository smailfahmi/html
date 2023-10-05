<?php
$miCumpleTimestamp = strtotime("10-06-1999"); // Fecha en formato YYYY-MM-DD
$miCumpleFecha = date("d/m/Y", $miCumpleTimestamp); // Formato dd/mm/yyyy

echo "Mi cumpleaños en formato timestamp: $miCumpleTimestamp<br>";
echo "Mi cumpleaños en formato dd/mm/yyyy: $miCumpleFecha";
?>