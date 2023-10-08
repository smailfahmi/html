<?php
$ano = isset($_GET['ano']) ? $_GET['ano'] : 2023;
$mes = isset($_GET['mes']) ? $_GET['mes'] : 10;
$dia = isset($_GET['dia']) ? $_GET['dia'] : 3;
$fecha = "$ano-$mes-$dia";
$dia_semana = date('l', strtotime($fecha));
echo "La fecha $dia/$mes/$ano corresponde a un día de la semana: $dia_semana";
