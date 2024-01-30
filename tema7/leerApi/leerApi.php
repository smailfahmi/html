<?
// $uri = "http://dataservice.accuweather.com/forecasts/v1/daily/1day/303121?apikey=MEOZP32FLKOBbmT2LYL0QRlKcP7GCHNa&language=es-es";
$uri = "http://dataservice.accuweather.com/forecasts/v1/daily/5day/303121?apikey=MEOZP32FLKOBbmT2LYL0QRlKcP7GCHNa&language=es-es";
$contenido = file_get_contents($uri);
if ($contenido) {
    // echo '<pre>';
    // $jsonContenido = json_decode($contenido, true);
    // $f = ($jsonContenido['DailyForecasts'][0]['Temperature']['Minimum']['Value'] - 32) * 5 / 9;
    // print_r($f);
    // echo '<br>';
    // print_r($contenido);
}
?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
    </ul>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>


</body>

</html>