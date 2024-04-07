<?php
 // Asegúrate de tener la ruta correcta a tu archivo UsuarioDao.php

class UsuariosController
{
    public static function manejarSolicitud($recurso)
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (isset($recurso[2])) {
                    // Obtener usuario por ID
                    $usuario = UsuarioDao::findById($recurso[2]);
                    if ($usuario) {
                        Base::response(json_encode($usuario));
                    } else {
                        Base::response("HTTP/1.0 404 Usuario no encontrado");
                    }
                } else {
                    // Obtener todos los usuarios
                    $usuarios = UsuarioDao::findAll();
                    Base::response(json_encode($usuarios));
                }
                break;

            case 'POST':
                $data = json_decode(file_get_contents('php://input'), true);
                $result = UsuarioDao::insert($data);
                if ($result) {
                    Base::response("HTTP/1.0 201 Usuario creado");
                } else {
                    Base::response("HTTP/1.0 400 Error al crear usuario");
                }
                if (isset($data->usuario) && isset($data->password)) {
                    $usuario = UsuarioDao::validarLogin($data->usuario, $data->password);

                    if ($usuario) {
                        $_SESSION['usuario'] = $usuario;
                    } else {
                        Base::response("HTTP/1.0 401 Credenciales incorrectas");
                    }
                } else {
                    Base::response("HTTP/1.0 400 Datos incompletos");
                }
                break;

            case 'PUT':
                $data = json_decode(file_get_contents('php://input'), true);
                $result = UsuarioDao::update($data);
                if ($result) {
                    Base::response("HTTP/1.0 200 Usuario actualizado");
                } else {
                    Base::response("HTTP/1.0 400 Error al actualizar usuario");
                }
                break;

            case 'DELETE':
                if (isset($recurso[2])) {
                    $result = UsuarioDao::delete($recurso[2]);
                    if ($result) {
                        Base::response("HTTP/1.0 200 Usuario eliminado");
                    } else {
                        Base::response("HTTP/1.0 400 Error al eliminar usuario");
                    }
                } else {
                    Base::response("HTTP/1.0 400 ID de usuario requerido");
                }
                break;

            default:
                Base::response("HTTP/1.0 405 Método no permitido");
                break;
        }
    }
}
