<?php
require('./controllers/Base.php');
require('./dao/EjerciciosDAO.php'); // Asegúrate de tener la ruta correcta a tu archivo EjerciciosDAO.php

class EjerciciosController {
    public static function manejarSolicitud($recurso) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (isset($recurso[2])) {
                    // Obtener ejercicio por ID
                    $ejercicio = EjerciciosDAO::findById($recurso[2]);
                    if ($ejercicio) {
                        Base::response(json_encode($ejercicio));
                    } else {
                        Base::response("HTTP/1.0 404 Ejercicio no encontrado");
                    }
                } elseif (isset($_GET['nombre'])) {
                    // Buscar ejercicio por nombre
                    $nombre = $_GET['nombre'];
                    $ejercicios = EjerciciosDAO::findByNombre($nombre);
                    Base::response(json_encode($ejercicios));
                } elseif (isset($_GET['grupoMuscular'])) {
                    // Buscar ejercicio por grupo muscular
                    $grupoMuscular = $_GET['grupoMuscular'];
                    $ejercicios = EjerciciosDAO::findByGrupoMuscular($grupoMuscular);
                    Base::response(json_encode($ejercicios));
                } else {
                    // Obtener todos los ejercicios
                    $ejercicios = EjerciciosDAO::findAll();
                    Base::response(json_encode($ejercicios));
                }
                break;

            default:
                Base::response("HTTP/1.0 405 Método no permitido");
                break;
        }
    }
}
?>
