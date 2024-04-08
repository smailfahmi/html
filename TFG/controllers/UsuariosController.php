<?php
// Asegúrate de tener la ruta correcta a tu archivo UsuarioDao.php

class UsuariosController
{
    public static function manejarSolicitud()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':;

                if (base::buscarFiltros(['id'])) {

                    $usuario = UsuarioDao::findById(base::retornaValores("id"));


                    if ($usuario) {
                        Base::response("HTTP/1.0 200", json_encode($usuario));
                    } else {
                        Base::response("HTTP/1.0 404 Usuario no encontrado");
                    }
                } else {
                    $usuarios = UsuarioDao::findAll();
                    // print_r($usuarios);
                    Base::response("HTTP/1.0 200", json_encode($usuarios));
                    # code...
                }
                break;

            case 'POST':
                if (isset($_POST["iniciar"])) {
                    if (isset($_POST['usuario']) && isset($_POST['password'])) {
                        $usuario = UsuarioDao::validarLogin($_POST['usuario'], $_POST['password']);
                        print_r($usuario);
                        if ($usuario) {
                            $_SESSION['usuario'] = $usuario;
                        } else {
                            print_r("haos");
                            Base::response("HTTP/1.0 401 Credenciales incorrectas");
                        }
                    } else {
                        Base::response("HTTP/1.0 400 Datos incompletos");
                    }
                    # code...
                } elseif (isset($_POST["registrarse"])) {
                    $u = new Usuario(null, $_POST["usuario"], $_POST["password"], $_POST["nombre"], $_POST["apellidos"], $_POST["telefono"], $_POST["altura"], $_POST["sexo"], $_POST["fechaNacimiento"], $_POST["tipoUsuario"]);

                    if (UsuarioDao::insert($u)) {
                        Base::response("HTTP/1.0 201 Usuario creado");
                    } else {
                        Base::response("HTTP/1.0 400 Error al crear usuario");
                    }
                } else {
                    Base::response("HTTP/1.0 400 Error");
                }
                break;

            case 'PUT':
                print_r($_SERVER['REQUEST_METHOD']);
                print_r($_POST);
                $u = UsuarioDao::findById($_POST["id"]);
                foreach ($_POST as $key => $value) {
                    $u->__set($key, $value);
                }
                $result = UsuarioDao::update($u);
                if ($result) {
                    Base::response("HTTP/1.0 200 Usuario actualizado");
                } else {
                    Base::response("HTTP/1.0 400 Error al actualizar usuario");
                }
                break;

            case 'DELETE':
                if (base::buscarFiltros(['id'])) {
                    echo "hola";
                    $result = UsuarioDao::delete(base::retornaValores("id"));
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
