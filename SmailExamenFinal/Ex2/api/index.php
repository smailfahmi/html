<?
require('./controllers/Base.php');
require('./controllers/PalabrasController.php');
// echo '<pre>';
// print_r($_SERVER['PATH_INFO']);

if (isset($_SERVER['PATH_INFO'])) {
    $recurso = Base::divideUri($_SERVER['PATH_INFO']);
    if ($recurso[1] === 'palabras') {
        PalabrasController::palabras();
    } else {
    }
    // print_r($recurso);
} else {
    Base::response("HTTP/1.0 404 Direccion incorrecta");
}
