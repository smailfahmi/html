<?php
echo time();
echo "<br>";
echo "zona que yine el servidor";
echo "<br>";
echo date_default_timezone_get();
echo "<br> cambio";
echo "<br>";
date_default_timezone_set("Europe/Madrid");
echo date_default_timezone_get();
echo "<br> cambio";
echo "<br>";
echo date("r");
echo "<br> en españa";
echo "<br>";
echo date("d/m/y H:i:s")

?>