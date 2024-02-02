<?
// $uri = "http://dataservice.accuweather.com/forecasts/v1/daily/1day/303121?apikey=MEOZP32FLKOBbmT2LYL0QRlKcP7GCHNa&language=es-es";
$uri = "http://dataservice.accuweather.com/forecasts/v1/daily/5day/303121?apikey=MEOZP32FLKOBbmT2LYL0QRlKcP7GCHNa&language=es-es";
$contenido = file_get_contents($uri);
// if ($contenido) {
//     // echo '<pre>';
//     $jsonContenido = json_decode($contenido, true);
//     $f = ($jsonContenido['DailyForecasts'][0]['Temperature']['Minimum']['Value'] - 32) * 5 / 9;
//     print_r($f);
//     echo '<br>';
//     print_r($contenido);
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <h2 class="bg-primary text-center m-2 p-2">TIEMPO</h2>


    <div class="container-fluid">
        <p>Tiempo de 5 dias para la provinciade zamora.</p>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">HOY</a></li>
            <li><a data-toggle="tab" href="#menu1">DIA 1</a></li>
            <li><a data-toggle="tab" href="#menu2">DIA 2</a></li>
            <li><a data-toggle="tab" href="#menu3">DIA 3</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
                <h3>HOY</h3>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="panel panel-default">
                                <div class="panel-heading ">Temperatura minima</div>
                                <div class="panel-body"></div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Temperatura maxima</div>
                                <div class="panel-body"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Provabilida de lluvia</div>
                                <div class="panel-body"></div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Viento</div>
                                <div class="panel-body"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <h3>DIA 1</h3>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading ">Temperatura minima</div>
                                    <div class="panel-body"></div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Temperatura maxima</div>
                                    <div class="panel-body"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Provabilida de lluvia</div>
                                    <div class="panel-body"></div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Viento</div>
                                    <div class="panel-body"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <h3>DIA 2</h3>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading ">Temperatura minima</div>
                                    <div class="panel-body"></div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Temperatura maxima</div>
                                    <div class="panel-body"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Provabilida de lluvia</div>
                                    <div class="panel-body"></div>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Viento</div>
                                    <div class="panel-body"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <h3>DIA 3</h3>
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading ">Temperatura minima</div>
                                        <div class="panel-body"></div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Temperatura maxima</div>
                                        <div class="panel-body"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Provabilida de lluvia</div>
                                        <div class="panel-body"></div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">Viento</div>
                                        <div class="panel-body"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>