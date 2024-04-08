<?
class UsuarioDao
{

    public static function findAll()
    {
        try {
            $sql = "SELECT * FROM usuarios";
            $parametros = array();
            $result = FactoryBd::realizarConsulta($sql, $parametros);

            $array_usuarios = array();

            while ($usuarioStd = $result->fetchObject()) {
                $usuario = new Usuario(
                    $usuarioStd->id,
                    $usuarioStd->usuario,
                    $usuarioStd->password,
                    $usuarioStd->nombre,
                    $usuarioStd->apellidos,
                    $usuarioStd->telefono,
                    $usuarioStd->altura,
                    $usuarioStd->sexo,
                    $usuarioStd->fechaNacimiento,
                    $usuarioStd->tipoUsuario
                );

                array_push($array_usuarios, $usuario);
            }

            // Close the database connection
            $result = null;
            // FactoryBd::cerrarConexion();

            return $array_usuarios;
        } catch (Exception $e) {
            // Handle the exception (e.g., log it, display an error message)
            error_log("Error al buscar usuarios: " . $e->getMessage());
            return array();
        }
    }

    public static function findById($id)
    {
        try {
            // Validar si $id es un entero
            if (!is_numeric($id)) {
                error_log("El ID proporcionado no es un entero.");
                return null;
            }

            $sql = "SELECT * FROM usuarios WHERE id = ?";
            $parametros = array($id);
            $result = FactoryBd::realizarConsulta($sql, $parametros);

            if ($result && $result->rowCount() > 0) {
                $usuarioStd = $result->fetchObject();
                $usuario = new Usuario(
                    $usuarioStd->id,
                    $usuarioStd->usuario,
                    $usuarioStd->password,
                    $usuarioStd->nombre,
                    $usuarioStd->apellidos,
                    $usuarioStd->telefono,
                    $usuarioStd->altura,
                    $usuarioStd->sexo,
                    $usuarioStd->fechaNacimiento,
                    $usuarioStd->tipoUsuario
                );
                return $usuario;
            } else {
                return null;
            }
        } catch (Exception $e) {
            // Handle the exception (e.g., log it, display an error message)
            error_log("Error al buscar usuario por ID: " . $e->getMessage());
            return null;
        }
    }

    public static function insert($usuarioStd)
    {
        try {
            $sql = "INSERT INTO usuarios (id, usuario, password, nombre, apellidos, telefono, altura, sexo, fechaNacimiento, tipoUsuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $parametros = array(
                $usuarioStd->id,
                $usuarioStd->usuario,
                $usuarioStd->password,
                $usuarioStd->nombre,
                $usuarioStd->apellidos,
                $usuarioStd->telefono,
                $usuarioStd->altura,
                $usuarioStd->sexo,
                $usuarioStd->fechaNacimiento,
                $usuarioStd->tipoUsuario
            );

            $result = FactoryBd::realizarConsulta($sql, $parametros);

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it, display an error message)
            error_log("Error al insertar usuario: " . $e->getMessage());
            return false;
        }
    }

    public static function update($usuarioActualizar)
    {
        try {
            $sql = "UPDATE usuarios SET usuario = ?, password = ?, nombre = ?, apellidos = ?, telefono = ?, altura = ?, sexo = ?, fechaNacimiento = ?, tipoUsuario = ? WHERE id = ?";
            $parametros = array(
                $usuarioActualizar->usuario,
                $usuarioActualizar->password,
                $usuarioActualizar->nombre,
                $usuarioActualizar->apellidos,
                $usuarioActualizar->telefono,
                $usuarioActualizar->altura,
                $usuarioActualizar->sexo,
                $usuarioActualizar->fechaNacimiento,
                $usuarioActualizar->tipoUsuario,
                $usuarioActualizar->id
            );

            $result = FactoryBd::realizarConsulta($sql, $parametros);

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it, display an error message)
            error_log("Error al actualizar usuario: " . $e->getMessage());
            return false;
        }
    }

    public static function validarLogin($nombre, $contra)
    {
        //return 1 objeto usuario
        $sql = "SELECT * FROM usuarios WHERE usuario = ? and password= ? ";
        $parametros = array($nombre, $contra);
        $result = FactoryBD::realizarConsulta($sql, $parametros);

        if ($result->rowCount() == 1) {
            $usuarioStd = $result->fetchObject();
            $usuario = new Usuario(
                $usuarioStd->usuario,
                $usuarioStd->password,
                $usuarioStd->nombre,
                $usuarioStd->apellidos,
                $usuarioStd->telefono,
                $usuarioStd->altura,
                $usuarioStd->sexo,
                $usuarioStd->fechaNacimiento,
                $usuarioStd->tipoUsuario,
                $usuarioStd->id

            );
            return $usuario;
        } else {
            return null;
        }
    }
    public static function repetido($nombre)
    {
        $sql = 'SELECT usuario FROM usuarios WHERE usuario = ?';
        $parametros = array($nombre);
        $result = FactoryBD::realizarConsulta($sql, $parametros);

        $usuario = $result->fetchObject();

        if ($usuario) {
            return true; // El usuario existe
        } else {
            return false; // El usuario no existe
        }
    }
    public static function delete($id)
    {
        try {
            $sql = "UPDATE usuarios SET activo = FALSE WHERE id = ?";
            $parametros = array($id);

            $result = FactoryBd::realizarConsulta($sql, $parametros);

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it, display an error message)
            error_log("Error al eliminar usuario: " . $e->getMessage());
            return false;
        }
    }
}
