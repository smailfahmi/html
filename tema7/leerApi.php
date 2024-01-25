<?
$uri = "http://dataservice.accuweather.com/forecasts/v1/daily/1day/303121?apikey=MEOZP32FLKOBbmT2LYL0QRlKcP7GCHNa&language=es-es";

$contenido = file_get_contents($uri);
if ($contenido) {
    echo '<pre>';
    $jsonContenido = json_decode($contenido, true);
    $f = ($jsonContenido['DailyForecasts'][0]['Temperature']['Minimum']['Value'] - 32) * 5 / 9;
    print_r($f);
}