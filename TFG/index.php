<?php
require('./controllers/Base.php');

// Obtener la URI
if (isset($_SERVER['PATH_INFO'])) {
    $recurso = Base::divideUri($_SERVER['PATH_INFO']);

    // Identificar el recurso solicitado
    switch ($recurso[1]) {
        case 'usuarios':
            require('./controllers/UsuariosController.php');
            echo "hola";
            // UsuariosController::manejarSolicitud($recurso);
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
