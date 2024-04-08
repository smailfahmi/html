<?php
require('./controllers/Base.php');
require('./config/confi.php');
// Obtener la URI
if (isset($_SERVER['PATH_INFO'])) {
    $recurso = Base::divideUri($_SERVER['PATH_INFO']);
    if ($recurso[1] == "gymTrainer") {
        switch ($recurso[2]) {
            case 'usuarios':
                 UsuariosController::manejarSolicitud();
                break;

            case 'datosUsuario':
                require('./controllers/DatosUsuarioController.php');
                DatosUsuarioController::manejarSolicitud($recurso);
                break;

            case 'rutina':
                require('./controllers/RutinaController.php');
                RutinaController::manejarSolicitud($recurso);
                break;

            case 'ejercicios':
                require('./controllers/EjerciciosController.php');
                EjerciciosController::manejarSolicitud($recurso);
                break;

            default:
                Base::response("HTTP/1.0 404 Direccion incorrecta");
                break;
        }
    } else {
        Base::response("HTTP/1.0 404 Direccion incorrecta");
    }
} else {
    Base::response("HTTP/1.0 404 Direccion incorrecta");
}
