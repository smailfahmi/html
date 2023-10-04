<?php
// // Muestra el nombre del fichero en ejecución
// $nombreArchivo = basename(__FILE__);
// echo "<p>Nombre del archivo en ejecución: $nombreArchivo</p>";
echo "a EL FICHERO EN EJECUCUION :";
echo "<pre>";
echo "$_SERVER[SCRIPT_NAME]";
echo "</pre>";
print_r($_SERVER);