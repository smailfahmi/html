<?php
require('./controllers/Base.php');
require('./dao/DatosUsuarioDAO.php'); // Asegúrate de tener la ruta correcta a tu archivo RutinaDAO.php

class DatosUsuarioController {
    public static function manejarSolicitud($recurso) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (isset($recurso[2])) {
                    // Obtener rutina por ID
                    $rutina = DatosUsuarioDAO::findById($recurso[2]);
                    if ($rutina) {
                        Base::response(json_encode($rutina));
                    } else {
                        Base::response("HTTP/1.0 404 Rutina no encontrada");
                    }
                } else {
                    // Obtener todas las rutinas
                    $rutinas = RutinaDAO::findAll();
                    Base::response(json_encode($rutinas));
                }
                break;

            case 'POST':
                $data = json_decode(file_get_contents('php://input'), true);
                $result = DatosUsuarioDAO::insert($data);
                if ($result) {
                    Base::response("HTTP/1.0 201 Rutina creada");
                } else {
                    Base::response("HTTP/1.0 400 Error al crear rutina");
                }
                break;

            case 'PUT':
                $data = json_decode(file_get_contents('php://input'), true);
                $result = DatosUsuarioDAO::update($data);
                if ($result) {
                    Base::response("HTTP/1.0 200 Rutina actualizada");
                } else {
                    Base::response("HTTP/1.0 400 Error al actualizar rutina");
                }
                break;

            default:
                Base::response("HTTP/1.0 405 Método no permitido");
                break;
        }
    }
}
?>
